<?php

namespace Vmj\VmjBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vmj\UserBundle\Repository\UserProfileRepository;

class MessagesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                //->add('expediteur')
                ->add('destinataire', null,
                array(
                    'required' => 'required',
                    'query_builder' => function(UserProfileRepository $er ) {
                        return $er->createQueryBuilder('u')
                            ->orderBy('u.lastname', 'ASC');
                    }
                ))
                ->add('objet')
            ->add('message')
            //->add('created', 'datetime')
            //->add('updated', 'datetime')
            //->add('conversation')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vmj\VmjBundle\Entity\Messages'
        ));
    }
}
