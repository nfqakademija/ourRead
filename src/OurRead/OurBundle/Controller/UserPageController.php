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
        $user = $this->container->get('security.context')->getToken()->getUser();
        $books = $repository->findByOwner($user->getId());
        return $this->render('OurBundle:UserPage:user.html.twig',
            array('books'=>$books));
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
}
