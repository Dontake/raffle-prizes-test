<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
