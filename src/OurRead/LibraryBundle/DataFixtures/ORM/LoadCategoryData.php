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
        $category = new Category();
        
        $category->setCategory('Fiction');
        $manager->persist($category);
        $manager->flush();

    }

} 