<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/16/15
 * Time: 1:57 PM
 */

namespace OurRead\OrderBundle\Services;

use Doctrine\ORM\EntityManager;
use OurRead\OrderBundle\Entity\Orders;
use OurRead\LibraryBundle\Entity\Book;
use OurRead\UserBundle\Entity\Users;

class BookReservationService
{
    private $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function reserveBook(Book $book, Users $user)
    {
        $order = new Orders();
        $order->setUserId($user);
        $order->setBookId($book);
        $order->setStartDate(new \DateTime());
        $order->setEndDate(new \DateTime('0000-00-00'));
        $order->setOrderType(1);
        $order->setStatus(0);
        $order->setExtendedStatus(0);

        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }
}
