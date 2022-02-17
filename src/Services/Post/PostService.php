<?php
/**
 * rest_api - PostService.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 16.02.22 / 14:37
 */

namespace App\Services\Post;

use App\Exception\AppException;
use App\Interfaces\HandlerInterface;
use App\Models\Post;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PostService
{
    /**
     * @var ContainerInterface
     */
    public $container;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * PostService constructor.
     * @param ContainerInterface $container
     * @param LoggerInterface $logger
     * @param HandlerInterface $handler
     */
    public function __construct(
        ContainerInterface $container,
        LoggerInterface $logger,
        HandlerInterface $handler
    ) {
        $this->container = $container;
        $this->logger = $logger;
        $this->handler = $handler;
    }

    /**
     * @return array
     */
    public function getAllPosts(): array
    {
        $result = [];
        try {
            /** @var Post $post */
            foreach ($this->handler->getAllPosts() as $post) {
                $result[] = $post->getPostArray();
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
     * @return array
     */
    public function getPost(int $postId): array
    {
        $result = [];
        try {
            /** @var Post $post */
            $post = $this->handler->getPost($postId);
            $result = $post->getPostArray();
        } catch (AppException $e) {
            $this->logger->critical(
                __METHOD__,
                [
                    'ex' => $e->getMessage(),
                ]);
        }

        return $result;
    }
}