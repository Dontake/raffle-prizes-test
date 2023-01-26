<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\User\UserRole
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read User|null $user
 * @method static Builder|UserRole newModelQuery()
 * @method static Builder|UserRole newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserRole onlyTrashed()
 * @method static Builder|UserRole query()
 * @method static Builder|UserRole whereCreatedAt($value)
 * @method static Builder|UserRole whereDeletedAt($value)
 * @method static Builder|UserRole whereId($value)
 * @method static Builder|UserRole whereIsActive($value)
 * @method static Builder|UserRole whereName($value)
 * @method static Builder|UserRole whereUpdatedAt($value)
 * @method static Builder|UserRole whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|UserRole withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserRole withoutTrashed()
 * @mixin Eloquent
 */
class UserRole extends BaseModel
{
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
