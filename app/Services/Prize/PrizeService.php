<?php

namespace App\Services\Prize;

use App\Entities\Prize\PrizeEntity;
use App\Enums\Prize\PrizeStatusEnum;
use App\Enums\Prize\PrizeTypeEnum;
use App\Repositories\Prize\PrizeRepoInterface;
use App\Services\Prize\Type\PrizeTypeFactory;
use App\Services\Prize\Type\PrizeTypeService;
use Illuminate\Support\Facades\DB;
use Throwable;

class PrizeService
{
    public function __construct(
        protected PrizeRepoInterface $prizeRepo,
        protected PrizeTypeService $prizeTypeService
    ){}

    /**
     * Play prize
     * @throws Throwable
     */
    public function play(int $userId): PrizeEntity
    {
        return DB::transaction(function () use($userId) {
            $type = PrizeTypeEnum::AVAILABLE[rand(0, count(PrizeTypeEnum::AVAILABLE) - 1)];

            $playable = $this->prizeTypeService->setType(PrizeTypeFactory::getService($type))
                ->play($userId);

            return $this->prizeRepo->save(new PrizeEntity(
                $userId,
                $playable->getId(),
                $type,
                PrizeStatusEnum::PLAYED,
                $playable->getCount()
            ));
        });
    }

    /**
     * Refuse from prize
     *
     * @throws Throwable
     */
    public function refuse(int $id, int $userId): bool
    {
        return DB::transaction(function () use($id, $userId) {
            $playable = $this->prizeRepo->getPlayable($id);
            $this->prizeTypeService->setType(PrizeTypeFactory::getService(PrizeTypeEnum::ENTITIES[$playable::class]))
                ->refuse($playable);

            return $this->prizeRepo->delete($id);
        });
    }
}
