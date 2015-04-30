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
        $repository = $this->getDoctrine()
            ->getRepository('OurRead\LibraryBundle\Entity\Book');
        $books = $repository->findOneBy(
            array('owner' => 1)
        );

        return $this->render('OurBundle:UserPage:user.html.twig',
        array('books'=>$books));
    }
}
