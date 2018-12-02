<?php

namespace App\Service\NewPostsProcessor\Model;

class Listing
{
    private $kind;
    private $data;
    
    public function getKind() 
    {
        return $this->kind;
    }

    /**
     * @return ListingData
     */
    public function getData() 
    {
        return $this->data;
    }

    public function setKind($kind)
    {
        $this->kind = $kind;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}

class ListingData
{
    private $modhash;
    private $dist;
    private $children;

    /**
     * @return mixed
     */
    public function getModhash()
    {
        return $this->modhash;
    }

    /**
     * @param mixed $modhash
     */
    public function setModhash(string $modhash): void
    {
        $this->modhash = $modhash;
    }

    /**
     * @return mixed
     */
    public function getDist()
    {
        return $this->dist;
    }

    /**
     * @param mixed $dist
     */
    public function setDist($dist): void
    {
        $this->dist = $dist;
    }

    /**
     * @return ListingDataChild[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children): void
    {
        $this->children = $children;
    }

}

class ListingDataChild
{
    private $kind;
    private $data;

    /**
     * @return mixed
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @param mixed $kind
     */
    public function setKind($kind): void
    {
        $this->kind = $kind;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }
}