<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>User Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'figtree', sans-serif;
            background-color: #e8e0da ;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
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

<body class="font-sans antialiased dark:bg-gray-900 dark:text-white">
    <header class="fixed top-0 left-0 right-0 z-10 flex items-center justify-between p-5  bg-[#e6ddd6] shadow-lg dark:bg-neutral-800">
        <div class="flex items-center">
            <a href="#" class="text-3xl font-extrabold text-purple-900 dark:text-purple-400">E</a>
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
             <a href="{{ route('dashboard') }}"
                class="px-4 py-2 text-sm font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800">
                Dashboard
            </a>
            @auth
            <div class="relative dropdown">
                <button class="flex items-center px-4 py-2 text-sm font-semibold text-black bg-gray-200 rounded-md hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600">
                    {{ Auth::user()->name }}
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="dropdown-menu mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            @endauth
            <a href="https://github.com/anas0-1/event-planner" target="_blank" rel="noopener noreferrer"
                class="px-4 py-2 text-sm font-semibold text-white bg-gray-800 rounded-md hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                    <path
                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.623-5.479 5.922.43.371.823 1.102.823 2.222v3.293c0 .319.192.694.801.577 4.768-1.589 8.204-6.085 8.204-11.384 0-6.627-5.373-12-12-12z" />
                </svg>
            </a>
        </nav>
    </header>

    <main class="pt-20 pb-8 px-4">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-5xl font-extrabold text-purple-900 dark:text-purple-400 mb-4">My Events</h1>
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
                        <p class="mt-2 text-gray-600 dark:text-gray-400"><strong>Date:</strong> {{ $event->date->format('F j, Y') }}</p>
                        <p class="mt-2 text-gray-600 dark:text-gray-400"><strong>Location:</strong> {{ $event->location }}</p>
                        <form method="POST" action="{{ route('events.destroy', $event) }}" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-md hover:bg-red-500">
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
