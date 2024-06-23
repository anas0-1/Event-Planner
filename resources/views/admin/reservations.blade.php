<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Manage Reservations</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'figtree', sans-serif;
            background-color: #e8e0da ;
        }
        .table-container {
            overflow-x: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        .action-buttons form {
            display: inline;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50 custom-bg">
    <header class="fixed top-0 left-0 right-0 z-10 flex items-center justify-between p-5 bg-[#e6ddd6] shadow-lg dark:bg-neutral-800">
        <div class="flex items-center">
            <a href="#" class="text-3xl font-extrabold text-purple-900 dark:text-purple-400">E</a>
        </div>
        <nav class="flex items-center space-x-4">
            <a href="{{ route('welcome') }}" class="px-4 py-2 text-sm font-semibold text-black bg-gray-200 rounded-md hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600">
                Home
            </a>
            <a href="{{ route('events.index') }}" class="px-4 py-2 text-sm font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800">
                All Events
            </a>
            <a href="{{ route('launchevent') }}" class="px-4 py-2 text-sm font-semibold text-black bg-gray-200 rounded-md hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600">
                Launch an Event
            </a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800 dark:bg-purple-500 dark:hover:bg-purple-400">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-black bg-gray-200 rounded-md hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800 dark:bg-purple-500 dark:hover:bg-purple-400">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <main class="pt-20 pb-8 px-4 dark:bg-black">
        <div class="max-w-7xl mx-auto">
            <div class="bg-gray-100 dark:bg-neutral-800 p-6 rounded-lg shadow-md mb-8">
                <h1 class="text-3xl font-bold text-purple-900 dark:text-purple-400 mb-4">Manage Reservations</h1>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Event Name</th>
                                <th>Event Creator</th>
                                <th>Seats Reserved</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->user->name }}</td>
                                    <td>{{ $reservation->event->title }}</td>
                                    <td>{{ $reservation->event->user->name }}</td>
                                    <td>{{ $reservation->quantity }}</td>
                                    <td class="action-buttons">
                                        <form method="POST" action="{{ route('admin.reservations.delete', $reservation->id) }}">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if (session('success'))
                    <p class="text-green-500">{{ session('success') }}</p>
                @endif
                @if (session('error'))
                    <p class="text-red-500">{{ session('error') }}</p>
                @endif
            </div>
        </div>
    </main>
</body>
</html>
