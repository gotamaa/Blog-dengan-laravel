<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @foreach ($posts as $post )
    <article class ="py max-w-screen-md border-b border-gray-300">
        <h2 class="mb-1 text-2xl tracking-tigh font-bold text-gray-700">{{$post['title']}}</h2>
        <div class="text-base text-gray-400">
            <a>{{$post['author']}}</a> | 25 juni 2024
        </div>
        <p class = "my-4 font-light">
            {{$post['body']}}
        </p>
    </article>
    @endforeach
</x-layout>
