<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/prismjs-themes/prism.css') }}">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.2.1/dist/alpine.js" defer></script>
    </head>
    <body class="my-auto mx-auto">
        <div class="min-h-screen bg-gray-100" id="app">
            <main>
                <div class="py-12">
                    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
        <script>
            window.Auth = {!! json_encode([
                'signedIn' => Auth::check(),
                'user' => Auth::user()
            ]) !!}
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
