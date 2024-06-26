<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="resources/css/app.css">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        /* Base styles */
        body {
            font-family: 'figtree', sans-serif;
            background-color: #f3f4f6; /* Light gray background */
        }
        .navbar {
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
            max-width: 899px;
            margin: 0 auto;
            padding: 20px;
            padding-top: 100px
        }

        .card {
            background-color: #ffffff; /* White card background */
            border-radius: 5px;
            overflow: hidden;
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: auto;
            margin-bottom: 15px;
        }

        .card .content {
            padding: 10px;
        }

        .card h3 {
            margin-top: 0;
            font-size: 1.25rem;
            font-weight: bold;
            color: #333333; /* Dark gray text */
        }

        .card p {
            color: #666666;
            line-height: 1.5;
        }

        .card .category {
            display: inline-block;
            background-color: #4b6bfb1a; /* Light gray background */
            color: #4B6BFB; /* Dark gray text */
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 0.875rem;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .created-at {
            font-size: 0.875rem;
            color: #999999;
            margin-top: 10px;
        }

        /* Responsive grid */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        /* Centered text */
        .text-center {
            text-align: center;
        }

        /* Dark mode */
        .dark-mode {
            background-color: #1a202c; /* Dark gray background */
            color: #ffffff; /* White text */
        }

        /* Selection color */
        ::selection {
            background-color: #f56565; /* Red selection background */
            color: #ffffff; /* White text */
        }

        hr {
            border: 2px solid;
        }

        .jumbotron {
            position: relative;
            padding: 0;
            margin-bottom: 2rem;
            background-color: white;
            text-align: center;
            overflow: hidden;
            transition: transform 0.6s ease;
        }

        .jumbotron:hover {
            transform: scale(1.05);
        }

        .jumbotron img {
            width: 100%;
            height: 27rem;
            border-radius: 10px;
        }

        .jumbotron .overlay {
            transition: transform 0.3s ease;
            position: absolute;
            bottom: 15px;
            left: 15px;
            background: white; /* Black overlay with opacity */
            padding: 15px;
            border-radius: 10px;
            text-align: left;
            color: black;
            max-width: 400px;
        }

        .jumbotron .overlay:hover {
            transform: scale(1.05);
        }

        .jumbotron .overlay h1 {
            font-size: 30px;
            font-weight: 500;
        }

        .jumbotron .overlay p {
            font-size: 1rem;
        }

        .jumbotron .overlay .category {
            display: inline-block;
            background-color: #4B6BFB; /* Light gray background */
            color: white; /* Dark gray text */
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .latest-post{
            font-size: 23px;
            font-weight: bold;
        }

        .pagination {
            display: flex;
            justify-content: center;
        }

    </style>
</head>
<body class="antialiased" style="background-color: white;  ">
    <div class="relative min-h-screen bg-gray-100 bg-center sm:flex sm:justify-center sm:items-center bg-dots-darker dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <nav class="navbar navbar-expand-lg" id="mainNavbar">
                <a class="navbar-brand" href="#">
                    <img src="/assets/Union.png" alt="Logo">
                </a>
                <div class="title-brand"><h3>Meta <Span style="font-weight: bold">Blog</Span></h3></div>

            <div class="mx-auto navbar-nav">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
                <a class="nav-link" href="#">Blog</a>
                <a class="nav-link" href="#">Team</a>
            </div>
            <div class="navbar-right">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-secondary">Sign in</a>
                    @endif
                @endif
            </div>
        </nav>
        <div class="container">
            <!-- Jumbotron -->
            @if($todos->count() > 0)
                <div class="jumbotron">
                    <a href="{{ route('artikel.show', $todos[0]->id) }}">
                        @if ($todos[0]->image_path)
                            <img src="{{ $todos[0]->getImage() }}" alt="{{ $todos[0]->title }}">
                        @endif
                        <div class="overlay">
                            @if ($todos[0]->category)
                            <p class="category">{{ $todos[0]->category->title }}</p>
                        @endif
                            <h1>{{ $todos[0]->title }}</h1>
                            <p class="created-at">{{ $todos[0]->created_at->format('M d, Y') }}</p>
                        </div>
                    </a>
                </div>
            @endif
            <div class="latest-post"><p>Latest Post</p></div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3">
                @foreach ($todos->slice(0) as $todo)
                <div class="card">
                    <a href="{{ route('artikel.show', $todo->id) }}">
                        <div class="content">
                            @if ($todo->image_path)
                            <img src="{{ $todo->getImage() }}" alt="{{ $todo->title }}" class="w-full h-auto rounded-lg">
                            @endif
                            @if ($todo->category)
                            <p class="category">{{ $todo->category->title }}</p>
                            @endif
                            <h3 class="mb-2 text-lg font-semibold">{{ $todo->title }}</h3>
                            <p class="created-at">{{ $todo->created_at->format('M d, Y') }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <!-- Pagination links -->
            <div class="mt-4 pagination">
                {{ $todos->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <!-- Scripts -->
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
