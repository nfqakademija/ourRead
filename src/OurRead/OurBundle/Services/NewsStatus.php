<?php
/**
 * Created by PhpStorm.
 * User: dovius
 * Date: 5/18/15
 * Time: 10:51 AM
 */

namespace OurRead\OurBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class NewsStatus
{
    protected $em;

    public function __construct(EntityManager $em, ContainerInterface $container)
    {
        $this->entityManager = $em;
        $this->container = $container;
    }

    public function getNewsStatus()
    {
        $repository = $this->entityManager
            ->getRepository('OrderBundle:Orders');

        $user = $this->container->get('security.context')->getToken()->getUser();

        $securityContext = $this->container->get('security.context');



        if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){

        $query = $repository->createQueryBuilder('o')
            ->leftJoin('o.bookId', 'b')
            ->where('b.owner = :userId')
            ->Andwhere('o.orderType = 0')
            ->andWhere('o.status = 0')
            ->andWhere('o.confirmStatus = 0')
            ->setParameter('userId', $user->getId())
            ->getQuery();
        $requests=$query->getResult();
        $requests=count($requests);

        return $requests;
        }

        return 0;

    }

}
