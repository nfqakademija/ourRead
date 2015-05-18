<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/10/15
 * Time: 7:34 PM
 */

namespace OurRead\OurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchResultController extends Controller
{
    public function searchResultAction(Request $request)
    {
        $search= $request->query->get('search');

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('LibraryBundle:Book');

        //How many readers are requesting for your books
        $requests = $this->get('news_status')->getNewsStatus();

        $query = $repository->createQueryBuilder('book')
            ->leftJoin('book.categories', 'c')
            ->where('book.author LIKE :search')
            ->orWhere('book.title LIKE :search')
            ->orWhere('book.publisher LIKE :search')
            ->orWhere('book.description LIKE :search')
            ->orWhere('book.isbn LIKE :search')
            ->orWhere('c.category LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery();
        $pagination  = $this->get('knp_paginator')
                            ->paginate(
                                $query,
                                $request->query->get('page', 1)/*page number*/,
                                8/*limit per page*/
                            );
        return $this->render('OurBundle:Search:SearchResult.html.twig', array(
                'search' => $search,
                'pagination' => $pagination,
                'requests' => $requests
            )
        );
    }
}
