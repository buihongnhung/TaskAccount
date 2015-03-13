<?php

namespace Account\AccountBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Account\AccountBundle\Entity\CoreUser;
use Account\AccountBundle\Entity\CoreGroup;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('username', 'text')
//            ->add('password', 'text')
            ->add('email', 'text')
//            ->add('roles','entity', array(
//                'class' => 'AccountBundle:CoreGroup',
//                'property' => 'name',
//                'multiple' => false,
//                'expanded' => true,
//                'empty_data' => null,
//                'required' => false
//            ))
            ->add('Register', 'submit');


    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Account\AccountBundle\Entity\CoreUser',
            'id' => null
        ));
    }

    public function getName()
    {
        return 'username';
    }
}