<?php

namespace App\Service\Mailer;

use App\Service\Mailer\Mailer;
use App\Repository\UserRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MailerMultipleUsers {

    private $userRepo;
    private $mailer;
    private $message;

    public function __construct(Mailer $mailer, UserRepository $userRepo) {
        $this->userRepo = $userRepo;
        $this->mailer = $mailer;
    }

    public function getMailer(): Mailer {
        return $this->mailer;
    }
    
    public function query(array $query): void {
        $this->query = $query;
    }

    public function send(string $template, array $params = null): void {

        if ($users = $this->userRepo->filter($this->query)) {
            foreach ($users as $user) {
                $params['user'] = $user;
                $this->mailer->to($user->getEmail());
                $this->mailer->send($template, $params);
            }
        }
    }

}
