<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/15/15
 * Time: 5:54 PM
 */

namespace OurRead\OurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function createOrderAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $book= $em->getRepository('LibraryBundle:Book')->find($id);
        $user = $this->container->get('security.context')->getToken()->getUser();
        $status = $this->get('check_book_availability')->getBookAvailabilityStatus($book, $user);
        if($book && $user && $status === 'available') {
            $this->get('create_order')->createOrder($book, $user);

            return new JsonResponse(array(
                'message' => 'Book order was successful!',
            ), 200);
        }
        else{
            return new JsonResponse(array(
                'message' => 'Something goes wrong. Try again later',
            ), 400);
        }
    }

    public function extendOrderAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $book= $em->getRepository('LibraryBundle:Book')->find($id);
        $user = $this->container->get('security.context')->getToken()->getUser();
        $status = $this->get('check_book_availability')->getBookAvailabilityStatus($book, $user);
        if($book && $user && $status === 'prolongation') {
            $this->get('extend_order')->extendOrder($book, $user);

            return new JsonResponse(array(
                'message' => "Book's order return time was extended successfully!",
            ), 200);
        }
        else{
            return new JsonResponse(array(
                'message' => 'Something goes wrong. Try again later',
            ), 400);
        }
    }

    public function reserveBookAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $book= $em->getRepository('LibraryBundle:Book')->find($id);
        $user = $this->container->get('security.context')->getToken()->getUser();
        $status = $this->get('check_book_availability')->getBookAvailabilityStatus($book, $user);
        if($book && $user && $status === 'reservation') {
            $this->get('reserve_book')->reserveBook($book, $user);

            return new JsonResponse(array(
                'response' => "Book's reservation was successful!"
            ), 200);
        }
        else{
            return new JsonResponse(array(
                'response' => 'Something goes wrong. Try again later'
            ), 400);
        }
    }

    public function returnBookAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $book= $em->getRepository('LibraryBundle:Book')->find($id);
        $user = $this->container->get('security.context')->getToken()->getUser();
        $status = $this->get('check_book_availability')->getBookAvailabilityStatus($book, $user);
        if($book && $user && $status === 'return') {
            $this->get('return_book')->returnBook($book, $user);

            return new JsonResponse(array(
                'response' => "Book was returned successfully!"
            ), 200);
        }
        else{
            return new JsonResponse(array(
                'response' => 'Something goes wrong. Try again later'
            ), 400);
        }
    }

    public function cancelReservationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $book= $em->getRepository('LibraryBundle:Book')->find($id);
        $user = $this->container->get('security.context')->getToken()->getUser();
        $status = $this->get('check_book_availability')->getBookAvailabilityStatus($book, $user);
        if($book && $user && $status === 'cancel_reservation') {
            $this->get('cancel_reservation')->cancelReservation($book, $user);

            return new JsonResponse(array(
                'response' => "Reservation was canceled successfully!"
            ), 200);
        }
        else{
            return new JsonResponse(array(
                'response' => 'Something goes wrong. Try again later'
            ), 400);
        }
    }

    public function cancelAndOrderAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $book= $em->getRepository('LibraryBundle:Book')->find($id);
        $user = $this->container->get('security.context')->getToken()->getUser();
        $status = $this->get('check_book_availability')->getBookAvailabilityStatus($book, $user);
        if($book && $user && $status === 'cancel_and_order') {
            $this->get('cancel_reservation')->cancelReservation($book, $user);
            $this->get('create_order')->createOrder($book, $user);

            return new JsonResponse(array(
                'response' => "Book order was successful!!"
            ), 200);
        }
        else{
            return new JsonResponse(array(
                'response' => 'Something goes wrong. Try again later'
            ), 400);
        }
    }
} 