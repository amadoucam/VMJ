<?php

namespace Vmj\VmjBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vmj\VmjBundle\Entity\Newscontact;
use Vmj\VmjBundle\Entity\Commande;
//use Vmj\VmjBundle\Form\AdvancedSearchType;
use Vmj\VmjBundle\Entity\Rappel;
use Vmj\VmjBundle\Form\CommandeType;
use Vmj\VmjBundle\Form\MotivationType;
use Vmj\VmjBundle\Form\SimpleSearchType;
use Vmj\VmjBundle\Form\CodePromoType;
use Vmj\VmjBundle\Form\FilterSearchType;
use Vmj\VmjBundle\Form\NewscontactType;
use Vmj\VmjBundle\Entity\CategorieJob;
use Vmj\VmjBundle\Entity\Promo;
use Vmj\VmjBundle\Form\DurationType;

class DefaultController extends Controller
{
    public function temporaireAction(Request $request)
    {
        return $this->render('VmjBundle:Default:temporaire.html.twig');
    }

    public function newsletterconfirmationAction(Request $request)
    {
        return $this->render('VmjBundle:Default:confirmationNewsletter.html.twig', array(
            'listPages' => $this->getPagesList(),
            ));
    }

    public function contactconfirmationAction(Request $request)
    {
        return $this->render('VmjBundle:Default:confirmationContact.html.twig', array(
            'listPages' => $this->getPagesList(),
            ));
    }

    public function rappelAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contact = new Newscontact();
        $rappel = new Newscontact();

        $rappelform = $this->createForm('Vmj\VmjBundle\Form\RappelType', $rappel);
        $rappelform->handleRequest($request);

        $newsletterform = $this->createForm('Vmj\VmjBundle\Form\NewscontactType', $contact);
        $newsletterform->handleRequest($request);

        $commentaires = $em->getRepository('VmjBundle:Temoignages')->findBy(array(
            'valide' => 1
        ));

        if ($rappelform->isSubmitted() && $rappelform->isValid()) {
            $email = $request->request->get('email');
            $email = $rappel->getEmail();
            $phone = $request->request->get('telephone');
            //Mail pour envoyer les coordonées
            $message = \Swift_Message::newInstance()
                ->setSubject('Viemonjob vous rappelle')
                ->setFrom(array('matthieu@viemonjob.com'=> 'Viemonjob|Matthieu'))
                ->setTo(array('contact@viemonjob.com' => "Viemonjob"))
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($this->renderView('VmjBundle:MailTemplates:rappel.html.twig', array(
                    "email" => $email,
                    "phone" => $phone,
                )));

            $this->get('mailer')->send($message);
        }

        return $this->render('VmjBundle:Default:confirmationRappel.html.twig', array(
            'listPages' => $this->getPagesList(),
            'temoignages' => $commentaires));
    }

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contact = new Newscontact();
        $rappel = new Newscontact();

        $rappelform = $this->createForm('Vmj\VmjBundle\Form\RappelType', $rappel);
        $rappelform->handleRequest($request);

        $newsletterform = $this->createForm('Vmj\VmjBundle\Form\NewscontactType', $contact);
        $newsletterform->handleRequest($request);

        $simpleSearchform = $this->createForm('Vmj\VmjBundle\Form\SimpleSearchType');
        $simpleSearchform->handleRequest($request);

        $commentaires = $em->getRepository('VmjBundle:Temoignages')->findBy(array(
            'valide' => 1
        ));

        if ($newsletterform->isSubmitted() && $newsletterform->isValid()) {
            $contact->setInscrit(1);

            $em->persist($contact);
            $em->flush();
            $this->addFlash('success', '<p class=”fs25 gris6”><span class=”rose fs45”>Merci. <span><br>
		Votre inscription à bien été prise en compte ! <br>
Vous recevrez bientôt toutes les actualités Viemonjob dans votre boite mail. </p>');

            return $this->redirectToRoute('vmj_newsletterconfirm', array(
                'listPages' => $this->getPagesList(),
                'temoignages' => $commentaires));
        }

        if ($simpleSearchform->isSubmitted() && $simpleSearchform->isValid()) {
            $texte = $simpleSearchform->get('metier')->getData();

            return $this->redirectToRoute('findJob', array(
                'texte' => $texte
            ));
        }
        return $this->render('VmjBundle:Default:accueil.html.twig', array(
            'listPages' => $this->getPagesList(),
            'newsletterForm' => $newsletterform->createView(),
            'simpleSearchform' => $simpleSearchform->createView(),
            'rappelForm' => $rappelform->createView(),
            'temoignages' => $commentaires));
    }

    public function particuliersAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contact = new Newscontact();
        $form = $this->createForm('Vmj\VmjBundle\Form\NewscontactType', $contact);
        $form->handleRequest($request);

        $commentaires = $em->getRepository('VmjBundle:Temoignages')->findBy(array(
            'valide' => 1
        ));


        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setInscrit(1);

            $em->persist($contact);
            $em->flush();
            $this->addFlash('success', '<p class=”fs25 gris6”><span class=”rose fs45”>Merci. <span><br>
		Votre inscription à bien été prise en compte ! <br>
Vous recevrez bientôt toutes les actualités Viemonjob dans votre boite mail. </p>');
        }
        return $this->render('VmjBundle:Default:particuliers.html.twig', array(
            'listPages' => $this->getPagesList(),
            'newsletterForm' => $form->createView(),
            'temoignages' => $commentaires));
    }

    public function contactAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contact = new Newscontact();
        $form = $this->createForm(NewscontactType::class, $contact);
        $form->handleRequest($request);

        $commentaires = $em->getRepository('VmjBundle:Temoignages')->findBy(array(
            'valide' => 1
        ));

        if ($form->isSubmitted() && $form->isValid()) {
            $firstname = $request->request->get('first_name');
            $lastname = $request->request->get('last_name');
            $email = $contact->getEmail();
            $phone = $request->request->get('phone');
            /* $address = $request->request->get('address');
             $city = $request->request->get('city');
             $zip = $request->request->get('zip');
             $website = $request->request->get('website');*/
            $comment = $request->request->get('comment');
            //Mail de confirmation de paiement
            $message = \Swift_Message::newInstance()
                ->setSubject('Contactez-nous')
                ->setFrom(array($email => $firstname.' '.$lastname))
                ->setTo(array('contact@viemonjob.com' => "Viemonjob"))
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($this->renderView('VmjBundle:MailTemplates:contact.html.twig', array(
                    "first_name" => $firstname,
                    "last_name" => $lastname,
                    "email" => $email,
                    "phone" => $phone,
                    /*"address" => $address,
                    "city" => $city,
                    "zip" => $zip,
                    "website" => $website,*/
                    "comment" => $comment
                )));

            $this->get('mailer')->send($message);

            $contact->setInscrit(1);

            $em->persist($contact);
            $em->flush();
            $this->addFlash('success', '<p class=”fs25 gris6”><span class=”rose fs45”>Merci. <span><br>
		Votre inscription à bien été prise en compte ! <br>
Vous recevrez bientôt toutes les actualités Viemonjob dans votre boite mail. </p>');

            return $this->redirectToRoute('vmj_contactconfirm', array(
                'listPages' => $this->getPagesList(),
                'temoignages' => $commentaires));
        }
        return $this->render('VmjBundle:Default:contact.html.twig', array(
            'listPages' => $this->getPagesList(),
            'newsletterForm' => $form->createView(),
            'temoignages' => $commentaires));
    }

    public function professionnelsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $contact = new Newscontact();
        $form = $this->createForm('Vmj\VmjBundle\Form\NewscontactType', $contact);
        $form->handleRequest($request);
        $commentaires = $em->getRepository('VmjBundle:Temoignages')->findBy(array(
            'valide' => 1
        ));
        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setInscrit(1);
            $em->persist($contact);
            $em->flush();
            $this->addFlash('success', '<p class=”fs25 gris6”><span class=”rose fs45”>Merci. <span><br>
		Votre inscription à bien été prise en compte ! <br>
Vous recevrez bientôt toutes les actualités Viemonjob dans votre boite mail. </p>');
        }
        return $this->render('VmjBundle:Default:professionnels.html.twig', array(
            'listPages' => $this->getPagesList(),
            'newsletterForm' => $form->createView(),
            'temoignages' => $commentaires));
    }

    public function searchResultAction(Request $request, $texte)
    {
        $contact = new Newscontact();
        $form = $this->createForm('Vmj\VmjBundle\Form\NewscontactType', $contact);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setInscrit(1);
            $em->persist($contact);
            $em->flush();
            $this->addFlash('success', '<p class=”fs25 gris6”><span class=”rose fs45”>Merci. <span><br>
		Votre inscription à bien été prise en compte ! <br>
Vous recevrez bientôt toutes les actualités Viemonjob dans votre boite mail. </p>');
        }
        $findSearchResult = $em->getRepository('VmjBundle:Immersion')->recherche($texte, '', '', '');
        $categorieJobs = $em->getRepository('VmjBundle:CategorieJob')->findAll();

        /* Test filtre recherche */
        $jobsByCity = $em->getRepository('VmjUserBundle:UserProfile')->findAllProByCity();
        
        /* PAGINATION */
       $searchResult = $this->get('knp_paginator')->paginate(
            $findSearchResult, $this->get('request')->query->get('page', 1), 6);

        $simpleSearchform = $this->createForm('Vmj\VmjBundle\Form\SimpleSearchType', null, array(
            'action' => $this->generateUrl('vmj_homepage')
        ));
        return $this->render('VmjBundle:Default:metiers.html.twig', array(
            'categorieJobs' => $categorieJobs,
            'immersions' => $searchResult,
            'listPages' => $this->getPagesList(),
            'jobsByCity' => $jobsByCity,
            'newsletterForm' => $form->createView(),
            'simpleSearchform' => $simpleSearchform->createView(),
            'isSearch' => true
        ));
    }

    public function metiersAction(Request $request, CategorieJob $categorie = null)
    {
        $simpleSearchform = $this->createForm(SimpleSearchType::class, null, array(
            'action' => $this->generateUrl('vmj_homepage')
        ));

        /* Test filtre recherche */
        //$filterSearchForm = $this->createForm(FilterSearchType::class, null);

        $em = $this->getDoctrine()->getManager();

        $categorieJobs = $em->getRepository('VmjBundle:CategorieJob')->findAll();

        /* Test filtre recherche */
        //$jobsByCity = $em->getRepository('VmjUserBundle:UserProfile')->findAllProByCity();

        if($categorie != null)
        {
            $findImmersions = $em->getRepository('VmjBundle:Immersion')->valideImmersionByCategorie($categorie);
        }
        else
        {

            $findImmersions = $em->getRepository('VmjBundle:Immersion')->valideImmersion();
        }

        /* PAGINATION */
        $immersions = $this->get('knp_paginator')->paginate(
            $findImmersions, $this->get('request')->query->get('page', 1), 15);

        return $this->render('VmjBundle:Default:metiers.html.twig', array(
            'categorieJobs' => $categorieJobs,
            'listPages' => $this->getPagesList(),
            'immersions' => $immersions,
            'findImmersions' => $findImmersions,
            /*'jobsByCity' => $jobsByCity,*/
            'simpleSearchform' => $simpleSearchform->createView()
        ));
    }

    /* Test filtre recherche */
    /*public function filterSearchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $query ='';

        $categorie = $_POST["categories"];
        $region = $_POST["regions"];

        $immersions = $em->getRepository('VmjBundle:Immersion')->filter($categorie, $region);

        return $this->render('VmjBundle:Default:test.html.twig', array( 'categorie' => $categorie,
            'region' => $region,
            'immersions' => $immersions
        ));
    }*/

    public function metierAction(Request $request, $slug)
    {
		
		date_default_timezone_set('UTC');
		
        $em = $this->getDoctrine()->getManager();

        $immersionChoisie = $em->getRepository('VmjBundle:Immersion')->findOneBySlug($slug);
        $temoignages = $em->getRepository('VmjBundle:Temoignages')->findByImmersion($immersionChoisie);

        $immersions = $em->getRepository('VmjBundle:Immersion')->immersionsByProfessionnal($immersionChoisie->getProfessionnel()->getId());

        $session = $request->getSession();

        if (!$session->has('panier')) {
            $session->set('panier', array(
                'metier' => null,
                'date_start' => null,
                'actif' => false
            ));
        }

        if ($request->getMethod() == 'POST') {
            $dateStart = $request->request->get('date_start');
            $immersion = $em->getRepository('VmjBundle:Immersion')->find($immersionChoisie->getId());
            $session = $request->getSession();
            $panier = $session->get('panier');
            $panier['metier'] = $immersion->getId();
            $panier['date_start'] = $dateStart;
            $panier['actif'] = true;
            $session->set('panier', $panier);
            return $this->redirect($this->generateUrl('vmj_panier'));
        }

        return $this->render('VmjBundle:Default:metier.html.twig', array(
            'metier' => $immersionChoisie,
            'immersions' => $immersions,
            'temoignages' => $temoignages
        ));
    }
    
    public function ficheMetierAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $immersionChoisie = $em->getRepository('VmjBundle:Immersion')->findOneBySlug($slug);

        $immersions = $em->getRepository('VmjBundle:Immersion')->immersionsByProfessionnal($immersionChoisie->getProfessionnel()->getId());

        $session = $request->getSession();

        if (!$session->has('panier')) {
            $session->set('panier', array(
                'metier' => null,
                'date_start' => null,
                'actif' => false
            ));
        }
        $contact = new Newscontact();
        $form = $this->createForm('Vmj\VmjBundle\Form\NewscontactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setInscrit(1);
            $em->persist($contact);
            $em->flush();
            $this->addFlash('success', '<p class=”fs25 gris6”><span class=”rose fs45”>Merci. <span><br>
		Votre inscription à bien été prise en compte ! <br>
Vous recevrez bientôt toutes les actualités Viemonjob dans votre boite mail. </p>');
        }

        if ($request->getMethod() == 'POST') {
            $dateStart = $request->request->get('date_start');
            $immersion = $em->getRepository('VmjBundle:Immersion')->find($immersionChoisie->getId());
            $session = $request->getSession();
            $panier = $session->get('panier');
            $panier['metier'] = $immersion->getId();
            $panier['date_start'] = $dateStart;
            $panier['actif'] = true;
            $session->set('panier', $panier);
            return $this->redirect($this->generateUrl('vmj_panier'));
        }
        return $this->render('VmjBundle:Default:metier.html.twig', array(
            'metier' => $immersionChoisie,
            'immersions' => $immersions
        ));
    }

    public function panierAction(Request $request, $code = null)
    {
        $insertCode = '-';

		date_default_timezone_set('UTC');
		
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();

        $panier = $session->get('panier');

        //durée immersion
        $duration = $panier['duration'];
        $adjustDate = $duration - 1;

        $immersionId = $panier['metier'];
        $dateDebut = new \DateTime($panier['debut']);

        $end = new \DateTime($panier['debut']);
        $end->add(new \DateInterval('P' . $adjustDate . 'D'));

        $userProfile = $this->getUser()->getUserProfile();
        $immersion = $em->getRepository('VmjBundle:Immersion')->findOneById($immersionId);

        $price = ($immersion->getWeekprice() / 5) * $duration;

        $pricePromoFree = $price;

        $codePromoform = $this->createForm(CodePromoType::class, null);
        $codePromoform->handleRequest($request);

        if($codePromoform->isSubmitted() && $codePromoform->isValid())
        {
            $code = $codePromoform['code_promo']->getData();
            $promo = $em->getRepository('VmjBundle:Promo')->findOneByName($code);

            if($promo)
            {
                $name = $promo->getName();
                $coeff = $promo->getCoeff();
                $statut = $promo->getStatut();
            }
        }

        if($code === $name && $statut === 1)
        {
            $price = $price - ($price * $coeff);
            $insertCode = $name;
        }

        $commande = $this->initCommande($userProfile, $dateDebut, $immersion, $price, $insertCode, $duration, $end);

        $idCommande = $commande->getId();

        $fname = $this->getUser()->getUserProfile()->getFirstname();
        $lname = $this->getUser()->getUserProfile()->getLastname();
        $mail = $this->getUser()->getUserProfile()->getEmail();
        $title = $immersion->getTitle();
        $current = $immersion->getSlug();
        //Mail
        $message = \Swift_Message::newInstance()
            ->setSubject('Mail')
            ->setFrom('matt.lempereur@gmail.com')
            ->setTo('012zwwej@robot.zapier.com')
            ->setCharset('utf-8')
            ->setContentType('text/html')
            ->setBody($this->renderView('VmjBundle:MailTemplates:panierabandonne.html.twig', array(
                "fname" => $fname,
                "lname" => $lname,
                "mail" => $mail,
                "title" => $title,
                "url" => $current,
            )));

        $this->get('mailer')->send($message);

        $actionMode = utf8_encode($this->container->getParameter('vads_action_mode'));
        $ctx_mode = utf8_encode($this->container->getParameter('vads_ctx_mode'));
        $currency = utf8_encode($this->container->getParameter('vads_currency'));
        $page_action = utf8_encode($this->container->getParameter('vads_page_action'));
        $payment_config = utf8_encode($this->container->getParameter('vads_payment_config'));
        $siteId = utf8_encode($this->container->getParameter('vads_site_id'));
        $version = utf8_encode($this->container->getParameter('vads_version'));
        $captureDelay = utf8_encode($this->container->getParameter('vads_capture_delay'));
        $certificate = $this->container->getParameter('certificate');
        $captureDelay = utf8_encode($this->container->getParameter('vads_redirect_success_timeout'));
        $captureDelay = utf8_encode($this->container->getParameter('vads_redirect_error_timeout'));
        $vads = $this->getVADS($idCommande, $price, $userProfile, $actionMode, $ctx_mode, $currency, $page_action, $payment_config, $siteId, $version, $captureDelay, $certificate);

        return $this->render('VmjBundle:Default:panier.html.twig', array(
            'vads' => $vads,
            'immersion' => $immersion,
            'price' => $price,
            'code' => $code,
            'name' => $name,
            'statut' => $statut,
            'duration' => $duration,
            'pricePromoFree' => $pricePromoFree,
            'codePromoform' => $codePromoform->createView(),
        ));
    }

    public function retourPaiementAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->query) {
            $vads = $request->query;
            $vads_trans_id = intval($vads->get('vads_trans_id'));
            /** @var Commande $commande */
            $commande = $em->getRepository('VmjBundle:Commande')->findOneById($vads_trans_id);
            if ($vads->get('vads_trans_status') == 'AUTHORISED' || $vads->get('vads_trans_status') == 'WAITING_AUTHORISATION') {

                $commande->setStatut(1);
                $em->persist($commande);
                $em->flush();

                $html = $this->renderView('VmjBundle:Particuliers:printFacture.html.twig', array(
                    'commande' => $commande
                ));

                $pdf = $this->get('knp_snappy.pdf')->getOutputFromHtml($html);

                $this->addFlash('success', 'Votre paiement a été validé avec succès.');

                return $this->render('VmjBundle:Particuliers:confirmationPaiement.html.twig', array('commande' => $commande));

                /*
                $user = $em->getRepository('VmjUserBundle:User')->findOneBy(array('user_profile' => $commande->getCustomer()));

                //Mail de confirmation de paiement
                $message = \Swift_Message::newInstance()
                    ->setSubject('Confirmation de paiement')
                    ->setFrom(array('contact@viemonjob.com' => "Viemonjob"))
                    ->setTo($user->getEmail())
                    ->setBcc('contact@viemonjob.com')
                    ->setCharset('utf-8')
                    ->setContentType('text/html')
                    ->setBody($this->renderView('VmjBundle:MailTemplates:paiementConfirmed.html.twig', array(
                        'commande' => $commande
                    )))
                    ->attach(\Swift_Attachment::newInstance($pdf, 'facture.pdf', 'application/pdf'))
                ;
                $this->get('mailer')->send($message);

                //Mail de confirmation de paiement pour le pro
                $message = \Swift_Message::newInstance()
                    ->setSubject('Confirmation de réservation')
                    ->setFrom(array('contact@viemonjob.com' => "Viemonjob"))
                    ->setTo($commande->getImmersion()->getProfessionnel()->getEmail())
                    ->setBcc('contact@viemonjob.com')
                    ->setCharset('utf-8')
                    ->setContentType('text/html')
                    ->setBody($this->renderView('VmjBundle:MailTemplates:paiementConfirmedPro.html.twig', array(
                        'commande' => $commande
                    )))
                ;
                $this->get('mailer')->send($message);

                return $this->redirectToRoute('vmj_motivation', array('id' => $commande->getId()));
                */
            } else {
                $this->addFlash('danger', 'Votre paiement a échoué');
                return $this->redirectToRoute('vmj_homepage');
            }
        }

        return $this->redirectToRoute('vmj_homepage');
    }

    public function motivationAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('VmjBundle:Commande')->findOneById($id);

        $form = $this->createForm(MotivationType::class, $commande);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute('particuliers_immersions');
        }

        return $this->render('VmjBundle:Default:motivation.html.twig', array(
            'commande' => $commande,
            'form' => $form->createView()
        ));
    }

    public function reservationAction(Request $request)
    {
        return $this->render('VmjBundle:Default:reservation.html.twig', array(
            'listPages' => $this->getPagesList()));
    }

    /**
     * Finds and displays a Pages entity.
     *
     */
    public function displayPageAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $page = $em->getRepository('VmjBundle:Pages')->findOneBySlug($slug);

        return $this->render('VmjBundle:Default:displayPage.html.twig', array(
            'page' => $page,
            'listPages' => $this->getPagesList()
        ));
    }

    public function getPagesList()
    {
        $em = $this->getDoctrine()->getManager();

        $page = $em->getRepository('VmjBundle:Pages')->findAll();

        return $page;
    }

    public function initCommande($customer, $dateDebut, $immersion, $price, $insertCode, $duration, $end)
    {
        $em = $this->getDoctrine()->getManager();
        $commande = new Commande();
        $commande->setCustomer($customer);
        $commande->setImmersion($immersion);
        $commande->setStart($dateDebut);
        $commande->setPrice($price);
        //$commande->setPrice($immersion->getWeekPrice());
        $commande->setInitialPrice($immersion->getWeekPrice());
        $commande->setCodePromo($insertCode);
        $commande->setQuantity(1);
        $commande->setStatut(0);
        $commande->setDuration($duration);
        $commande->setEnd($end);
        $em->persist($commande);
        $em->flush();

        return $commande;
    }

    public function validerCommande($id)
    {
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('VmjBundle:Commande')->findOneById($id);
        $commande->setStatut(0);
        $em->persist($commande);
        $em->flush();
    }

    public function immersionAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $immersion = $em->getRepository('VmjBundle:Immersion')->findOneById($id);

        $session = $request->getSession();

        if (!$session->has('panier')) {
            $session->set('panier', array(
                'metier' => null,
                'actif' => false,
                'duration' => 5
            ));
        }

        if ($request->getMethod() == 'POST') {
            $debut = $request->request->get('date_start');

            //durée immersion
            $duration = $request->request->get('duration');

            $session = $request->getSession();
            $panier = $session->get('panier');
            $panier['debut'] = $debut;
            $panier['metier'] = $immersion->getId();
            $panier['actif'] = true;

            //durée immersion
            $panier['duration'] = $duration;
            
            $session->set('panier', $panier);
            return $this->redirect($this->generateUrl('vmj_panier'));
        }
        return $this->render('VmjBundle:Default:immersion.html.twig', array(
            'immersion' => $immersion
        ));
    }

    public static function getVADS($id, $price, $user, $actionMode, $ctx_mode, $currency, $page_action, $payment_config, $siteId, $version, $captureDelay, $certificate)
    {
        $vads['vads_action_mode'] = $actionMode;
        $vads['vads_amount'] = utf8_encode($price * 100);
        $vads['vads_ctx_mode'] = $ctx_mode;
        $vads['vads_currency'] = $currency;
        //////////////////////////////////////////////////////////////new params
        $vads['vads_cust_email'] = utf8_encode($user->getEmail());
        $vads['vads_cust_first_name'] = utf8_encode($user->getFirstname());
        $vads['vads_cust_last_name'] = utf8_encode($user->getLastname());
        $vads['vads_return_mode'] = 'GET';
        $vads['vads_redirect_success_timeout'] = 0;
        $vads['vads_redirect_error_timeout'] = 0;
        //$vads['vads_cust_phone'] = utf8_encode($user->phone);
        //$vads['vads_cust_address'] = utf8_encode($user->address);
        //$vads['vads_cust_city'] = utf8_encode($user->city);
        //$vads['vads_cust_zip'] = utf8_encode($user->postal_code);
        ////////////////////////////////////////////////////////////////////////
        $vads['vads_page_action'] = $page_action;
        $vads['vads_payment_config'] = $payment_config;
        $vads['vads_site_id'] = $siteId;
        $vads['vads_trans_date'] = date("YmdHis");
        $vads['vads_trans_id'] = utf8_encode(DefaultController::GetTransIdVADS($id));
        $vads['vads_version'] = $version;
        $vads['vads_capture_delay'] = $captureDelay;


        $vads['signature'] = DefaultController::GetSignatureVADS($vads, $certificate);


        return $vads;
    }

    public static function GetTransIdVADS($id)
    {
        return str_pad($id, 6, "0", STR_PAD_LEFT);
    }

    private static function GetSignatureVADS($field, $certificate)
    {
        $key = $certificate;

        ksort($field); // tri des paramètres par ordre alphabétique
        $contenu_signature = "";

        foreach ($field as $nom => $valeur) {
            if (substr($nom, 0, 5) == 'vads_') {
                $contenu_signature .= $valeur . "+";
            }
        }
        $contenu_signature .= $key; // On ajoute le certificat à la fin de la chaîne

        //sha1($vads['vads_action_mode']."+".$vads['vads_amount']."+".$vads['vads_capture_delay']."+".$vads['vads_ctx_mode']."+".$vads['vads_currency']."+".$vads['vads_page_action']."+".$vads['vads_payment_config']."+".$vads['vads_site_id']."+".$vads['vads_trans_date']."+".$vads['vads_trans_id']."+".$vads['vads_version']."+".$vads['certificate'])       
        $signature = sha1($contenu_signature);

        return $signature;
    }

    public static function ValidSignatureVADS($field)
    {
        $result = false;
        $signature = self::GetSignatureVADS($field);

        if (isset($field['signature']) && ($signature == $field['signature'])) {
            $result = true;
        }

        return $result;
    }

    private function checkCaptcha($code, $ip = null){
        if (empty($code)) {
            return false; // Si aucun code n'est entré, on ne cherche pas plus loin
        }
        $params = [
            'secret'    => '6Le7LBQUAAAAABBYQhVfVD3wDMHK8mQC73xqNvyU',
            'response'  => $code
        ];
        if( $ip ){
            $params['remoteip'] = $ip;
        }
        $url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
        if (function_exists('curl_version')) {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Evite les problèmes, si le ser
            $response = curl_exec($curl);
        } else {
            // Si curl n'est pas dispo, un bon vieux file_get_contents
            $response = file_get_contents($url);
        }

        if (empty($response) || is_null($response)) {
            return false;
        }

        $json = json_decode($response);
        return $json->success;
    }
}
