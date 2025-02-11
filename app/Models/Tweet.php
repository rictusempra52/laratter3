<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
