<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 11/24/18
 * Time: 12:48 AM
 */

namespace App\Service\NewPostsProcessor\Processor;

use App\Service\NewPostsProcessor\Model\Post;
use App\Service\NewPostsProcessor\Model\PostComment;
use App\Service\NewPostsProcessor\Model\ListingCommentRepliesData;
use App\Service\NewPostsProcessor\Model\Listing;
use App\Service\NewPostsProcessor\Model\ListingData;
use App\Service\NewPostsProcessor\Model\ListingDataChild;
use App\Service\NewPostsProcessor\Model\PostInfo;
use App\Service\NewPostsProcessor\Serializer\TypeMappedExtractor;
use App\Service\NewPostsProcessor\Serializer\TypeMapper;
use GuzzleHttp\Client;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class PostsAPI
{
    public const USER_AGENT = 'MyRedditPostsProcessorX';

    /**
     * @param string $url
     * @return Post
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPost(string $url) : Post
    {
        try
        {
            $response = (new Client())->request("GET", $url.'.json', [
                'headers' => [
                    'User-Agent' => self::USER_AGENT
                ]
            ]);

            $dataJson = $response->getBody();

            $decoder = new Serializer([], [new JsonEncoder()]);
            $jsonData = $decoder->decode($dataJson, 'json');

            //
            //
            $postInfo = $this->denormilizePostData($jsonData[0], ModelMapping::postInfo());
            $postComments = $this->denormilizePostData($jsonData[1], ModelMapping::postComments());

            $post = new Post();
            $post->setPost($postInfo->getData()->getChildren()[0]->getData());

            foreach($postComments->getData()->getChildren() as $child)
            {
                $comment = $child->getData();
                $post->addComment($this->removeListingsFromComments($comment));
            }

            return $post;
        }
        catch (\Exception $ex)
        {
            throw $ex;
        }
    }

    /**
     * @param $data
     * @param $map
     * @return Listing
     */
    private function denormilizePostData($data, $map)
    {
        $postInfoNormilizer = new ObjectNormalizer(
            null,
            new CamelCaseToSnakeCaseNameConverter(),
            null,
            new TypeMappedExtractor($map));

        $denormilizer = new Serializer([$postInfoNormilizer, new ArrayDenormalizer()]);

        return $denormilizer->denormalize($data, Listing::class);
    }

    /**
     * Transforming listings to pure PostComments to remove unnecessary data mappings
     *
     * @param PostComment $comment
     * @return PostComment
     */
    private function removeListingsFromComments(PostComment $comment)
    {
        if($comment->getReplies() && $comment->getReplies()->getData())
        {
            $replyComments = [];
            foreach($comment->getReplies()->getData()->getChildren() as $child)
            {
                $replyComments[] = $this->removeListingsFromComments($child->getData());
            }

            $comment->setReplies($replyComments);
        } else {
            $comment->setReplies([]);
        }

        return $comment;
    }
}

class ModelMapping
{
    public static function postInfo()
    {
        return [
            Listing::class => [
                'data' => TypeMapper::makeType(ListingData::class)
            ],
            ListingData::class => [
                'children' => TypeMapper::makeCollection(ListingDataChild::class)
            ],
            ListingDataChild::class => [
                'data' => TypeMapper::makeType(PostInfo::class)
            ]
        ];
    }

    public static function postComments()
    {
        return [
            Listing::class => [
                'data' => TypeMapper::makeType(ListingData::class)
            ],
            ListingData::class => [
                'children' => TypeMapper::makeCollection(ListingDataChild::class)
            ],
            ListingDataChild::class => [
                'data' => TypeMapper::makeType(PostComment::class)
            ],
            PostComment::class => [
                'replies' => TypeMapper::makeType(Listing::class)
            ],
        ];
    }
}