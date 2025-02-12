<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * ツイートにいいねをする
     */
    public function store(Request $request, Tweet $tweet): RedirectResponse
    {
        $tweet->likes()->create([
            'user_id' => Auth::id(),
        ]);

        return back();
    }

    /**
     * いいねを解除する
     */
    public function destroy(Request $request, Tweet $tweet): RedirectResponse
    {
        $tweet->likes()
            ->where('user_id', Auth::id())
            ->delete();

        return back();
    }
}
