<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/16/15
 * Time: 3:28 PM
 */

namespace OurRead\OrderBundle\Services;

use Doctrine\Common\Persistence\ManagerRegistry;
use OurRead\LibraryBundle\Entity\Book;
use OurRead\UserBundle\Entity\Users;

class EndOrderService
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function endOrder(Book $book, Users $user,$orderType)
    {
        $entityManager = $this->managerRegistry->getManager();
        $repository = $entityManager
            ->getRepository('OrderBundle:Orders');
        $order = $repository->createQueryBuilder('orders')
            ->where('orders.status = 0')
            ->andWhere('orders.bookId = :book_id')
            ->andWhere('orders.userId = :user_id')
            ->andWhere('orders.orderType = :order_type')
            ->setParameter('book_id', $book->getId())
            ->setParameter('user_id', $user->getId())
            ->setParameter('order_type', $orderType)
            ->getQuery()
            ->getSingleResult();
        $order->setStatus(1);
        $entityManager->flush();
    }
}
