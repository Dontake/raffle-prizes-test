<?php

namespace App\Models\Loyalty;

use App\Models\BaseModel;
use App\Models\User\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Loyalty\LoyaltyBonus
 *
 * @property int id
 * @property int user_id
 * @property int balance
 * @property float monetary_equivalent
 * @property string currency
 * @property bool is_active
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
 * @property int $id
 * @property int $user_id
 * @property int $balance
 * @property string $monetary_equivalent
 * @property string $currency
 * @property int $is_active
 */
class LoyaltyBonus extends BaseModel
{
    protected $guarded = ['id'];

    const DEFAULT_CURRENCY = 'USD';
    const DEFAULT_MONETARY_EQUIVALENT = 0.1;

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
     * @return LoyaltyBonus
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
     * @return LoyaltyBonus
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
     * @return LoyaltyBonus
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
     * @return LoyaltyBonus
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }
}
