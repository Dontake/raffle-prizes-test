<?php

namespace App\Services\Prize\Type;

use App\Enums\Prize\PrizeTypeEnum;
use Illuminate\Contracts\Container\BindingResolutionException;

class PrizeTypeFactory
{
    /**
     * @throws BindingResolutionException
     */
    public static function getService(string $type): PrizeTypeInterface
    {
        $service = match ($type) {
            PrizeTypeEnum::MONEY => MoneyPrizeService::class,
            PrizeTypeEnum::ARTICLE => ArticlePrizeService::class,
            default => LoyaltyBonusPrizeService::class
        };

        return app()->make($service);
    }
}
