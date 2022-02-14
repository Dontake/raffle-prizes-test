<?php

namespace App\Http\Controllers\Web\Prize;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Prize\PrizeRefuseRequest;
use App\Services\Prize\PrizeServiceInterface;
use App\Services\Raffle\RaffleInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\ArrayShape;
use Throwable;

class PrizeController extends BaseController
{
    /**
     * @param PrizeServiceInterface $prizeService
     */
    public function __construct(protected PrizeServiceInterface $prizeService){}

    /**
     * Refuse from prize
     *
     * @param PrizeRefuseRequest $request
     * @return array
     */
    #[ArrayShape(['result' => "bool"])]
    public function refuse(PrizeRefuseRequest $request): array
    {
        return [
            'result' => $this->prizeService->refuse($request->getId(), Auth::id())
        ];
    }
}
