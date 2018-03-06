<?php

namespace Vmj\VmjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vmj\VmjBundle\Entity\CategorieJob;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ImmersionCreateType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title')
                ->add('categories')
                ->add('weekPrice', NumberType::class, array('attr' => array('min' => 200, 'max' => 500)))
                ->add('advert', null, array('required' => false))
                ->add('conditions', null, array('required' => false))
                ->add('imgPresentation', 'file', array('required' => false))
                ->add('banniere', 'file', array('required' => false))
                ->add('receiveHandicap', ChoiceType::class, array(
                    'choices' => array('1' => 'Oui', '0' => 'Non'),
                    'data' => '0'
                ))
                ->add('customerHost', ChoiceType::class, array(
                    'choices' => array('1' => 'Oui', '0' => 'Non'),
                ))
                ->add('hostFirstname', null, array('required' => false))
                ->add('hostLastname', null, array('required' => false))
                ->add('hostNumber', null, array('required' => false))
                ->add('sameAddress', ChoiceType::class, array(
                    'choices' => array('1' => 'Oui', '0' => 'Non'),
                ))
                ->add('secondAddress', null, array('required' => false))
                ->add('secondCp', null, array('required' => false))
                ->add('secondTown', null, array('required' => false))

                ->add('hebergement', ChoiceType::class, array(
                    'choices' => array('1' => 'Oui', '0' => 'Non'),
                    'data' => '0'
                ))
                ->add('champHebergement', null, array('required' => false))
                ->add('lundi', null, array('required' => false))
                ->add('mardi', null, array('required' => false))
                ->add('mercredi', null, array('required' => false))
                ->add('jeudi', null, array('required' => false))
                ->add('vendredi', null, array('required' => false))
                ->add('samedi', null, array('required' => false))
                ->add('dimanche', null, array('required' => false))
                
                ->add('moteur', null, array('required' => false))
                ->add('visuel', null, array('required' => false))
                ->add('auditif', null, array('required' => false))
                ->add('mental', null, array('required' => false))
                ->add('autre', null, array('required' => false))
                ->add('champAutre', null, array('required' => false))
                ->add('actifPro', null, array('required' => false))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Vmj\VmjBundle\Entity\Immersion'
        ));
    }

}
