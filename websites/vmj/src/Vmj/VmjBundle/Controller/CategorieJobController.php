<?php

namespace Vmj\VmjBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Vmj\VmjBundle\Entity\CategorieJob;
use Vmj\VmjBundle\Form\CategorieJobType;

/**
 * CategorieJob controller.
 *
 */
class CategorieJobController extends Controller
{
    /**
     * Lists all CategorieJob entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorieJobs = $em->getRepository('VmjBundle:CategorieJob')->findAll();

        return $this->render('categoriejob/index.html.twig', array(
            'categorieJobs' => $categorieJobs,
        ));
    }

    /**
     * Creates a new CategorieJob entity.
     *
     */
    public function newAction(Request $request)
    {
        $categorieJob = new CategorieJob();
        $form = $this->createForm('Vmj\VmjBundle\Form\CategorieJobType', $categorieJob);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieJob);
            $em->flush();

            return $this->redirectToRoute('admin_categoriejob_show', array('id' => $categorieJob->getId()));
        }

        return $this->render('categoriejob/new.html.twig', array(
            'categorieJob' => $categorieJob,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CategorieJob entity.
     *
     */
    public function showAction(CategorieJob $categorieJob)
    {
        $deleteForm = $this->createDeleteForm($categorieJob);

        return $this->render('categoriejob/show.html.twig', array(
            'categorieJob' => $categorieJob,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CategorieJob entity.
     *
     */
    public function editAction(Request $request, CategorieJob $categorieJob)
    {
        $deleteForm = $this->createDeleteForm($categorieJob);
        $editForm = $this->createForm('Vmj\VmjBundle\Form\CategorieJobType', $categorieJob);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieJob);
            $em->flush();

            return $this->redirectToRoute('admin_categoriejob_edit', array('id' => $categorieJob->getId()));
        }

        return $this->render('categoriejob/edit.html.twig', array(
            'categorieJob' => $categorieJob,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CategorieJob entity.
     *
     */
    public function deleteAction(Request $request, CategorieJob $categorieJob)
    {
        $form = $this->createDeleteForm($categorieJob);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorieJob);
            $em->flush();
        }

        return $this->redirectToRoute('admin_categoriejob_index');
    }

    /**
     * Creates a form to delete a CategorieJob entity.
     *
     * @param CategorieJob $categorieJob The CategorieJob entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CategorieJob $categorieJob)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_categoriejob_delete', array('id' => $categorieJob->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
