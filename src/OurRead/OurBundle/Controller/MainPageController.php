<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/8/15
 * Time: 9:06 PM
 */
namespace OurRead\OurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class MainPageController extends Controller
{
    public function indexAction()
    {
        return $this->render('OurBundle:MainPage:index.html.twig');
    }
}