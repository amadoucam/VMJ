<?php

namespace Vmj\VmjBundle\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Vmj\UserBundle\Form\IndividualType;
use Vmj\UserBundle\Form\ProfessionalType;
use Vmj\VmjBundle\Entity\Commande;
use Vmj\VmjBundle\Form\SearchType;
use Vmj\VmjBundle\Helper\Translator;
use WebChemistry\Invoice\Data\Template;
use Vmj\VmjBundle\Helper\Invoice;
use WebChemistry\Invoice\InvoiceFactory;

class ParticuliersController extends Controller {

    public function dashboardAction(Request $request) {
        return $this->redirectToRoute('particuliers_immersions');
        $em = $this->getDoctrine()->getManager();
        $userProfile = $this->getUser()->getUserProfile();
        $NonLus = $em->getRepository('VmjBundle:Messages')->compteNonLus($userProfile->getId());
        $compteNonLus = $NonLus[0][1];
        $searchForm = $this->createForm(new SearchType);
        $searchForm->handleRequest($request);
        $searchResult = null;

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $metier = $searchForm->get('metier')->getData();
            $lieu = $searchForm->get('lieu')->getData();
            $periode = $searchForm->get('periode')->getData();
            $motCle = $searchForm->get('motCle')->getData();
            $searchResult = $em->getRepository('VmjBundle:Immersion')->recherche($metier, $lieu, $periode, $motCle);
        }

        return $this->render('VmjBundle:Particuliers:dashboardParticuliers.html.twig', array(
                    'userProfile' => $userProfile,
                    'searchForm' => $searchForm->createView(),
                    'compteNonLus' => $compteNonLus,
                    'resultats' => $searchResult
        ));
    }

    public function mesImmersionsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $userProfile = $this->getUser()->getUserProfile();
        $NonLus = $em->getRepository('VmjBundle:Messages')->compteNonLus($userProfile->getId());
        $mesCommandes = $em->getRepository('VmjBundle:Commande')->findBy(array(
            'customer' => $userProfile->getId(),
            'statut' => 1
                    ));
        
        $compteNonLus = $NonLus[0][1];

        return $this->render('VmjBundle:Particuliers:mesImmersions.html.twig', array(
                    'userProfile' => $userProfile,
                    'compteNonLus' => $compteNonLus,
                    'mesCommandes' => $mesCommandes
        ));
    }

    public function searchImmersionAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $userProfile = $this->getUser()->getUserProfile();
        $NonLus = $em->getRepository('VmjBundle:Messages')->compteNonLus($userProfile->getId());
        $compteNonLus = $NonLus[0][1];

        $searchForm = $this->createForm(new SearchType);
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $em->persist($userProfile);
            $em->flush();
        }
        return $this->render('VmjBundle:Particuliers:dashboardParticuliers.html.twig', array(
                    'userProfile' => $userProfile,
                    'searchForm' => $searchForm->createView(),
                    'compteNonLus' => $compteNonLus,
        ));
    }

    public function editionProfilePersoAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $userProfile = $this->getUser()->getUserProfile();
        $NonLus = $em->getRepository('VmjBundle:Messages')->compteNonLus($userProfile->getId());
        $compteNonLus = $NonLus[0][1];
        $editForm = $this->createForm(IndividualType::class, $userProfile);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $userProfile->uploadPhoto();
            $em->persist($userProfile);
            $em->flush();
        }
        return $this->render('VmjBundle:Particuliers:editionProfilePerso.html.twig', array(
                    'userProfile' => $userProfile,
                    'edit_form' => $editForm->createView(),
                    'compteNonLus' => $compteNonLus,
        ));
    }

    public function affichageProfileProAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $userProfile = $this->getUser()->getUserProfile();
        $NonLus = $em->getRepository('VmjBundle:Messages')->compteNonLus($userProfile->getId());
        $compteNonLus = $NonLus[0][1];
        $editForm = $this->createForm(ProfessionalType::class, $userProfile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->persist($userProfile);
            $em->flush();
        }
        return $this->render('VmjBundle:Professionnels:affichageProfilePerso.html.twig', array(
                    'userProfile' => $userProfile,
                    'edit_form' => $editForm->createView(),
                    'compteNonLus' => $compteNonLus,));
    }

    public function maFactureAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('VmjBundle:Commande')->findOneById($id);
        $userProfile = $em->getRepository('VmjUserBundle:UserProfile')->findOneById($commande->getCustomer());

        /*$factory = new InvoiceFactory();
        $company = $factory->createCompany('VIEMONJOB SAS', ' rue de Bellevue', '92100 Boulogne Billancourt', '77,', 'FRANCE', '', '');
        $customer = $factory->createCustomer(
            $userProfile->__toString(),
            ($userProfile->getAddress())? $userProfile->getAddress(): ' ',
            $userProfile->getPostalCode().' '.$userProfile->getTown(), ' ', 'France');
        $account = $factory->createAccount('1111', 'CZ4808000000002353462015', 'GIGACZPX');
        $subtotal = $commande->getPrice() * 0.20;
        $payment = $factory->createPaymentInformation('€', '', '', $subtotal);
        $order = $factory->createOrder('20160001', new \DateTime('+ 14 days'), $account, $payment);
        $order->addItem($commande->getImmersion()->getTitle(), 1, $commande->getPrice());

        $template = new Template();
        $template->setLogo('theme/img/vmj-logo.png');

        $invoice = new Invoice($company, $template, new Translator());

        $images = $invoice->create($customer, $order);
        foreach ($images as $page => $invoice) {
            $invoice->save("/invoice-$page.jpg");
        }


        header('Content-Type: image/jpeg');
        echo $images[0]->encode();*/



        return $this->render('VmjBundle:Particuliers:maFacture.html.twig', array(
            'userProfile' => $userProfile,
            'commande' => $commande
        ));
    }

    public function printFactureAction($id){
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('VmjBundle:Commande')->findOneById($id);
        $user = $em->getRepository('VmjUserBundle:User')->findOneBy(array('user_profile' => $commande->getCustomer()));

        $html = $this->renderView('VmjBundle:Particuliers:printFacture.html.twig', array(
            'commande' => $commande
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="facture.pdf"'
            )
        );
    }

    public function mailFactureAction($id){
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('VmjBundle:Commande')->findOneById($id);
        $user = $em->getRepository('VmjUserBundle:User')->findOneBy(array('user_profile' => $commande->getCustomer()));

        $html = $this->renderView('VmjBundle:Particuliers:printFacture.html.twig', array(
            'commande' => $commande
        ));

        $pdf = $this->get('knp_snappy.pdf')->getOutputFromHtml($html);

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

        return $this->redirectToRoute('particuliers_facture', array('id' => $commande->getId()));
    }

}
