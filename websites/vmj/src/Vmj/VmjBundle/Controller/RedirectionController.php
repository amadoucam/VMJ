<?php

namespace Vmj\VmjBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vmj\VmjBundle\Entity\Newscontact;
use Vmj\VmjBundle\Entity\Commande;
//use Vmj\VmjBundle\Form\AdvancedSearchType;
use Vmj\VmjBundle\Form\CommandeType;
use Vmj\VmjBundle\Form\MotivationType;
use Vmj\VmjBundle\Form\SimpleSearchType;
use Vmj\VmjBundle\Form\NewscontactType;

class RedirectionController extends Controller
{

    #Redirections des anciens id

    public function redirect15Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/e-galeriste');
    }

    public function redirect17Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/estheticienne-canine');
    }

    public function redirect18Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/photographe-studio');
    }

    public function redirect19Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/electricien');
    }

    public function redirect20Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/libraire');
    }

    public function redirect21Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/architecte-et-expert-bim');
    }

    public function redirect22Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/voyagiste');
    }

    public function redirect23Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/fleuriste-2');
    }

    public function redirect24Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/directeur-d-agence-de-production-advertising');
    }

    public function redirect26Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/fleuriste-1');
    }

    public function redirect27Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/veterinaire');
    }

    public function redirect28Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/tapissier');
    }

    public function redirect29Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/concepteur-de-site-web');
    }

    public function redirect30Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/vendeuse-a-domicile');
    }

    public function redirect31Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/paysagiste-concepteur');
    }

    public function redirect32Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/menuisier');
    }

    public function redirect33Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/traiteur');
    }

    public function redirect34Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/boucher');
    }

    public function redirect35Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/chef-de-rayon-epicerie');
    }

    public function redirect36Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/fromager');
    }

    public function redirect37Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/avocat');
    }

    public function redirect38Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/primeur-premium');
    }

    public function redirect39Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/architecte-et-ingenieur-immobilier');
    }

    public function redirect41Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/professeur-de-golf');
    }

    public function redirect42Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/fleuriste-3');
    }

    public function redirect43Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/gerant-de-chambre-d-hotes');
    }

    public function redirect44Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/maraicher-agroforestier');
    }

    public function redirect46Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/foodtrucker');
    }

    public function redirect47Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/hotelier');
    }

    public function redirect48Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/concepteur-graphique');
    }

    public function redirect49Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/forgeron-coutelier');
    }

    public function redirect50Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/commercante-sur-les-marches');
    }

    public function redirect51Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/directeur-des-ressources-humaines');
    }

    public function redirect52Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/directeur-d-hotel-92100-boulogne');
    }

    public function redirect53Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/directeur-d-une-association');
    }

    public function redirect54Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/photographe-reportage-1');
    }

    public function redirect55Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/maitre-fromager-androuet');
    }

    public function redirect56Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/professeur-d-arts-martiaux');
    }

    public function redirect57Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/restaurateur-1');
    }

    public function redirect59Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/artiste-chanteur-crooner');
    }

    public function redirect60Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/coaching-emploi');
    }

    public function redirect61Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/poissonnier');
    }

    public function redirect62Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/poissonnier');
    }

    public function redirect63Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/artiste-et-metteur-en-scene');
    }

    public function redirect64Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/gerant-de-camping');
    }

    public function redirect65Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/agent-immobilier-75008-paris');
    }

    public function redirect66Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/chef-de-rayon-bazar-technique');
    }

    public function redirect67Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/chargee-de-communication-et-marketing');
    }

    public function redirect68Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/chef-de-rayon-boucherie');
    }

    public function redirect69Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/opticien');
    }

    public function redirect71Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/receptionnaire-magasinier');
    }

    public function redirect73Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/e-galeriste');
    }

    public function redirect74Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/chef-de-rayon-boulangerie');
    }

    public function redirect75Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/directeur-d-hotel');
    }

    public function redirect76Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/directrice-d-agence-de-services-d-aide-a-domicile');
    }

    public function redirect77Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/agent-de-securite');
    }

    public function redirect78Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/restaurateur-et-chef-de-salle');
    }

    public function redirect79Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/consultant-innovation-et-creativite');
    }

    public function redirect80Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/assistante-administrative-et-comptable');
    }

    public function redirect81Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/restaurateur-2');
    }

    public function redirect82Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/mere-au-foyer');
    }

    public function redirect83Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/fondatrice-et-directrice-de-start-up-92100-boulogne');
    }

    public function redirect85Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/chef-cuisinier');
    }

    public function redirect86Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/gerante-d-un-concept-store-createurs');
    }

    public function redirect87Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/directeur-de-publication');
    }

    public function redirect88Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/boulanger-patissier-traiteur');
    }

    public function redirect89Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/avocat-penaliste');
    }

    public function redirect90Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/animatrice-periscolaire');
    }

    public function redirect93Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/responsable-formation-et-recrutement');
    }

    public function redirect94Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/comedien-realisateur-auteur');
    }

    public function redirect95Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/attachee-de-presse');
    }

    public function redirect96Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/epicier-restaurateur-et-barista');
    }

    public function redirect97Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/concepteur-et-integrateur-3d');
    }

    public function redirect98Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/gerant-de-magasin-de-jeux-et-jouets');
    }

    public function redirect99Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/charge-d-affaires');
    }

    public function redirect100Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/charge-d-affaires');
    }

    public function redirect101Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/directrice-marketing-data-analysis');
    }

    public function redirect102Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/expert-social-media-monitoring-e-reputation');
    }

    public function redirect103Action()
    {
        return $this->redirect('http://www.viemonjob.com/metier/menuisier-et-peintre');
    }

    # Autres redirections

    public function redirect0Action()
    {
        return $this->redirect('http://www.viemonjob.com/');
    }

    public function redirect1bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/maitre-nageur-coach-fitness');
    }

    public function redirect2bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/creative-technologist-chef-operateur-video');
    }

    public function redirect3bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/data-scientist-co-founder-start-up-e-sport');
    }

    public function redirect4bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/pages/cgv');
    }

    public function redirect5bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/libraire');
    }

    public function redirect6bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/traiteur');
    }

    public function redirect7bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/commercante-sur-les-marches');
    }

    public function redirect82bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/foodtrucker');
    }

    public function redirect9bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/boucher');
    }

    public function redirect10bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/electricien');
    }

    public function redirect11bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/maitre-fromager-androuet');
    }

    public function redirect12bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/concepteur-de-site-web');
    }

    public function redirect13bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/directeur-d-une-association');
    }

    public function redirect14bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/artiste-chanteur-crooner');
    }

    public function redirect15bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/professeur-de-golf');
    }

    public function redirect16bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/primeur-premium');
    }

    public function redirect17bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/forgeron-coutelier');
    }

    public function redirect18bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/hotelier');
    }

    public function redirect19bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/concepteur-graphique');
    }

    public function redirect20bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/architecte-et-ingenieur-immobilier');
    }

    public function redirect21bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/photographe-reportage-1');
    }

    public function redirect22bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/realisateur-chef-de-projet-video');
    }

    public function redirect23bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/metier/restauratrice-de-tableaux');
    }

    public function redirect24bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/particuliers');
    }

    public function redirect25bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/pages/a-propos-de-nous');
    }

    public function redirect26bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/pages/on-parle-de-nous');
    }

    public function redirect27bisAction()
    {
        return $this->redirect('http://www.viemonjob.com/professionnels');
    }
}