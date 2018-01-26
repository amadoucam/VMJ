<?php

namespace Vmj\VmjBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vmj\VmjBundle\Entity\Messages;
use Vmj\VmjBundle\Entity\Conversations;
use Vmj\VmjBundle\Form\MessagesType;
use Vmj\VmjBundle\Form\MessagesReplyType;

/**
 * Messages controller.
 *
 */
class MessagesController extends Controller {

    /**
     * Lists all Messages entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('VmjBundle:Messages')->findAll();

        return $this->render('messages/index.html.twig', array(
                    'messages' => $messages,
        ));
    }

    /**
     * Lists all Messages entities.
     *
     */
    public function inboxAction() {
        $em = $this->getDoctrine()->getManager();

        $userProfile = $this->getUser()->getUserProfile();
        $mails = $em->getRepository('VmjBundle:Messages')->findBy(array(
            'destinataire' => $userProfile->getId()
        ));

        return $this->render('messages/inbox.html.twig', array(
                    'mails' => $mails,
                    'userProfile' => $userProfile,
        ));
    }

    /**
     * Lists all Messages entities.
     *
     */
    public function outboxAction() {
        $em = $this->getDoctrine()->getManager();

        $userProfile = $this->getUser()->getUserProfile();
        $sents = $em->getRepository('VmjBundle:Messages')->findBy(array(
            'expediteur' => $userProfile->getId()
        ));

        return $this->render('messages/outbox.html.twig', array(
                    'sents' => $sents,
                    'userProfile' => $userProfile,
        ));
    }

    /**
     * Creates a new Message entity.
     *
     */
    public function composeAction(Request $request) {
        $userProfile = $this->getUser()->getUserProfile();
        $message = new Messages();
        $message->setForadmin(0);
        $message->setExpediteur($userProfile);
        $form = $this->createForm('Vmj\VmjBundle\Form\MessagesType', $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $destinataireId = $this->get('request')->request->get('messages')['destinataire'];
            $em = $this->getDoctrine()->getManager();

            $destinataire = $em->getRepository('VmjUserBundle:UserProfile')->findOneById($destinataireId);
            //dump($destinataire);
            //die();
            $conversation = $em->getRepository('VmjBundle:Conversations')->getTheConversation($userProfile->getId(), $destinataireId);
            if (empty($conversation)) {
                
                $conversation = new Conversations();
                $conversation->setEmetteur($userProfile);
                $conversation->setRecepteur($destinataire);
                $conversation->setForadmin(0);
                $message->setConversation($conversation);
               // dump($conversation);
               // die();
            } else {
                $message->setConversation($conversation[0]);
            }
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('messages_outbox');
        }

        return $this->render('messages/compose.html.twig', array(
                    'message' => $message,
                    'userProfile' => $userProfile,
                    'form' => $form->createView(),
        ));
    }
    
    /**
     * Creates a new Message entity.
     *
     */
    public function contacterProAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $userProfile = $this->getUser()->getUserProfile();
        $proProfile = $em->getRepository('VmjUserBundle:UserProfile')->findOneById($id);
        $message = new Messages();
        $message->setExpediteur($userProfile);
        $message->setDestinataire($proProfile);
        $form = $this->createForm('Vmj\VmjBundle\Form\MessagesType', $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $destinataireId = $this->get('request')->request->get('messages')['destinataire'];

            $destinataire = $em->getRepository('VmjUserBundle:UserProfile')->findOneById($destinataireId);
            //dump($destinataire);
            //die();
            $conversation = $em->getRepository('VmjBundle:Conversations')->getTheConversation($userProfile->getId(), $destinataireId);
            if (empty($conversation)) {
                $conversation = new Conversations();
                $conversation->setEmetteur($userProfile);
                $conversation->setRecepteur($destinataire);
                $message->setConversation($conversation);
            } else {
                $message->setConversation($conversation[0]);
            }
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('messages_outbox');
        }

        return $this->render('messages/compose.html.twig', array(
                    'message' => $message,
                    'userProfile' => $userProfile,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Message entity.
     *
     */
    public function replyAction(Request $request) {
        $userProfile = $this->getUser()->getUserProfile();
        $em = $this->getDoctrine()->getManager();
        $message = new Messages();
        $message->setExpediteur($userProfile);
        $form = $this->createForm('Vmj\VmjBundle\Form\MessagesReplyType', $message);
        $form->handleRequest($request);
        if (isset($_POST['destinataire'])) {
            $destinataireId = $_POST['destinataire'];
            $destinataire = $em->getRepository('VmjUserBundle:UserProfile')->findOneById($destinataireId);
            $messageObjet = $_POST['objet'];
        }
        if ($form->isSubmitted() && $form->isValid()) {

            $destinataireId = $_POST['messages']['destinataire'];
            $messageObjet = $_POST['messages']['objet'];

            $destinataire = $em->getRepository('VmjUserBundle:UserProfile')->findOneById($destinataireId);
            //dump($destinataire);
            //die();
            $message->setDestinataire($destinataire);
            $message->setObjet($messageObjet);
            $conversation = $em->getRepository('VmjBundle:Conversations')->getTheConversation($userProfile->getId(), $destinataireId);
            if (empty($conversation)) {
                $conversation = new Conversations();
                $conversation->setEmetteur($userProfile);
                $conversation->setRecepteur($destinataire);
                $message->setConversation($conversation);
            } else {
                $message->setConversation($conversation[0]);
            }
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('messages_outbox');
        }

        return $this->render('messages/reply.html.twig', array(
                    'message' => $message,
                    'userProfile' => $userProfile,
                    'form' => $form->createView(),
                    'destinataire' => $destinataire,
                    'messageObjet' => $messageObjet,
        ));
    }

    /**
     * Ecrire à un administrateur
     *
     */
    public function writeToAdminAction(Request $request) {
        $userProfile = $this->getUser()->getUserProfile();
        $em = $this->getDoctrine()->getManager();
        $message = new Messages();
        $message->setExpediteur($userProfile);
        $form = $this->createForm('Vmj\VmjBundle\Form\MessagesReplyType', $message);
        $form->handleRequest($request);
        $messageObjet = "";
       /* if (isset($_POST['destinataire'])) {
            $destinataireId = $_POST['destinataire'];
            $destinataire = $em->getRepository('VmjUserBundle:UserProfile')->findOneById($destinataireId);
            $messageObjet = $_POST['objet'];
        }*/
        if ($form->isSubmitted() && $form->isValid()) {

           // $destinataireId = $_POST['messages']['destinataire'];
            $messageObjet = $_POST['messages']['objet'];

           // $destinataire = $em->getRepository('VmjUserBundle:UserProfile')->findOneByType(2);
            
           // $message->setDestinataire($destinataire);
            $message->setObjet($messageObjet);
            $message->setForadmin(1);
            
            $conversation = $em->getRepository('VmjBundle:Conversations')->getAdminConversation($userProfile->getId());
            //dump($destinataire);
           // die();
            if (empty($conversation)) {
                $conversation = new Conversations();
                $conversation->setEmetteur($userProfile);
                $conversation->setForadmin(1);
                $message->setConversation($conversation);
            } else {
                $message->setConversation($conversation[0]);
            }
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('messages_outbox');
        }

        return $this->render('messages/writeAdmin.html.twig', array(
                    'message' => $message,
                    'userProfile' => $userProfile,
                    'form' => $form->createView(),
                    'messageObjet' => $messageObjet,
        ));
    }

    /**
     * Creates a new Messages entity.
     *
     */
    public function newAction(Request $request) {
        $message = new Messages();
        $form = $this->createForm('Vmj\VmjBundle\Form\MessagesType', $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('messages_show', array('id' => $message->getId()));
        }

        return $this->render('messages/new.html.twig', array(
                    'message' => $message,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Messages entity.
     *
     */
    public function showAction(Messages $message) {
        if (!$message->getLu()) {
            $message->setLu(TRUE);
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
        }
        $deleteForm = $this->createDeleteForm($message);
        $userProfile = $this->getUser()->getUserProfile();
        return $this->render('messages/show.html.twig', array(
                    'message' => $message,
                    'delete_form' => $deleteForm->createView(),
                    'userProfile' => $userProfile,
        ));
    }

    /**
     * Finds and displays a Message without mark read.
     *
     */
    public function voirAction(Messages $message) {

        $deleteForm = $this->createDeleteForm($message);
        $userProfile = $this->getUser()->getUserProfile();
        return $this->render('messages/show.html.twig', array(
                    'message' => $message,
                    'delete_form' => $deleteForm->createView(),
                    'userProfile' => $userProfile,
        ));
    }

    /**
     * Displays a form to edit an existing Messages entity.
     *
     */
    public function editAction(Request $request, Messages $message) {
        $deleteForm = $this->createDeleteForm($message);
        $editForm = $this->createForm('Vmj\VmjBundle\Form\MessagesType', $message);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('messages_edit', array('id' => $message->getId()));
        }

        return $this->render('messages/edit.html.twig', array(
                    'message' => $message,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Messages entity.
     *
     */
    public function deleteAction(Request $request, Messages $message) {
        $form = $this->createDeleteForm($message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($message);
            $em->flush();
        }

        return $this->redirectToRoute('messages_index');
    }

    /**
     * Creates a form to delete a Messages entity.
     *
     * @param Messages $message The Messages entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Messages $message) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('messages_delete', array('id' => $message->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
