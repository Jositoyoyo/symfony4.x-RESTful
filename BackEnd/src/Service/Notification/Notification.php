<?php

namespace App\Service\Notification;

use App\Service\Mailer\MailerMultipleUsers;

class Notification {

    protected $mail;

    public function __construct(MailerMultipleUsers $mail) {
        $this->mail = $mail;
    }

    public function query() {
        
    }
    public function send(string $template, array $parameters) {
        
    }

}
