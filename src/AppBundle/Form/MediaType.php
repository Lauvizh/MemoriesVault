<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('type', ChoiceType::class, array(
                    'disabled' => true,
                    'choices'  => array(
                        'Photo' => 'pho',
                        'Video' => 'vid',
                        ),
                    'expanded' => true,
                    )
                )
            ->add('event')
            ->add('sizeKo',IntegerType::class, array("disabled" => true))
            ->add('fileOldName', TextType::class, array("disabled" => true))
            ->add('folder', TextType::class, array("disabled" => true))
            ->add('addDate', DateTimeType::class, array("disabled" => true))
            ->add('pdvDate', DateTimeType::class)
            ->add('title', TextType::class)
            ->add('camera', TextType::class)
            ->add('focal', TextType::class)
            ->add('focal35', TextType::class)
            ->add('iso', TextType::class)
            ->add('speed', TextType::class)
            ->add('aperture', TextType::class)
            ->add('height', IntegerType::class, array("disabled" => true))
            ->add('width', IntegerType::class, array("disabled" => true))
            ->add('duration', IntegerType::class)
            ->add('startDate', DateTimeType::class)
            ->add('endDate', DateTimeType::class)
            ->add('videoPoster', TextType::class)
            ->add('gpsLat', NumberType::class, array("scale" => 6))
            ->add('gpsLon', NumberType::class, array("scale" => 6))
            ->add('infos' , TextareaType::class)
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
