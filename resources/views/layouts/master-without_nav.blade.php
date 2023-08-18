<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8" />
            <title> @yield('title') | Nonskin - Admin & Dashboard</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta content="Premium Multipurpose Admin & Dashboard" name="description" />
            <meta content="Nonskin" name="author" />
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <link rel="shortcut icon" href="{{ URL::asset('assets/images/nonskin/non-logo.jpg') }}">
            @include('layouts.head-css')
        </head>

    @section('body')
        @include('layouts.body')
    @show
        @yield('content')
        @include('layouts.vendor-scripts')
    </body>
</html>
