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

    /**
     * @return $this|bool
     */
    public function parsedBookInfo()
    {
        return $this->getResponseFromGoogleLibrary();
    }

    private function getResponseFromGoogleLibrary()
    {
        $content = file_get_contents(self::URL.'q='.$this->ISBN);
        if($content === false)
        {
            return false;
        }
        $this->unprocessedResponse = json_decode($content);
        return $this->constructBookInfo();
    }

    /**
     * @return $this|bool
     */
    private function constructBookInfo()
    {
        if ($this->unprocessedResponse->totalItems === 0)
        {
            return false;
        }
        else
        {
            if(!empty($this->unprocessedResponse->items[0]))
            {
                $this->volumeInfo = $this->unprocessedResponse->items[0]->volumeInfo;
                $this->title = $this->parseTitle();
                $this->author = $this->parseAuthor();
                $this->publisher = $this->parsePublisher();
                $this->publishedDate = $this->parsePublishedDate();
                $this->description = $this->parseDescription();
                $this->pageCount = $this->parsePageCount();
                $this->category = $this->parseCategory();
                $this->language = $this->parseLanguage();
                $this->imageLink = $this->parseImageLink();
            }
            else
            {
                return false;
            }
        }
        return $this;


    }

    private function parseTitle ()
    {
        if(!empty($this->volumeInfo->title))
        {
            return $this->volumeInfo->title;
        }
        else
        {
            return '';
        }
    }

    private function parseAuthor ()
    {
        if(!empty($this->volumeInfo->authors[0]))
        {
            return $this->volumeInfo->authors[0];
        }
        else
        {
            return '';
        }
    }
    private function parsePublisher()
    {
        if(!empty($this->volumeInfo->publisher))
        {
            return $this->volumeInfo->publisher;
        }
        else
        {
            return '';
        }
    }

    private function parsePublishedDate()
    {
        if(!empty($this->volumeInfo->publishedDate))
        {
            return $this->volumeInfo->publishedDate;
        }

    }

    private function parseDescription()
    {
        if (!empty($this->volumeInfo->description))
        {
            return $this->volumeInfo->description;
        }
        else
        {
            return '';
        }
    }

    private function parsePageCount()
    {
        if(!empty($this->volumeInfo->pageCount))
        {
           return $this->volumeInfo->pageCount;
        }
        else
        {
            return '';
        }
    }

    /**
     * @return string
     */
    private function parseCategory()
    {
        if(!empty($this->volumeInfo->categories[0]))
        {
            return $this->volumeInfo->categories[0];
        }
        else
        {
            return '';
        }
    }

    private function parseLanguage()
    {
        if (!empty($this->volumeInfo->language))
        {
            return $this->volumeInfo->language;
        }
        else
        {
            return '';
        }
    }

    private function parseImageLink()
    {   $image = $this->volumeInfo->imageLinks->thumbnail;
        if (!empty($image))
        {
            return $image;
        }
        else
        {
            return '';
        }
    }
}