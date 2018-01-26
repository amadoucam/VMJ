<?php

namespace Vmj\VmjBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Vmj\VmjBundle\Entity\Newscontact;
use Vmj\VmjBundle\Form\NewscontactType;

/**
 * Newscontact controller.
 *
 */
class NewscontactController extends Controller
{
    /**
     * Lists all Newscontact entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $newscontacts = $em->getRepository('VmjBundle:Newscontact')->findistinct();

        return $this->render('newscontact/index.html.twig', array(
            'newscontacts' => $newscontacts,
        ));
    }

    /**
     * Creates a new Newscontact entity.
     *
     */
    public function newAction(Request $request)
    {
        $newscontact = new Newscontact();
        $form = $this->createForm('Vmj\VmjBundle\Form\NewscontactType', $newscontact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newscontact);
            $em->flush();

            return $this->redirectToRoute('newscontact_show', array('id' => $newscontact->getId()));
        }

        return $this->render('newscontact/new.html.twig', array(
            'newscontact' => $newscontact,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Newscontact entity.
     *
     */
    public function showAction(Newscontact $newscontact)
    {
        $deleteForm = $this->createDeleteForm($newscontact);

        return $this->render('newscontact/show.html.twig', array(
            'newscontact' => $newscontact,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Newscontact entity.
     *
     */
    public function editAction(Request $request, Newscontact $newscontact)
    {
        $deleteForm = $this->createDeleteForm($newscontact);
        $editForm = $this->createForm('Vmj\VmjBundle\Form\NewscontactType', $newscontact);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newscontact);
            $em->flush();

            return $this->redirectToRoute('newscontact_edit', array('id' => $newscontact->getId()));
        }

        return $this->render('newscontact/edit.html.twig', array(
            'newscontact' => $newscontact,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Newscontact entity.
     *
     */
    public function deleteAction(Request $request, Newscontact $newscontact)
    {
        $form = $this->createDeleteForm($newscontact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($newscontact);
            $em->flush();
        }

        return $this->redirectToRoute('newscontact_index');
    }

    /**
     * Creates a form to delete a Newscontact entity.
     *
     * @param Newscontact $newscontact The Newscontact entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Newscontact $newscontact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('newscontact_delete', array('id' => $newscontact->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
