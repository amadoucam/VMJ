<?php

namespace Vmj\VmjBundle\Repository;

/**
 * MessagesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MessagesRepository extends \Doctrine\ORM\EntityRepository
{
     public function compteNonLus($destinataire) {
        $qb = $this->createQueryBuilder('u')
                ->Select('count(u.id)')
                ->Where('u.destinataire = :destinataire')
                ->andWhere('u.lu != 1')
                ->setParameter('destinataire', $destinataire);
        return $qb->getQuery()->getResult();
    }
}
