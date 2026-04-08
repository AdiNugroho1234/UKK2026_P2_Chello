<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard Parkir</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
</head>

<body data-sidebar="light">

    <div id="layout-wrapper">

        {{-- HEADER --}}
        @include('layouts.header')

           @include('layouts.navbar')


        {{-- MAIN CONTENT --}}
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    @yield('content')

                </div>
            </div>

            {{-- FOOTER --}}
            @include('layouts.footer')
        </div>

    </div>

    {{-- JS --}}
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>

    <script>
        feather.replace()
    </script>

    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>