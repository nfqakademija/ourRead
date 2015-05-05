<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/9/15
 * Time: 9:04 PM
 */

namespace OurRead\RemoteLibraryBundle;

use OurRead\RemoteLibraryBundle\Parser\GoogleLibraryParser;

class RemoteLibraryService implements RemoteLibraryInterface
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
        if (!$bookInfo = $this->parser->getBookInfoFromWebService($isbn)) {
            return false;
        }

        $this->bookInfo->setAuthor($bookInfo->author);
        $this->bookInfo->setTitle($bookInfo->title);
        $this->bookInfo->setPublisher($bookInfo->publisher);
        $this->bookInfo->setPublishedDate($bookInfo->publishedDate);
        $this->bookInfo->setDescription($bookInfo->description);
        $this->bookInfo->setCategory($bookInfo->category);
        $this->bookInfo->setPageCount($bookInfo->pageCount);
        $this->bookInfo->setLanguage($bookInfo->language);
        $this->bookInfo->setImageLink($bookInfo->imageLink);
        $this->bookInfo->setIsbn($isbn);

        return $this->bookInfo;
    }
}
