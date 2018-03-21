<?php

namespace Vmj\VmjBundle\Form;

use function PHPSTORM_META\type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vmj\UserBundle\Repository\UserProfileRepository;

class AdminPresse extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder

                ->add('name')
                ->add('date', 'date')
                ->add('logo', 'file', array('required' => false))
                ->add('lien', null, array('required' => false))
                ->add('cat', ChoiceType::class, array(
                    'choices' => array('television', 'web', 'radio'),
                ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Vmj\VmjBundle\Entity\Presse'
        ));
    }

}
