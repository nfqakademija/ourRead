<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/17/15
 * Time: 6:28 PM
 */

namespace OurRead\OurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OurRead\LibraryBundle\Entity\Book;
use OurRead\LibraryBundle\Form\BookType;
use OurRead\LibraryBundle\Form\IsbnType;

class AddBookController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     */
    public function addBookAction(Request $request)
    {
        $form1 = $this->createForm(new IsbnType());
        $form1->handleRequest($request);

        $bookInfo = null;
        if ($form1->isValid()) {
            $bookInfo = $this->get('remote_library_service')
                ->getBookInfoByISBN(str_replace('-', '', $form1["isbn"]->getData()));


            if (empty($bookInfo)) {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Sorry, but there was no match found by your ISBN. Please fill data manually'
                );
            }
        }
        $book = new Book();
        $form2 = $this->createForm(new BookType($bookInfo), $book);
        $form2->handleRequest($request);

        if ($form2->isValid()) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $book->setOwner($user);
            $book->setPopularity(0);
            $book->setCreatedDate(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            if ($form2['bookCoverByUser']->getData() !== null) {
                $form2['bookCoverByUser']->getData()->move(__DIR__.'/../../../../web/uploads/', $book->getId());
            } else {
                $this->container->get('cover_uploader')
                    ->uploadBookCoverByImageLink($form2['bookCoverByWebService']->getData(), $book->getId());
            }
            return $this->redirectToRoute('OurHomepage', array(), 301);
        }

        //How many people requesting for books
        $requests = $this->get('news_status')->getNewsStatus();

        return $this->render('OurBundle:AddBook:index.html.twig', array(
            'form1' => $form1->createView(),
            'form2' => $form2->createView(),
            'bookCover' => (is_object($bookInfo))?$bookInfo->getImageLink():'',
            'requests' => $requests
        ));
    }
}
