<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('title')
            ->add('startDate', DateTimeType::class)
            ->add('endDate', DateTimeType::class)
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
