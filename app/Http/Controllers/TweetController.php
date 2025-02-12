<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ツイート一覧を表示
        $tweets = Tweet::with('user')->latest()->get();
        return view('tweets.index', compact('tweets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ツイート作成画面を表示
        return view('tweets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'tweet' => 'required|max:255',
        ]);
        // ツイートを保存
        $request->user()->tweets()->create($request->only('tweet'));
        // ツイート一覧にリダイレクト 
        return redirect()->route('tweets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tweet $tweet)
    {
        //　ツイート詳細を表示
        return view('tweets.show', compact('tweet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweet)
    {
        // ツイート編集画面を表示
        return view('tweets.edit', compact('tweet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tweet $tweet)
    {
        // ツイートを更新
        /**
         * ツイートを更新し、ツイート一覧ページにリダイレクトします。
         *
         * @param \Illuminate\Http\Request $request HTTPリクエストオブジェクト
         * @param \App\Models\Tweet $tweet 更新対象のツイートモデル
         * @return \Illuminate\Http\RedirectResponse ツイート一覧ページへのリダイレクトレスポンス
         */
        $tweet->update($request->only('tweet'));
        // ツイート一覧にリダイレクト
        return redirect()->route('tweets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet)
    {
        // ツイートを削除
        $tweet->delete();
        // ツイート一覧にリダイレクト
        return redirect()->route('tweets.index');
        
    }
}
