<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 11/26/18
 * Time: 9:58 PM
 */

namespace App\Document\Reddit;

use App\Service\NewPostsProcessor\Model\PostComment;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document
 *
 * Class Comment
 * @package App\Service\PostsManager\Model\MongoDB\Reddit
 */
class Comment
{
    /** @MongoDB\Id
     * @var
     */
    private $id;

    /** @MongoDB\ReferenceOne(targetDocument=Post::class, inversedBy="comments")
     * @var
     */
    private $post;

    /** @MongoDB\Field(type="string")
     * @var
     */
    private $commentId;

    /** @MongoDB\Field(type="string")
     * @var
     */
    private $body;

    /** @MongoDB\Field(type="int")
     * @var
     */
    private $ups;

    /** @MongoDB\Field(type="string")
     * @var
     */
    private $bodyHtml;

    /** @MongoDB\Field(type="int")
     * @var
     */
    private $createdUtc;

    /** @MongoDB\Field(type="string")
     * @var
     */
    private $author;

    /** @MongoDB\EmbedMany(targetDocument="Comment")
     *
     * @var array
     */
    private $replies = [];

    /**
     * @param PostComment $comment
     * @return $this
     */
    public function fromPostComment(PostComment $comment): self
    {
        $this->setCommentId($comment->getId());
        $this->setBody($comment->getBody());
        $this->setBodyHtml($comment->getBodyHtml());
        $this->setUps($comment->getUps());
        $this->setAuthor($comment->getAuthor());
        $this->setRepliesFromPostComments($comment->getReplies());
        $this->setCreatedUtc($comment->getCreatedUtc());

        return $this;
    }

    public function withPost(Post $post)
    {
        $this->setPost($post);

        return $this;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

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
    public function setPost($post): void
    {
        $this->post = $post;
    }



    /**
     * @return mixed
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * @param mixed $commentId
     */
    public function setCommentId($commentId): void
    {
        $this->commentId = $commentId;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getUps()
    {
        return $this->ups;
    }

    /**
     * @param mixed $ups
     */
    public function setUps($ups): void
    {
        $this->ups = $ups;
    }



    /**
     * @return mixed
     */
    public function getBodyHtml()
    {
        return $this->bodyHtml;
    }

    /**
     * @param mixed $bodyHtml
     */
    public function setBodyHtml($bodyHtml): void
    {
        $this->bodyHtml = $bodyHtml;
    }

    /**
     * @return mixed
     */
    public function getCreatedUtc()
    {
        return $this->createdUtc;
    }

    /**
     * @param mixed $createdUtc
     */
    public function setCreatedUtc($createdUtc): void
    {
        $this->createdUtc = $createdUtc;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return array
     */
    public function getReplies()
    {
        return $this->replies;
    }

    /**
     * @param array $replies
     */
    public function setReplies(array $replies): void
    {
        $this->replies = $replies;
    }

    /**
     * @param PostComment[] $replies
     */
    public function setRepliesFromPostComments(array  $replies): void
    {
        foreach ($replies as $reply)
        {
            $this->replies[] = (new Comment())->fromPostComment($reply);
        }
    }
}