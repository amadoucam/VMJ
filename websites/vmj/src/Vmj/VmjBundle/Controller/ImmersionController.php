<?php

namespace Vmj\VmjBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Vmj\VmjBundle\Entity\Immersion;
use Vmj\VmjBundle\Form\ImmersionType;

/**
 * Immersion controller.
 *
 */
class ImmersionController extends Controller
{
    /**
     * Lists all Immersion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $immersions = $em->getRepository('VmjBundle:Immersion')->findAll();

        return $this->render('immersion/index.html.twig', array(
            'immersions' => $immersions,
        ));
    }

    /**
     * Creates a new Immersion entity.
     *
     */
    public function newAction(Request $request)
    {
        $immersion = new Immersion();
        $form = $this->createForm('Vmj\VmjBundle\Form\ImmersionType', $immersion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($immersion);
            $em->flush();

            return $this->redirectToRoute('immersion_show', array('id' => $immersion->getId()));
        }

        return $this->render('immersion/new.html.twig', array(
            'immersion' => $immersion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Immersion entity.
     *
     */
    public function showAction(Immersion $immersion)
    {
        $deleteForm = $this->createDeleteForm($immersion);

        return $this->render('immersion/show.html.twig', array(
            'immersion' => $immersion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Immersion entity.
     *
     */
    public function editAction(Request $request, Immersion $immersion)
    {
        $deleteForm = $this->createDeleteForm($immersion);
        $editForm = $this->createForm('Vmj\VmjBundle\Form\ImmersionType', $immersion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($immersion);
            $em->flush();

            return $this->redirectToRoute('immersion_edit', array('id' => $immersion->getId()));
        }

        return $this->render('immersion/edit.html.twig', array(
            'immersion' => $immersion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Immersion entity.
     *
     */
    public function deleteAction(Request $request, Immersion $immersion)
    {
        $form = $this->createDeleteForm($immersion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($immersion);
            $em->flush();
        }

        return $this->redirectToRoute('immersion_index');
    }

    /**
     * Creates a form to delete a Immersion entity.
     *
     * @param Immersion $immersion The Immersion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Immersion $immersion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('immersion_delete', array('id' => $immersion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
