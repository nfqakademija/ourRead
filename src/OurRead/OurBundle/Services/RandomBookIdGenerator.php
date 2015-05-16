<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/15/15
 * Time: 5:43 PM
 */

namespace OurRead\OurBundle\Services;

class RandomBookIdGenerator
{

    public function randBookGenerator($query, $count)
    {
        if (count($query) < $count) {
            $count = count($query);
        }
        $randomKeys = array_rand($query, $count);
        shuffle($randomKeys);
        $randomBooks = array();
        foreach ($randomKeys as $number) {
            $randomBooks[] = $query[$number];
        }
        return $randomBooks;
    }
}
