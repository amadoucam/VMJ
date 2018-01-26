<?php

namespace Vmj\VmjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimpleSearchType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('metier', 'text', array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control br30 grisfonce fontstyleinput',
                        'placeholder' => "Entrez un métier, rechercher par mots clés ou par ville"
                    )));
    }

}
