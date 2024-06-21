<!-- resources/views/eventdetail.blade.php -->
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
        }
        .star {
            cursor: pointer;
            transition: color 0.2s;
        }
        .star:hover {
            color: #fbbf24;
        }
        .star.selected {
            color: #fbbf24;
        }
        /* Custom background color */
        .custom-bg {
            background-color: #2d2f3b;
        }
        /* Custom comment style */
        .comment-box {
            background-color: #edf2f7;
        }
    </style>
</head>

<body class=" font-sans antialiased dark:bg-black dark:text-white/50 custom-bg">
    <header class="fixed top-0 left-0 right-0 z-10 flex items-center justify-between p-5 bg-gray-50 shadow-lg dark:bg-neutral-800">
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
                       class="px-4 py-2 text-sm font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800 dark:bg-purple-500 dark:hover:bg-purple-400">
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
        </nav>
    </header>

    <main class="pt-20 pb-8 px-4 bg-white dark:bg-black">
        <div class="max-w-7xl mx-auto">
            <div class="bg-gray-100 dark:bg-neutral-800 p-6 rounded-lg shadow-md mb-8">
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="w-full h-64 object-cover rounded-md mb-4">
                <h1 class="text-5xl font-extrabold text-purple-900 dark:text-purple-400 mb-4">{{ $event->title }}</h1>
                <p class="text-xl text-gray-700 dark:text-gray-300 mb-4">{{ $event->description }}</p>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-4"><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-4"><strong>Location:</strong> {{ $event->location }}</p>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-4"><strong>Created by:</strong> {{ $event->user->name }}</p>
            </div>

            <!-- Rating Section -->
            <div class="bg-gray-100 dark:bg-neutral-800 p-6 rounded-lg shadow-md mb-8">
                <h2 class="text-2xl font-bold text-purple-900 dark:text-purple-400 mb-4">Rate this Event</h2>
                <form method="POST" action="{{ route('events.rating', $event->id) }}" class="mb-4">
                    @csrf
                    <div class="flex items-center mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-8 h-8 star @if($userRating && $userRating->rating >= $i) selected @endif" data-value="{{ $i }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 2.5l3.09 6.26L22 9.76l-5 4.87 1.18 6.88L12 17.75 5.82 21.5 7 14.62 2 9.76l6.91-1L12 2.5z"></path>
                            </svg>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating-value" value="{{ $userRating ? $userRating->rating : 0 }}">
                    <button type="submit" class="px-4 py-2 font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800">
                        Submit Rating
                    </button>
                </form>
                @if ($userRating)
                    <p class="text-lg text-gray-700 dark:text-gray-300 mt-4">Your current rating: {{ $userRating->rating }}</p>
                @endif
            </div>

            <!-- Comments Section -->
            <div class="bg-gray-100 dark:bg-neutral-800 p-6 rounded-lg shadow-md mb-8">
                <h2 class="text-2xl font-bold text-purple-900 dark:text-purple-400 mb-4">Comments</h2>
                <form method="POST" action="{{ route('events.comment', $event->id) }}" class="mb-4">
                    @csrf
                    <textarea name="comment" rows="3" class="w-full bg-gray-200 dark:bg-neutral-700 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-purple-600" placeholder="Add your comment"></textarea>
                    <button type="submit" class="px-4 py-2 font-semibold text-white bg-purple-900 rounded-md hover:bg-purple-800 mt-2">Post Comment</button>
                </form>
                @foreach ($event->comments as $comment)
                    <div class="comment-box rounded-md p-4 mb-2">
                        <p class="text-lg text-gray-800 dark:text-gray-200">{{ $comment->comment }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Posted by: {{ $comment->user->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <script>
        document.querySelectorAll('.star').forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                document.getElementById('rating-value').value = value;
                document.querySelectorAll('.star').forEach(s => s.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
    </script>
</body>
</html>
