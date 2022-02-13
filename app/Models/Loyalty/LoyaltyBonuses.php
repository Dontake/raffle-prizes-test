<?php

namespace App\Models\Loyalty;

use App\Models\BaseModel;
use App\Models\User\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Loyalty\LoyaltyBonuses
 *
 * @property int id
 * @property int user_id
 * @property int balance
 * @property float monetary_equivalent
 * @property string currency
 * @property bool is_active
 * @property string $monetary equivalent
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read User|null $user
 * @method static Builder|LoyaltyBonuses newModelQuery()
 * @method static Builder|LoyaltyBonuses newQuery()
 * @method static \Illuminate\Database\Query\Builder|LoyaltyBonuses onlyTrashed()
 * @method static Builder|LoyaltyBonuses query()
 * @method static Builder|LoyaltyBonuses whereBalance($value)
 * @method static Builder|LoyaltyBonuses whereCreatedAt($value)
 * @method static Builder|LoyaltyBonuses whereCurrency($value)
 * @method static Builder|LoyaltyBonuses whereDeletedAt($value)
 * @method static Builder|LoyaltyBonuses whereId($value)
 * @method static Builder|LoyaltyBonuses whereIsActive($value)
 * @method static Builder|LoyaltyBonuses whereMonetaryEquivalent($value)
 * @method static Builder|LoyaltyBonuses whereUpdatedAt($value)
 * @method static Builder|LoyaltyBonuses whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|LoyaltyBonuses withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LoyaltyBonuses withoutTrashed()
 * @mixin Eloquent
 */
class LoyaltyBonuses extends BaseModel
{
    protected $guarded = ['id'];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
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
     * @return LoyaltyBonuses
     */
    public function setUserId(int $userId): self
    {
        $this->user_id = $userId;
        return $this;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     * @return LoyaltyBonuses
     */
    public function setBalance(int $balance): self
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * @return float
     */
    public function getMonetaryEquivalent(): float
    {
        return $this->monetary_equivalent;
    }

    /**
     * @param float $monetaryEquivalent
     * @return LoyaltyBonuses
     */
    public function setMonetaryEquivalent(float $monetaryEquivalent): self
    {
        $this->monetary_equivalent = $monetaryEquivalent;
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
     * @return LoyaltyBonuses
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }
}
