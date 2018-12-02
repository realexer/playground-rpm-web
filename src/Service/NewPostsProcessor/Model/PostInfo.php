<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service\NewPostsProcessor\Model;

/**
 * Description of PostInfo
 *
 * @author alexeyskrypnik
 */
class PostInfo 
{
    private $id;
    private $subredditNamePrefixed;
    private $title;
    private $selftext;
    private $selftextHtml;
    private $permalink;
    private $url;
    private $createdUtc;
    
    private $author;
    private $ups;

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
}
