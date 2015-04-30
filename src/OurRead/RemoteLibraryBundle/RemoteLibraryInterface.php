<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/9/15
 * Time: 9:11 PM
 */

namespace OurRead\RemoteLibraryBundle;

interface RemoteLibraryInterface
{
    /**
     * @param $isbn
     * @return mixed
     */
    public function getBookInfoByISBN($isbn);
}
