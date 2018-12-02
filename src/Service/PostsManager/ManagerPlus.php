<?php

namespace App\Service\PostsManager;

class ManagerPlus extends Manager
{
    public function getAllPosts() : array
    {
        $posts = parent::getAllPosts();
        array_push($posts, [
            "id" => 3,
            "title" => "Third post",
            "comments" => []
        ]);
        
        return $posts;
    }
}
