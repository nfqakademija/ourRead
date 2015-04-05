<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }
    
    /**
    * @Route("/book", name="book")
    */
        public function bookAction()
    {
        return $this->render('AppBundle:Default:book.html.twig');
    }
    
}
