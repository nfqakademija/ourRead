<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/9/15
 * Time: 9:53 PM
 */

namespace OurRead\RemoteLibraryBundle\Parser;


abstract class Parser
{
    protected $ISBN;

    abstract public function parsedBookInfo();

    public function getBookInfoFromWS($ISBN)
    {
        $this->ISBN = $ISBN;
        return $this->parsedBookInfo();
    }

}