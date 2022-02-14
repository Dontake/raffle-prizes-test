<?php

namespace App\Models\Prize;

use App\Models\BaseModel;
use App\Models\Article\Article;
use App\Models\User\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\Pure;

/**
 * App\Models\Prize\Prize
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $article_id
 * @property string $type
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

    const TYPE_MONEY = 'money';
    const TYPE_LOYALTY_BONUS = 'loyalty_bonus';
    const TYPE_ARTICLE = 'article';

    const STATUS_RAFFLED = 'raffled';
    const STATUS_SENT = 'sent';
    const STATUS_RECEIVED = 'received';

    const TYPES = [
        self::TYPE_MONEY,
        self::TYPE_LOYALTY_BONUS,
        self::TYPE_ARTICLE
    ];

    /**
     * @return BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
     * @return Prize
     */
    public function setUserId(int $userId): self
    {
        $this->user_id = $userId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getArticleId(): ?int
    {
        return $this->article_id;
    }

    /**
     * @param int|null $articleId
     * @return Prize
     */
    public function setArticleId(?int $articleId): self
    {
        $this->article_id = $articleId;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Prize
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Prize
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return float
     */
    public function getCount(): float
    {
        return $this->count;
    }

    /**
     * @param float $count
     * @return Prize
     */
    public function setCount(float $count): self
    {
        $this->count = $count;
        return $this;
    }

    #[Pure]
    public function getName(): ?string
    {
        return $this->article_id ? $this->article->getName() : null;
    }
}
