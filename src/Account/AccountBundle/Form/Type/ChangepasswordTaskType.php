<?php

namespace Account\AccountBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Account\AccountBundle\Entity\Account;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangepasswordTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', 'text')
            ->add('new_password', 'text')
            ->add('repeat_new_password', 'text')
            ->add('Change', 'submit');


    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Account\AccountBundle\Entity\Account',
            'id' => null
        ));
    }

    public function getName()
    {
        return 'account';
    }
}