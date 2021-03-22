<?php

declare(strict_types=1);

namespace api\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class MessagesFactory
{
    public function __invoke(ContainerInterface $container) : Messages
    {
        $dbAdapter = $container->get('Application\Db\DatabaseAdapter');
        return new Messages($container->get(TemplateRendererInterface::class), $dbAdapter);
    }
}
