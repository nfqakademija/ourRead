<?php
/**
 * Created by PhpStorm.
 * User: Dovius
 * Date: 2015-04-23
 */
namespace OurRead\OurBundle\Controller;

use OurRead\LibraryBundle\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserPageController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('OurRead\LibraryBundle\Entity\Book');
        $repositoryOrders = $this->getDoctrine()->getRepository('OurRead\OrderBundle\Entity\Orders');
        $user = $this->container->get('security.context')->getToken()->getUser();
        $books = $repository->findByOwner($user->getId());

        //How many books Im reading
        $query = $repositoryOrders->createQueryBuilder('o')
            ->where('o.userId = :userId')
            ->Andwhere('o.orderType = 0')
            ->andWhere('o.status = 0')
            ->andWhere('o.confirmStatus = 1')
            ->setParameter('userId', $user->getId())
            ->getQuery();
        $reading=$query->getResult();

        //How many books I finished
        $query = $repositoryOrders->createQueryBuilder('o')
            ->where('o.userId = :userId')
            ->Andwhere('o.orderType = 0')
            ->andWhere('o.status = 1')
            ->andWhere('o.confirmStatus = 1')
            ->setParameter('userId', $user->getId())
            ->getQuery();
        $finished=$query->getResult();

        $stats= array(
            "read" => count($books),
            "reading" => count($reading),
            "finished" =>count($finished)
        );

        //How many people requesting for books
        $requests = $this->get('news_status')->getNewsStatus();

        //Reading books
        $query = $repositoryOrders->createQueryBuilder('o')
            ->leftJoin('o.bookId', 'b')
            ->where('b.owner = :userId')
            ->Andwhere('o.orderType = 0')
            ->andWhere('o.status = 0')
            ->setParameter('userId', $user->getId())
            ->getQuery();
        $readingBooks=$query->getResult();   //Books which are reading by other readers

        return $this->render('OurBundle:UserPage:user.html.twig',
            array('books' =>$books,
                  'requests' => $requests,
                  'readingBooks' => $readingBooks,
                   'stats' => $stats
            ));
    }

    public function deleteAction($id)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('OurRead\LibraryBundle\Entity\Book');
        $books = $repository->findBy(
            array('owner' => $user->getId(), 'id' => $id)
        );

        if (count($books)) {
            $book=$this->getDoctrine()->getRepository('OurRead\LibraryBundle\Entity\Book')->find($id);
            $em->remove($book);
            $em->flush();
            $this->container->get('cover_remover')->removeBookCover($id);
            return $this->redirectToRoute('UserPage', array(), 301);
        }
        return new Response('You have no permission');
    }

    public function confirmAction($id)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('OurRead\LibraryBundle\Entity\Book');
        $books = $repository->findBy(
            array('owner' => $user->getId(), 'id' => $id)
        );

        if (count($books)) {

            $order=$this->getDoctrine()->getRepository('OurRead\OrderBundle\Entity\Orders')->findOneByBookId($id);
            $order->setConfirmStatus(1);
            $em->flush();

            return $this->redirectToRoute('UserPage', array(), 301);
        }
        return new Response('You have no permission');
    }

    public function cancelAction($id)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('OurRead\LibraryBundle\Entity\Book');
        $books = $repository->findBy(
            array('owner' => $user->getId(), 'id' => $id)
        );

        if (count($books)) {

            $order=$this->getDoctrine()->getRepository('OurRead\OrderBundle\Entity\Orders')->findOneByBookId($id);
            $em->remove($order);
            $em->flush();

            return $this->redirectToRoute('UserPage', array(), 301);
        }
        return new Response('You have no permission');
    }
}
