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
     */
    public function __construct(
        private int $userId,
        private ?int $articleId,
        private string $type,
        private string $status,
        private float $count
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
}
