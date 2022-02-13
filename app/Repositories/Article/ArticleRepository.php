<?php

namespace App\Repositories\Article;

use App\Models\Article\Article;

class ArticleRepository implements ArticleRepoInterface
{
    public function getIds(): array
    {
        return Article::select('id')->toBase()->toArray();
    }
}
