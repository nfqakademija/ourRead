<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/1/15
 * Time: 3:26 PM
 */


namespace OurRead\LibraryBundle\Services\BookCoverService;

class BookCoverUploader extends BookCoverService
{
    /**
     * @param $imageLink
     * @param $fileName
     */
    public function uploadBookCoverByImageLink($imageLink, $fileName)
    {
        if (!is_dir($this->getUploadRootDir())) {
            mkdir($this->getUploadRootDir());
        }
        file_put_contents($this->getUploadRootDir().$fileName, file_get_contents($imageLink));
    }
}
