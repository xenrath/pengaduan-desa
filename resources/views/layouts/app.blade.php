<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.partials.link')
</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">
        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')

        <div class="main-content">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <h6 class="px-4 py-3 mt-2 bg-light">Notifications</h6>
            <div class="p-2" id="container-notification">
                @foreach ($user as $u)
                    <a href="{{ route('user.index') }}" class="text-reset notification-item">
                        <div class="media">
                            <div class="media-body overflow-hidden">
                                <h6 class="mt-0 mb-1">{{ $u->name }}</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-0 text-truncate">
                                        Have been registered but unactivated
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.partials.script')
</body>

</html>
