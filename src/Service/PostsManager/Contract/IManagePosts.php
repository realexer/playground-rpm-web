<?php

namespace App\Service\PostsManager\Contract;

use App\Document\Reddit\Post;

interface IManagePosts
{
    public function getAllPosts() : ?array;
    public function getById(int $id);
    public function add(Post $post) : bool;
}
