<?php

namespace App\Services\Article;

use App\Repositories\Article\ArticleRepoInterface;

class ArticleService implements ArticleServiceInterface
{
    /**
     * @param ArticleRepoInterface $article
     */
    public function __construct(protected ArticleRepoInterface $article){}

    /**
     * Get article random id
     * @return int
     */
    public function firstRandomId(): int
    {
        $ids = $this->article->getIds();
        return $ids[rand(1, count($ids) - 1)];
    }

    /**
     * Article count decreasing
     *
     * @param int $id
     * @return bool|int
     */
    public function decreaseCount(int $id): bool|int
    {
        return $this->article->decreaseCount($id);
    }

    /**
     * Article count increasing
     *
     * @param int $id
     * @return bool|int
     */
    public function increaseCount(int $id): bool|int
    {
        return $this->article->increaseCount($id);
    }
}
