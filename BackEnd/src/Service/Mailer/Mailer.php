<?php

namespace App\Service\Mailer;

use Twig_Environment;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Mailer {

    private $template;
    private $mailer;
    private $subject;
    private $from;
    private $to;
    private $container;
    private $message;
    private $format = 'text/html';

    public function __construct(Twig_Environment $template, Swift_Mailer $mailer, ContainerInterface $container) {
        $this->template = $template;
        $this->mailer = $mailer;
        $this->container = $container;
        $this->message = new Swift_Message();
        $this->message->setSubject($this->container->getParameter('default_subject'));
        $this->message->setFrom($this->container->getParameter('site_email'), 'symfony');        
    }
    public function getMailer() : Swift_Mailer {
        return $this->mailer;
    }
    public function getMessage() : Swift_Message {
        return $this->message;
    }
    public function subject(string $subject): void {
        $this->message->setSubject($subject);
    }
    public function contentType($type) {
        $this->message->setContentType($type);
    }
    public function from(string $email, string $name = null): void {
        $this->message->setFrom($email, $name);
    }
    public function to(string $email, string $name = null): void {
        $this->message->setTo($email, $name);
    }
    public function reply(string $email) : void {
        $this->message->setReplyTo($email, $name);
    }
    public function format(string $format) {
        $this->format = $format;
    }
    public function send(string $template, array $params = null) : void {
        $this->mailer->send($this->message->setBody($this->template->render($template, $params), $this->format));
    }

}


