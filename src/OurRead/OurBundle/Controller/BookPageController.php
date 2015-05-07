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
        $repository = $this->getDoctrine()->getRepository('OurRead\LibraryBundle\Entity\Book');
        $bookData = $repository->findOneById($id);
        if (!$bookData) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }
        return $this->render('OurBundle:BookPage:book.html.twig', array('book_data' => $bookData));
    }
}
