<?php

declare(strict_types=1);

namespace api\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class JoinChatFactory
{
    public function __invoke(ContainerInterface $container) : JoinChat
    {
        return new JoinChat($container->get(TemplateRendererInterface::class));
    }
}
