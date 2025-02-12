<!-- resources/views/tweets/index.blade.php -->

<!-- アプリケーションのレイアウトを使用 -->
<x-app-layout>
    <!-- ヘッダーセクションのスロットを定義 -->
    <x-slot name="header">
        <!-- ヘッダーのタイトルを表示 -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tweet一覧') }}
        </h2>
    </x-slot>

    <!-- メインコンテンツのパディングを設定 -->
    <div class="py-12">
        <!-- コンテンツの最大幅を設定し、中央寄せにする -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- 背景色とシャドウを設定したコンテナ -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- コンテンツのパディングとテキストカラーを設定 -->
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- $tweetsコレクションをループして各ツイートを表示 -->
                    @foreach ($tweets as $tweet)
                        <!-- ツイートごとのコンテナ -->
                        <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                            <!-- ツイートの内容を表示 -->
                            <p class="text-gray-800 dark:text-gray-300">{{ $tweet->tweet }}</p>
                            <!-- 投稿者の名前を表示 -->
                            <p class="text-gray-600 dark:text-gray-400 text-sm">投稿者: {{ $tweet->user->name }}</p>
                            <div class="flex items-center mt-2 space-x-4">
                                <!-- いいねボタン -->
                                @auth
                                    @if($tweet->likedBy(auth()->user()))
                                        <form action="{{ route('tweets.unlike', $tweet) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center space-x-1 text-red-500 hover:text-red-700 transform transition-all duration-200 hover:scale-110 active:scale-95">
                                                <svg class="w-5 h-5 transition-transform duration-200 hover:scale-110" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                                </svg>
                                                <span>{{ $tweet->likes_count }}</span>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('tweets.like', $tweet) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="flex items-center space-x-1 text-gray-500 hover:text-red-500 transform transition-all duration-200 hover:scale-110 active:scale-95">
                                                <svg class="w-5 h-5 transition-transform duration-200 hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                                                </svg>
                                                <span>{{ $tweet->likes_count }}</span>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                                <!-- 詳細ページへのリンク -->
                                <a href="{{ route('tweets.show', $tweet) }}"
                                    class="text-blue-500 hover:text-blue-700">詳細を見る</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
