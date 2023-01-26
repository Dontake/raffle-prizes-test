<?php

namespace App\Models\Prize;

use App\Models\BaseModel;
use App\Models\Article\Article;
use App\Models\User\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\Pure;
use function PHPUnit\Framework\isInstanceOf;

/**
 * App\Models\Prize\Prize
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $playable_type
 * @property string $playable_id
 * @property string $status
 * @property float $count
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Article|null $article
 * @property-read User|null $user
 * @method static Builder|Prize newModelQuery()
 * @method static Builder|Prize newQuery()
 * @method static \Illuminate\Database\Query\Builder|Prize onlyTrashed()
 * @method static Builder|Prize query()
 * @method static Builder|Prize whereArticleId($value)
 * @method static Builder|Prize whereCount($value)
 * @method static Builder|Prize whereCreatedAt($value)
 * @method static Builder|Prize whereDeletedAt($value)
 * @method static Builder|Prize whereId($value)
 * @method static Builder|Prize whereIsActive($value)
 * @method static Builder|Prize whereStatus($value)
 * @method static Builder|Prize whereType($value)
 * @method static Builder|Prize whereUpdatedAt($value)
 * @method static Builder|Prize whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Prize withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Prize withoutTrashed()
 * @mixin Eloquent
 */
class Prize extends BaseModel
{
    protected $guarded = ['id'];

    public function playable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    #[Pure]
    public function getName(): string
    {
        return $this->playable instanceof Article ? $this->playable->name : $this->playable_type;
    }
}
