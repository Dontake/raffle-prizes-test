<?php

namespace App\Models\User;

use App\Models\BaseModel;
use App\Models\Prize\Prize;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\User\UserWallet
 *
 * @property int $id
 * @property int $user_id
 * @property float $balance
 * @property string $currency
 * @property string $account
 * @property int $is_active
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $user
 * @method static Builder|UserWallet newModelQuery()
 * @method static Builder|UserWallet newQuery()
 * @method static Builder|UserWallet query()
 * @method static \Illuminate\Database\Query\Builder|UserWallet onlyTrashed()
 * @method static Builder|UserWallet whereAccount($value)
 * @method static Builder|UserWallet whereBalance($value)
 * @method static Builder|UserWallet whereCreatedAt($value)
 * @method static Builder|UserWallet whereCurrency($value)
 * @method static Builder|UserWallet whereDeletedAt($value)
 * @method static Builder|UserWallet whereId($value)
 * @method static Builder|UserWallet whereIsActive($value)
 * @method static Builder|UserWallet whereUpdatedAt($value)
 * @method static Builder|UserWallet whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|UserWallet withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserWallet withoutTrashed()
 * @mixin Eloquent
 */
class UserWallet extends BaseModel
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

    public function increaseBalance(float $amount): bool|int
    {
        return $this->increment('balance', $amount);
    }

    public function getCount(): float
    {
        return $this->balance;
    }
}
