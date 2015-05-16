<?php

namespace OurRead\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
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
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setEmail('email@domain.com');
        $user->setPlainPassword('password');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_ADMIN'));
        $userManager->updateUser($user, true);

        $user2 = $userManager->createUser();
        $user2->setUsername('user');
        $user2->setEmail('email1@domain.com');
        $user2->setPlainPassword('password');
        $user2->setEnabled(true);
        $user2->setRoles(array('ROLE_USER'));
        $userManager->updateUser($user2, true);

        $user3 = $userManager->createUser();
        $user3->setUsername('Cipolinas');
        $user3->setEmail('email2@domain.com');
        $user3->setPlainPassword('password');
        $user3->setEnabled(true);
        $user3->setRoles(array('ROLE_USER'));
        $userManager->updateUser($user3, true);

        $user4 = $userManager->createUser();
        $user4->setUsername('nezinaitis');
        $user4->setEmail('email3@domain.com');
        $user4->setPlainPassword('password');
        $user4->setEnabled(true);
        $user4->setRoles(array('ROLE_USER'));
        $userManager->updateUser($user4, true);
    }
}