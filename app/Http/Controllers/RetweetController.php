<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetweetController extends Controller
{
    /**
     * ツイートをリツイートする
     */
    public function store(Request $request, Tweet $tweet): RedirectResponse
    {
        $tweet->retweets()->create([
            'user_id' => Auth::id(),
        ]);

        return back();
    }

    /**
     * リツイートを解除する
     */
    public function destroy(Request $request, Tweet $tweet): RedirectResponse
    {
        $tweet->retweets()
            ->where('user_id', Auth::id())
            ->delete();

        return back();
    }
}
