<?php

namespace OurRead\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use OurRead\UserBundle\Entity\Users;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface,OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    public function load(ObjectManager $manager)
    {
        $user0 = new Users();
        $user0->setUsername('Povilas');
        $user0->setEmail('kruger99@gmail.com');
        $user0->setPlainPassword('nfq');
        $user0->setEnabled(true);
        $user0->setRoles(array('ROLE_ADMIN'));



        $user = new Users();
        $user->setUsername('admin');
        $user->setEmail('email@domain.com');
        $user->setPlainPassword('password');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_ADMIN'));



        $user2 = new Users();
        $user2->setUsername('user');
        $user2->setEmail('email1@domain.com');
        $user2->setPlainPassword('password');
        $user2->setEnabled(true);
        $user2->setRoles(array('ROLE_USER'));



        $user3 = new Users();
        $user3->setUsername('Cipolinas');
        $user3->setEmail('email2@domain.com');
        $user3->setPlainPassword('password');
        $user3->setEnabled(true);
        $user3->setRoles(array('ROLE_USER'));



        $user4 = new Users();
        $user4->setUsername('nezinaitis');
        $user4->setEmail('email3@domain.com');
        $user4->setPlainPassword('password');
        $user4->setEnabled(true);
        $user4->setRoles(array('ROLE_USER'));

        $manager->persist($user0);
        $manager->persist($user);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->persist($user4);

        $manager->flush();

        $this->addReference('user1', $user0);
        $this->addReference('user2', $user);
        $this->addReference('user3', $user2);
        $this->addReference('user4', $user3);
        $this->addReference('user5', $user4);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
