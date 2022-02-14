<?php

namespace App\Entities\DTO;

class PrizeDTO
{
    /**
     * @param int $userId
     * @param int|null $articleId
     * @param string $type
     * @param string $status
     * @param float $count
     * @param int|null $id
     * @param string|null $name
     */
    public function __construct(
        private int $userId,
        private ?int $articleId,
        private string $type,
        private string $status,
        private float $count,
        private ?int $id = null,
        private ?string $name = null,
    ){}

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int|null
     */
    public function getArticleId(): ?int
    {
        return $this->articleId;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getCount(): float
    {
        return $this->count;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
