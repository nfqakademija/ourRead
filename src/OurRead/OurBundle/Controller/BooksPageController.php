<?php
/**
 * Created by PhpStorm.
 * User: dovius
 * Date: 5/5/15
 * Time: 9:06 PM
 */
namespace OurRead\OurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OurRead\LibraryBundle\Entity\Book;
use Symfony\Component\HttpFoundation\Response;

class BooksPageController extends Controller
{

    public function indexAction()
    {
        return $this->render('');
    }
}
