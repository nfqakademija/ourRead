<?php
/**
 * Created by PhpStorm.
 * User: dovius
 * Date: 5/5/15
 * Time: 9:06 PM
 */
namespace OurRead\OurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OurRead\LibraryBundle\Entity\Book;
use Symfony\Component\HttpFoundation\Response;

class BooksPageController extends Controller
{

    public function indexAction(Request $request)
    {


        //How many readers are requesting for your books
        $requests = $this->get('news_status')->getNewsStatus();

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('LibraryBundle:Book');

        $query = $repository->createQueryBuilder('book')
            ->leftJoin('book.categories', 'c')
            ->getQuery();
        $pagination  = $this->get('knp_paginator')
            ->paginate(
                $query,
                $request->query->get('page', 1)/*page number*/,
                10/*limit per page*/
            );
        return $this->render('OurBundle:BooksPage:books.html.twig', array(
                'pagination' => $pagination,
                'requests' =>$requests
            )
        );
    }
}
