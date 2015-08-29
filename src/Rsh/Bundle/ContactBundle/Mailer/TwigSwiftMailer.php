<?php

namespace Rsh\Bundle\ContactBundle\Mailer;

use Mremi\ContactBundle\Mailer\MailerInterface;
use Rsh\Bundle\ContactBundle\Model\Contact;

class TwigSwiftMailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var string
     */
    private $recipientAddress;

    /**
     * @var string
     */
    private $template;

    /**
     * @var array
     */
    private $from;

    /**
     * Constructor
     *
     * @param \Swift_Mailer     $mailer           A mailer instance
     * @param \Twig_Environment $twig             A Twig instance
     * @param string            $recipientAddress The recipient email
     * @param string            $template         The template used for email content
     * @param array             $from             The From address
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, $recipientAddress, $template, $from = '')
    {
        $this->mailer           = $mailer;
        $this->twig             = $twig;
        $this->recipientAddress = $recipientAddress;
        $this->template         = $template;
        $this->from             = $from;
    }

    /**
     * {@inheritdoc}
     */
    public function sendMessage(Contact $contact)
    {
        $context = array(
            'contact' => $contact,
        );

        $template = $this->twig->loadTemplate($this->template);
        $textBody = $template->renderBlock('body_text', $context);
        $htmlBody = $template->renderBlock('body_html', $context);

        $message = \Swift_Message::newInstance()
            ->setSubject($contact->getSubject())
            ->setFrom($this->from ?: array($contact->getEmail() => $contact->getFirstName() . $contact->getLastName()))
            ->setTo($this->recipientAddress);

        if (!empty($htmlBody)) {
            $message->setBody($htmlBody, 'text/html')
                ->addPart($textBody, 'text/plain');
        } else {
            $message->setBody($textBody);
        }

        return $this->mailer->send($message);
    }
} 