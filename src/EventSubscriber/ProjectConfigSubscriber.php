<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;
use App\Repository\ProjectConfigRepository;

class ProjectConfigSubscriber implements EventSubscriberInterface
{

    private $twig;
    private $projectConfig;

    /**
     * @param $twig
     * @param $projectConfig
     */
    public function __construct(Environment $twig, ProjectConfigRepository $projectConfig)
    {
        $this->twig = $twig;
        $this->projectConfig = $projectConfig;
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
