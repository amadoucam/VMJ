<?php

namespace Vmj\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vmj\VmjBundle\Form\MediaType;

class RegistrationUserProfileType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('firstname', null, array(
                    'required' => 'required'
                ))
                ->add('lastname', null, array(
                    'required' => 'required'
                ))
                ->add('type', 'choice' , array(
                    'choices' => array(
                      '1' => 'Je veux tester un métier',
                      '2' => 'Je veux faire découvrir mon métier'
                    ),
                    'multiple' => false,
                    'expanded' => true,
                    'required' => true
                ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Vmj\UserBundle\Entity\UserProfile'
        ));
    }

}
