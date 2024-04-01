<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;
use App\Repository\ProjectConfigRepository;

class ProjectConfigSubscriber implements EventSubscriberInterface
{
    /**
     * @param $twig
     * @param $projectConfig
     */
    public function __construct(private readonly \Twig\Environment $twig, private readonly \App\Repository\ProjectConfigRepository $projectConfig)
    {
    }

    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('projectConfig', $this->projectConfig->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
