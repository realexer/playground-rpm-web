<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 11/24/18
 * Time: 1:26 PM
 */

namespace App\Service\NewPostsProcessor\Model;


class Post
{
    /**
     * @var PostInfo
     */
    private $post;

    /**
     * @var PostComment[]
     */
    private $comments = [];

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost(PostInfo $post): void
    {
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments(array $comments): void
    {
        $this->comments = $comments;
    }

    public function addComment(PostComment $comment)
    {
        $this->comments[] = $comment;
    }


}