<?php

declare(strict_types=1);

namespace api\Handler;

use api\Model\ChatmessagesService;
use Laminas\Db\Adapter\Adapter;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class Messages implements RequestHandlerInterface
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

        $chatMessageService = ChatmessagesService::getInstance($this->dbAdapter);

        if (empty($data))
        {
            return new HtmlResponse($this->renderer->render(
            'error::404',
            ['info' => 'Required data was missing.']
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

        if(strlen($data['chatId']) > 12){
            return new HtmlResponse($this->renderer->render(
                'error::404',
                ['info' => 'Chat-Id is too long.']
            ),
                400);
        }

        if(!isset($data['message'])){
            $messageArray = [];
            if(isset($data['timestamp'])){
                //gebe alle Msgs des Chats wieder
                $allMsgs = $chatMessageService->getAll(
                    [
                        'roomId' => $data['chatId'],
                        'timestamp > ' . $data['timestamp']
                    ]
                );

                if(empty($allMsgs)){
                    return new HtmlResponse($this->renderer->render(
                        'error::404',
                        ['info' => 'no new data']
                    ),
                        202);
                }
            }

            if(!isset($allMsgs)){
                $allMsgs = $chatMessageService->getAll(
                    [
                        'roomId' => $data['chatId']
                    ]
                );
            }

            if(!empty($allMsgs)){
                foreach ($allMsgs as $msg){
                    $messageArray[]['message'] = $msg->message;

                }
                return new JsonResponse(
                    json_encode($messageArray),
                    200,
                    [
                        'Content-Type' =>
                            [
                                'application/hal+json'
                            ]
                    ]
                );
            }
            return new HtmlResponse($this->renderer->render(
                'error::404',
                ['info' => 'no new data']
            ),
                202);

        }
        if(isset($data['message'])){
            if(strlen($data['message']) > 400){
                return new HtmlResponse($this->renderer->render(
                    'error::404',
                    ['info' => 'Message is too long.']
                ),
                    400);
            }

        }


        $create = $chatMessageService->create(
            [
                'chatId' => $data['chatId'],
                'message' => $data['message'],
                'timestamp' => $data['timestamp']
            ]
        );

        if($create){
            return new HtmlResponse($this->renderer->render(
                'error::404',
                ['info' => 'All fine, lmao']
            ),
                200);
        }

    }


}
