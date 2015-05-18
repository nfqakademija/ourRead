<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/15/15
 * Time: 7:42 PM
 */

namespace OurRead\OrderBundle\Services;

use Doctrine\Common\Persistence\ManagerRegistry;
use OurRead\LibraryBundle\Entity\Book;
use OurRead\UserBundle\Entity\Users;

class BookAvailabilityService
{

    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function getBookAvailabilityStatus(Book $book, Users $user)
    {
        $repository = $this->managerRegistry
            ->getManager()
            ->getRepository('OrderBundle:Orders');

        $repositoryBooks = $this->managerRegistry
            ->getManager()
            ->getRepository('OurRead\LibraryBundle\Entity\Book');



        $books = $repositoryBooks ->createQueryBuilder('books')
            ->where('books.owner = :ownerId')
            ->andWhere('books.id = :bookId')
            ->setParameter('bookId', $book)
            ->setParameter('ownerId', $user->getId())
            ->getQuery()
            ->getResult();
        $books=count($books);

        $orders = $repository->createQueryBuilder('orders')
            ->where('orders.status = 0')
            ->andWhere('orders.bookId = :book_id')
            ->setParameter('book_id', $book->getId())
            ->getQuery()
            ->getResult();

        if($books){
            return 'owner';
        }

        if (empty($orders)) {
            return 'available'; //Book is available to order
        }

        foreach ($orders as $order) {
            if ($order->getUserId() == $user) {
                if ( $order->getOrderType() === 0 && $order->getConfirmStatus() === 1 ) {
                    // if normal order

                    if (count($orders) === 1 && $order->getExtendedStatus() === 0) {
                        return 'prolongation'; // Book can be prolongate or returned
                    } else {
                        return 'return'; // Book can only by returned
                    }
                }
                if ($order->getOrderType() === 1) {
                    // if reservation

                    if (count($orders) === 1) {
                        return 'cancel_and_order'; // cancel reservation and order book
                    } else {
                        return 'cancel_reservation'; // reservation can be canceled
                    }
                }
            } else {
                if ($order->getOrderType() === 0) {
                    if (count($orders) === 2) {
                        // one normal and only one reservation

                        continue;
                    } else {
                        return 'reservation'; // book can be reserved
                    }
                } else {
                    return 'not_available';
                }
            }

            if($order->getConfirmStatus() === 0)    // waiting form confirm
                return 'waiting';
        }
        return 'available'; //Book is available to order
    }
}
