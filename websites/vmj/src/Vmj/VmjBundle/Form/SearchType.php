<?php

namespace Vmj\VmjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('metier', 'text', array('label' => 'Metier', 'required' => false))
                ->add('lieu', 'text', array('label' => 'lieu', 'required' => false))
                ->add('periode','date', array('label' => 'Quand ?',
                    'widget' => 'single_text', 'format' => 'dd-MM-yyyy', 'required' => false))
                ->add('motCle', 'text', array(
                    'label' => 'Recherche Libre', 'required' => false,
                    'attr' => array('size' => '15')
        ));
    }

}
