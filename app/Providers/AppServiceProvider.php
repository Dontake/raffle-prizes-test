<?php

namespace App\Providers;

use App\Enums\Prize\PrizeTypeEnum;
use App\Models\Article\Article;
use App\Models\Loyalty\LoyaltyBonus;
use App\Models\User\UserWallet;
use App\Repositories\Article\ArticleRepoInterface;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\LoyaltyBonus\LoyaltyBonusRepoInterface;
use App\Repositories\LoyaltyBonus\LoyaltyBonusRepository;
use App\Repositories\Prize\PrizeRepoInterface;
use App\Repositories\Prize\PrizeRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserWallet\UserWalletRepository;
use App\Repositories\User\UserWallet\UserWalletRepositoryInterface;
use App\Services\Auth\AuthInterface;
use App\Services\Auth\AuthService;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        AuthInterface::class => AuthService::class,
        PrizeRepoInterface::class => PrizeRepository::class,
        UserWalletRepositoryInterface::class => UserWalletRepository::class,
        UserRepositoryInterface::class => UserRepository::class,
        ArticleRepoInterface::class => ArticleRepository::class,
        LoyaltyBonusRepoInterface::class => LoyaltyBonusRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::enforceMorphMap([
            PrizeTypeEnum::ARTICLE => Article::class,
            PrizeTypeEnum::LOYALTY_BONUS => LoyaltyBonus::class,
            PrizeTypeEnum::MONEY => UserWallet::class
        ]);
    }
}
