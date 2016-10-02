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
            ->add('startDate','date', array('years'=>range(1900, date('Y')), 'format'=>'ddMMMMyyyy'))
            ->add('endDate','date', array('years'=>range(1900, date('Y')), 'format'=>'ddMMMMyyyy'))
            ->add('summary','textarea')
            ->add('themes', 'sonata_type_model', array(
                'class'=> 'AppBundle\Entity\Theme',
                'multiple' => true,
                'expanded' => true
                ))
            ->add('allowedUsers', 'sonata_type_model', array(
                'class'=> 'AppBundle\Entity\User',
                'multiple' => true,
                'expanded' => true
                ))
            ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('summary')
            ->add('themes');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('startDate', 'datetime', array('format'=>'d-m-Y'))
            ->add('endDate', 'datetime', array('format'=>'d-m-Y'))
            ->add('summary')
            ->add('themes');
    }
}