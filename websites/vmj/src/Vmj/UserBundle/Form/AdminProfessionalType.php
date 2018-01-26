<?php

namespace Vmj\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vmj\VmjBundle\Form\MediaType;
use Vmj\VmjBundle\Form\MetierType;

class ProfessionalType extends AbstractType {

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
                ->add('profession', null, array(
                    'required' => 'required'
                ))
                ->add('town', null, array(
                    'required' => 'required'
                ))
                ->add('avatar', new MediaType())
                ->add('language', null, array(
                    'required' => 'required'
                ))
                ->add('sexe', null, array(
                    'required' => 'required'
                ))
        //->add('postes')
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
