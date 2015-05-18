<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/23/15
 * Time: 11:30 PM
 */

namespace OurRead\LibraryBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OurRead\LibraryBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getCategoriesList() as $categoryName) {
            $category = new Category();
            $category->setCategory($categoryName);
            $manager->persist($category);
            $this->addReference($categoryName, $category);
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
            'Fantasy',
            'Fiction'
        );

        return $categoriesList;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
