<?php

namespace Vmj\VmjBundle\Repository;

use Vmj\VmjBundle\Entity\Metier;
use Vmj\UserBundle\Entity\UserProfile;
use Vmj\VmjBundle\Entity\Immersion;


/**
 * ImmersionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ImmersionRepository extends \Doctrine\ORM\EntityRepository {
    public function findAllByUpdatedDate() {
        $qb = $this->createQueryBuilder('i')
            ->Select('i')
            ->OrderBy('i.updated', 'DESC');
        return $qb->getQuery()->getResult();
    }

    public function valideImmersion() {
        $qb = $this->createQueryBuilder('i')
            ->Select('i')
            ->leftJoin('i.categories', 'c')
            ->addSelect('c')
            ->Where('i.weekprice is not null')
            ->andWhere('i.actifAdmin = 1');
        return $qb->getQuery()->getResult();
    }   

    /* Pour tri par catégorie */
    public function valideImmersionByCategorie($categorie) {
        $qb = $this->createQueryBuilder('i')
            ->Select('i')
            ->leftJoin('i.categories', 'c')
            ->addSelect('c')
            ->Where('i.weekprice is not null')
            ->andWhere('i.actifAdmin = 1')
            ->andWhere('c = :categories')
            ->setParameter('categories', $categorie);
        return $qb->getQuery()->getResult();
    }  

    public function findByProfessionnalAndStatut($idPro, $statut) {
        $qb = $this->createQueryBuilder('i')
                ->Select('i')
                ->join('Vmj\VmjBundle\Entity\Metier', 'm', 'WITH', 'i.metier = m.id')
                ->Where('m.professionnel = :idPro')
                ->andWhere('i.statut = :statut')
                ->setParameter('idPro', $idPro)
                ->setParameter('statut', $statut);
        return $qb->getQuery()->getResult();
    }

    public function immersionsByProfessionnal($id) {
        /*   $qb = $this->createQueryBuilder('i')
          ->Select('i')
          ->join('Vmj\VmjBundle\Entity\Metier', 'm', 'WITH', 'i.metier = m.id')
          ->Where('m.professionnel = :id')
          ->setParameter('id', $id);
          return $qb->getQuery()->getResult(); */
        $qb = $this->createQueryBuilder('i')
                ->Select('i')
                ->Where('i.professionnel = :id')
               // ->andWhere('i.actifAdmin = 1')
                ->setParameter('id', $id);
        return $qb->getQuery()->getResult();
    }

    public function findByProfessionnal($id) {
        $qb = $this->createQueryBuilder('i')
                ->Select('i')
                ->leftJoin('i.categories', 'c')
                ->addSelect('c')
                ->Where('i.professionnel = :id')
                ->setParameter('id', $id);
        return $qb->getQuery()->getResult();
    }

    public function findWithCategories($id) {
        $qb = $this->createQueryBuilder('i')
            ->Select('i')
            ->leftJoin('i.categories', 'c')
            ->addSelect('c')
            ->Where('i.id = :id')
            ->setParameter('id', $id);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function myParticuliersImmersions($idParticuliers) {
        $qb = $this->createQueryBuilder('i')
                ->Select('i')
                ->Join('VmjBundle:Formation', 'f', 'With', 'f.immersion = i.id')
                ->Where('f.customer = :idParticuliers')
                ->setParameter('idParticuliers', $idParticuliers);
        return $qb->getQuery()->getResult();
    }

    public function findCommandesByProfessional($id) {
        $qb = $this->createQueryBuilder('i')
                ->Select('i')->distinct()
                ->innerJoin('Vmj\VmjBundle\Entity\Immersion', 'i', 'With', 'f.immersion = i.id')
                ->innerJoin('Vmj\VmjBundle\Entity\Metier', 'm', 'With', 'i.metier = m.id')
                ->Where('m.professionnel = :id')
                ->setParameter('id', $id)
                ->andWhere('f.statut = 2')
                ->orderBy('i.id');
        return $qb->getQuery()->getResult();
    }

    public function recherche($metier, $lieu = null, $periode = null, $motCle = null) {
        $qb = $this->createQueryBuilder('i')
                ->Select('i')
                ->join('Vmj\UserBundle\Entity\UserProfile', 'u', 'WITH', 'i.professionnel = u.id')
                ->where('i.actifAdmin = 1');

        $keys = explode(' ', $metier);
        $query = '';
        $cpt = 0;
        foreach ($keys as $key){
            if($cpt != 0){
                $query .= 'OR ';
            }
            $query .= 'i.title LIKE :key OR u.town LIKE :key OR u.postalcode LIKE :key OR u.region LIKE :key OR i.advert LIKE :key ';
            $cpt++;
        }

        $qb
            ->andWhere('('.$query.')')
            ->setParameter('key', '%' . $key . '%')
        ;

        return $qb->getQuery()->getResult();
    }
    
    /*
    public function filter($categorie, $region)
    {
        $region = '%'.$region.'%';

        $em = $this->getEntityManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare('
            SELECT * FROM immersion
            INNER JOIN user_profile 
            ON immersion.professionnel_id = user_profile.id
            INNER JOIN categoriejob_immersion
            ON immersion.id = categoriejob_immersion.immersion_id
            INNER JOIN categorie_job
            ON categorie_job.id = categoriejob_immersion.categoriejob_id 
            WHERE immersion.actifAdmin ="1"
            AND categorie_job.name = :categorie
            AND user_profile.region 
            LIKE :region');
        $statement->bindParam(':categorie', $categorie);
        $statement->bindParam(':region', $region);
        $statement->execute();
        $results = $statement->fetchall();
        return $results;
    }
    */
}
 