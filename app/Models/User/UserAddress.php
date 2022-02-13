<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\User\UserAddress
 *
 * @property int $id
 * @property int $user_id
 * @property string $postcode
 * @property string $country
 * @property string $town
 * @property string $address
 * @property bool $default
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read User|null $user
 * @method static Builder|UserAddress newModelQuery()
 * @method static Builder|UserAddress newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserAddress onlyTrashed()
 * @method static Builder|UserAddress query()
 * @method static Builder|UserAddress whereAddress($value)
 * @method static Builder|UserAddress whereCountry($value)
 * @method static Builder|UserAddress whereCreatedAt($value)
 * @method static Builder|UserAddress whereDefault($value)
 * @method static Builder|UserAddress whereDeletedAt($value)
 * @method static Builder|UserAddress whereId($value)
 * @method static Builder|UserAddress whereIsActive($value)
 * @method static Builder|UserAddress wherePostcode($value)
 * @method static Builder|UserAddress whereTown($value)
 * @method static Builder|UserAddress whereUpdatedAt($value)
 * @method static Builder|UserAddress whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|UserAddress withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserAddress withoutTrashed()
 * @mixin Eloquent
 */
class UserAddress extends BaseModel
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
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $userId
     * @return UserAddress
     */
    public function setUserId(int $userId): self
    {
        $this->user_id = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     * @return UserAddress
     */
    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return UserAddress
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }

    /**
     * @param string $town
     * @return UserAddress
     */
    public function setTown(string $town): self
    {
        $this->town = $town;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return UserAddress
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->default;
    }

    /**
     * @param bool $default
     * @return UserAddress
     */
    public function setDefault(bool $default): self
    {
        $this->default = $default;
        return $this;
    }
}
