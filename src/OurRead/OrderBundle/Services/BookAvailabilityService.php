<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/15/15
 * Time: 7:42 PM
 */

namespace OurRead\OrderBundle\Services;

use Doctrine\ORM\EntityManager;
use OurRead\LibraryBundle\Entity\Book;
use OurRead\UserBundle\Entity\Users;

class BookAvailabilityService {

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function getBookAvailabilityStatus(Book $book,Users $user)
    {

        $repository = $this->entityManager
            ->getRepository('OrderBundle:Orders');
        $orders = $repository->createQueryBuilder('orders')
            ->where('orders.status = 0')
            ->andWhere('orders.bookId = :book_id')
            ->setParameter('book_id',$book->getId())
            ->getQuery()
            ->getResult();
        if(empty($orders)){
            return 'available'; //Book is available to order
        }
        foreach($orders as $order)
        {
            if($order->getUserId() == $user)
            {
                if($order->getOrderType() === 0) // if normal order
                {
                    if(count($orders) === 1 && $order->getExtendedStatus() === 0){
                        return 'prolongation'; // Book can be prolongate or returned
                    }
                    else{
                        return 'return'; // Book can only by returned
                    }
                }
                if($order->getOrderType() === 1) // if reservation
                {
                    if(count($orders) === 1 )
                    {
                        return 'cancel_and_order'; // cancel reservation and order book
                    }
                    else
                    {
                        return 'cancel_reservation'; // reservation can be canceled
                    }
                }
            }
            else{
                if($order->getOrderType() === 0) {
                    if(count($orders) === 2) // one normal and only one reservation
                    {
                        continue;
                    }
                    else
                    {
                        return 'reservation'; // book can be reserved
                    }
                }
                else
                {
                    return 'not_available';
                }
            }

        }
        return 'available'; //Book is available to order
    }
} 