<?php

namespace AppBundle\Repository;

/**
 * PhotoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PhotoRepository extends \Doctrine\ORM\EntityRepository
{

	public function findPhotosByEvent(\AppBundle\Entity\Event $event)
    {
        return $this->createQueryBuilder('p')
            ->where('p.event = :eventid')
            ->setParameter('eventid', $event->getId())
            ->getQuery();
    }


	public function findNextPhoto(\AppBundle\Entity\Photo $photo)
    {
        return $this->createQueryBuilder('p')
            ->where('p.event = :eventId')
            ->andWhere('p.captureDate >= :photoCaptureDate')
            ->andWhere('p.id <> :photoId')
            ->setParameter('eventId', $photo->getEvent()->getId())
            ->setParameter('photoId', $photo->getId())
            ->setParameter('photoCaptureDate', $photo->getCaptureDate())
            ->setMaxResults(1)
            ->getQuery();
    }

    public function findPreviousPhoto(\AppBundle\Entity\Photo $photo)
    {
        return $this->createQueryBuilder('p')
            ->where('p.event = :eventId')
            ->andWhere('p.captureDate <= :photoCaptureDate')
            ->andWhere('p.id <> :photoId')
            ->setParameter('eventId', $photo->getEvent()->getId())
            ->setParameter('photoId', $photo->getId())
            ->setParameter('photoCaptureDate', $photo->getCaptureDate())
            ->setMaxResults(1)
            ->getQuery();
    }
}
