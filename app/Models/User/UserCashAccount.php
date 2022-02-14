<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\User\UserCashAccount
 *
 * @property int $id
 * @property int $user_id
 * @property float $balance
 * @property string $currency
 * @property bool $isActive
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $user
 * @method static Builder|UserCashAccount newModelQuery()
 * @method static Builder|UserCashAccount newQuery()
 * @method static Builder|UserCashAccount query()
 * @mixin Eloquent
 * @property string $account
 * @property int $is_active
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|UserCashAccount onlyTrashed()
 * @method static Builder|UserCashAccount whereAccount($value)
 * @method static Builder|UserCashAccount whereBalance($value)
 * @method static Builder|UserCashAccount whereCreatedAt($value)
 * @method static Builder|UserCashAccount whereCurrency($value)
 * @method static Builder|UserCashAccount whereDeletedAt($value)
 * @method static Builder|UserCashAccount whereId($value)
 * @method static Builder|UserCashAccount whereIsActive($value)
 * @method static Builder|UserCashAccount whereUpdatedAt($value)
 * @method static Builder|UserCashAccount whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|UserCashAccount withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserCashAccount withoutTrashed()
 */
class UserCashAccount extends BaseModel
{
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param float $amount
     * @return bool|int
     */
    public function increaseBalance(float $amount): bool|int
    {
        return $this->increment('balance', $amount);
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $userId
     * @return UserCashAccount
     */
    public function setUserId(int $userId): self
    {
        $this->user_id = $userId;
        return $this;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     * @return UserCashAccount
     */
    public function setBalance(float $balance): self
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return UserCashAccount
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * @param string $account
     * @return UserCashAccount
     */
    public function setAccount(string $account): self
    {
        $this->account = $account;
        return $this;
    }
}
