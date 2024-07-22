<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <x-layout>
        <x-slot:title>{{ $title }}</x-slot:title>
        <x-searchbar></x-searchbar>
        <div class="h-screen dark:bg-gray-700 bg-gray-200 pt-12">
                <div class="max-w-sm mx-auto bg-white dark:bg-gray-900 rounded-lg overflow-hidden shadow-lg">
                    <div class="border-b px-4 pb-6">
                        <div class="text-center my-4">
                            <img class="h-32 w-32 rounded-full border-4 border-white dark:border-gray-800 mx-auto my-4"
                                src="{{$user->avatar}}" alt="">
                            <div class="py-2">
                                <h3 class="font-bold text-2xl text-gray-800 dark:text-white mb-1">{{$user->name}}</h3>
                                <div class="inline-flex text-gray-700 dark:text-gray-300 items-center">
                                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-600 mr-1" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path class=""
                                            d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                    </svg>
                                    New York, NY
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="py-4 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-0">
            <div class="grid gap-8 lg:grid-cols-2">
                @forelse ($posts as $post)
                    <article
                        class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-5 text-gray-500">
                            <a href="/posts?category={{ $post->category->slug }}">
                                <span
                                    class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                    {{ $post->category->name }}
                                </span>
                                <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="/posts/{{ $post->slug }}">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
                            {{ Str::words($post->body, 150) }}
                        </p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <a href="/profile/{{$post->author->username}}">
                                    <img class="w-7 h-7 rounded-full"
                                        src="{{ $post->author->avatar }}"
                                        alt="Jese Leos avatar" />
                                </a>
                                <a href="/posts?author={{ $post->author->username }}">
                                    <span class="font-medium dark:text-white">
                                        {{ $post->author->name }}
                                    </span>
                                </a>
                            </div>
                            <a href="/posts/{{ $post->slug }}"
                                class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                Read more
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div>
                        <p class="font-semibold text-xl my-4">Article Not Found!</p> <br>
                        <a href="/posts" class="stext-blue-600 text-sm hover:underline">&laquo;Back To All Post</a>
                    </div>
                @endforelse
            </div>
            </div>
            {{$posts->links()}}
    </x-layout>
</body>

</html>
