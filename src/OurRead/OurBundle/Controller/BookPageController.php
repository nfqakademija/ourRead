<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/8/15
 * Time: 9:06 PM
 */
namespace OurRead\OurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class BookPageController extends Controller
{
    public function indexAction($id)
    {
        return $this->render('OurBundle:BookPage:book.html.twig',array('book_id' => $id));
    }
}