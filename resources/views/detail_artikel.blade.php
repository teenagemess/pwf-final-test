<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo Detail</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* Base styles */
        body {
            font-family: 'figtree', sans-serif;
            background-color: #f3f4f6; /* Light gray background */
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
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
    </style>
</head>
<body class="antialiased">
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
    </div>
</body>
</html>
