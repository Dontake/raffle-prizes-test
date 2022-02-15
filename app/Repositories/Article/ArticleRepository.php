<?php

namespace App\Repositories\Article;

use App\Models\Article\Article;
use Exception;

class ArticleRepository implements ArticleRepoInterface
{

    /**
     * @return array
     */
    public function getIds(): array
    {
        return Article::select('id')->where('count', '>', 0)
            ->sharedLock()
            ->toBase()
            ->get()
            ->toArray();
    }

    /**
     * Article count decreasing
     *
     * @param int $id
     * @return bool|int
     * @throws Exception
     */
    public function decreaseCount(int $id): bool|int
    {
        $exist = Article::where('id', $id)
            ->where('count', '!=', 0)
            ->sharedLock()
            ->exists();

        if (!$exist) {
            throw new Exception('Not found available articles');
        }

        return Article::find($id)->decrement('count');
    }

    /**
     * Article count increasing
     *
     * @param int $id
     * @return bool|int
     */
    public function increaseCount(int $id): bool|int
    {
        return Article::find($id)->increment('count');
    }
}
