<?php

namespace Vmj\VmjBundle\Repository;

/**
 * NewscontactRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewscontactRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function findistinct() {
        $qb = $this->createQueryBuilder('i')
            ->Select('i')
         ->groupBy('i.email');
        return $qb->getQuery()->getResult();
    }
}
