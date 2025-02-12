<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tweet extends Model
{
    /** @use HasFactory<\Database\Factories\TweetFactory> */
    use HasFactory;

    // fillableでホワイトリストを設定
    protected $fillable = ['tweet'];

    /** ユーザーID(1対多の関係) */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ツイートのいいねを取得
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * ツイートのリツイートを取得
     */
    public function retweets(): HasMany
    {
        return $this->hasMany(Retweet::class);
    }

    /**
     * 特定のユーザーがいいねしているかチェック
     */
    public function likedBy(?User $user): bool
    {
        if ($user === null) {
            return false;
        }

        return $this->likes()
            ->where('user_id', $user->id)
            ->exists();
    }

    /**
     * 特定のユーザーがリツイートしているかチェック
     */
    public function retweetedBy(?User $user): bool
    {
        if ($user === null) {
            return false;
        }

        return $this->retweets()
            ->where('user_id', $user->id)
            ->exists();
    }

    /**
     * いいねの数を取得
     */
    public function getLikesCountAttribute(): int
    {
        return $this->likes->count();
    }

    /**
     * リツイートの数を取得
     */
    public function getRetweetsCountAttribute(): int
    {
        return $this->retweets->count();
    }
}
