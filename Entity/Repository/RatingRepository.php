<?php

namespace Desarrolla2\Bundle\BlogBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * RatingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RatingRepository extends EntityRepository
{

    /**
     * @param $entityName
     * @param $entityId
     *
     * @return int
     */
    public function getRatingFor($entityName, $entityId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('n', 'n', 'integer');

        return (int) $this->getEntityManager()
            ->createNativeQuery(
                ' SELECT SUM(r.rating) as n ' .
                ' FROM rating AS r' .
                ' WHERE r.entity_name = :entityName ' .
                ' AND r.entity_id = :entityId ',
                $rsm
            )
            ->setParameter('entityName', $entityName)
            ->setParameter('entityId', $entityId)
            ->getSingleScalarResult();
    }

    /**
     * @param $entityName
     * @param $entityId
     *
     * @return int
     */
    public function getVotesFor($entityName, $entityId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('n', 'n', 'integer');

        return (int) $this->getEntityManager()
            ->createNativeQuery(
                ' SELECT COUNT(*) as n ' .
                ' FROM rating AS r' .
                ' WHERE r.entity_name = :entityName ' .
                ' AND r.entity_id = :entityId ',
                $rsm
            )
            ->setParameter('entityName', $entityName)
            ->setParameter('entityId', $entityId)
            ->getSingleScalarResult();
    }
}
