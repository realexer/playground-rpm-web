<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 11/30/18
 * Time: 1:05 AM
 */

namespace App\Service\NewPostsProcessor\Message;


class AbstractProcessMessage
{
    protected $id;
    protected $name;
    protected $content;
    protected $url;

    public function __construct(string $content, string $url)
    {
        $this->id = time();
        $this->name = get_class($this);
        $this->content = $content;
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}