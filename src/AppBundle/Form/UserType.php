<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles',ChoiceType::class, array(
                    'choices'  => array(
                        'Admin' => 'ROLE_ADMIN',
                        'User' => 'ROLE_USER',
                        'Super User' => 'ROLE_SUPER_USER',
                        ),
                    'multiple' => true,
                    'expanded' => true,)
            )
            ->add('username')
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
                ))
            ->add('email')
            ->add('isActive', ChoiceType::class, array(
                    'choices'  => array(
                        'Activate' => true,
                        'Deactivate' => false,
                        ),
                    'expanded' => true)
            )
            ->add('face', FaceType::class)
            ->add('viweableEvents',EntityType::class,array(
                'class' =>      'AppBundle:Event',
                'choice_label' =>   'title',
                'multiple' =>   true,
                'expanded' => true))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }
}
