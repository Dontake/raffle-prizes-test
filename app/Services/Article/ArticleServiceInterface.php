<?php

namespace App\Services\Article;

interface ArticleServiceInterface
{
    public function firstRandomId(): int;
    public function decreaseCount(int $id): bool|int;
}
