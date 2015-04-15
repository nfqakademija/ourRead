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

    public function dbAction(Request $request)
    {
        $user = new user2();
        $user->setEmail("labas@ok.shityday");
        $user->setPassword("ok");
        $user->setTest("ok");

        $form = $this->createFormBuilder($user)
            ->add('email', 'text')
            ->add('password', 'text')
            ->add('test', 'text')
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database

            return new Response("SEKAS");
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));

        $validator = $this->get("validator");
        $errors = $validator->validate($user);

        if ($errors)
            var_dump($errors);

        return new Response("labas");
    }


    public function db2Action(Request $request)
    {
        $user = new user2();
        $user->setEmail("labas@ok.shityday");
        $user->setPassword("ok");
        $user->setTest("ok");

        $form = $this->createFormBuilder($user)
            ->add('email', 'text')
            ->add('password', 'text')
            ->add('test', 'text')
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();

        var_dump($form);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database

            return new Response("SEKAS");
        }

        return $this->render('default/test.html');

        $validator = $this->get("validator");
        $errors = $validator->validate($user);

        if ($errors)
            var_dump($errors);

        return new Response("labas");
    }


    public function labasAction()
    {
        $url = 'https://openlibrary.org/api/books?bibkeys=ISBN:0495011606&format=jsoning-php';
        $ch = curl_init();
// Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
// Execute
        $result = curl_exec($ch);
// Closing
        curl_close($ch);
        $result = substr($result, 18);
        $result = substr($result, 0, -1);

        //$response  = file_get_contents('https://openlibrary.org/api/books?bibkeys=ISBN:0201558025&format=jsoning-php');
        $json_data = json_decode($result, true);
        var_dump($json_data);
        die;
        return $this->render('OurBundle:MainPage:index.html.twig');
    }
}