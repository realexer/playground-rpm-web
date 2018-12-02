<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Service\NewPostsProcessor\Message\ProcessPost;

class ApiController extends AbstractController
{
    public function submitUrl(Request $request, MessageBusInterface $bus)
    {
        if($request->request->get('url'))
        {
            $bus->dispatch(new ProcessPost('Process post message.', $request->request->get('url')));
        }

        return $this->json(['result' => true]);
    }
}
