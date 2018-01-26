<?php
namespace Vmj\VmjBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vmj\VmjBundle\Entity\CategorieJob;

class LoadCategorieJobData extends AbstractFixture implements OrderedFixtureInterface
{
    private $listCat = array(   
        'Agriculture, Animaux, Environnement',
        'Architecture, Immobilier',
        'Arts, Design, Culture',
        'Automobile',
        'Commerce, Artisanat',
        'Communication, Marketing',
        'Droit, Justice',
        'Édition, Journalisme',
        'Enseignement',
        'Informatique, Internet',
        'Loisirs, Sport',
        'Mode',
        'Santé, Social',
        'Tourisme, Restauration'
        );
    
    public function load(ObjectManager $em)
    {
        foreach($this->listCat as $cat){
            $categorieJob = new CategorieJob();
            $categorieJob->setName($cat);
            $categorieJob->setSlug('');  
            $categorieJob->setCreated(new \DateTime('NOW'));
            $categorieJob->setModified(new \DateTime('NOW'));
            $categorieJob->setActif(true);
            
            $em->persist($categorieJob);
            $em->flush();
        }       
    }
    
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}
