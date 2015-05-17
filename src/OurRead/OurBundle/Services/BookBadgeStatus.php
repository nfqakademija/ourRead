<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/16/15
 * Time: 5:31 PM
 */

namespace OurRead\OurBundle\Services;

use Doctrine\ORM\EntityManager;

class BookBadgeStatus
{

    private $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function addBadgeStatus($books)
    {
        foreach($books as $key => $book)
        {
            $repository = $this->entityManager
                ->getRepository('OrderBundle:Orders');
            $orders = $repository->createQueryBuilder('orders')
                ->where('orders.status = 0')
                ->andWhere('orders.bookId = :book_id')
                ->andWhere('orders.confirmStatus = 1')
                ->setParameter('book_id', $book->getId())
                ->getQuery()
                ->getResult();
            if(!empty($orders))
            {
                $books[$key]->badge = false; // book is taken
            }
            else
            {
                $books[$key]->badge = true; // book is available
            }
        }
        return $books;
    }

}
