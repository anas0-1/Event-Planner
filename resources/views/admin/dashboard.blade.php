<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        /* Custom styles */
        body {
            font-family: 'figtree', sans-serif;
        }

        /* Dropdown menu styles */
        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-menu a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 dark:text-white">
    <header
        class="fixed top-0 left-0 right-0 z-10 flex items-center justify-between p-5 bg-gray-50 shadow-lg dark:bg-neutral-800">
        <div class="flex items-center">
            <a href="#" class="text-3xl font-extrabold text-purple-900 dark:text-purple-400">Admin</a>
        </div>
        <nav class="flex items-center space-x-4">
            <a href="{{ route('welcome') }}"
                class="px-4 py-2 text-sm font-semibold text-black bg-gray-200 rounded-md hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600">
                Home
            </a>
            <a href="{{ route('events.index') }}"
                class="px-4 py-2 text-sm font-semibold text-black bg-gray-200 rounded-md hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600">
                All Events
            </a>
            <a href="{{ route('launchevent') }}"
                class="px-4 py-2 text-sm font-semibold text-black bg-gray-200 rounded-md hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600">
                Launch an Event
            </a>
            <a href="{{ route('admin.reservations') }}"
                class="px-4 py-2 text-sm font-semibold text-white bg-gray-200 rounded-md hover:bg-purple-800">
                Manage Reservations
            </a>
            <a href="{{ route('admin.dashboard') }}"
                class="px-4 py-2 text-sm font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800">
                Dashboard
            </a>
            @auth
                <div class="relative dropdown">
                    <button
                        class="flex items-center px-4 py-2 text-sm font-semibold text-black bg-gray-200 rounded-md hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600">
                        {{ Auth::user()->name }}
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="dropdown-menu mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </nav>
    </header>

    <main class="pt-20 pb-8 px-4">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-5xl font-extrabold text-purple-900 dark:text-purple-400 mb-4">Admin Dashboard</h1>
            @if (session('success'))
                <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($events as $event)
                    <div class="bg-white dark:bg-neutral-800 shadow-md rounded-lg p-6">
                        <h2 class="text-2xl font-bold text-purple-900 dark:text-purple-400">{{ $event->title }}</h2>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $event->description }}</p>
                        <p class="mt-2 text-gray-600 dark:text-gray-400"><strong>Date:</strong>
                            {{ $event->date->format('F j, Y') }}</p>
                        <p class="mt-2 text-gray-600 dark:text-gray-400"><strong>Location:</strong> {{ $event->location }}
                        </p>
                        <form method="POST" action="{{ route('events.destroy', $event) }}" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-md hover:bg-red-500">
                                Delete Event
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</body>

</html>