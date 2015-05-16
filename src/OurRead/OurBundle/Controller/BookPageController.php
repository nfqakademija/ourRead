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
     * @return Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $book= $em->getRepository('LibraryBundle:Book')->find($id);
        $user = $this->container->get('security.context')->getToken()->getUser();

        if(is_object($user) && $book){
            $status = $this->get('check_book_availability')->getBookAvailabilityStatus($book, $user);
        }
        else{
            $status = 'no_action';
        }
        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }
        return $this->render('OurBundle:BookPage:book.html.twig', array(
                'book_data' => $book,
                'book_status' => $status,
            )
        );
    }
}
