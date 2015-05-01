<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/1/15
 * Time: 2:53 PM
 */

namespace OurRead\LibraryBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use OurRead\LibraryBundle\Entity\Book;

class LoadBookData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->removeUploadsDirectory();

        foreach ($this->getBookList() as $book) {
            $bookData = new Book();
            $bookData->setTitle($book['title']);
            $bookData->setAuthor($book['author']);
            $bookData->setPublisher($book['publisher']);
            $bookData->setPublishedDate($book['publishedDate']);
            foreach ($book['category'] as $categoryName) {
                $bookData->addCategory($this->getReference($categoryName));
            }
            $bookData->setPageCount($book['pageCount']);
            $bookData->setLanguage($book['language']);
            $bookData->setIsbn($book['isbn']);
            $bookData->setDescription($book['description']);
            $bookData->setOwner($book['owner']);

            $manager->persist($bookData);
            $manager->flush();

            $fileName = $bookData->getId();

            $this->container->get('cover_uploader_service')
            ->uploadBookCoverByImageLink($book['imageLink'], $fileName);
        }
    }

    /**
     * @return array
     */
    private function getBookList()
    {
        $bookList[] = array(
           'title' => 'The Nightingale',
           'author' => 'Kristin Hannah',
           'publisher' => 'Macmillan',
           'publishedDate' => new \DateTime('2015-02-13'),
           'category' => array(
               'Drama',
               'Romance',
               ),
            'pageCount' => 448,
            'language' => 'en',
            'isbn' => '0312577222',
            'description' => "From the #1 New York Times bestselling author comes Kristin Hannah's next novel. It is an epic love story and family drama set at the dawn of World War II. She is the author of twenty-one novels. Her previous novels include Home Front, Night Road, Firefly Lane, Fly Away, and Winter Garden",
            'imageLink' => 'http://bks8.books.google.lt/books/content?id=B6eQBQAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api',
            'owner' => 1
        );

        $bookList[] = array(
            'title' => 'The Girl on the Train',
            'author' => 'Paula Hawkins',
            'publisher' => 'Riverhead Books (Hardcover)',
            'publishedDate' => new \DateTime('2015-01-13'),
            'category' => array(
                'Adventure',
            ),
            'pageCount' => 321,
            'language' => 'en',
            'isbn' => '1594633665',
            'description' => "Obsessively watching a breakfasting couple every day to escape the pain of her losses, Rachel witnesses a shocking event that inextricably entangles her in the lives of strangers.",
            'imageLink' => 'http://bks4.books.google.lt/books/content?id=IevnoAEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api',
            'owner' => 1
        );

        $bookList[] = array(
            'title' => 'All the Light We Cannot See',
            'author' => 'Anthony Doerr',
            'publisher' => 'Simon and Schuster',
            'publishedDate' => new \DateTime('2014-01-13'),
            'category' => array(
                'Children',
            ),
            'pageCount' => 121,
            'language' => 'en',
            'isbn' => '1476746583',
            'description' => "A blind French girl on the run from the German occupation and a German orphan-turned-Resistance tracker struggle with their respective beliefs after meeting on the Brittany coast. By the award-winning author of About Grace.",
            'imageLink' => 'http://bks9.books.google.lt/books/content?id=_AZ_AwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api',
            'owner' => 1
        );
        return $bookList;
    }
    /**
     * @return int
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }

    /**
     * Remove uploads folder within files inside
     */
    private function removeUploadsDirectory()
    {
        $target = __DIR__.'/../../../../../web/uploads/';
        $files = glob($target.'*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        rmdir($target);
    }
}
