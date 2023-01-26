<?php

namespace App\Http\Controllers\Web\Prize;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Prize\PrizeRefuseRequest;
use App\Http\Resources\PrizeResource;
use App\Services\Prize\PrizeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\ArrayShape;
use Throwable;

class PrizeController extends BaseController
{
    public function __construct(protected PrizeService $prizeService){}

    /**
     * Play prize
     * @throws Throwable
     */
    public function play(): Factory|View|Application
    {
        return view('prize', [
            'prize' => new PrizeResource($this->prizeService->play(Auth::id()))
        ]);
    }

    /**
     * Refuse from prize
     * @throws Throwable
     */
    #[ArrayShape(['result' => "bool"])]
    public function refuse(PrizeRefuseRequest $request): array
    {
        return [
            'result' => $this->prizeService->refuse($request->getId(), Auth::id())
        ];
    }
}
