<?php

namespace Vmj\VmjBundle\Controller;

use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vmj\UserBundle\Form\UserEditType;
use Vmj\UserBundle\Entity\User;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Vmj\VmjBundle\Entity\Immersion;
use Vmj\VmjBundle\Entity\Presse;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vmj\VmjBundle\Form\AdminImmersionType;
use Vmj\UserBundle\Entity\UserProfile;
use Vmj\VmjBundle\Entity\Promo;

class AdminController extends Controller {

    private $roles = array(
        1 => 'ROLE_USER',
        2 => 'ROLE_PRO',
        3 => 'ROLE_ADMIN'
    );

    public function dashboardAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $userProfile = $this->getUser()->getUserProfile();
        if (empty($userProfile)) {
            $userProfile = new Userprofile();
            $this->getUser()->setUserProfile($userProfile);

            $em->persist($userProfile);
            $em->flush();
        }
        $NonLus = $em->getRepository('VmjBundle:Messages')->compteNonLus($userProfile->getId());
        $compteNonLus = $NonLus[0][1];
        return $this->render('VmjBundle:Admin:dashboardAdmin.html.twig', array(
                    'userProfile' => $userProfile,
                    'compteNonLus' => $compteNonLus,
        ));
    }

    public function editImmersionAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $immersion = $em->getRepository('VmjBundle:Immersion')->findOneById($id);
        $categories = $em->getRepository('VmjBundle:CategorieJob')->findByImmersion($immersion->getId());
        $immersionForm = $this->createForm(AdminImmersionType::class, $immersion);
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

            $categories = $request->request->get('admin_immersion')['categories'];
            foreach ($categories as $category) {
                $cat = $em->getReference('VmjBundle:CategorieJob', $category);
                $cat->addImmersion($immersion);
            }
            $em->persist($immersion);
            $em->flush();

            return $this->redirectToRoute('admin_immersions');
        }
        $deleteForm = $this->createDeleteImmersionForm($immersion);
        return $this->render('VmjBundle:Admin:immersionCreate.html.twig', array(
                    'immersionForm' => $immersionForm->createView(),
                    'deleteForm' => $deleteForm->createView()
        ));
    }

    /**
     * Creates a form to delete a Immersion entity.
     *
     * @param Immersion $immersion The Immersion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteImmersionForm(Immersion $immersion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_immersion_delete', array('id' => $immersion->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function deleteImmersionAction(Request $request, Immersion $immersion)
    {
        $form = $this->createDeleteImmersionForm($immersion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($immersion);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Votre immersion a été supprimé avec succès')
            ;
        }

        return $this->redirectToRoute('admin_immersions');
    }

    public function indexUserAction() {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('VmjUserBundle:UserProfile')->findBy(
            array('type' => 2),
            array('id' => 'DESC')
        );

        return $this->render('VmjBundle:Admin:User/list.html.twig', array(
                    'users' => $users
        ));
    }
    
    public function listParticuliersAction() {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('VmjUserBundle:UserProfile')->findAllParticulier();

        return $this->render('VmjBundle:Admin:User/particuliers.html.twig', array(
                    'users' => $users
        ));
    }

    public function addUserAction(Request $request) {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            // Gestion du type d'utilisateur et ajout du role
            $user_type = $form->get('user_profile')->get('type')->getData();
            $new_role = $this->roles[$user_type];

            $event = new FormEvent($form, $request);
            $user = $event->getForm()->getData();
            $user->addRole($new_role);
            //dump($form->get('user_profile')->get('birthday')->getData()); die(); 
            $birthday = \DateTime::createFromFormat("d-m-Y", $form->get('user_profile')->get('birthday')->getData());
            $birthday->format('Y-m-d');
            $user->getUserProfile()->setBirthday($birthday);

          //  $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('admin_users_index');
                $response = new RedirectResponse($url);
            }

           // $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('VmjBundle:Admin:User/add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function editUserAction(Request $request) {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');
        $em = $this->getDoctrine()->getManager();

        $id = $request->attributes->get('id');
        $user = $em->getRepository('VmjUserBundle:User')->findOneBy(array(
            'user_profile' => $id
        ));

        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }
        $form = $this->createForm(UserEditType::class, $user);

        $deleteForm = $this->createDeleteForm($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            // Gestion du type d'utilisateur et ajout du role
            $user_type = $form->get('user_profile')->get('type')->getData();
            $new_role = $this->roles[$user_type];

            $event = new FormEvent($form, $request);
            $user = $event->getForm()->getData();
            $user->addRole($new_role);
            //dump($form->get('user_profile')->get('birthday')->getData()); die(); 
            $birthday = \DateTime::createFromFormat("d-m-Y", $form->get('user_profile')->get('birthday')->getData());
            $birthday->format('Y-m-d');
            $user->getUserProfile()->setBirthday($birthday);
            $user->getUserProfile()->uploadPhoto();

            //$dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('admin_users_index');
                $response = new RedirectResponse($url);
            }

            //  $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
            //return $this->generateUrl('admin_users_index');
        }

        return $this->render('VmjBundle:Admin:User/edit.html.twig', array(
                    'form' => $form->createView(),
                    'deleteform' => $deleteForm->createView(),
                    'userprofile' => $user->getUserProfile()
        ));
    }

    public function deleteUserAction(Request $request, User $user) {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            try{
                $em->remove($user->getUserProfile());
                $em->flush();

                $em->remove($user);
                $em->flush();
            }
            catch (ForeignKeyConstraintViolationException $e)
            {
                if($e->getSQLState() == "23000"){
                    $this->addFlash('notice', "Ce professionel  ne peut être supprimé car il est relié à une commande. Veuillez supprimer la commande avant.");
                }
            }
        }
        
        return $this->redirectToRoute('admin_users_index');
    }

    public function searchUserAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $keys = $request->request->get('search');
        $users = null;

        if ($keys) {
            $users = $em->getRepository('VmjUserBundle:UserProfile')->search($keys);
        }

        return $this->render('VmjBundle:Admin:User/search.html.twig', array('users' => $users));
    }

    /**
     * Creates a form to delete a Temoignages entity.
     *
     * @param User $user The Temoignages entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_users_delete', array('id' => $user->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function adminImmersionsAction() {
        $em = $this->getDoctrine()->getManager();
        $userProfile = $this->getUser()->getUserProfile();
        $immersions = $em->getRepository('VmjBundle:Immersion')->findAllByUpdatedDate();
        return $this->render('VmjBundle:Admin:immersions.html.twig', array(
                    'userProfile' => $userProfile,
                    'immersions' => $immersions
        ));
    }

    public function createImmersionAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $immersion = new Immersion();
        $immersionForm = $this->createForm('Vmj\VmjBundle\Form\AdminImmersionType', $immersion);
        $immersionForm->add('submit', SubmitType::class, array(
            'label' => 'Créer l\'immersion',
            'attr' => array('class' => 'btn btn-default pull-right')
        ));

        $immersionForm->handleRequest($request);

        if ($immersionForm->isValid()) {
            $em->persist($immersion);
            $em->flush();

            $immersions = $em->getRepository('VmjBundle:Immersion')->findAll();
            return $this->render('VmjBundle:Admin:immersions.html.twig', array(
                        'immersions' => $immersions
            ));
        }
        return $this->render('VmjBundle:Admin:immersionCreate.html.twig', array(
                    'immersionForm' => $immersionForm->createView()
        ));
    }

                    /* ADMIN PRESSE */

    public function listPresseAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('VmjBundle:Presse')->findAll();

        return $this->render('VmjBundle:Admin:presseList.html.twig', array(
            'articles' => $articles
        ));
    }

    public function editPresseAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('VmjBundle:Presse')->findOneById($id);

        $presseForm = $this->createForm('Vmj\VmjBundle\Form\AdminPresse', $article);

        $presseForm->add('submit', SubmitType::class, array(
            'label' => 'Modifier l\'article',
            'attr' => array('class' => 'btn btn-success pull-right')
        ));

        $presseForm->handleRequest($request);

        if ($presseForm->isValid())
        {
            $article->uploadLogo();

            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('admin_presse_list');
        }

        $deleteArticleForm = $this->createDeletePresseForm($article);

        return $this->render('VmjBundle:Admin:presseCreate.html.twig', array(
            'presseForm' => $presseForm->createView(),
            'deleteArticleForm' => $deleteArticleForm->createView()));
    }

    public function deletePresseAction(Request $request, Presse $article)
    {
        $form = $this->createDeletePresseForm($article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Votre article a été supprimé avec succès')
            ;
        }

        return $this->redirectToRoute('admin_presse_list');
    }

    /**
     * Creates a form to delete a Presse entity.
     *
     * @param Presse $presse The Presse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeletePresseForm(Presse $presse)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_presse_delete', array('id' => $presse->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function createPresseAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $presse = new Presse();
        $presseForm = $this->createForm('Vmj\VmjBundle\Form\AdminPresse', $presse);
        $presseForm->add('submit', SubmitType::class, array(
            'label' => 'Valider',
            'attr' => array('class' => 'btn btn-default pull-right')
        ));

        $presseForm->handleRequest($request);

        if ($presseForm->isValid())
        {
            $presse->uploadLogo();
            $em->persist($presse);
            $em->flush();

            /*return $this->render('VmjBundle:Admin:presseCreate.html.twig', array (
                'presseForm' => $presseForm->createView()
            ));*/

            return $this->redirectToRoute('admin_presse_list');
        }
        
        return $this->render('VmjBundle:Admin:presseCreate.html.twig', array(
            'presseForm' => $presseForm->createView()
        ));
    }
                    /* END ADMIN PRESSE */

                    /* ADMIN PROMO */

    public function createPromoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $promo = new Promo();
        $promoForm = $this->createForm('Vmj\VmjBundle\Form\AdminPromoType', $promo);
        $promoForm->add('submit', SubmitType::class, array(
            'label' => 'Valider',
            'attr' => array('class' => 'btn btn-default pull-right')
        ));

        $promoForm->handleRequest($request);

        if ($promoForm->isValid())
        {
            $em->persist($promo);
            $em->flush();

            return $this->redirectToRoute('admin_promo_list');
        }
        
        return $this->render('VmjBundle:Admin:promoCreate.html.twig', array(
            'promoForm' => $promoForm->createView()
        ));
    }

    public function listPromoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $codes = $em->getRepository('VmjBundle:Promo')->findAll();

        return $this->render('VmjBundle:Admin:promoList.html.twig', array(
            'codes' => $codes
        ));
    }

    private function createDeletePromoForm(Promo $promo) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_promo_delete', array('id' => $promo->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function deletePromoAction(Request $request, Promo $promo)
    {
        $form = $this->createDeletePromoForm($promo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($promo);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Le code promo a été supprimé avec succès')
            ;
        }

        return $this->redirectToRoute('admin_promo_list');
    }

    public function editPromoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $promo = $em->getRepository('VmjBundle:Promo')->findOneById($id);

        $promoForm = $this->createForm('Vmj\VmjBundle\Form\AdminPromoType', $promo);

        $promoForm->add('submit', SubmitType::class, array(
            'label' => 'Modifier le code promo',
            'attr' => array('class' => 'btn btn-success pull-right')
        ));

        $promoForm->handleRequest($request);

        if ($promoForm->isValid())
        {
            $em->persist($promo);
            $em->flush();

            return $this->redirectToRoute('admin_promo_list');
        }

        $deleteCodeForm = $this->createDeletePromoForm($promo);

        return $this->render('VmjBundle:Admin:promoCreate.html.twig', array(
            'promoForm' => $promoForm->createView(),
            'deleteCodeForm' => $deleteCodeForm->createView()));
    }

                    /* END ADMIN PROMO */

    
    public function adminCommandesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $commandes = $em->getRepository('VmjBundle:Commande')->findBy(
                array());
        /*if ($res) {
            $commandes[] = $res;
        }*/
        //dump($commandes);
        //die();
        //$commandes = $em->getRepository('VmjBundle:Commande')->commandesValidees();

        return $this->render('VmjBundle:Admin:Commandes/adminCommandes.html.twig', array(
                    'commandes' => $commandes
        ));
    }

    /**
     * Deletes a Immersion entity.
     *
     */
    public function changeImmersionStatutAction(Request $request, $immersionId) {
        $em = $this->getDoctrine()->getManager();
        $immersion = $em->getRepository('VmjBundle:Immersion')->findOneById($immersionId);
        $userProfile = $this->getUser()->getUserProfile();
        if ($immersion->getActifAdmin() == 0) {
            $immersion->setActifAdmin(1);
            $em->persist($immersion);
            $em->flush();

            $request->getSession()
                    ->getFlashBag()
                    ->add('success', 'L\'immersion a été activé avec succès')
            ;
            return $this->redirectToRoute('dashboard_admin_immersions');
        } else {
            $request->getSession()
                    ->getFlashBag()
                    ->add('danger', 'Cette suppression n\'est pas permise')
            ;
            return $this->redirectToRoute('dashboard_pro_immersions');
        }
    }

    public function statsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $particuliers = $em->getRepository('VmjUserBundle:UserProfile')->countAllParticuliers();

        $particuliers_f = $em->getRepository('VmjUserBundle:UserProfile')->countAllParticuliersWomen();

        $particuliers_h = $em->getRepository('VmjUserBundle:UserProfile')->countAllParticuliersMen();

        $particuliers_null = $particuliers - ( $particuliers_f + $particuliers_h);

        $professionnels = $em->getRepository('VmjUserBundle:UserProfile')->countAllPro();

        $professionnels_f = $em->getRepository('VmjUserBundle:UserProfile')->countAllProWomen();

        $professionnels_h = $em->getRepository('VmjUserBundle:UserProfile')->countAllProMen();

        $professionnels_null = $professionnels - ($professionnels_f + $professionnels_h);

        $immersions = $em->getRepository('VmjBundle:Commande')->countAllCommandes();

        $commande_stat_f = $em->getRepository('VmjBundle:Commande')->countAllCommandesF();

        $commande_stat_h = $em->getRepository('VmjBundle:Commande')->countAllCommandesM();

        $immersions_ko = $em->getRepository('VmjBundle:Commande')->immersionsKo();

        $immersions_run = $em->getRepository('VmjBundle:Commande')->immersionsRun();

        $immersions_end = $em->getRepository('VmjBundle:Commande')->immersionsEnd();

        $top_pro = $em->getRepository('VmjBundle:Commande')->topPro();

        $temoignages = $em->getRepository('VmjBundle:Commande')->countTemoin();

        return $this->render('VmjBundle:Admin:statistiques.html.twig', array(
            'particuliers' => $particuliers,
            'immersions' => $immersions,
            'particuliers_null' => $particuliers_null,
            'particuliers_f' => $particuliers_f,
            'particuliers_h' => $particuliers_h,
            'professionnels' => $professionnels,
            'professionnels_f' => $professionnels_f,
            'professionnels_h' => $professionnels_h,
            'professionnels_null' => $professionnels_null,
            'commande_stat_f' => $commande_stat_f,
            'commande_stat_h' => $commande_stat_h,
            'immersions_ko' => $immersions_ko,
            'immersions_run' => $immersions_run,
            'immersions_end' => $immersions_end,
            'top_pro' => $top_pro,
            'temoignages' => $temoignages
        ));
    }
}