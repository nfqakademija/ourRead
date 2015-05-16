<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/16/15
 * Time: 3:55 PM
 */

namespace OurRead\OrderBundle\Services;

use Doctrine\ORM\EntityManager;
use OurRead\LibraryBundle\Entity\Book;
use OurRead\UserBundle\Entity\Users;

class CancelReservationService
{
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function cancelReservation(Book $book, Users $user)
    {
        $repository = $this->entityManager
            ->getRepository('OrderBundle:Orders');
        $order = $repository->createQueryBuilder('orders')
            ->where('orders.status = 0')
            ->andWhere('orders.bookId = :book_id')
            ->andWhere('orders.userId = :user_id')
            ->andWhere('orders.orderType = 1')
            ->setParameter('book_id', $book->getId())
            ->setParameter('user_id', $user->getId())
            ->getQuery()
            ->getSingleResult();
        $order->setStatus(1);
        $this->entityManager->flush();
    }
}
