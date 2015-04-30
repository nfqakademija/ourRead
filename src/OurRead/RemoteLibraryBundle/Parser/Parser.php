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
    protected $isbn;

    abstract public function parsedBookInfo();

    public function getBookInfoFromWebService($isbn)
    {
        $this->isbn = $isbn;
        return $this->parsedBookInfo();
    }
}
