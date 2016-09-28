<?php
// src/AppBundle/Admin/EventAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EventAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('startDate')
            ->add('endDate')
            ->add('summary')
            ->add('themes', 'sonata_type_model', array(
                'class'=> 'AppBundle\Entity\Theme',
                'multiple' => true
                ))
            ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('startDate')
            ->add('endDate')
            ->add('summary')
            ->add('themes');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('startDate')
            ->add('endDate')
            ->add('summary')
            ->add('themes');
    }
}