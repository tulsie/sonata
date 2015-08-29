<?php

namespace Rsh\Bundle\ContactBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Mremi\ContactBundle\Provider\SubjectProviderInterface;

abstract class AbstractContactType extends AbstractType
{
    /**
     * @var SubjectProviderInterface
     */
    protected $subjectProvider;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var string
     */
    protected $captchaType;

    /**
     * Constructor
     *
     * @param SubjectProviderInterface $subjectProvider A subject provider instance
     * @param string                   $class           The Contact class namespace
     * @param string                   $captchaType     The captcha type
     */
    public function __construct(SubjectProviderInterface $subjectProvider, $class, $captchaType)
    {
        $this->subjectProvider = $subjectProvider;
        $this->class           = $class;
        $this->captchaType     = $captchaType;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => $this->class,
            'intention'          => 'contact',
            'translation_domain' => 'MremiContactBundle',
        ));
    }

} 