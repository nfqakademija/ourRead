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
use OurRead\LibraryBundle\Entity\BookCover;
use OurRead\LibraryBundle\Form\BookType;
use OurRead\LibraryBundle\Form\BookCoverType;


class AddBookController extends Controller
{

    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $allBook = $em->getRepository('OurRead\LibraryBundle\Entity\Book')->findAll();
var_dump($allBook);
        die;


        return $this->render('OurBundle:AddBook:index.html.twig');
    }

    public function saveAction(Request $request)
    {
        $form1 = $this->createFormBuilder()
            ->add('isbn', 'text', array(
                'label' => 'Fill book data by ISBN'
            ))
            ->add('search', 'submit', array(
                'attr' => array(
                    'class'=>'btn-info'
                )
            ))
            ->getForm();
        $form1->handleRequest($request);

        $bookInfo = null;
        if ($form1->isValid())
        {
            $bookInfo = $this->get('remote_library_service')
                ->getBookInfoByISBN(str_replace('-','',$form1["isbn"]->getData()));
            if(!$bookInfo)
            {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Sorry, but there was no match found by your ISBN. Please fill data manually'
                );
            }
        }

        $book = new Book();

        $form2 = $this->createForm(new BookType($bookInfo), $book);
        $form2->handleRequest($request);
        if ($form2->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $book->setOwner('OurRead');
            $em->persist($book);
            $em->flush();
            $form2['bookCover']->getData()->move(__DIR__.'/../../../../web/test/',$book->getId());
            return new Response('<html><body>Knyga prideta sekmingai</body></html>');
        }
        return $this->render('OurBundle:AddBook:index.html.twig', array(
            'form1' => $form1->createView(),
            'form2' => $form2->createView(),
            'bookInfo' => $bookInfo,
        ));
    }
} 