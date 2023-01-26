<?php

namespace App\Entities\Prize\Type;

class PrizeLoyaltyBonusTypeEntity implements PlayableEntityInterface
{
    private int $id;
    private int $userId;
    private int $count;
    private float $monetaryEquivalent;
    private string $currency;
    private bool $isActive;

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

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;
        return $this;
    }

    public function getMonetaryEquivalent(): float
    {
        return $this->monetaryEquivalent;
    }

    public function setMonetaryEquivalent(float $monetaryEquivalent): self
    {
        $this->monetaryEquivalent = $monetaryEquivalent;
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

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }
}
