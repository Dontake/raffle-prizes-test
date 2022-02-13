<?php

namespace App\Http\Controllers\Web\Raffle;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\PrizeResource;
use App\Services\Auth\AuthInterface;
use App\Services\Raffle\RaffleInterface;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\ArrayShape;

class RaffleController extends BaseController
{
    public function __construct(protected RaffleInterface $ruffleService){}

    /**
     * @return PrizeResource
     */
    public function getPrize(): PrizeResource
    {
        return  new PrizeResource($this->ruffleService->run(Auth::id()));
    }
}
