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
    public function __construct(GoogleLibraryParser $parser, BookInfo $bookInfo)
    {
        $this->parser = $parser;
        $this->bookInfo = $bookInfo;
    }
    /**
     * @param $isbn
     * @return mixed
     */
    public function getBookInfoByIsbn($isbn)
    {
        if (!$this->parser->getBookInfoFromWebService($isbn)) {
            return false;
        }
        $this->bookInfo->setAuthor($this->parser->getBookInfoFromWebService($isbn)->author);
        $this->bookInfo->setTitle($this->parser->getBookInfoFromWebService($isbn)->title);
        $this->bookInfo->setPublisher($this->parser->getBookInfoFromWebService($isbn)->publisher);
        $this->bookInfo->setPublishedDate($this->parser->getBookInfoFromWebService($isbn)->publishedDate);
        $this->bookInfo->setDescription($this->parser->getBookInfoFromWebService($isbn)->description);
        $this->bookInfo->setCategory($this->parser->getBookInfoFromWebService($isbn)->category);
        $this->bookInfo->setPageCount($this->parser->getBookInfoFromWebService($isbn)->pageCount);
        $this->bookInfo->setLanguage($this->parser->getBookInfoFromWebService($isbn)->language);
        $this->bookInfo->setImageLink($this->parser->getBookInfoFromWebService($isbn)->imageLink);
        $this->bookInfo->setIsbn($isbn);

        return $this->bookInfo;
    }
}
