<?php
/**
 * rest_api - HandlerInterface.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 16.02.22 / 14:21
 */

namespace App\Interfaces;


use App\Models\Post;

interface HandlerInterface
{
    /**
     * @param int $postId
     *
     * @return Post
     */
    public function getPost(int $postId): ?Post;

    /**
     * @return Post[]
     */
    public function getAllPosts(): array;
}