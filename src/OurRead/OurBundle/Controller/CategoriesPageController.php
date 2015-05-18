<?php
/**
 * Created by PhpStorm.
 * User: Dovius
 * Date: 2015-04-23
 */
namespace OurRead\OurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpFoundation\Request;

class CategoriesPageController extends Controller
{
    public function indexAction()
    {
        //How many readers are requesting for your books
        $requests = $this->get('news_status')->getNewsStatus();

        return $this->render('OurBundle:CategoriesPage:categories.html.twig', array(
            'requests' => $requests
        ));
    }
}
