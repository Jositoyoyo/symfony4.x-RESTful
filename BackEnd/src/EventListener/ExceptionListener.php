<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener {

    public function onKernelException(GetResponseForExceptionEvent $event) {

        $exception = $event->getException();
        $message = sprintf(
                'Ocurrio un error: %s with code: %s', $exception->getMessage(), $exception->getCode()
        );

        if ($exception instanceof HttpExceptionInterface) {
            $status = $exception->getStatusCode();
            $headers = $exception->getHeaders();
        } else {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $headers = [null];
        }
        $event->setResponse(new \Symfony\Component\HttpFoundation\JsonResponse(
                array(
            'error' => $message,
            'status' => $status
                ), $status, $headers
        ));
    }

}