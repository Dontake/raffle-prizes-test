<?php

namespace App\Providers;

use App\Repositories\Article\ArticleRepoInterface;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Cash\CashAccountRepository;
use App\Repositories\Cash\CashAccountRepositoryInterface;
use App\Repositories\LoyaltyBonus\LoyaltyBonusRepoInterface;
use App\Repositories\LoyaltyBonus\LoyaltyBonusRepository;
use App\Repositories\Prize\PrizeRepoInterface;
use App\Repositories\Prize\PrizeRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Article\ArticleService;
use App\Services\Article\ArticleServiceInterface;
use App\Services\Auth\AuthInterface;
use App\Services\Auth\AuthService;
use App\Services\Cash\CashAccountService;
use App\Services\Cash\CashAccountServiceInterface;
use App\Services\Loyalty\BonusService;
use App\Services\Loyalty\LoyaltyBonusServiceInterface;
use App\Services\Prize\PrizeService;
use App\Services\Prize\PrizeServiceInterface;
use App\Services\Raffle\RafflePrizeService;
use App\Services\Raffle\RaffleInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        RaffleInterface::class => RafflePrizeService::class,
        AuthInterface::class => AuthService::class,
        PrizeRepoInterface::class => PrizeRepository::class,
        ArticleServiceInterface::class => ArticleService::class,
        LoyaltyBonusServiceInterface::class => BonusService::class,
        CashAccountServiceInterface::class => CashAccountService::class,
        CashAccountRepositoryInterface::class => CashAccountRepository::class,
        UserRepositoryInterface::class => UserRepository::class,
        ArticleRepoInterface::class => ArticleRepository::class,
        LoyaltyBonusRepoInterface::class => LoyaltyBonusRepository::class,
        PrizeServiceInterface::class => PrizeService::class
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
        //
    }
}
