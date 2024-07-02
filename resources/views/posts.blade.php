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
        @foreach ($posts as $post )
        <article class ="py max-w-screen-md border-b border-gray-300">
            <h2 class="mb-1 text-2xl tracking-tigh font-bold text-gray-700">{{$post['title']}}</h2>
            <div class="text-base text-gray-400">
                <a href="/authors/{{$post->author->id}}"class="hover:underline">{{$post->author->name}}</a> <a href="/cattegories/{{$post->cattegory->id}}"class="hover:underline">| {{$post->cattegory->name}}</a> | {{$post->created_at}}
            </div>
            <p class = "my-4 font-light">
                {{$post['body']}}
            </p>
        </article>
        @endforeach
    </x-layout>

</body>
</html>
