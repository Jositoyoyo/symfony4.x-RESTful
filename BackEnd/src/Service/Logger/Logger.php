<?php

namespace App\Service\Logger;
use Psr\Log\LoggerInterface;

class Logger {

    public function __construct(LoggerInterface $logger) {
        $logger->info('I just got the logger');
        $logger->error('An error occurred');

        $logger->critical('I left the oven on!', array(
            // include extra "context" info in your logs
            'cause' => 'in_hurry',
        ));

        // ...
    }

}
