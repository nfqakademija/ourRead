<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/23/15
 * Time: 11:30 PM
 */

namespace OurRead\LibraryBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OurRead\LibraryBundle\Entity\Category;

class LoadCategoryData implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getCategoriesList() as $row) {
            $category = new Category();
            $category->setCategory($row);
            $manager->persist($category);
        }
        $manager->flush();
    }

    private function getCategoriesList()
    {
        $categoriesList = array(
            'Science fiction',
            'Satire',
            'Drama',
            'Action',
            'Adventure',
            'Romance',
            'Mystery',
            'Horror',
            'Self help',
            'Guide',
            'Travel',
            'Children',
            'Religious',
            'Science',
            'History',
            'Math',
            'Anthology',
            'Poetry',
            'Encyclopedia',
            'Dictionary',
            'Comic',
            'Art',
            'Cookbook',
            'Diary',
            'Biography',
            'Autobiography',
            'Fantasy'
        );

        return $categoriesList;
    }

} 