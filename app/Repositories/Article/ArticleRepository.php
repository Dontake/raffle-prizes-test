<?php

namespace App\Repositories\Article;

use App\Entities\Prize\Type\PrizeArticleTypeEntity;
use App\Models\Article\Article;

class ArticleRepository implements ArticleRepoInterface
{
    /**
     * Get first article in random order
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function firstRandom(): PrizeArticleTypeEntity
    {
        $article = Article::where('count', '>', 0)
            ->inRandomOrder()
            ->sharedLock()
            ->firstOrFail();

        return (new PrizeArticleTypeEntity())->setId($article->id)
            ->setName($article->name)
            ->setCount($article->count)
            ->setDescription($article->description)
            ->setIsActive($article->is_active);
    }

    /**
     * Article count decreasing
     */
    public function decreaseCount(int $id, int $count = 1): bool|int
    {
        return Article::where('id', $id)->decrement('count', $count);
    }

    /**
     * Article count increasing
     */
    public function increaseCount(int $id, int $count = 1): bool|int
    {
        return Article::where('id', $id)->increment('count', $count);
    }
}
