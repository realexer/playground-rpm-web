<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 11/27/18
 * Time: 6:21 PM
 */

namespace App\Service\PostsManager\Repository;


use Doctrine\ODM\MongoDB\DocumentManager;

abstract class AbstractRepository
{
    protected $dm;

    protected $type;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    public function getAll() : ?array
    {
        return $this->dm
            ->getRepository($this->type)
            ->findBy([], ['createdUtc' => 'desc']);
    }


    public function getById(string $id)
    {
        return $this->dm
            ->getRepository($this->type)
            ->find($id);
    }

    public function add($doc)
    {
        $this->dm->persist($doc);

        return $doc;
    }

    public function addMany(array $docs)
    {
        foreach($docs as $doc) {
            $this->dm->persist($doc);
        }
    }

    public function update($doc)
    {
        $this->dm->persist($doc);

        return $doc;
    }

    public function save()
    {
        $this->dm->flush();
        $this->dm->clear();
    }
}