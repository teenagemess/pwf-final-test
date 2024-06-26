<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo Detail</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        /* Base styles */
        body {
            font-family: 'figtree', sans-serif;
            background-color: white; /* Light gray background */
        }

        .rounded-circle {
            width: 30px;
            height: 30px;
            padding: 5px;
            border-radius: 50%;
            background-color: #6c757d; /* Sesuaikan dengan warna latar belakang atau tema */
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }

        .rounded-circle i {
            color: white; /* Sesuaikan dengan warna ikon */
        }

        .navbar {
            top: 0;
            background-color: transparent; /* Transparent navbar */
            padding: 15px 20px;
            border-bottom: none; /* No border */
            transition: background-color 0.3s ease; /* Smooth transition */
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        .navbar.navbar-scrolled {
            background-color: #ffffff; /* White background on scroll */
            border-bottom: 1px solid #e3e3e3; /* Light gray border bottom */
        }

        .navbar-brand img {
            height: 40px; /* Adjust height as needed */
            vertical-align: middle; /* Align vertically */
        }

        .title-brand {
            font-size: 20px;
            color: #333333; /* Dark gray text */
        }

        .navbar-nav {
            flex-grow: 1; /* Take remaining space */
            display: flex;
            justify-content: center; /* Center align navbar links */
            align-items: center; /* Vertical alignment */
        }

        .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
            color: #333333; /* Dark gray text */
        }

        .navbar-nav .nav-link:hover {
            color: #4B6BFB; /* Dark gray text on hover */
        }

        .navbar-right {
            margin-left: auto; /* Pushes buttons to the right */
            display: flex;
            align-items: center; /* Vertical alignment */
        }

        .navbar-right .btn {
            margin-left: 1rem;
        }

        .container {
            max-width: 800px;
            margin: 80px auto;
            padding: 20px;
            background-color: #ffffff; /* White card background */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container img {
            width: 100%;
            height: auto;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .content {
            padding: 20px;
        }

        .content h1 {
            margin-top: 0;
            font-size: 1.5rem;
            font-weight: bold;
            color: #333333; /* Dark gray text */
        }

        .content p {
            color: #666666;
            line-height: 1.5;
        }

        .category {
            color: #999999;
            font-size: 0.875rem;
        }

        /* Comments section */
        .comments-section {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        .comment {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .comment .author {
            font-weight: bold;
            color: #333333;
        }

        .comment .content {
            margin-top: 5px;
            color: #666666;
        }

        .comment .timestamp {
            font-size: 0.875rem;
            color: #999999;
        }

        .comment-form {
            margin-top: 20px;
        }

        .comment-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            min-height: 100px;
        }

        .comment-form button {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .comment-form button:hover {
            background-color: #0056b3;
        }

        .back-button {
            margin-top: 20px;
        }
    </style>
</head>
<body class="antialiased">
    @include('components.navbar')
    <div class="container">
        @if ($todo->image_path)
            <img src="{{ $todo->getImage() }}" alt="{{ $todo->title }}" class="rounded-lg">
        @endif
        <div class="content">
            <h1>{{ $todo->title }}</h1>
            <p>{!! $todo->description !!}</p>
            @if ($todo->category)
                <p class="category">Category: {{ $todo->category->title }}</p>
            @endif
        </div>

        <!-- Comments section -->
        <div class="comments-section">
            <h2>Comments</h2>

            <!-- Display comments -->
            @forelse ($todo->comments as $comment)
                <div class="comment">
                    <div class="author">{{ $comment->user->name }}</div>
                    <div class="timestamp">{{ $comment->created_at->diffForHumans() }}</div>
                    <div class="content">{{ $comment->content }}</div>
                </div>
            @empty
                <p>No comments yet.</p>
            @endforelse

            <!-- Comment form -->
            <div class="comment-form">
                <form action="{{ route('comment.store', $todo) }}" method="POST">
                    @csrf
                    <textarea name="content" placeholder="Add a comment..." required></textarea>
                    <button type="submit">Post Comment</button>
                </form>
            </div>
        </div>

        <!-- Back button -->
        <div class="back-button">
            <a href="javascript:history.back()" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Add scroll event listener to navbar
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll > 50) {
                $('#mainNavbar').addClass('navbar-scrolled');
            } else {
                $('#mainNavbar').removeClass('navbar-scrolled');
            }
        });
    </script>
</body>
</html>
