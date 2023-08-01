<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <title> @yield('title') | Nonskin - Admin & Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Nonskin Admin & Dashboard" name="description" />
        <meta content="Nonskin" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ URL::asset('assets/images/nonskin/non-logo.jpg') }}">
        @include('layouts.head-css')
    </head>

<body data-layout="vertical" data-sidebar="light">
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @include('layouts.sidebar')
        @include('layouts.horizontal')

            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
        <div hidden>@include('layouts.right-sidebar')</div>
        @include('layouts.vendor-scripts')
    </body>
</html>
