<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Event Details</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'figtree', sans-serif;
            background-color: #e8e0da;
        }

        .star {
            cursor: pointer;
            transition: color 0.2s;
        }

        .star:hover,
        .star.selected {
            color: #fbbf24;
        }

        /* Custom comment style */
        .comment-box {
            background-color: #edf2f7;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50 custom-bg">
    <header
        class="fixed top-0 left-0 right-0 z-10 flex items-center justify-between p-5 bg-[#e6ddd6] shadow-lg dark:bg-neutral-800">
        <div class="flex items-center">
            <a href="#" class="text-3xl font-extrabold text-purple-900 dark:text-purple-400">E</a>
        </div>
        <nav class="flex items-center space-x-4">
            <a href="{{ route('welcome') }}"
                class="px-4 py-2 text-sm font-semibold text-black bg-gray-200 rounded-md hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600">
                Home
            </a>
            <a href="{{ route('events.index') }}"
                class="px-4 py-2 text-sm font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800">
                All Events
            </a>
            <a href="{{ route('launchevent') }}"
                class="px-4 py-2 text-sm font-semibold text-black bg-gray-200 rounded-md hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600">
                Launch an Event
            </a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-4 py-2 text-sm font-semibold text-black bg-gray-200 rounded-md hover:bg-purple-800 dark:bg-purple-500 dark:hover:bg-purple-400">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-semibold text-black bg-gray-200 rounded-md hover:bg-gray-300 dark:text-white dark:bg-neutral-700 dark:hover:bg-neutral-600">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 text-sm font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800 dark:bg-purple-500 dark:hover:bg-purple-400">
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

    <main class="pt-20 pb-8 px-4 dark:bg-black">
        <div class="max-w-7xl mx-auto">
            <div class="bg-gray-100 dark:bg-neutral-800 p-6 rounded-lg shadow-md mb-8">
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}"
                    class="w-full h-64 object-cover rounded-md mb-4">
                <h1 class="text-5xl font-extrabold text-purple-900 dark:text-purple-400 mb-4">{{ $event->title }}</h1>
                <p class="text-xl text-gray-700 dark:text-gray-300 mb-4">{{ $event->description }}</p>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-4"><strong>Date:</strong>
                    {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-4"><strong>Location:</strong>
                    {{ $event->location }}
                </p>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-4"><strong>Created by:</strong>
                    {{ $event->user->name }}
                </p>
            </div>

            <!-- Rating Section -->
            <div class="bg-gray-100 dark:bg-neutral-800 p-6 rounded-lg shadow-md mb-8">
                <h2 class="text-2xl font-bold text-purple-900 dark:text-purple-400 mb-4">Rate this Event</h2>
                <form method="POST" action="{{ route('events.rating', $event->id) }}" class="mb-4">
                    @csrf
                    <div class="flex items-center mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-8 h-8 star @if($userRating && $userRating->rating >= $i) selected @endif"
                                data-value="{{ $i }}" fill="currentColor" viewBox="0 0 24 24" stroke="none">
                                <path
                                    d="M12 2.5l3.09 6.26L22 9.76l-5 4.87 1.18 6.88L12 17.75 5.82 21.5 7 14.62 2 9.76l6.91-1L12 2.5z">
                                </path>
                            </svg>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating-value"
                        value="{{ $userRating ? $userRating->rating : 0 }}">
                    <button type="submit"
                        class="px-4 py-2 font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800">
                        Submit Rating
                    </button>
                </form>
                @if ($userRating)
                    <p class="text-lg text-gray-700 dark:text-gray-300 mt-4">Your current rating:
                        {{ $userRating->rating }}
                    </p>
                @endif
            </div>
            <div class="bg-gray-100 dark:bg-neutral-800 p-6 rounded-lg shadow-md mb-8">
                <!-- Reservation Section -->
                <div class="bg-gray-100 dark:bg-neutral-800 p-6 rounded-lg shadow-md mb-8">
                    <h2 class="text-2xl font-bold text-purple-900 dark:text-purple-400 mb-4">Reserve Seats</h2>
                    @php
                        $userReservation = $event->reservations->where('user_id', auth()->id())->first();
                    @endphp
                    @if ($userReservation)
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-4">You have reserved
                            {{ $userReservation->quantity }} seats.</p>
                        <form method="POST" action="{{ route('events.reserve', $event->id) }}" class="mb-4">
                            @csrf
                            <label for="quantity" class="block mb-2 font-semibold">Update Number of Seats:</label>
                            <input type="number" id="quantity" name="quantity"
                                class="w-full bg-gray-200 dark:bg-neutral-700 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                min="1" value="{{ $userReservation->quantity }}">
                            <button type="submit"
                                class="px-4 py-2 font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800 mt-2">Update
                                Reservation</button>
                        </form>
                        <form method="POST" action="{{ route('events.deleteReservation', $event->id) }}" class="mb-4">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 font-semibold text-white bg-red-600 rounded-md hover:bg-red-500 mt-2">Delete
                                Reservation</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('events.reserve', $event->id) }}" class="mb-4">
                            @csrf
                            <label for="quantity" class="block mb-2 font-semibold">Number of Seats:</label>
                            <input type="number" id="quantity" name="quantity"
                                class="w-full bg-gray-200 dark:bg-neutral-700 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                                min="1" value="1">
                            <button type="submit"
                                class="px-4 py-2 font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800 mt-2">Reserve
                                Seats</button>
                        </form>
                    @endif
                    @if (session('success'))
                        <p class="text-green-500">{{ session('success') }}</p>
                    @endif
                    @if (session('error'))
                        <p class="text-red-500">{{ session('error') }}</p>
                    @endif
                </div>

                <!-- Comments Section -->
                <div class="bg-gray-100 dark:bg-neutral-800 p-6 rounded-lg shadow-md mb-8">
                    <h2 class="text-2xl font-bold text-purple-900 dark:text-purple-400 mb-4">Comments</h2>
                    <form method="POST" action="{{ route('events.comment', $event->id) }}" class="mb-4">
                        @csrf
                        <textarea name="comment" rows="3"
                            class="w-full bg-gray-200 dark:bg-neutral-700 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-purple-600"
                            placeholder="Add your comment"></textarea>
                        <button type="submit"
                            class="px-4 py-2 font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800 mt-2">Post
                            Comment</button>
                    </form>
                    @foreach ($event->comments as $comment)
                        <div class="comment-box rounded-md p-4 mb-2">
                            <p class="text-lg text-gray-800 dark:text-gray-200">{{ $comment->comment }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Posted by: {{ $comment->user->name }}</p>
                            @if ($comment->user_id == auth()->id())
                                <form method="POST" action="{{ route('comments.delete', $comment->id) }}" class="mt-2">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete Comment</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                    @if (session('success'))
                        <p class="text-green-500">{{ session('success') }}</p>
                    @endif
                    @if (session('error'))
                        <p class="text-red-500">{{ session('error') }}</p>
                    @endif
                </div>

    </main>

    <script>
        document.querySelectorAll('.star').forEach(star => {
            star.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                document.getElementById('rating-value').value = value;
                document.querySelectorAll('.star').forEach(s => s.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
    </script>
</body>

</html>