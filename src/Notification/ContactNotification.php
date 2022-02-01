<?php

namespace App\Notification;

use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ContactNotification
{

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    public function notifyContact(Contact $contact)
    {
        $message  = (new TemplatedEmail())
            ->from('medmodiallo19@gmail.com')
            ->subject('Agence :' . $contact->getProperty()->getTitle())
            ->to('contact@agence.tn')
            ->replyTo($contact->getEmail())
            ->htmlTemplate(
                'email/contact.html.twig',
            )
            ->context([
                'contact' => $contact,
            ]);
        $this->mailer->send($message);
    }
}
