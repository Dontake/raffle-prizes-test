<?php

namespace App\Services\Article;

use App\Repositories\Article\ArticleRepoInterface;

class ArticleService
{
    public function __construct(protected ArticleRepoInterface $article){}

    public function firstRandomId()
    {
        $ids = $this->article->getIds();
        return $ids[rand(0, count($ids))];
    }
}
