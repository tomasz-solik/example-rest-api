<?php
/**
 * rest_api - JsonplaceholderApi.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 16.02.22 / 15:03
 */

namespace App\Api;

use App\Abstracts\ApiAbstract;
use App\Exception\AppException;
use App\Interfaces\ApiInterface;
use App\Interfaces\HandlerInterface;
use App\Models\Post;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class JsonplaceholderApi extends ApiAbstract implements ApiInterface, HandlerInterface
{
    /**
     * JsonplaceholderApi constructor.
     * @param ContainerInterface $container
     * @param LoggerInterface $logger
     */
    public function __construct(ContainerInterface $container, LoggerInterface $logger)
    {
        parent::__construct($container, $logger, 'api_jsonplaceholder');
    }

    /**
     * @return Post[]
     */
    public function getAllPosts(): array
    {
        $result = [];
        try {
            if ($this->makeRequest('GET', self::ENDPOINT_POSTS)) {
                if (JsonResponse::HTTP_OK === $this->getResponseCode()) {
                    foreach (json_decode($this->getResponseContents()) as $content) {
                        $result[] = (new Post())->setDataFromContent($content);
                    }
                }
            }
        } catch (AppException $e) {
            $this->logger->critical(
                __METHOD__,
                [
                    'ex' => $e->getMessage(),
                ]);
        }

        return $result;
    }

    /**
     * @param int $postId
     * @return Post
     */
    public function getPost(int $postId): ?Post
    {
        $result = null;
        try {
            if ($this->makeRequest('GET', self::ENDPOINT_POSTS.'/'.$postId)) {
                if (JsonResponse::HTTP_OK === $this->getResponseCode()) {
                    $result = (new Post())->setDataFromContent(json_decode($this->getResponseContents()));
                }
            }
        } catch (AppException $e) {
            $this->logger->critical(
                __METHOD__,
                [
                    'ex' => $e->getMessage(),
                ]);
        }

        return $result;
    }

    public const ENDPOINT_POSTS = '/posts';

}