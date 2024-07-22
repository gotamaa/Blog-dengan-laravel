<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>

    <div class="bg-white w-full flex flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row text-[#161931]">
        <aside class="hidden py-4 md:w-1/3 lg:w-1/4 md:block">
            <div class="sticky flex flex-col gap-2 p-4 text-sm border-r border-indigo-100 top-12">

                <h2 class="pl-3 mb-4 text-2xl font-semibold">Settings</h2>

                <a href="/manageposts"
                    class="flex items-center px-3 py-2.5 font-bold bg-white  text-indigo-900 border rounded-full">
                    Post Management
                </a>
            </div>
        </aside>
        <main class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
            <div class="p-2 md:p-4">
                <div class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
                    <h2 class="pl-6 text-2xl font-bold sm:text-xl">Public Profile</h2>

                    <div class="grid max-w-2xl mx-auto mt-8">
                        <div class="flex flex-col items-center space-y-5 sm:flex-row sm:space-y-0">

                            <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                                src="{{ Auth::user()->avatar }}" alt="Bordered avatar">

                            <div class="flex flex-col space-y-5 sm:ml-8">
                                <button type="button" id="open-popup"
                                    class="py-3.5 px-7 text-base font-medium text-indigo-100 focus:outline-none bg-[#202142] rounded-lg border border-indigo-200 hover:bg-indigo-900 focus:z-10 focus:ring-4 focus:ring-indigo-200 ">
                                    Change picture
                                </button>
                                <form action="{{route('picture.delete')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit"
                                        class="py-3.5 px-7 text-base font-medium text-indigo-900 focus:outline-none bg-white rounded-lg border border-indigo-200 hover:bg-indigo-100 hover:text-[#202142] focus:z-10 focus:ring-4 focus:ring-indigo-200 ">
                                        Delete picture
                                    </button>
                                </form>
                            </div>
                        </div>

                        <form action="{{ route('picture.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div id="info-popup" tabindex="-1"
                                class="hidden fixed inset-0 z-50 bg-black bg-opacity-50">
                                <div class="flex items-center justify-center min-h-screen">
                                    <div class="relative p-4 w-full max-w-lg h-full md:h-auto">
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 md:p-8">
                                            <div class="flex items-center justify-center w-full">
                                                <label for="image"
                                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        {{-- <div class="flex items-center justify-center mt-4">
                                                            <img id="image-preview" class="hidden object-cover w-40 h-40 rounded-lg">
                                                        </div> --}}
                                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 20 16">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                        </svg>
                                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                                class="font-semibold">Click to upload</span> or drag and
                                                            drop</p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG,
                                                            JPG or GIF (MAX. 800x400px)</p>
                                                    </div>
                                                    <input type="file" name="image" id="image" class="hidden" accept="image/*">
                                                </label>

                                            </div>

                                            <div class="justify-between items-center pt-0 space-y-4 sm:flex sm:space-y-0">
                                                <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0">
                                                    <button id="close-modal" type="button"
                                                        class="py-2 px-4 w-full text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 sm:w-auto hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                    <button id="confirm-button" type="submit"
                                                        class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-auto hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Confirm</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <script>
                            document.getElementById('open-popup').addEventListener('click', function() {
                                var popup = document.getElementById('info-popup');
                                popup.classList.remove('hidden');
                            });

                            document.getElementById('close-modal').addEventListener('click', function() {
                                var popup = document.getElementById('info-popup');
                                popup.classList.add('hidden');
                            });

                            document.getElementById('confirm-button').addEventListener('click', function() {
                                var popup = document.getElementById('info-popup');
                                popup.classList.add('hidden');
                            });

                            document.getElementById('image').addEventListener('change', function(event) {
                                var reader = new FileReader();
                                reader.onload = function() {
                                    var output = document.getElementById('image-preview');
                                    output.src = reader.result;
                                    output.classList.remove('hidden');
                                };
                                reader.readAsDataURL(event.target.files[0]);
                            });
                        </script>

                        <div class="items-center mt-8 sm:mt-14 text-[#202142]">
                            <div
                                class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                                <div class="w-full">
                                    <label for="name"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                                    Name</label>
                                <label for="Name"
                                    class="bg-indigo-50 border border-indigo-300  text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 ">
                                    {{ Auth::user()->name }}
                                </label>
                                </div>

                                <div class="w-full">
                                    <label for="username"
                                        class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                                        Username</label>
                                    <label for="Username"
                                        class="bg-indigo-50 border border-indigo-300  text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 ">
                                        {{ Auth::user()->username }}
                                    </label>
                                </div>
                            </div>

                            <div class="mb-2 sm:mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                                    email</label>
                                <label for="email"
                                    class="bg-indigo-50 border border-indigo-300  text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 ">
                                    {{ Auth::user()->email }}
                                </label>
                            </div>
                            <form action="{{route('profile.update')}}" method="POST">
                                @csrf
                                <div class="mb-6">
                                    <label for="bio"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Bio</label>
                                    <textarea id="bio" name="bio" rows="4"
                                    class="block p-2.5 w-full text-sm text-indigo-900 bg-indigo-50 rounded-lg border border-indigo-300 focus:ring-indigo-500 focus:border-indigo-500 "
                                    placeholder="Write your bio here...">{{auth::user()->bio}}</textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit"
                                    class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
