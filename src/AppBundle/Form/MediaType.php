<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('sizeKo')
            ->add('fileOldName')
            ->add('name')
            ->add('folder')
            ->add('addDate', 'datetime')
            ->add('pdvDate', 'datetime')
            ->add('title')
            ->add('camera')
            ->add('focal')
            ->add('focal35')
            ->add('iso')
            ->add('speed')
            ->add('aperture')
            ->add('height')
            ->add('width')
            ->add('duration')
            ->add('startDate', 'datetime')
            ->add('endDate', 'datetime')
            ->add('videoSet')
            ->add('gpsLat')
            ->add('gpsLon')
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
            'data_class' => 'AppBundle\Entity\Media'
        ));
    }
}
