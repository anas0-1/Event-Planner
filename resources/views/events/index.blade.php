<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>All Events</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'figtree', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<header class="fixed top-0 left-0 right-0 z-10 flex items-center justify-between p-5 bg-gray-50 shadow-lg dark:bg-neutral-800">
    <div class="flex items-center">
        <a href="#" class="text-3xl font-extrabold text-purple-900 dark:text-purple-400">
            E
        </a>
    </div>
    <nav class="flex items-center space-x-4">
        <a href="{{ route('welcome') }}"
           @class([
               'px-4 py-2 text-sm font-semibold rounded-md',
               'text-white bg-purple-900 hover:bg-purple-800' => request()->routeIs('welcome'),
               'text-black bg-gray-200 hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600' => !request()->routeIs('welcome'),
           ])>
            Home
        </a>
        <a href="{{ route('events.index') }}"
           @class([
               'px-4 py-2 text-sm font-semibold rounded-md',
               'text-white bg-purple-900 hover:bg-purple-800' => request()->routeIs('events.index'),
               'text-black bg-gray-200 hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600' => !request()->routeIs('events.index'),
           ])>
            All Events
        </a>
        <a href="{{ route('launchevent') }}"
           @class([
               'px-4 py-2 text-sm font-semibold rounded-md',
               'text-white bg-purple-900 hover:bg-purple-800' => request()->routeIs('launchevent'),
               'text-black bg-gray-200 hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600' => !request()->routeIs('launchevent'),
           ])>
            Launch an Event
        </a>
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}"
                   @class([
                       'px-4 py-2 text-sm font-semibold rounded-md',
                       'text-white bg-purple-900 hover:bg-purple-800' => request()->routeIs('dashboard'),
                       'text-black bg-gray-200 hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600' => !request()->routeIs('dashboard'),
                   ])>
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   @class([
                       'px-4 py-2 text-sm font-semibold rounded-md',
                       'text-white bg-purple-900 hover:bg-purple-800' => request()->routeIs('login'),
                       'text-black bg-gray-200 hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600' => !request()->routeIs('login'),
                   ])>
                    Log in
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       @class([
                           'px-4 py-2 text-sm font-semibold rounded-md',
                           'text-white bg-purple-900 hover:bg-purple-800' => request()->routeIs('register'),
                           'text-black bg-gray-200 hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600' => !request()->routeIs('register'),
                       ])>
                        Register
                    </a>
                @endif
            @endauth
        @endif
        <button
            class="px-4 py-2 text-sm font-semibold text-white bg-gray-800 rounded-md hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                <path
                    d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.623-5.479 5.922.43.371.823 1.102.823 2.222v3.293c0 .319.192.694.801.577 4.768-1.589 8.204-6.085 8.204-11.384 0-6.627-5.373-12-12-12z" />
            </svg>
        </button>
    </nav>
</header>

    <main class="pt-20 pb-8 px-4 bg-white dark:bg-black">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-5xl font-extrabold text-purple-900 dark:text-purple-400 mb-4">All Events</h1>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($events as $event)
    <div class="bg-white shadow-md rounded-lg p-4 dark:bg-gray-800">
    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="w-full h-48 object-cover">
        <h2 class="text-xl font-bold text-purple-900 dark:text-purple-400">{{ $event->name }}</h2>
        <p class="text-gray-700 dark:text-gray-300">{{ Str::limit($event->description, 100) }}</p>
        <a href="{{ route('events.show', $event->id) }}"
           class="mt-4 inline-block px-4 py-2 text-sm font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800">
            Read More
        </a>
    </div>
    @endforeach
</div>

            
        </div>
    </main>
</body>

</html>
