<?php

namespace OurRead\RemoteLibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RemoteLibraryBundle:Default:index.html.twig', array('name' => $name));
    }
}
