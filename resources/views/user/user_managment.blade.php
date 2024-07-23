<!DOCTYPE html>
<html>
<head>
    <title>Data Table</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        /* Style for modal popup */
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<x-layout>
    <x-slot:title>
        <button>
            <a href="/">Back Home</a>
        </button>
    </x-slot:title>

    <h2>Data Table</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Posts</th>
                <th>Created</th>
                <th>Verified At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->posts->count() }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->email_verified_at }}</td>

                <td>
                    <div x-data="{ isOpen: false }" class="menu-button">
                        <button @click="isOpen = !isOpen"
                                class="relative flex items-center rounded-full bg-zinc-50 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            ☰
                            <span class="sr-only">Open user menu</span>
                        </button>

                        <div x-show="isOpen" @click.away="isOpen = false"
                            x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none menu-items"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <button type="button" @click="isOpen = false"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700" role="menuitem"
                                tabindex="1" id="open-popup">Delete</button>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Popup -->
    <div id="info-popup" tabindex="-1" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="relative p-4 w-full max-w-lg h-full md:h-auto">
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 md:p-8">
                    <div class="justify-between items-center pt-0 space-y-4 sm:flex sm:space-y-0">
                        <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0">
                            <p>Are you sure you want to delete this User?</p>
                            <button id="close-modal" type="button"
                                class="py-2 px-4 w-full text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 sm:w-auto hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                            <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button id="confirm-button" type="submit"
                                    class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-auto hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Confirm
                                    Delete?</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

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
</script>

</body>
</html>
