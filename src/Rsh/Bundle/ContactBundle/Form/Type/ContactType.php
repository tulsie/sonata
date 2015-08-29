<?php

namespace Rsh\Bundle\ContactBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ContactType extends AbstractContactType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text',  ['label' => true])
            ->add('lastName', 'text',  ['label' => true])
            ->add('company', 'text',  ['label' => true])
            ->add('phone', 'number',  ['label' => true])
            ->add('email',     'email');

        $builder->add('message', 'textarea', ['label' => true]);

        $builder->add('save', 'submit', ['label' => true]);
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'messages'
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'rsh_contact';
    }
} 