<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2" defer></script>
    <title>Document</title>
    <style>
        .menu-button {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 24px;
        }

        .menu-items {
            right: 0;
            top: 100%;
        }
    </style>
</head>

<body>
    <x-layout>
        <x-slot:title></x-slot:title>
        @forelse ($posts as $post)
        <article
        class="relative p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700" style="margin-top: 11px; margin-bottom: 11px;">
        <div x-data="{ isOpen: false }" class="menu-button">
            <button @click="isOpen = !isOpen"
            class="relative flex items-center rounded-full bg-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
            ☰
            <span class="sr-only">Open user menu</span>
        </button>

        <div x-show="isOpen" @click.away="isOpen = false"
        x-transition:enter="transition ease-out duration-100 transform"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75 transform"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none menu-items"
        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
        <!-- Menu items -->
        <a href="managepost/edit/{{$post->id}}" class="block px-4 py-2 text-sm text-gray-700"
            role="menuitem" tabindex="0">Edit</a>
            <form method="POST" action="{{ route('manageposts.destroy', $post->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700"
                role="menuitem" tabindex="1">Delete</button>
            </form>
        </div>
    </div>

    <div class="flex justify-between items-center mb-5 text-gray-500">
        <a href="/posts?category={{ $post->category->slug }}">
            <span
            class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
            {{ $post->category->name }}
        </span>
    </a>
    <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
</div>

<h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
    <a href="/posts/{{ $post->slug }}">
        {{ $post->title }}
    </a>
</h2>
<p class="mb-5 font-light text-gray-500 dark:text-gray-400">
    {{ $post->body }}
</p>

<div class="flex justify-between items-center">
    <div class="flex items-center space-x-4">
        <img class="w-7 h-7 rounded-full" src="{{ $post->author->avatar }}"
        alt="{{ $post->author->name }} avatar" />
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
    <p class="font-semibold text-xl my-4">You don't have any articles!</p>
    <br>
    <a href="/uploadpost" class="text-blue-600 text-sm hover:underline">&laquo; Create New Article</a>
</div>
@endforelse
</x-layout>
</body>

</html>
