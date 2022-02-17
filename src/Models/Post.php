<?php
/**
 * rest_api - Post.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 16.02.22 / 14:23
 */

namespace App\Models;


class Post
{
    /**
     * @var int
     */
    private $userId;
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $body;

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string|null $body
     */
    public function setBody(?string $body): void
    {
        $this->body = $body;
    }

    /**
     * @param object $content
     * @return Post
     */
    public function setDataFromContent($content): Post
    {
        $this->userId = $content->userId ?? null;
        $this->id = $content->id ?? null;
        $this->title = $content->title ?? null;
        $this->body = $content->body ?? null;

        return $this;
    }

    /**
     * @return array
     */
    public function getPostArray(): array
    {
        return [
            'userId' => $this->userId,
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
        ];
    }

}