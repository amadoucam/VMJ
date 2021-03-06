<?php

namespace Vmj\VmjBundle\Repository;

/**
 * PresseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PresseRepository extends \Doctrine\ORM\EntityRepository
{

    public function validePresse() {
        $qb = $this->createQueryBuilder('i')
            ->Select('i')
            ->Where('i.name is not null')
            ->andWhere('i.date is not null')
            ->orderBy('i.date', 'DESC');
        return $qb->getQuery()->getResult();
    }

}
