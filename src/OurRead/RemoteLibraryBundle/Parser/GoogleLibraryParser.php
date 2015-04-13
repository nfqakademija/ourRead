<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/9/15
 * Time: 11:37 PM
 */

namespace OurRead\RemoteLibraryBundle\Parser;



class GoogleLibraryParser extends Parser
{
    const URL = 'https://www.googleapis.com/books/v1/volumes?';

    public $title;
    public $author;
    public $publisher;
    public $publishedDate;
    public $description;
    public $pageCount;
    public $category;
    public $language;
    public $imageLink;

    private $unprocessedResponse;
    private $volumeInfo;


    function parsedBookInfo()
    {
        $this->getResponseFromGoogleLibrary();
        return $this;
    }

    function getResponseFromGoogleLibrary()
    {
        $this->unprocessedResponse = json_decode(file_get_contents(self::URL.'q='.$this->ISBN));
        $this->constructBookInfo();
    }

    function constructBookInfo()
    {
        $this->volumeInfo = $this->unprocessedResponse->items[0]->volumeInfo;
        $this->title = $this->volumeInfo->title;
        $this->author = $this->volumeInfo->authors[0];
        $this->publisher = $this->volumeInfo->publisher;
        $this->publishedDate = $this->volumeInfo->publishedDate;
        $this->description = $this->volumeInfo->description;
        $this->pageCount = $this->volumeInfo->pageCount;
        $this->category = $this->volumeInfo->categories[0];
        $this->language = $this->volumeInfo->language;
        $this->imageLink = $this->volumeInfo->imageLinks->thumbnail;
    }

}