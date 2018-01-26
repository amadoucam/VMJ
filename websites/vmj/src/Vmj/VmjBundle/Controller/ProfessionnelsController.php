<?php

namespace Vmj\VmjBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Vmj\UserBundle\Form\UserProfileType;
use Vmj\UserBundle\Form\UserType;
use Vmj\VmjBundle\Entity\CategorieJob;
use Vmj\VmjBundle\Entity\Messages;
use Vmj\UserBundle\Form\ProfessionalType;
use Vmj\VmjBundle\Entity\Immersion;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vmj\VmjBundle\Form\ImmersionCreateType;

class ProfessionnelsController extends Controller {

    public function dashboardAction() {
        return $this->redirectToRoute('dashboard_pro_immersions');
    }

    public function editionProfileProAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $userProfile = $this->getUser()->getUserProfile();
        $NonLus = $em->getRepository('VmjBundle:Messages')->compteNonLus($userProfile->getId());
        $compteNonLus = $NonLus[0][1];
        $editForm = $this->createForm(UserProfileType::class, $userProfile);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $userProfile->uploadPhoto();
            $em->persist($userProfile);
            $em->flush();
        }
        return $this->render('VmjBundle:Professionnels:editionProfilePro.html.twig', array(
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
        $editForm = $this->createForm(new ProfessionalType, $userProfile);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em->persist($userProfile);
            $em->flush();
        }
        return $this->render('VmjBundle:Professionnels:affichageProfilePro.html.twig', array(
                    'userProfile' => $userProfile,
                    'edit_form' => $editForm->createView(),
                    'compteNonLus' => $compteNonLus,));
    }

    public function afficherProAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $proProfile = $em->getRepository('VmjUserBundle:UserProfile')->findOneById($id);
        $userProfile = $this->getUser()->getUserProfile();
        $NonLus = $em->getRepository('VmjBundle:Messages')->compteNonLus($userProfile->getId());
        $compteNonLus = $NonLus[0][1];
        $editForm = $this->createForm(new ProfessionalType, $userProfile);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->persist($userProfile);
            $em->flush();
        }
        return $this->render('VmjBundle:Professionnels:afficherPro.html.twig', array(
                    'proProfile' => $proProfile,
                    'edit_form' => $editForm->createView(),
                    'compteNonLus' => $compteNonLus,));
    }

    public function immersionsAction() {
        $em = $this->getDoctrine()->getManager();
        $userProfile = $this->getUser()->getUserProfile();

        $immersions = $em->getRepository('VmjBundle:Immersion')->findByProfessionnal($userProfile->getId());

        return $this->render('VmjBundle:Professionnels:immersions.html.twig', array(
                    'userProfile' => $userProfile,
                    'immersions' => $immersions
        ));
    }

    public function newImmersionAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $userProfile = $this->getUser()->getUserProfile();

        $immersion = new Immersion();
        $immersionForm = $this->createForm(ImmersionCreateType::class, $immersion);
        $immersionForm->add('submit', SubmitType::class, array(
            'label' => 'Créer l\'immersion',
            'attr' => array('class' => 'btn btn-success pull-right')
        ));

        $immersionForm->handleRequest($request);

        if ($immersionForm->isValid()) {
            $immersion->setProfessionnel($userProfile);
            $immersion->uploadImg();
            $immersion->uploadBanniere();
            $em->persist($immersion);
            $em->flush();

            $immersions = $em->getRepository('VmjBundle:Immersion')->findByProfessionnal($userProfile);
            return $this->render('VmjBundle:Professionnels:immersions.html.twig', array(
                        'userProfile' => $userProfile,
                        'immersions' => $immersions
            ));
        }
        return $this->render('VmjBundle:Professionnels:immersionCreate.html.twig', array(
                    'immersionForm' => $immersionForm->createView()
        ));
    }

    public function editImmersionAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $immersion = $em->getRepository('VmjBundle:Immersion')->findWithCategories($id);
        $categories = $em->getRepository('VmjBundle:CategorieJob')->findByImmersion($immersion->getId());
        $immersionForm = $this->createForm(ImmersionCreateType::class, $immersion);
        $immersionForm->add('submit', SubmitType::class, array(
            'label' => 'Modifier l\'immersion',
            'attr' => array('class' => 'btn btn-success pull-right')
        ));

        $immersionForm->handleRequest($request);

        if ($immersionForm->isValid()) {
            $immersion->uploadImg();
            $immersion->uploadBanniere();
            foreach ($categories as $category) {
                $category->removeImmersion($immersion);
            }
            $em->persist($immersion);
            $em->flush();

            $categories = $request->request->get('immersion_create')['categories'];
            foreach ($categories as $category) {
                $cat = $em->getReference('VmjBundle:CategorieJob', $category);
                $cat->addImmersion($immersion);
            }
            $em->persist($immersion);
            $em->flush();

            return $this->redirectToRoute('dashboard_pro_immersions');
        }
        return $this->render('VmjBundle:Professionnels:immersionCreate.html.twig', array(
                    'immersionForm' => $immersionForm->createView()
        ));
    }

    public function myCommandesAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $immersions = $em->getRepository('VmjBundle:Commande')->findImmersionsByProfessional($user->getId());

        $commandes = array();
        foreach ($immersions as $immersion) {
            $res = $em->getRepository('VmjBundle:Commande')->findCommandesByImmersion($immersion->getId());
            if ($res) {
                $commandes[] = $res;
            }
        }

        return $this->render('VmjBundle:Professionnels:Commandes/list.html.twig', array(
                    'commandes' => $commandes
        ));
    }

    public function commandesAction($id) {
        $em = $this->getDoctrine()->getManager();
        $commandes = null;
        $res = $em->getRepository('VmjBundle:Commande')->findCommandesByImmersion($id);
        if ($res) {
            $commandes[] = $res;
        }

        return $this->render('VmjBundle:Professionnels:Commandes/list.html.twig', array(
                    'commandes' => $commandes
        ));
    }
    
    
    /**
     * Deletes a Immersion entity.
     *
     */
    public function deleteImmersionAction(Request $request, $immersionId)
    {
        $em = $this->getDoctrine()->getManager();
        $immersion = $em->getRepository('VmjBundle:Immersion')->findOneById($immersionId);
        $userProfile = $this->getUser()->getUserProfile();

        if ($immersion->getProfessionnel()->getId() == $userProfile->getId()) {
            $em->remove($immersion);
            $em->flush();

            $this->addFlash('success', 'Votre immersion a été supprimé avec succès');
            return $this->redirectToRoute('dashboard_pro_immersions');
        }else{
            $this->addFlash('danger', 'Cette suppression n\'est pas permise');
            return $this->redirectToRoute('dashboard_pro_immersions');
        }

        
    }
    /**
     * Creates a form to delete a Immersion entity.
     *
     * @param Immersion $immersion The Immersion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function immersioncreateDeleteForm(Immersion $immersion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('immersion_delete', array('id' => $immersion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
