<?php

namespace App\EventSubscriber;

use App\Repository\ProjectConfigRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class ProjectConfigSubscriber implements EventSubscriberInterface
{
    /**
     * @param $twig
     * @param $projectConfig
     */
    public function __construct(private readonly Environment $twig, private readonly ProjectConfigRepository $projectConfig)
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
