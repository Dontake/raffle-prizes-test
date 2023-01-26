<?php

namespace App\Repositories\Article;

use App\Entities\Prize\Type\PrizeArticleTypeEntity;

interface ArticleRepoInterface
{
    /**
     * Get first article in random order
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function firstRandom(): PrizeArticleTypeEntity;

    /**
     * Article count decreasing
     */
    public function decreaseCount(int $id, int $count): bool|int;

    /**
     * Article count increasing
     */
    public function increaseCount(int $id, int $count): bool|int;
}
