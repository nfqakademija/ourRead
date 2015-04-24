<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/9/15
 * Time: 9:04 PM
 */

namespace OurRead\RemoteLibraryBundle;

use OurRead\RemoteLibraryBundle\Parser\GoogleLibraryParser;

class RemoteLibraryService
{
    private $parser;
    private $bookInfo;

    /**
     * @param GoogleLibraryParser $parser
     * @param BookInfo $bookInfo
     */
    function __construct(GoogleLibraryParser $parser, BookInfo $bookInfo)
    {
        $this->parser = $parser;
        $this->bookInfo = $bookInfo;
    }

    /**
     * @param $ISBN
     * @return mixed
     */
    function getBookInfoByISBN($ISBN)
    {
        if(!$this->parser->getBookInfoFromWS($ISBN))
        {
            return false;
        }
        $this->bookInfo->setAuthor($this->parser->getBookInfoFromWS($ISBN)->author);
        $this->bookInfo->setTitle($this->parser->getBookInfoFromWS($ISBN)->title);
        $this->bookInfo->setPublisher($this->parser->getBookInfoFromWS($ISBN)->publisher);
        $this->bookInfo->setPublishedDate($this->parser->getBookInfoFromWS($ISBN)->publishedDate);
        $this->bookInfo->setDescription($this->parser->getBookInfoFromWS($ISBN)->description);
        $this->bookInfo->setCategory($this->parser->getBookInfoFromWS($ISBN)->category);
        $this->bookInfo->setPageCount($this->parser->getBookInfoFromWS($ISBN)->pageCount);
        $this->bookInfo->setLanguage($this->parser->getBookInfoFromWS($ISBN)->language);
        $this->bookInfo->setImageLink($this->parser->getBookInfoFromWS($ISBN)->imageLink);
        $this->bookInfo->setIsbn($ISBN);

        return $this->bookInfo;
    }
}