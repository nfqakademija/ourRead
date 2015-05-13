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
            $bookData->setCreatedDate($book['createdDate']);
            $bookData->setPopularity($book['popularity']);

            $manager->persist($bookData);
            $manager->flush();

            $fileName = $bookData->getId();

            $this->container->get('cover_uploader')
            ->uploadBookCoverByImageLink($book['imageLink'], $fileName);
        }
    }

    /**
     * @return array
     */
    private function getBookList()
    {
        $bookList = array();

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
            'owner' => 1,
            'createdDate' => new \DateTime('2014-05-11'),
            'popularity' => 23
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
            'owner' => 1,
            'createdDate' => new \DateTime('2015-05-11'),
            'popularity' => 2
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
            'owner' => 1,
            'createdDate' => new \DateTime('2015-05-11'),
            'popularity' => 0
        );
        $bookList[] = array(
            'title' => 'A Clockwork Orange',
            'author' => 'Anthony Burgess',
            'publisher' => 'W. W. Norton',
            'publishedDate' => new \DateTime('1995-04-17'),
            'category' => array(
                'Fiction',
            ),
            'pageCount' => 240,
            'language' => 'en',
            'isbn' => '0393312836',
            'description' => "Great Music, it said, and Great Poetry would like quieten Modern Youth down and make Modern Youth more Civilized. Civilized my syphilised yarbles. A vicious fifteen-year-old droog is the central character of this 1963 classic. In Anthony Burgess's nightmare vision of the future, where the criminals take over after dark, the story is told by the central character, Alex, who talks in a brutal invented slang that brilliantly renders his and his friends' social pathology. ",
            'imageLink' => 'http://bks2.books.google.lt/books/content?id=Kb5_Q0_AILIC&printsec=frontcover&img=1&zoom=1&source=gbs_api',
            'owner' => 1,
            'createdDate' => new \DateTime(),
            'popularity' => 13
        );
        $bookList[] = array(
            'title' => 'Fight Club: A Novel',
            'author' => 'Chuck Palahniuk',
            'publisher' => 'W. W. Norton & Company',
            'publishedDate' => new \DateTime('2005-10-17'),
            'category' => array(
                'Fiction',
                'Mystery',
                'Horror'
            ),
            'pageCount' => 218,
            'language' => 'en',
            'isbn' => '0393327345',
            'description' => "In a confusing world poised on the brink of mayhem, Tyler Durden, a projectionist, waiter, and anarchic genius, comes up with an idea to create clubs in which young men can escape their humdrum existence and prove themselves in barehanded fights. Reprint. 50,000 first printing.",
            'imageLink' => 'http://bks5.books.google.lt/books/content?id=SzfvHXu_5t8C&printsec=frontcover&img=1&zoom=1&source=gbs_api',
            'owner' => 1,
            'createdDate' => new \DateTime('2014-04-17'),
            'popularity' => 4
        );
        $bookList[] = array(
            'title' => 'Girls in Pants',
            'author' => 'Ahban Azer',
            'publisher' => 'zeki books',
            'publishedDate' => new \DateTime('2004-12-15'),
            'category' => array(
                'Romance',
                'Drama'
            ),
            'pageCount' => 240,
            'language' => 'en',
            'isbn' => '0385732317',
            'description' => "The Pants first came to us at the perfect moment. That is, when we were splitting up for the first time. It was two summers ago when they first worked their magic, and last summer when they shook up our lives once again. You see, we donâ€™t wear the Pants year-round. We let them rest so they are extra powerful when summer comes. (There was the time this spring when Carmen wore them to her momâ€™s wedding, but that was a special case.) Now weâ€™re facing our last summer together.",
            'imageLink' => 'http://bks6.books.google.lt/books/content?id=UKQDCQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api',
            'owner' => 1,
            'createdDate' => new \DateTime('2015-05-12'),
            'popularity' => 4
        );
        $bookList[] = array(
            'title' => 'A Tree Grows in Brooklyn',
            'author' => 'Betty Smith',
            'publisher' => 'Harper Perennial',
            'publishedDate' => new \DateTime('2014-09-16'),
            'category' => array(
                'Fiction',
            ),
            'pageCount' => 624,
            'language' => 'en',
            'isbn' => '0062096958',
            'description' => "The beloved American classic about a young girl's coming-of-age at the turn of the century, Betty Smith's A Tree Grows in Brooklyn is a poignant and moving tale filled with compassion and cruelty, laughter and heartache, crowded with life and people and incident. The story of young, sensitive, and idealistic Francie Nolan and her bittersweet formative years in the slums of Williamsburg has enchanted and inspired millions of readers for more than sixty years.",
            'imageLink' => 'http://bks4.books.google.lt/books/content?id=KbSPuAAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api',
            'owner' => 1,
            'createdDate' => new \DateTime('2015-04-17'),
            'popularity' => 13
        );
        $bookList[] = array(
            'title' => 'City of Bones',
            'author' => 'Cassandra Clare',
            'publisher' => 'Margaret K. McElderry',
            'publishedDate' => new \DateTime('2008-02-19'),
            'category' => array(
                'Fiction',
                'History'
            ),
            'pageCount' => 485,
            'language' => 'en',
            'isbn' => '9781416955078',
            'description' => "Suddenly able to see demons and the Darkhunters who are dedicated to returning them to their own dimension, fifteen-year-old Clary Fray is drawn into this bizzare world when her mother disappears and Clary herself is almost killed by a monster.",
            'imageLink' => 'http://bks8.books.google.lt/books/content?id=N25JAQAAIAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api',
            'owner' => 1,
            'createdDate' => new \DateTime('2015-05-13'),
            'popularity' => 9
        );
        $bookList[] = array(
            'title' => 'Feed',
            'author' => 'M. T. Anderson',
            'publisher' => 'Candlewick Press (MA)',
            'publishedDate' => new \DateTime('2012-10-17'),
            'category' => array(
                'Fiction',
            ),
            'pageCount' => 299,
            'language' => 'en',
            'isbn' => '0763662623',
            'description' => "In a future where most people have computer implants in their heads to control their environment, a boy meets an unusual girl who is in serious trouble.",
            'imageLink' => 'http://bks4.books.google.lt/books/content?id=NAHvnQEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api',
            'owner' => 1,
            'createdDate' => new \DateTime(),
            'popularity' => 7
        );
        $bookList[] = array(
            'title' => 'I Know What You Did Last Summer',
            'author' => 'Lois Duncan',
            'publisher' => 'Little, Brown Books for Young Readers',
            'publishedDate' => new \DateTime('2010-10-05'),
            'category' => array(
                'Fiction',
                'Horror'
            ),
            'pageCount' => 224,
            'language' => 'en',
            'isbn' => '031609899X',
            'description' => "Some secrets just won't stay buried. They didn't mean it. They didn't mean to hit the boy. There was a party, and it was an accident...that wasn't who they were. They were pre-law, a football player, bound for New York. No one could know, so Barry, Julie, Helen, and Ray swore one another to secrecy. But now, a year later, someone knows. Julie receives a haunting, anonymous threat: 'I know what you did last summer.' The dark lie is unearthed, and before the four friends know it they need to outsmart a killer",
            'imageLink' => 'http://bks1.books.google.lt/books/content?id=swnwRAAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api',
            'owner' => 1,
            'createdDate' => new \DateTime('2014-04-17'),
            'popularity' => 9
        );
        $bookList[] = array(
            'title' => 'Monster',
            'author' => 'Walter Dean Myers',
            'publisher' => 'Amistad',
            'publishedDate' => new \DateTime('2001-05-08'),
            'category' => array(
                'Fiction',
            ),
            'pageCount' => 304,
            'language' => 'en',
            'isbn' => '0064407314',
            'description' => "FADE IN: INTERIOR: Early morning in CELL BLOCK D, MANHATTAN DETENTION CENTER. Steve (Voice-Over) Sometimes I feel like I have walked into the middle of a movie. Maybe I can make my own movie. The film will be the story of my life. No, not my life, but of this experience. I'll call it what the lady prosecutor called me ... Monster.",
            'imageLink' => 'http://bks5.books.google.lt/books/content?id=tcr0ii90BrcC&printsec=frontcover&img=1&zoom=1&source=gbs_api',
            'owner' => 1,
            'createdDate' => new \DateTime(''),
            'popularity' => 0
        );
        $bookList[] = array(
            'title' => 'The Boy in the Striped Pajamas',
            'author' => 'John Boyne',
            'publisher' => 'Ember',
            'publishedDate' => new \DateTime('2006-10-17'),
            'category' => array(
                'History',
                'Drama',
            ),
            'pageCount' => 231,
            'language' => 'en',
            'isbn' => '0385751532',
            'description' => "Bored and lonely after his family moves from Berlin to a place called 'Out-With'' in 1942, Bruno, the son of a Nazi officer, befriends a boy in striped pajamas who lives behind a wire fence. Reprint.",
            'imageLink' => 'http://bks1.books.google.lt/books/content?id=dpCzx9Ho52UC&printsec=frontcover&img=1&zoom=1&source=gbs_api',
            'owner' => 1,
            'createdDate' => new \DateTime('2014-04-17'),
            'popularity' => 4
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
        if (is_dir($target)) {
            $files = glob($target.'*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($target);
        }
    }
}
