<?php

namespace App\Service\NewPostsProcessor;

use App\Document\Reddit\Comment;
use App\Document\Reddit\Post;
use App\Service\NewPostsProcessor\Processor\PostsAPI;
use App\Service\PostsManager\Repository\CommentRepostiory;
use App\Service\PostsManager\Repository\PostRepository;


class Processor
{
    private $postRepository;
    private $commentRepository;

    public function __construct(PostRepository $postRepository, CommentRepostiory $commentRepository)
    {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
    }

    public function process(string $url)
    {
        $postsApi = new PostsAPI();
        $postData = $postsApi->getPost($url);


        $post = (new Post())->fromPostInfo($postData->getPost());

        $comments = array_map(function($comment) use ($post)
        {
            return (new Comment())->fromPostComment($comment)->withPost($post);

        }, $postData->getComments());

        $post->attachComments($comments);


        $this->postRepository->add($post);
        $this->commentRepository->addMany($comments);

        // unnessary duplicated save, maybe use different repository for saving data
        $this->postRepository->save();
        $this->commentRepository->save();

    }
}