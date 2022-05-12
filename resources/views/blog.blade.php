@extends('welcome')

@section('body_content')
    <div class="flex flex-col items-center">

        @if(Auth::check())
            <div class="mt-8">
                @if($errors->any())
                    <div>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="mb-4 text-sm font-medium text-red-700">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <span class="mb-2 font-large text-gray-700 bg-gray-100">Форма создания поста в блоге</span>
                <form method="POST" class="bg-gray-100" action="{{ route('createPost') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="theme" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-500">Тема
                            поста</label>
                        <input type="text" name="theme" id="theme"
                               class="w-64 bg-gray-300 border border-gray-300 text-gray-900 text-sm">
                    </div>
                    <div class="mb-6">
                        <label for="post_text" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-500">Текст
                            поста</label>
                        <textarea name="post_text" id="post_text" rows="5"
                                  class="w-64 bg-gray-300 border border-gray-300 text-gray-900 text-sm"></textarea>
                    </div>
                    <button type="submit"
                            class="float-right text-white px-5 border-gray-300 bg-blue-900 hover:bg-blue-500 focus:ring-4 text-sm rounded-lg text-center">
                        Отправить
                    </button>
                </form>
            </div>
        @endif
            <div class="mt-3 max-w-4xl flex flex-col items-center">
                @foreach($blogPosts as $blogPost)
                    <div id="{{ $blogPost['id'] }}" class="mt-4 w-3/4">
                        <h2 class="break-all text-lg text-black-900">{{ $blogPost['theme'] }}</h2>
                        <span class="block break-all text-sm text-gray-600">{{ $blogPost['postText'] }}</span>
                        @if(Auth::check())
                            <a href="{{ route('deletePost', ['id' => $blogPost['id']]) }}"
                               class="text-white px-5 border-gray-300 bg-red-900 hover:bg-red-500 focus:ring-4 text-sm rounded-lg text-center">
                                Удалить</a>
                        @endif
                        @if(Auth::check())
                            <div class="mt-8">
                                <span class="mb-2 font-large text-gray-700 bg-gray-100">Форма обновления поста в блоге</span>
                                <form method="POST" class="bg-gray-100" action="{{ route('updatePost') }}">
                                    @csrf
                                    <input type="text" name="id" hidden value="{{ $blogPost['id'] }}">
                                    <div class="mb-6">
                                        <label for="theme" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-500">Тема
                                            поста</label>
                                        <input type="text" name="theme" id="theme"
                                               class="w-64 bg-gray-300 border border-gray-300 text-gray-900 text-sm">
                                    </div>
                                    <div class="mb-6">
                                        <label for="post_text" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-500">Текст
                                            поста</label>
                                        <textarea name="post_text" id="post_text" rows="5"
                                                  class="w-64 bg-gray-300 border border-gray-300 text-gray-900 text-sm"></textarea>
                                    </div>
                                    <button type="submit"
                                            class="text-white px-5 border-gray-300 bg-blue-900 hover:bg-blue-500 focus:ring-4 text-sm rounded-lg text-center">
                                        Отправить
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div>
                @if($previousPage >= 1)
                    <a href="{{ route('blog', ['id' => $previousPage]) }}">Назад</a>
                @endif
                @if($nextPage <= $maxPage)
                    <a href="{{ route('blog', ['id' => $nextPage]) }}">Вперёд</a>
                @endif
            </div>
    </div>
@endsection
