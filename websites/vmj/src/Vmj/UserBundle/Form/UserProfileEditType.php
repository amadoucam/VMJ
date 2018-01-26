<?php

namespace Vmj\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vmj\VmjBundle\Form\MediaType;

class UserProfileEditType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('birthday', 'text')
                ->add('firstname', null, array(
                    'required' => 'required'
                ))
                ->add('lastname', null, array(
                    'required' => 'required'
                ))
                ->add('address')
                ->add('postalcode')
                ->add('phonenumber', null, array(
                   'attr' => array(
                       'placeholder' => 'Exemple: 0123456789'
                   ) 
                ))
                ->add('town')
                ->add('sexe', 'choice', array(
                    'choices' => array(
                        'M' => 'Masculin',
                        'F' => 'Féminin'
                    ),
                    'label' => 'Sexe',
                    'expanded' => true,))
                ->add('type', 'choice' , array(
                    'choices' => array(
                      '1' => 'Particulier',
                      '2' => 'Professionnel'
                    ),
                    'multiple' => false,
                    'expanded' => true,
                    'required' => true
                ))
                ->add('photo', 'file', array('required' => false))
                ->add('businessName')
                ->add('siret')
                ->add('businessDescription')
                ->add('website')
                ->add('facebookLink')
                ->add('linkedinLink')
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
