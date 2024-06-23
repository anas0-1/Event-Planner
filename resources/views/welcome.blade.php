<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>EventPlanner</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'figtree', sans-serif;
            background-color: #e8e0da ;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<header class="fixed top-0 left-0 right-0 z-10 flex items-center justify-between p-5 bg-[#e6ddd6] shadow-lg dark:bg-neutral-800">
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
        <a href="https://github.com/anas0-1/event-planner" target="_blank" rel="noopener noreferrer"
                class="px-4 py-2 text-sm font-semibold text-white bg-gray-800 rounded-md hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                    <path
                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.623-5.479 5.922.43.371.823 1.102.823 2.222v3.293c0 .319.192.694.801.577 4.768-1.589 8.204-6.085 8.204-11.384 0-6.627-5.373-12-12-12z" />
                </svg>
            </a>
    </nav>
</header>

    <main class="pt-20 pb-8 px-4 bg-[#e8e0da] dark:bg-black">
        <div class="max-w-7xl mx-auto">
            <!-- Hero Section -->
            <div class="relative flex flex-col items-center justify-center text-center bg-cover bg-center py-20"
                style="background-image: url('background.png');">
                <h1 class="text-5xl font-extrabold text-purple-900 dark:text-purple-400 mb-4">Welcome to EventPlanner</h1>
                <p class="text-xl text-gray-700 dark:text-gray-300 mb-8">Your ultimate solution for scheduling and managing events effortlessly.</p>
                <a href="{{ route('register') }}"
                    class="px-8 py-3 text-lg font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800 dark:bg-purple-500 dark:hover:bg-purple-400">
                    Get Started
                </a>
            </div>

            <!-- Features Section -->
            <div class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex flex-col items-center text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-purple-900 mb-4" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 000 2h8a1 1 0 100-2H6zM3 5a1 1 0 011-1h12a1 1 0 011 1v1H3V5zM3 8h14v7a1 1 0 01-1 1h-3.293l-2.853 2.854a.5.5 0 01-.708 0L7.293 16H4a1 1 0 01-1-1V8zm7 1a1 1 0 110 2 1 1 0 010-2zm0 4a1 1 0 110 2 1 1 0 010-2z"
                            clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Easy Scheduling</h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-400">Effortlessly schedule and manage your events with our intuitive interface.</p>
                </div>
                <div class="flex flex-col items-center text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-purple-900 mb-4" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M2 5a2 2 0 012-2h12a2 2 0 012 2v7a2 2 0 01-2 2h-3.5l-2.5 3-2.5-3H4a2 2 0 01-2-2V5zm6 3a1 1 0 100-2 1 1 0 000 2z" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Reminders</h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-400">Never miss an event with timely reminders and notifications.</p>
                </div>
                <div class="flex flex-col items-center text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-purple-900 mb-4" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3-9a1 1 0 01-1 1H8a1 1 0 110-2h4a1 1 0 011 1z"
                            clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">24/7 Support</h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-400">Get round-the-clock support from our dedicated team.</p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
