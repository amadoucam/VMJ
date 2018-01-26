<?php

namespace Vmj\UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;

class RegistrationController extends BaseController
{
    private $roles = array(
        1 => 'ROLE_USER',
        2 => 'ROLE_PRO',
        3 => 'ROLE_ADMIN'
    );
    
    public function registerAction(Request $request)
    { 
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

            $user->getUserProfile()->setEmail($user->getEmail());
            $user_mail = $user->getEmail();
            
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {

                //Mail de confirmation d'inscription
                $message = \Swift_Message::newInstance()
                    ->setSubject('Inscription')
                    ->setFrom(array('contact@viemonjob.com' => "Viemonjob"))
                    ->setTo('4wrpl3z6@robot.zapier.com')
                    ->setCharset('utf-8')
                    ->setContentType('text/html')
                    ->setBody($this->renderView('VmjBundle:MailTemplates:inscription.html.twig', array(
                        'type' => $user_type,
                        'mail' => $user_mail
                    )))
                ;
                $this->get('mailer')->send($message);

                $url = $this->generateUrl('fos_user_registration_confirmed');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('FOSUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
