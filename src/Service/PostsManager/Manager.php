<?php

namespace App\Service\PostsManager;

use App\Document\Reddit\Post;

class Manager
{
    public function getAllPosts() : ?array
    {
        return $this->get('doctrine_mongodb')
            ->getRepository(Post::class)
            ->findAll();
    }

    public function getById(int $id)
    {
        return $this->get('doctrine_mongodb')
            ->getRepository(Post::class)
            ->find($id);
    }
    
    
    public function add(Post $post): Post
    {
        $dm = $this->get('doctrine_mongodb');

        $dm->persist($post);

        $dm->flush();

        return $post;
    }
}
