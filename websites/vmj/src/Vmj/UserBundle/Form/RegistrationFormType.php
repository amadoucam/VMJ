<?php

namespace Vmj\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_profile', RegistrationUserProfileType::class)
        ;
    }
    
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType'; 
    }

    public function getBlockPrefix()
    {
        return 'vmj_user_registration';
    }
    
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
