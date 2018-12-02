<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 11/26/18
 * Time: 9:57 PM
 */

namespace App\Document\Reddit;

use App\Service\NewPostsProcessor\Model\PostInfo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/** @MongoDB\Document
 * Class Post
 * @package App\Service\PostsManager\Model\MongoDB\Reddit
 */
class Post
{
    /** @MongoDB\Id
     * @var
     */
    private $id;

    /** @MongoDB\Field(type="string")
     * @var
     */
    private $postId;

    /** @MongoDB\Field(type="string")
     * @var
     */
    private $subredditNamePrefixed;

    /** @MongoDB\Field(type="string")
     * @var
     */
    private $title;

    /** @MongoDB\Field(type="string")
     * @var
     */
    private $selftext;

    /** @MongoDB\Field(type="string")
     * @var
     */
    private $selftextHtml;

    /** @MongoDB\Field(type="string")
     * @var
     */
    private $permalink;

    /** @MongoDB\Field(type="string")
     * @var
     */
    private $url;

    /** @MongoDB\Field(type="int")
     * @var
     */
    private $createdUtc;

    /** @MongoDB\Field(type="string")
     * @var
     */
    private $author;

    /** @MongoDB\Field(type="int")
     * @var
     */
    private $ups;

    /** @MongoDB\ReferenceMany(targetDocument=Comment::class, mappedBy="post")
     *
     * @var ArrayCollection
     */
    private $comments = [];


    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * @param PostInfo $post
     * @return $this
     */
    public function fromPostInfo(PostInfo $post): self
    {
        $this->setPostId($post->getId());
        $this->setSubredditNamePrefixed($post->getSubredditNamePrefixed());
        $this->setAuthor($post->getAuthor());
        $this->setTitle($post->getTitle());
        $this->setUrl($post->getUrl());
        $this->setSelftext($post->getSelftext());
        $this->setSelftextHtml($post->getSelftextHtml());
        $this->setPermalink($post->getPermalink());
        $this->setCreatedUtc($post->getCreatedUtc());
        $this->setUps($post->getUps());

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param mixed $postId
     */
    public function setPostId($postId): void
    {
        $this->postId = $postId;
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
    public function getSubredditNamePrefixed()
    {
        return $this->subredditNamePrefixed;
    }

    /**
     * @param mixed $subredditNamePrefixed
     */
    public function setSubredditNamePrefixed($subredditNamePrefixed): void
    {
        $this->subredditNamePrefixed = $subredditNamePrefixed;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSelftext()
    {
        return $this->selftext;
    }

    /**
     * @param mixed $selftext
     */
    public function setSelftext($selftext): void
    {
        $this->selftext = $selftext;
    }

    /**
     * @return mixed
     */
    public function getSelftextHtml()
    {
        return $this->selftextHtml;
    }

    /**
     * @param mixed $selftextHtml
     */
    public function setSelftextHtml($selftextHtml): void
    {
        $this->selftextHtml = $selftextHtml;
    }


    /**
     * @return mixed
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * @param mixed $permalink
     */
    public function setPermalink($permalink): void
    {
        $this->permalink = $permalink;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
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
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    public function attachComments($comments)
    {
        $this->comments = new ArrayCollection($comments);
    }

    public function setComments(array $comments)
    {
        $this->comments = $comments;
    }

    public function addComment(Comment $comment)
    {
        $this->comments->add($comment);
    }
}