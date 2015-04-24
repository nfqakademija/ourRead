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

    public function indexAction(){


        return $this->render('OurBundle:MyBooksPage:MyBooks.html.twig');
    }



}