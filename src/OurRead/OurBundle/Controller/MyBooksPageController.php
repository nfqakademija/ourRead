<?php
/**
 * Created by PhpStorm.
 * User: dovius
 * Date: 4/24/15
 * Time: 2:32 PM
 */

namespace OurRead\OurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpFoundation\Request;

class MyBooksPageController extends Controller
{

    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('OurRead\LibraryBundle\Entity\Book');
        $repositoryOrders = $this->getDoctrine()->getRepository('OurRead\OrderBundle\Entity\Orders');
        $user = $this->container->get('security.context')->getToken()->getUser();

        //Shared books
        $books = $repository->findByOwner($user->getId());

        //Reading books
        $query = $repositoryOrders->createQueryBuilder('o')
            ->where('o.userId = :id')
            ->Andwhere('o.orderType = 0')
            ->andWhere('o.status = 0')
            ->andWhere('o.confirmStatus = 1')
            ->setParameter('id', $user->getId())
            ->getQuery();
        $reading=$query->getResult();

        //finished books
        $query = $repositoryOrders->createQueryBuilder('o')
            ->where('o.userId = :id')
            ->Andwhere('o.orderType = 0')
            ->andWhere('o.status = 1')
            ->setParameter('id', $user->getId())
            ->getQuery();
        $finished=$query->getResult();

        //waiting books
        $query = $repositoryOrders->createQueryBuilder('o')
            ->where('o.userId = :id')
            ->Andwhere('o.orderType = 1')
            ->andWhere('o.status = 0')
            ->setParameter('id', $user->getId())
            ->getQuery();
        $waiting=$query->getResult();

        return $this->render('OurBundle:MyBooksPage:MyBooks.html.twig', array(
            'myBooks' => $books,
            'readingBooks' => $reading,
            'finishedBooks' => $finished,
            'waitingBooks' => $waiting
        ));
    }
}
