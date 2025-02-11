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
                            <!-- 詳細ページへのリンク -->
                            <a href="{{ route('tweets.show', $tweet) }}"
                                class="text-blue-500 hover:text-blue-700">詳細を見る</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
