<?php

namespace App\Repositories\Prize;

use App\Entities\DTO\PrizeDTO;

interface PrizeRepoInterface
{
    public function save(PrizeDTO $prizeDTO): PrizeDTO;
    public function getTypes(): array;
    public function getBonusType(): string;
    public function getArticleType(): string;
    public function getMoneyType(): string;
}
