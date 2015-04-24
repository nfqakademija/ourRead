<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/9/15
 * Time: 9:17 PM
 */

namespace OurRead\RemoteLibraryBundle\Parser;


class OpenLibraryParser extends Parser
{
    const URL = 'https://openlibrary.org/api/books?';

    private $bookInfo;

    function parsedBookInfo()
    {
        $response = $this->getResponseFromOpenLibrary();
        return $this->bookInfo;
    }

    function getResponseFromOpenLibrary()
    {
        $unprocessedResponse = json_decode(file_get_contents(self::URL .
            'bibkeys=ISBN:' . $this->ISBN . '&format=json'));
    }
}