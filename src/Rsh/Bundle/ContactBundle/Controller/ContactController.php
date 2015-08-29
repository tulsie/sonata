<?php

namespace Rsh\Bundle\ContactBundle\Controller;

use Mremi\ContactBundle\ContactEvents;
use Rsh\Bundle\ContactBundle\Event\ContactEvent;
use Rsh\Bundle\ContactBundle\Event\FilterContactResponseEvent;
use Mremi\ContactBundle\Event\FormEvent;
use Mremi\ContactBundle\Form\Factory\FormFactory;
use Rsh\Bundle\ContactBundle\Model\ContactManager;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Contact controller class
 *
 * @author Rémi Marseille <marseille.remi@gmail.com>
 */
class ContactController
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @var ContactManagerInterface
     */
    private $contactManager;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * Constructor
     *
     * @param EventDispatcherInterface $eventDispatcher An event dispatcher instance
     * @param FormFactory              $formFactory     A form factory instance
     * @param ContactManager  $contactManager  A contact manager instance
     * @param RouterInterface          $router          A router instance
     * @param SessionInterface         $session         A session instance
     * @param EngineInterface          $templating      A templating instance
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, FormFactory $formFactory, ContactManager $contactManager, RouterInterface $router, SessionInterface $session, EngineInterface $templating)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->formFactory     = $formFactory;
        $this->contactManager  = $contactManager;
        $this->router          = $router;
        $this->session         = $session;
        $this->templating      = $templating;
    }

    /**
     * Index action in charge to render the form
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response|RedirectResponse
     */
    public function indexAction(Request $request)
    {
        $contact = $this->contactManager->create();

        $this->eventDispatcher->dispatch(ContactEvents::FORM_INITIALIZE, new ContactEvent($contact, $request));

        $form = $this->formFactory->createForm($contact);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $this->eventDispatcher->dispatch(ContactEvents::FORM_SUCCESS, $event);

            if (null === $response = $event->getResponse()) {
                $response = new RedirectResponse($this->router->generate('mremi_contact_confirmation'));
            }

            $this->contactManager->save($contact, true);
            $this->session->set('mremi_contact_data', $contact);

            $this->eventDispatcher->dispatch(ContactEvents::FORM_COMPLETED, new FilterContactResponseEvent($contact, $request, $response));

            return $response;
        }

        return $this->templating->renderResponse('RshContactBundle:Contact:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Confirm action in charge to render a confirmation message
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws AccessDeniedException If no contact stored in session
     */
    public function confirmAction()
    {
        $contact = $this->session->get('mremi_contact_data');

        if (!$contact) {
            throw new AccessDeniedException('Please fill the contact form');
        }

        return $this->templating->renderResponse('RshContactBundle:Contact:confirm.html.twig', array(
            'contact' => $contact,
        ));
    }
}
