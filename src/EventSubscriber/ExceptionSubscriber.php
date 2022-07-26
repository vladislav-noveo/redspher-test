<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class ExceptionSubscriber implements EventSubscriberInterface
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {}

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => [
                ['badRequestException', 1],
            ],
        ];
    }

    public function badRequestException($event)
    {
        $exception = $event->getThrowable();
        if ($exception instanceof BadRequestHttpException) {
            $event->setResponse(new RedirectResponse($this->urlGenerator->generate('calculator.page', ['solution' => 'Error'])));
        }
    }
}
