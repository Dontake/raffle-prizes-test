<?php

namespace App\Entities\Prize\Type;

class PrizeMoneyTypeEntity implements PlayableEntityInterface
{
    private int $id;
    private int $userId;
    private float $count;
    private string $currency;
    private string $account;
    private int $isActive;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getCount(): float
    {
        return $this->count;
    }

    public function setCount(float $count): self
    {
        $this->count = $count;
        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function getAccount(): string
    {
        return $this->account;
    }

    public function setAccount(string $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * @return int
     */
    public function getIsActive(): int
    {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }
}
