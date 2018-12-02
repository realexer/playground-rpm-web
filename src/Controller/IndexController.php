<?php

namespace App\Controller;

use App\Service\PostsManager\Repository\CommentRepostiory;
use App\Service\PostsManager\Repository\PostRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Service\NewPostsProcessor\Message\ProcessPost;

class IndexController extends AbstractController
{
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->getAll();

        return $this->render('index/index.html.twig', [
            'posts' => $posts
        ]);
    }
    
    public function test(PostRepository $postRepository, CommentRepostiory $commentRepostiory, DocumentManager $dm)
    {

    }
    
    public function send(MessageBusInterface $bus)
    {

        return $this->json($bus->dispatch(new ProcessPost('Process post message.')));
    }

    public function submitUrl(Request $request, MessageBusInterface $bus)
    {
        if($request->request->get('url'))
        {
            $bus->dispatch(new ProcessPost('Process post message.', $request->request->get('url')));
        }

        return $this->redirectToRoute("index");
    }

    public function viewPost($id, PostRepository $postRepository)
    {
//        \Doctrine\ODM\MongoDB\PersistentCollection::class;
        $post = $postRepository->getById($id);

        return $this->render('index/view_post.html.twig', [
            'post' => $post
        ]);
    }
}
