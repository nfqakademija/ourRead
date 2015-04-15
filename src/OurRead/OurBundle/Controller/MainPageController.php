<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/8/15
 * Time: 9:06 PM
 */
namespace OurRead\OurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OurRead\OurBundle\Entity\user2;

class MainPageController extends Controller
{

    public function indexAction(Request $request)
    {

        $user = new user2;
        $registerForm = $this->createFormBuilder($user)
            ->add('email', 'text')
            ->add('password', 'text')
            ->add('test', 'text')
            ->add('register', 'submit')
            ->getForm();
        $registerForm->handleRequest($request);

        if ($registerForm->isValid()) {

            $repository = $this->getDoctrine()
                ->getRepository('OurRead\OurBundle\Entity\user2');
            $em = $this->getDoctrine()->getManager();
            $emailCheck = $repository->findByEmail($user->getEmail());

            if ($emailCheck)
                return new Response("email is taken");
            else {
                $user->setPassword(sha1($user->getPassword()));
                $user->settest($user->getPassword());
                $em->persist($user);
                $em->flush();

            }

            return new Response  ("Your psw is safe" . sha1($user->getPassword()));

        }

        return $this->render('OurBundle:MainPage:index.html.twig', array(
            'rForm' => $registerForm->createView()
        ));
    }

}