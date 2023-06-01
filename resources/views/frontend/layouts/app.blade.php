<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{env('APP_NAME')}}</title>
    {{-- Style --}}
    @include('partials.style')
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
                {{-- Header --}}
                @include('frontend.layouts.header')

                {{-- Navigation --}}
                @include('frontend.layouts.nav')

                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-body">
                            @yield('content')
                        </div>
                    </section>
                </div>
            {{-- Footer --}}
            @include('frontend.layouts.footer')
        </div>
    </div>
    {{-- Scripts --}}
    @include('partials.script')
</body>
</html>
