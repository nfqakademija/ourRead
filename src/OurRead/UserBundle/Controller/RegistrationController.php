<?php

namespace OurRead\UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

class RegistrationController extends BaseController
{
    public function confirmedAction()
    {
        $confirmed=1;

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('LibraryBundle:Book');
        // most recent books
        $newBooks = $repository->createQueryBuilder('book')
            ->orderBy('book.createdDate', 'DESC')
            ->getQuery()
            ->setMaxResults(8)
            ->getResult();

        // most popular books
        $popularBooks = $repository->createQueryBuilder('book')
            ->orderBy('book.popularity', 'DESC')
            ->getQuery()
            ->setMaxResults(8)
            ->getResult();

        // get 12 random books for slide
        $query=$repository->createQueryBuilder('book')
            ->getQuery()
            ->getResult();

        $randomKeys = array_rand($query, 12);
        shuffle($randomKeys);
        $randomBooks = array();
        foreach ($randomKeys as $number) {
            $randomBooks[] = $query[$number];
        }

        return $this->render('OurBundle:MainPage:index.html.twig', array(
            'confirmed' => $user,
            'newBooks' => $newBooks,
            'popularBooks' => $popularBooks,
            'randomBooks' =>$randomBooks
        ));
    }
}
