<?php

namespace Rsh\Bundle\ContactBundle\Model;


class ContactManager
{
    /**
     * @var string
     */
    protected $class;

    /**
     * Constructor
     *
     * @param string $class The Contact class namespace
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        return new $this->class;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Contact $contact, $flush = false)
    {
        // nothing to do, just to be compliant with the created alias
    }
} 