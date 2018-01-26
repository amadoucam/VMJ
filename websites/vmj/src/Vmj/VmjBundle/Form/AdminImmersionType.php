<?php

namespace Vmj\VmjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vmj\UserBundle\Repository\UserProfileRepository;

class AdminImmersionType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('professionnel', null, array(
                    'required' => 'required',
                    'query_builder' => function(UserProfileRepository $er ) {
                        return $er->createQueryBuilder('u')
                            ->where(' u.type = 2')
                            ->orderBy('u.lastname', 'ASC')
                            ->addOrderBy('u.firstname', 'ASC');
                    }
                ))
                ->add('title')
                ->add('categories')
                ->add('weekPrice')
                ->add('advert', null, array('required' => false))
                ->add('conditions', null, array('required' => false))
                ->add('imgPresentation', 'file', array('required' => false))
                ->add('banniere', 'file', array('required' => false))
                ->add('receiveHandicap', ChoiceType::class, array(
                    'choices' => array('1' => 'Oui', '0' => 'Non'),
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
                ->add('actifAdmin', null, array('required' => false))
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
