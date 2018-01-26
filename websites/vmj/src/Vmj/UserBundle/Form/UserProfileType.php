<?php

namespace Vmj\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vmj\VmjBundle\Form\MediaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserProfileType extends AbstractType {

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
                ->add('address', null, array(
                    'required' => 'required'
                ))
                ->add('postalcode', null, array(
                    'required' => 'required'
                ))
                ->add('photo', 'file', array('required' => false))
                //->add('avatar', new MediaType())
                ->add('language')
                ->add('sexe', 'choice', array(
                    'choices' => array(
                        'M' => 'Masculin',
                        'F' => 'Féminin'
                    ),
                    'label' => 'Sexe',
                    'expanded' => true,))
                ->add('phonenumber', null, array(
                   'attr' => array(
                       'placeholder' => 'Exemple: 0123456789'
                    ) 
                ))
                ->add('businessName')
                ->add('siret')
                ->add('type_tva', ChoiceType::class, array(
                    'choices' => array('20' => '20 %', '10' => '10 %'),
                ))
                ->add('insuranceNumber')
                ->add('insuranceName')
                ->add('businessDescription')
                ->add('website')
                ->add('facebookLink')
                ->add('linkedinLink')
                ->add('rib')
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
