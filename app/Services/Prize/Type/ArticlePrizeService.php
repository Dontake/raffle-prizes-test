<?php

namespace App\Services\Prize\Type;

use App\Entities\Prize\Type\PlayableEntityInterface;
use App\Jobs\SendArticleToUser;
use App\Repositories\Article\ArticleRepoInterface;

class ArticlePrizeService implements PrizeTypeInterface
{
    const defaultPlayableCount = 1;

    /**
     * @param ArticleRepoInterface $articleRepo
     */
    public function __construct(protected ArticleRepoInterface $articleRepo){}

    public function play(int $userId): PlayableEntityInterface
    {
        $article = $this->articleRepo->firstRandom();
        $this->articleRepo->decreaseCount($article->getId(), self::defaultPlayableCount);

        SendArticleToUser::dispatch($userId);

        return $article->setCount(self::defaultPlayableCount);
    }

    public function refuse(PlayableEntityInterface $playable): bool
    {
       return $this->articleRepo->increaseCount($playable->getId(), $playable->getCount());
    }
}
