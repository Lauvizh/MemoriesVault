<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isActive', ChoiceType::class, array(
                    'choices'  => array(
                        'Activate' => true,
                        'Deactivate' => false,
                        ),
                    'expanded' => true)
            )
            ->add('title', TextType::class)
            ->add('startDate', DateTimeType::class,array(
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'js-datepicker'],
                    ))
            ->add('endDate', DateTimeType::class,array(
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => ['class' => 'js-datepicker'],
                    ))
            ->add('summary',TextareaType::class)
            ->add('themes',EntityType::class,array(
                'class' =>      'AppBundle:Theme',
                'choice_label' =>   'name',
                'multiple' =>   true,
                'expanded' => true)
                )
            ->add('allowedUsers',EntityType::class,array(
                'class' =>      'AppBundle:User',
                'choice_label' =>   'name',
                'multiple' =>   true,
                'expanded' => true)
                )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }
}
