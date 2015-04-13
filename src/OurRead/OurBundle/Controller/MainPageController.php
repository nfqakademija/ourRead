<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/8/15
 * Time: 9:06 PM
 */
namespace OurRead\OurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class MainPageController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('OurBundle:MainPage:index.html.twig');
    }

    public function labasAction()
    {
$url='https://openlibrary.org/api/books?bibkeys=ISBN:0495011606&format=jsoning-php';
        $ch = curl_init();
// Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
// Execute
        $result=curl_exec($ch);
// Closing
        curl_close($ch);
        $result = substr($result, 18);
        $result = substr($result,0,-1);

       //$response  = file_get_contents('https://openlibrary.org/api/books?bibkeys=ISBN:0201558025&format=jsoning-php');
       $json_data = json_decode($result, true);
        var_dump($json_data);
        die;
        return $this->render('OurBundle:MainPage:index.html.twig');
    }
}