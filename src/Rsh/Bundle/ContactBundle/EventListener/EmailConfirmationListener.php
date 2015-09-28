<?php
namespace Rsh\Bundle\ContactBundle\EventListener;


use Mremi\ContactBundle\ContactEvents;
use Mremi\ContactBundle\Event\FormEvent;
use Rsh\Bundle\ContactBundle\Mailer\TwigSwiftMailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class EmailConfirmationListener implements EventSubscriberInterface
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * Constructor
     *
     * @param MailerInterface       $mailer A mailer instance
     * @param UrlGeneratorInterface $router An URL generator instance
     */
    public function __construct(TwigSwiftMailer $mailer, UrlGeneratorInterface $router)
    {
        $this->mailer = $mailer;
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            ContactEvents::FORM_SUCCESS => 'onSubmitSuccess',
        );
    }

    /**
     * Called when the form is submitted successfully.
     * Sends a confirmation email and sets the event response.
     *
     * @param FormEvent $event A form event instance
     */
    public function onSubmitSuccess(FormEvent $event)
    {
        $this->mailer->sendMessage($event->getForm()->getData());

        $url = $this->router->generate('mremi_contact_confirmation');

        $event->setResponse(new RedirectResponse($url));
    }
} 