<?php

declare(strict_types=1);

namespace api\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CreateChatFactory
{
    public function __invoke(ContainerInterface $container) : CreateChat
    {
        $dbAdapter = $container->get('Application\Db\DatabaseAdapter');
        return new CreateChat($container->get(TemplateRendererInterface::class), $dbAdapter);
    }
}
