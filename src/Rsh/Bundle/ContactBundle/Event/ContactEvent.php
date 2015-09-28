<?php
namespace Rsh\Bundle\ContactBundle\Event;


use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Rsh\Bundle\ContactBundle\Model\Contact;

class ContactEvent extends Event
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Contact
     */
    private $contact;

    /**
     * Constructor
     *
     * @param Contact $contact A contact instance
     * @param Request          $request A request instance
     */
    public function __construct(Contact $contact, Request $request)
    {
        $this->contact = $contact;
        $this->request = $request;
    }

    /**
     * Gets the contact
     *
     * @return ContactInterface
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Gets the request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
} 