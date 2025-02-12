<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // プロフィール編集
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // プロフィール更新
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // プロフィール削除
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // ツイートのCRUD (一覧、作成、更新、削除)ルーティング
    Route::resource('tweets', TweetController::class);
    
    // いいね機能のルート
    Route::post('/tweets/{tweet}/like', [LikeController::class, 'store'])->name('tweets.like');
    Route::delete('/tweets/{tweet}/like', [LikeController::class, 'destroy'])->name('tweets.unlike');
});

require __DIR__ . '/auth.php';
