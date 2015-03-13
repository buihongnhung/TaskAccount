<?php

namespace Account\AccountBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Account\AccountBundle\Entity\CoreGroup;
use Symfony\Component\Form\FormBuilderInterface;

class AdminCreateTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
            ->add('email', 'email')
            ->add('rolesCollection', 'entity', array(
                'class' => 'AccountBundle:CoreGroup',
                'multiple' => true,
                'expanded' => true,
                'attr' => array('class' => 'single-line-checks')
            ))
            ->add('groups', 'entity', array(
                'class' => 'AccountBundle:CoreGroup',
                'multiple' => true,
                'expanded' => true,
            ));
    }

    // public function setDefaultOptions(OptionsResolverInterface $resolver)
    // {
    //     $resolver->setDefaults(array(
    //         'data_class' => 'Exercise01\DaTaBundle\Entity\Product',
    //     ));
    // }

    public function getName()
    {
        return 'username';
    }
}