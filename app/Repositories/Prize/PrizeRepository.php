<?php

namespace App\Repositories\Prize;

use App\Entities\Prize\PrizeEntity;
use App\Entities\Prize\Type\PlayableEntityInterface;
use App\Entities\Prize\Type\PrizeEntityFactory;
use App\Enums\Prize\PrizeStatusEnum;
use App\Enums\Prize\PrizeTypeEnum;
use App\Models\Prize\Prize;
use App\Services\Prize\Type\PrizeTypeFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;

class PrizeRepository implements PrizeRepoInterface
{
    /**
     * Save new Prize
     */
    public function save(PrizeEntity $prizeEntity): PrizeEntity
    {
        $newPrize = new Prize();

        $newPrize->user_id = $prizeEntity->getUserId();
        $newPrize->playable_type = $prizeEntity->getType();
        $newPrize->playable_id = $prizeEntity->getPlayableId();
        $newPrize->count = $prizeEntity->getCount();
        $newPrize->status = $prizeEntity->getStatus();

        $newPrize->save();

        return new PrizeEntity(
            $newPrize->user_id,
            $newPrize->playable_id,
            $newPrize->playable_type,
            $newPrize->status,
            $newPrize->count,
            $newPrize->id,
            $newPrize->getName()
        );
    }

    /**
     * Get played prizes of money type
     * @param int $count
     * @return Collection|array
     */
    public function getPlayedMoney(int $count): Collection|array
    {
        return Prize::with('user')->select('id', 'count', 'user_id')
            ->where('type', PrizeTypeEnum::MONEY)
            ->where('status', PrizeStatusEnum::PLAYED)
            ->limit($count)
            ->get();
    }

    /**
     * Check exists prize
     */
    public function exists(int $id): bool
    {
        return Prize::where('id', $id)->sharedLock()->exists();
    }

    /**
     * Detach curren user of prize
     */
    public function delete(int $id): bool
    {
        return Prize::destroy($id);
    }

    /**
     * Check status !== sent
     */
    public function checkNotSent(int $id): bool
    {
        return Prize::where('id', $id)
            ->where('status', '!=', PrizeStatusEnum::SENT)
            ->sharedLock()
            ->exists();
    }

    /**
     * @throws BindingResolutionException
     */
    public function getPlayable(int $id): PlayableEntityInterface
    {
        $prize = Prize::where('id', $id)
            ->where('status', PrizeStatusEnum::PLAYED)
            ->with('playable')
            ->firstOrFail();

        $playable = $prize->playable;
        $playableEntity = PrizeEntityFactory::getEntity($playable::class);

        return $playableEntity->setId($playable->getId())
            ->setCount($playable->getCount());
    }
}
