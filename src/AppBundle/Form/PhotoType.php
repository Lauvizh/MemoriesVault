<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sizeOctet')
            ->add('fileOldName')
            ->add('extention')
            ->add('mimeType')
            ->add('addDate', 'datetime')
            ->add('captureDate', 'datetime')
            ->add('title')
            ->add('metadataScanned')
            ->add('camera')
            ->add('cameraSerialNumber')
            ->add('focal')
            ->add('focal35')
            ->add('iso')
            ->add('speed')
            ->add('aperture')
            ->add('height')
            ->add('width')
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
            'data_class' => 'AppBundle\Entity\Photo'
        ));
    }
}
