<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 11/27/18
 * Time: 1:21 PM
 */

namespace App\Service\PostsManager\Repository;

use App\Document\Reddit\Post;

class PostRepository extends AbstractRepository
{
    protected $type = Post::class;

    public function getById(string $id)
    {
        $post = parent::getById($id);


        return $post;
    }
}