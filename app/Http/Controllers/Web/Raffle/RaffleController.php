<?php

namespace App\Http\Controllers\Web\Raffle;

use App\Http\Controllers\Web\BaseController;
use App\Services\Raffle\RaffleInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Throwable;

class RaffleController extends BaseController
{
    /**
     * @param RaffleInterface $raffleService
     */
    public function __construct(protected RaffleInterface $raffleService){}

    /**
     * Get ruffle prize
     *
     * @return Factory|View|Application
     * @throws Throwable
     */
    public function getPrize(): Factory|View|Application
    {
        return view('prize', ['prize' => $this->raffleService->run(Auth::id())]);
    }
}
