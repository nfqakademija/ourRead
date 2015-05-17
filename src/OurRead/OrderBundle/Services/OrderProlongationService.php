<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/16/15
 * Time: 12:58 PM
 */

namespace OurRead\OrderBundle\Services;

use Doctrine\Common\Persistence\ManagerRegistry;
use OurRead\LibraryBundle\Entity\Book;
use OurRead\UserBundle\Entity\Users;

class OrderProlongationService
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function extendOrder(Book $book, Users $user)
    {
        $entityManager = $this->managerRegistry->getManager();
        $repository = $entityManager
            ->getRepository('OrderBundle:Orders');
        $order = $repository->createQueryBuilder('orders')
            ->where('orders.status = 0')
            ->andWhere('orders.bookId = :book_id')
            ->andWhere('orders.userId = :user_id')
            ->setParameter('book_id', $book->getId())
            ->setParameter('user_id', $user->getId())
            ->getQuery()
            ->getSingleResult();
        $order->setExtendedStatus(1)
              ->setEndDate(new \DateTime($this->extendReturnDate($order->getEndDate())));
        $entityManager->flush();
    }

    private function extendReturnDate($returnDate)
    {
        $date = new \DateTime($returnDate->format('Y-m-d'));
        $date->add(new \DateInterval('P14D'));

        return $date->format('Y-m-d');
    }
}
