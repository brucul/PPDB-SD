<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{-- Style --}}
    @include('partials.style')
</head>

<body>
    <div id="app">
        @yield('content')
    </div>
    {{-- Scripts --}}
    @include('partials.script')
</body>
</html>