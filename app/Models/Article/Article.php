<?php

namespace App\Models\Article;

use App\Models\BaseModel;
use App\Models\Prize\Prize;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Article\Article
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $count
 * @property bool $is_active
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Prize|null $prize
 * @method static Builder|Article newModelQuery()
 * @method static Builder|Article newQuery()
 * @method static \Illuminate\Database\Query\Builder|Article onlyTrashed()
 * @method static Builder|Article query()
 * @method static Builder|Article whereCount($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereDeletedAt($value)
 * @method static Builder|Article whereDescription($value)
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereIsActive($value)
 * @method static Builder|Article whereName($value)
 * @method static Builder|Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Article withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Article withoutTrashed()
 * @mixin Eloquent
 * @property Carbon|null $created_at
 */
class Article extends BaseModel
{
    protected $guarded = ['id'];

    public function getCount(): int
    {
        return $this->count;
    }

    public function prize(): MorphOne
    {
        return $this->morphOne(Prize::class, 'playable');
    }
}
