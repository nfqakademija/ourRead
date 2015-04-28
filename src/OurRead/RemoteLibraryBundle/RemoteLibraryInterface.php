<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/9/15
 * Time: 9:11 PM
 */

namespace OurRead\RemoteLibraryBundle;

interface RemoteLibraryInterface {
    /**
     * @param $ISBN
     * @return mixed
     */
    function getBookInfoByISBN($ISBN);
} 