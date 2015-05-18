<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/18/15
 * Time: 9:51 PM
 */

namespace OurRead\OrderBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use OurRead\OrderBundle\Entity\Orders;


class LoadOrderData  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $order = new Orders();
        $order->setUserId($this->getReference('user1'));
        $order->setBookId($this->getReference('book3'));
        $order->setStartDate(new \DateTime());
        $order->setEndDate(new \DateTime($this->getReturnDate()));
        $order->setOrderType(0);
        $order->setStatus(0);
        $order->setExtendedStatus(0);
        $order->setConfirmStatus(0);
        $manager->persist($order);

        $order = new Orders();
        $order->setUserId($this->getReference('user1'));
        $order->setBookId($this->getReference('book4'));
        $order->setStartDate(new \DateTime());
        $order->setEndDate(new \DateTime($this->getReturnDate()));
        $order->setOrderType(0);
        $order->setStatus(0);
        $order->setExtendedStatus(0);
        $order->setConfirmStatus(0);
        $manager->persist($order);

        $manager->flush();

    }

    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }

    private function getReturnDate()
    {
        $date = new \DateTime();
        $dateAfterOneMonth = new \DateInterval('P1M');
        $date->add($dateAfterOneMonth);

        return $date->format('Y-m-d');
    }
} 