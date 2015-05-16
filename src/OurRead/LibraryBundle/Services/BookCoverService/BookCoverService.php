<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/1/15
 * Time: 3:45 PM
 */

namespace OurRead\LibraryBundle\Services\BookCoverService;

abstract class BookCoverService
{
    /**
     * @return string
     */
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();
    }

    /**
     * @return string
     */
    protected function getUploadDir()
    {
        return 'uploads/';
    }
}
