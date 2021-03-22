<?php

declare(strict_types=1);

namespace api\Handler;

use api\Model\ChatroomsService;
use Laminas\Db\Adapter\Adapter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class CreateChat implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;
    private $dbAdapter;

    public function __construct(TemplateRendererInterface $renderer, Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {

        $body = file_get_contents('php://input');
        $data = json_decode($body, true);
        if (empty($data))
        {
            return new HtmlResponse($this->renderer->render(
                'error::404',
                [
                    'info' => 'Required data was missing.'
                ]
            ),
                400);
        }

        if (!isset($data['chatId']))
        {
             return new HtmlResponse($this->renderer->render(
                 'error::404',
                 ['info' => 'Chat-Id was missing on create.']
             ),
                 400);
        }

        $chatroomService = ChatroomsService::getInstance($this->dbAdapter);
        $existingChat = $chatroomService->get($data['chatId']);

        if(is_null ($existingChat) ){
            $chatroomService->create(['id' => $data['chatId']]);
            return new HtmlResponse($this->renderer->render(
                'error::404',
                ['info' => 'Chat created.']
            ),
                201);
        }else{
            return new HtmlResponse($this->renderer->render(
                'error::404',
                ['info' => 'Chat already exists.']
            ),
                200);
        }

    }
}
