<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 11/23/18
 * Time: 5:14 PM
 */

namespace App\Service\NewPostsProcessor\Model;


class PostComment
{
    private $id;
    private $body;
    private $bodyHtml;
    private $ups;
    private $createdUtc;
    private $author;

    private $replies;


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
     * @return mixed
     */
    public function getReplies()
    {
        return $this->replies;
    }

    /**
     * @param mixed $replies
     */
    public function setReplies($replies): void
    {
        $this->replies = $replies;
    }
}
