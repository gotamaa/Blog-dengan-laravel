<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>Buat Blog Baru</title>
</head>
<body>
    <form action="{{ route('posts.create') }}" method="POST">
        @csrf
        <div>
            <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
            <div class="relative mt-2 rounded-md shadow-sm">
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            @error('title')
                <div class="text-red-500">{{ $message }}</div>
            @enderror

            <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Author</label>
            <div class="relative mt-2 rounded-md shadow-sm">
                <input type="text" name="author" id="author" value="{{ old('author') }}" required class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            @error('author')
                <div class="text-red-500">{{ $message }}</div>
            @enderror

            <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Blog</label>
            <div class="relative mt-2 rounded-md shadow-sm">
                <textarea name="body" id="body" required class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('body') }}</textarea>
            </div>
            @error('body')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Buat Blog</button>
    </form>
</body>
</html>
