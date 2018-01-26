<?php

namespace Vmj\VmjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminTemoignagesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('note', 'choice', array(
                    'choices' => array(
                        "1" =>1,
                        "2" =>2,
                        "3" =>3,
                        "4" =>4,
                        "5" =>5),
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('temoignage', null, array(
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('immersion', null, array(
                    'attr' => array(
                        'style' => 'visibibility:none'
                    )
                ))
                
                ->add('redacteur', null, array(
                    'label' => 'Temoignant'/*,
                    'attr' => array(
                        'class' => 'form-control'
                    )*/
                ))

        //->add('created', 'datetime')
        //->add('updated', 'datetime')
        ->add('valide', null, array(
                    'label' => 'Valider ce temoignage'/*,
                    'attr' => array(
                        'class' => 'form-control'
                    )*/
                ))
        //->add('immersion')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Vmj\VmjBundle\Entity\Temoignages'
        ));
    }

}
