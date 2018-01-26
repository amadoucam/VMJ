<?php

namespace Vmj\VmjBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Vmj\VmjBundle\Entity\Conversations;
use Vmj\VmjBundle\Form\ConversationsType;

/**
 * Conversations controller.
 *
 */
class ConversationsController extends Controller
{
    /**
     * Lists all Conversations entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $conversations = $em->getRepository('VmjBundle:Conversations')->findAll();

        return $this->render('conversations/index.html.twig', array(
            'conversations' => $conversations,
        ));
    }

    /**
     * Creates a new Conversations entity.
     *
     */
    public function newAction(Request $request)
    {
        $conversation = new Conversations();
        $form = $this->createForm('Vmj\VmjBundle\Form\ConversationsType', $conversation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($conversation);
            $em->flush();

            return $this->redirectToRoute('conversations_show', array('id' => $conversation->getId()));
        }

        return $this->render('conversations/new.html.twig', array(
            'conversation' => $conversation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Conversations entity.
     *
     */
    public function showAction(Conversations $conversation)
    {
        $deleteForm = $this->createDeleteForm($conversation);

        return $this->render('conversations/show.html.twig', array(
            'conversation' => $conversation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Conversations entity.
     *
     */
    public function editAction(Request $request, Conversations $conversation)
    {
        $deleteForm = $this->createDeleteForm($conversation);
        $editForm = $this->createForm('Vmj\VmjBundle\Form\ConversationsType', $conversation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($conversation);
            $em->flush();

            return $this->redirectToRoute('conversations_edit', array('id' => $conversation->getId()));
        }

        return $this->render('conversations/edit.html.twig', array(
            'conversation' => $conversation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Conversations entity.
     *
     */
    public function deleteAction(Request $request, Conversations $conversation)
    {
        $form = $this->createDeleteForm($conversation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($conversation);
            $em->flush();
        }

        return $this->redirectToRoute('conversations_index');
    }

    /**
     * Creates a form to delete a Conversations entity.
     *
     * @param Conversations $conversation The Conversations entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Conversations $conversation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('conversations_delete', array('id' => $conversation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
