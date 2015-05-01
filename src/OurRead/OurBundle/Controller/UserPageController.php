<?php
/**
 * Created by PhpStorm.
 * User: Dovius
 * Date: 2015-04-23
 */
namespace OurRead\OurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserPageController extends Controller
{
    public function indexAction()
    {

        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('OurRead\LibraryBundle\Entity\Book')->findByOwner($user->getId());

        return $this->render('OurBundle:UserPage:user.html.twig',
        array('books'=>$books));
    }
}
