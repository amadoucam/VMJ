<?php

namespace Vmj\VmjBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vmj\VmjBundle\Entity\Pages;
use Vmj\VmjBundle\Entity\Presse;
use Vmj\VmjBundle\Form\PagesType;
use Vmj\VmjBundle\Form\NewscontactType;
use Vmj\VmjBundle\Entity\Newscontact;

/**
 * Pages controller.
 *
 */
class PagesController extends Controller {

    /**
     * Lists all Pages entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $userProfile = $this->getUser()->getUserProfile();
        $pages = $em->getRepository('VmjBundle:Pages')->findAll();

        return $this->render('pages/index.html.twig', array(
                    'pages' => $pages,
                    'userProfile' => $userProfile
        ));
    }

    public function aProposAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $contact = new Newscontact();
        $form = $this->createForm('Vmj\VmjBundle\Form\NewscontactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setInscrit(1);

            $em->persist($contact);
            $em->flush();
        }
        return $this->render('pages/apropos.html.twig', array(
                    'newsletterForm' => $form->createView()));
    }

    public function aideAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        $contact = new Newscontact();
        $form = $this->createForm('Vmj\VmjBundle\Form\NewscontactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setInscrit(1);

            $em->persist($contact);
            $em->flush();
        }

        return $this->render('pages/aide.html.twig', array(
                    'newsletterForm' => $form->createView()));
    }

    public function onParleDeNousAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $presse = $em->getRepository('VmjBundle:Presse')->validePresse();

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
        }

        return $this->render('pages/onparledenous.html.twig', array(
                    'newsletterForm' => $form->createView(),
                    'temoignages' => $commentaires,
                    'presse' => $presse));
    }

    public function partenairesAction(Request $request) {
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
        }

        return $this->render('pages/partenaires.html.twig', array(
            'newsletterForm' => $form->createView(),
            'temoignages' => $commentaires));
    }

    public function blogAction() {
        return $this->render('pages/blog.html.twig');
    }

    public function cgvAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $contact = new Newscontact();
        $form = $this->createForm('Vmj\VmjBundle\Form\NewscontactType', $contact);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setInscrit(1);

            $em->persist($contact);
            $em->flush();
        }
        return $this->render('pages/cgv.html.twig', array(
                    'newsletterForm' => $form->createView()));
    }

    public function mentionsLegalesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $contact = new Newscontact();
        $form = $this->createForm('Vmj\VmjBundle\Form\NewscontactType', $contact);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setInscrit(1);

            $em->persist($contact);
            $em->flush();
        }
        return $this->render('pages/mentionslegales.html.twig', array(
                    'newsletterForm' => $form->createView()));
    }

    /**
     * Creates a new Pages entity.
     *
     */
    public function newAction(Request $request) {
        $page = new Pages();
        $userProfile = $this->getUser()->getUserProfile();
        $form = $this->createForm('Vmj\VmjBundle\Form\PagesType', $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('pages_show', array('id' => $page->getId(),
                        'userProfile' => $userProfile));
        }

        return $this->render('pages/new.html.twig', array(
                    'page' => $page,
                    'form' => $form->createView(),
                    'userProfile' => $userProfile
        ));
    }

    /**
     * Finds and displays a Pages entity.
     *
     */
    public function showAction(Pages $page) {
        $deleteForm = $this->createDeleteForm($page);

        return $this->render('pages/show.html.twig', array(
                    'page' => $page,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pages entity.
     *
     */
    public function editAction(Request $request, Pages $page) {
        $deleteForm = $this->createDeleteForm($page);
        $editForm = $this->createForm('Vmj\VmjBundle\Form\PagesType', $page);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('pages_edit', array('id' => $page->getId()));
        }

        return $this->render('pages/edit.html.twig', array(
                    'page' => $page,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Pages entity.
     *
     */
    public function deleteAction(Request $request, Pages $page) {
        $form = $this->createDeleteForm($page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($page);
            $em->flush();
        }

        return $this->redirectToRoute('pages_index');
    }

    /**
     * Creates a form to delete a Pages entity.
     *
     * @param Pages $page The Pages entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pages $page) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('pages_delete', array('id' => $page->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
