<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>teste Api</title>
    <link rel="stylesheet" href="{{asset('site/bootstrap.css')}}">
</head>
<body class="container">
    <main class="py-4">
        @yield('content')
    </main>
    <script src="{{asset('site/jquery.js')}}"></script>
    <script src="{{asset('site/bootstrap.js')}}"></script>
</body>
</html>
