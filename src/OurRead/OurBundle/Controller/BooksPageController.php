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
use Doctrine\ORM\EntityRepository;
use OurRead\LibraryBundle\Form\CategoryFilterType;
use Symfony\Component\HttpFoundation\Response;

class BooksPageController extends Controller
{

    public function indexAction(Request $request)
    {
        $filter = $this->createForm(new CategoryFilterType());
        $filter->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('LibraryBundle:Book');

        $query = $repository->createQueryBuilder('book')
            ->leftJoin('book.categories', 'c')
            ->getQuery();

        //How many people requesting for books
        $requests = $this->get('news_status')->getNewsStatus();

        $pagination  = $this->get('knp_paginator')
            ->paginate(
                $query,
                $request->query->get('page', 1)/*page number*/,
                10/*limit per page*/
            );
        return $this->render('OurBundle:BooksPage:books.html.twig', array(
                'pagination' => $pagination,
                'filter' => $filter->createView(),
                'requests' => $requests
            )
        );
    }

    public function categoryFilterAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('LibraryBundle:Book');
        $query = $repository->createQueryBuilder('book')
            ->leftJoin('book.categories', 'c')
            ->where('c.category IN (:categories)')
            ->setParameter('categories', $request->query->get('category'))
            ->getQuery();
        $pagination  = $this->get('knp_paginator')
            ->paginate(
                $query,
                $request->query->get('page', 1)/*page number*/,
                10/*limit per page*/
            );
        return $this->render('OurBundle:BooksPage:categories.html.twig', array(
                'pagination' => $pagination,
            )
        );
    }
}
