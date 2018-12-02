<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 11/27/18
 * Time: 1:22 PM
 */

namespace App\Service\PostsManager\Repository;


use App\Document\Reddit\Comment;

class CommentRepostiory extends AbstractRepository
{
    protected $type = Comment::class;
}