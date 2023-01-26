<?php

namespace App\Entities\Prize\Type;

use App\Models\Article\Article;
use App\Models\Loyalty\LoyaltyBonus;
use App\Models\User\UserWallet;
use Illuminate\Contracts\Container\BindingResolutionException;

class PrizeEntityFactory
{
    /**
     * @throws BindingResolutionException
     */
    public static function getEntity(string $type): PlayableEntityInterface
    {
        $entity = match ($type) {
            UserWallet::class => PrizeMoneyTypeEntity::class,
            LoyaltyBonus::class => PrizeLoyaltyBonusTypeEntity::class,
            Article::class => PrizeArticleTypeEntity::class
        };

        return app()->make($entity);
    }
}
