<!doctype html>

<head>
    <title>My Blog</title>

    <link rel='stylesheet' href="/app.css">
</head>

<body>
    {{-- first approach to create blade layout --}}


    {{-- @yield('key') --}}
    {{-- any of the content of the views I want to be yield(display) it right here --}}
    @yield('content')

</body>