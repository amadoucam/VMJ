<?php

namespace Vmj\VmjBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vmj\VmjBundle\Entity\Temoignages;
use Vmj\VmjBundle\Form\TemoignagesType;
use Vmj\VmjBundle\Form\AdminTemoignagesType;

/**
 * Temoignages controller.
 *
 */
class TemoignagesController extends Controller {

    /**
     * Lists all Temoignages entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $temoignages = $em->getRepository('VmjBundle:Temoignages')->findAll();

        return $this->render('temoignages/index.html.twig', array(
                    'temoignages' => $temoignages,
        ));
    }

    /**
     * Lists all Temoignages entities.
     *
     */
    public function nonvalideAction() {
        $em = $this->getDoctrine()->getManager();

        $temoignages = $em->getRepository('VmjBundle:Temoignages')->findByValide(0);

        return $this->render('temoignages/nonvalide.html.twig', array(
                    'temoignages' => $temoignages,
        ));
    }

    /**
     * Creates a new Temoignages entity.
     *
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $temoignage = new Temoignages();
        $temoignage->setRedacteur($this->getUser()->getUserProfile());
         if ($request->request->get('immersion') !== null) {
                $idImmersion = $request->request->get('immersion');
                $immersion = $em->getRepository('VmjBundle:Immersion')->findOneById($idImmersion);

                $temoignage->setImmersion($immersion);
                
            }
            
        $form = $this->createForm('Vmj\VmjBundle\Form\TemoignagesType', $temoignage);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($temoignage);
            $em->flush();

            return $this->redirectToRoute('temoignages_show', array('id' => $temoignage->getId()));
        }

        return $this->render('temoignages/new.html.twig', array(
                    'temoignage' => $temoignage,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Temoignages entity.
     *
     */
    public function showAction(Temoignages $temoignage) {
        $deleteForm = $this->createDeleteForm($temoignage);

        return $this->render('temoignages/show.html.twig', array(
                    'temoignage' => $temoignage,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Temoignages entity.
     *
     */
    public function editAction(Request $request, Temoignages $temoignage) {
        $deleteForm = $this->createDeleteForm($temoignage);
        $editForm = $this->createForm('Vmj\VmjBundle\Form\TemoignagesType', $temoignage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($temoignage);
            $em->flush();

            return $this->redirectToRoute('temoignages_edit', array('id' => $temoignage->getId()));
        }

        return $this->render('temoignages/edit.html.twig', array(
                    'temoignage' => $temoignage,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Displays a form to edit an existing Temoignages entity.
     *
     */
    public function adminEditAction(Request $request, Temoignages $temoignage) {
        $deleteForm = $this->createDeleteForm($temoignage);
        $editForm = $this->createForm('Vmj\VmjBundle\Form\AdminTemoignagesType', $temoignage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($temoignage);
            $em->flush();

            return $this->redirectToRoute('admin_temoignages_index');
        }

        return $this->render('temoignages/adminEdit.html.twig', array(
                    'temoignage' => $temoignage,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Temoignages entity.
     *
     */
    public function deleteAction(Request $request, Temoignages $temoignage) {
        $form = $this->createDeleteForm($temoignage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($temoignage);
            $em->flush();
        }

        return $this->redirectToRoute('temoignages_index');
    }

    /**
     * Creates a form to delete a Temoignages entity.
     *
     * @param Temoignages $temoignage The Temoignages entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Temoignages $temoignage) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('temoignages_delete', array('id' => $temoignage->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
