<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>

    {{-- Partials Style --}}
    @include('partials.style')
</head>

<body>
    <div id="app">
        @include('sweetalert::alert')
        <div class="main-wrapper">

            {{-- Header --}}
            @include('backend.layouts.header')

            {{-- Side Navigation --}}
            @include('backend.layouts.nav')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>{{ $title }}</h1>
                        <div class="section-header-breadcrumb">
                            {!! $sub_title !!}
                        </div>
                    </div>

                    {{-- Yield Content --}}
                    <div class="row">
                        @yield('content')
                    </div>
                </section>
            </div>

            {{-- Footer --}}
            @include('backend.layouts.footer')
        </div>
  </div>

  {{-- Partials Script --}}
  @include('partials.script')
</body>
</html>
