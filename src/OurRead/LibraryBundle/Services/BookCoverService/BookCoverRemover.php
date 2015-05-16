<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/5/15
 * Time: 11:46 PM
 */

namespace OurRead\LibraryBundle\Services\BookCoverService;

class BookCoverRemover extends BookCoverService
{
    /**
     * @param $fileName
     */
    public function removeBookCover($fileName)
    {
        unlink($this->getUploadRootDir().$fileName);
    }
}
