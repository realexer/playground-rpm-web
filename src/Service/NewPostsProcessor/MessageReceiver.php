<?php

namespace App\Service\NewPostsProcessor;

use App\Service\NewPostsProcessor\Message\PostProcessed;
use App\Service\NewPostsProcessor\Message\PostProcessingFailed;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class MessageReceiver implements MessageHandlerInterface 
{
    /**
     * @var Processor
     */
    private $processor;

    /**
     * @var MessageBusInterface
     */
    private $bus;


    public function __construct(Processor $processor, MessageBusInterface $bus)
    {
        $this->processor = $processor;
        $this->bus = $bus;

        echo "Waiting for messages...\n";
    }

    public function __invoke(Message\ProcessPost $message)
    {
        echo "Message '{$message->getContent()}' received. \n";

        try
        {
            $this->processor->process($message->getUrl());

            $this->bus->dispatch(new PostProcessed('Post was processed.', $message->getUrl()));
        }
        catch (\Exception $ex)
        {

            $this->bus->dispatch(new PostProcessingFailed('Post processing failed.', $message->getUrl()));

            echo "Message {$message->getId()} failed. \n";
            throw $ex;
        }


        echo "Message '{$message->getContent()}' processed. \n";
    }
}