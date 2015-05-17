<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/15/15
 * Time: 5:34 PM
 */

namespace OurRead\OrderBundle\Services;

use Doctrine\Common\Persistence\ManagerRegistry;
use OurRead\OrderBundle\Entity\Orders;
use OurRead\LibraryBundle\Entity\Book;
use OurRead\UserBundle\Entity\Users;

class CreateOrderService
{

    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function createOrder(Book $book, Users $user)
    {
        $order = new Orders();
        $order->setUserId($user);
        $order->setBookId($book);
        $order->setStartDate(new \DateTime());
        $order->setEndDate(new \DateTime($this->getReturnDate()));
        $order->setOrderType(0);
        $order->setStatus(0);
        $order->setExtendedStatus(0);
        $order->setConfirmStatus(0);

        $book->setPopularity($book->getPopularity() + 1);

        $entityManager = $this->managerRegistry->getManager();
        $entityManager->persist($order);
        $entityManager->flush();
    }

    private function getReturnDate()
    {
        $date = new \DateTime();
        $dateAfterOneMonth = new \DateInterval('P1M');
        $date->add($dateAfterOneMonth);

        return $date->format('Y-m-d');
    }
}
