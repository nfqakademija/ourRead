<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/8/15
 * Time: 9:06 PM
 */
namespace OurRead\OurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use OurRead\LibraryBundle\Entity\Book;
use Symfony\Component\HttpFoundation\Response;


class BookPageController extends Controller
{
    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($id)
    {
        return $this->render('OurBundle:BookPage:book.html.twig', array('book_id' => $id));
    }

    /**
     * @param $id
     * @return Response
     */
    public function saveBookAction($id)
    {
        $bookInfo = $this->get('remote_library_service')->getBookInfoByISBN($id);
        $book = new Book();
        $book->setAuthor($bookInfo->getAuthor())
            ->setTitle($bookInfo->getTitle())
            ->setPublishedDate($bookInfo->getPublishedDate())
            ->setPublisher($bookInfo->getPublisher())
            ->setDescription($bookInfo->getDescription())
            ->setPageCount((int)$bookInfo->getPageCount())
            ->setLanguage($bookInfo->getLanguage())
            ->setIsbn($bookInfo->getIsbn())
            ->setOwner('OurRead');
        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $em->flush();

        return new Response('Created book id '.$book->getId());
    }
}