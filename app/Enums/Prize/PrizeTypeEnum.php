<?php

namespace App\Enums\Prize;

use App\Entities\Prize\Type\PrizeArticleTypeEntity;
use App\Entities\Prize\Type\PrizeLoyaltyBonusTypeEntity;
use App\Entities\Prize\Type\PrizeMoneyTypeEntity;

class PrizeTypeEnum
{
    const MONEY = 'money';
    const LOYALTY_BONUS = 'bonus';
    const ARTICLE = 'article';

    const AVAILABLE = [
        self::MONEY,
        self::LOYALTY_BONUS,
        self::ARTICLE
    ];

    const ENTITIES = [
        PrizeMoneyTypeEntity::class => self::MONEY,
        PrizeLoyaltyBonusTypeEntity::class => self::LOYALTY_BONUS,
        PrizeArticleTypeEntity::class => self::ARTICLE
    ];
}
