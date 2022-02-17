<?php

namespace App\Controller\Api;

use App\Services\Post\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/api/posts", name="api_posts")
     * @param PostService $postService
     * @return Response
     */
    public function posts(PostService $postService): Response
    {
        // http://ak-rest-api.local.com/api/posts
        return new JsonResponse($postService->getAllPosts());
    }

    /**
     * @Route("/api/posts/{postId}", name="api_post")
     * @param int $postId
     * @param PostService $postService
     * @return Response
     */
    public function post(int $postId, PostService $postService): Response
    {
        http://ak-rest-api.local.com/api/posts/1
        return new JsonResponse($postService->getPost($postId));
    }
}
