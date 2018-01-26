<?php

namespace Vmj\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vmj\VmjBundle\Form\MediaType;

class IndividualType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('birthday', 'date', ['widget' => 'single_text', 'format' => 'dd-MM-yyyy'])
                ->add('firstname', null, array(
                    'required' => 'required'
                ))
                ->add('lastname', null, array(
                    'required' => 'required'
                ))
                ->add('profession')
                ->add('town')
                ->add('avatar', new MediaType())
                ->add('photo', 'file', array('required' => false))
                ->add('language')
                ->add('sexe', null, array(
                    'required' => 'required'
                ))
                ->add('insuranceNumber')
                ->add('insuranceName')
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
