<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('makeblog.store') }}" method="POST">
    @csrf
    <div>
        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
        <div class="relative mt-2 rounded-md shadow-sm">
        <input type="text" name="title" id="Title" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
        <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Author</label>
        <div class="relative mt-2 rounded-md shadow-sm">
        <input type="text" name="author" id="author" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
        <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Blog</label>
        <div class="relative mt-2 rounded-md shadow-sm">
        <input type="text" name="body" id="body" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
    </div>
    <button type="submit">Submit</button>
    </form>
</body>
</html>
