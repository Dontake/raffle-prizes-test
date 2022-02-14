<?php

namespace App\Repositories\Article;

interface ArticleRepoInterface
{
    /**
     * Get article ids
     * @return array
     */
    public function getIds(): array;

    /**
     * Article count decreasing
     *
     * @param int $id
     * @return bool|int
     */
    public function decreaseCount(int $id): bool|int;

    /**
     * Article count increasing
     *
     * @param int $id
     * @return bool|int
     */
    public function increaseCount(int $id): bool|int;
}
