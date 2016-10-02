<?php
// src/AppBundle/Admin/UserAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('face', 'sonata_type_model', array(
                'class'=> 'AppBundle\Entity\Face'
                ))
            ->add('email')
            ->add('viweableEvents', 'sonata_type_model', array(
                'class'=> 'AppBundle\Entity\Event',
                'multiple' => true
                ))
            ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('face')
            ->add('email')
            ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('face')
            ->add('email')
            ;
    }
}