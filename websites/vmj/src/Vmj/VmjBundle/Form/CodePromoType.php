<?php

namespace Vmj\VmjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CodePromoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('code_promo', 'text', array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => "Votre code promo"
                    )));
    }
}
