<?php

namespace AppBundle\Repository;

/**
 * VideoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VideoRepository extends \Doctrine\ORM\EntityRepository
{

	public function findVideosByEvent(\AppBundle\Entity\Event $event)
    {
        return $this->createQueryBuilder('v')
            ->where('v.event = :eventid')
            ->setParameter('eventid', $event->getId())
            ->getQuery();
    }

}
