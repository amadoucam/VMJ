<?php

namespace Vmj\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * user_profileRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserProfileRepository extends EntityRepository
{
    public function search($keys){
        $qb = $this->createQueryBuilder('u')
                ->Select('u')
                ->Where('u.firstname LIKE :keys')
                ->orWhere('u.lastname LIKE :keys')
                ->setParameter('keys', '%'.$keys.'%')
                ->andWhere('u.type = 2');
        return $qb->getQuery()->getResult();
    }

    public function findAllPro(){
        $qb = $this->createQueryBuilder('u')
            ->Select('u')
            ->Where('u.type = 2')
            ->orderBy('u.updated', 'DESC');
        return $qb->getQuery()->getResult();
    }

    public function findAllParticulier(){
        $qb = $this->createQueryBuilder('u')
            ->Select('u')
            ->Where('u.type = 1')
            ->orderBy('u.updated', 'DESC');
        return $qb->getQuery()->getResult();
    }

    /* Pour page statistiques */
    public function countAllParticuliers()
    {
        return $this->createQueryBuilder('u')
        ->Select('COUNT(u)')
        ->Where('u.type = 1')
        ->getQuery()
        ->getSingleScalarResult();
    }

    public function countAllParticuliersWomen()
    {
        return $this->createQueryBuilder('u')
        ->Select('COUNT(u)')
        ->Where('u.type = 1')
        ->andWhere("u.sexe = 'F'")
        ->getQuery()
        ->getSingleScalarResult();
    }

    public function countAllParticuliersMen()
    {
        return $this->createQueryBuilder('u')
        ->Select('COUNT(u)')
        ->Where('u.type = 1')
        ->andWhere("u.sexe = 'M'")
        ->getQuery()
        ->getSingleScalarResult();
    }

    public function countAllPro()
    {
        return $this->createQueryBuilder('u')
        ->Select('COUNT(u)')
        ->Where('u.type = 2')
        ->getQuery()
        ->getSingleScalarResult();
    }

    public function countAllProWomen()
    {
        return $this->createQueryBuilder('u')
        ->Select('COUNT(u)')
        ->Where('u.type = 2')
        ->andWhere("u.sexe = 'F'")
        ->getQuery()
        ->getSingleScalarResult();
    }

    public function countAllProMen()
    {
        return $this->createQueryBuilder('u')
        ->Select('COUNT(u)')
        ->Where('u.type = 2')
        ->andWhere("u.sexe = 'M'")
        ->getQuery()
        ->getSingleScalarResult();
    }
}
