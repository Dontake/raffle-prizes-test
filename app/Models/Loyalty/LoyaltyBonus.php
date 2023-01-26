<?php

namespace App\Models\Loyalty;

use App\Models\BaseModel;
use App\Models\Prize\Prize;
use App\Models\User\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Loyalty\LoyaltyBonus
 *
 * @property int $id
 * @property int $user_id
 * @property int $balance
 * @property float $monetary_equivalent
 * @property string $currency
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read User|null $user
 * @method static Builder|LoyaltyBonus newModelQuery()
 * @method static Builder|LoyaltyBonus newQuery()
 * @method static \Illuminate\Database\Query\Builder|LoyaltyBonus onlyTrashed()
 * @method static Builder|LoyaltyBonus query()
 * @method static Builder|LoyaltyBonus whereBalance($value)
 * @method static Builder|LoyaltyBonus whereCreatedAt($value)
 * @method static Builder|LoyaltyBonus whereCurrency($value)
 * @method static Builder|LoyaltyBonus whereDeletedAt($value)
 * @method static Builder|LoyaltyBonus whereId($value)
 * @method static Builder|LoyaltyBonus whereIsActive($value)
 * @method static Builder|LoyaltyBonus whereMonetaryEquivalent($value)
 * @method static Builder|LoyaltyBonus whereUpdatedAt($value)
 * @method static Builder|LoyaltyBonus whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|LoyaltyBonus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LoyaltyBonus withoutTrashed()
 * @mixin Eloquent
 */
class LoyaltyBonus extends BaseModel
{
    protected $guarded = ['id'];

    public function prize(): MorphOne
    {
        return $this->morphOne(Prize::class, 'playable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getCount(): int
    {
        return $this->balance;
    }
}
