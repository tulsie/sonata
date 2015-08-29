<?php

namespace Rsh\Bundle\ContactBundle\Event;


use Rsh\Bundle\ContactBundle\Model\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FilterContactResponseEvent extends ContactEvent
{
    /**
     * @var Response
     */
    private $response;

    /**
     * Constructor
     *
     * @param Contact          $contact  A contact instance
     * @param Request          $request  A request instance
     * @param Response         $response A response instance
     */
    public function __construct(Contact $contact, Request $request, Response $response)
    {
        parent::__construct($contact, $request);

        $this->response = $response;
    }

    /**
     * Gets the response
     *
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
} 