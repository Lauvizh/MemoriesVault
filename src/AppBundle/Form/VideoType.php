<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isActive')
            ->add('addDate', 'datetime')
            ->add('title')
            ->add('height')
            ->add('width')
            ->add('duration')
            ->add('startDate', 'datetime')
            ->add('endDate', 'datetime')
            ->add('videoPoster')
            ->add('gpsLat')
            ->add('gpsLon')
            ->add('gpsRadius')
            ->add('infos')
            ->add('event')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Video'
        ));
    }
}
