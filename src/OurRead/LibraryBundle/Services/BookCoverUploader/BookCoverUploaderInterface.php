<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/1/15
 * Time: 3:45 PM
 */

namespace OurRead\LibraryBundle\Services\FileUploader;

interface BookCoverUploaderInterface
{
    public function uploadBookCoverByImageLink($imageLink, $fileName);
}
