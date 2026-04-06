<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')

    <link rel="stylesheet" href="{{ asset('template/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/style.css') }}">

    @stack('style-page')
</head>

<body>

    <div class="container-scroller">

        @include('layouts.navbar')

        <div class="container-fluid page-body-wrapper">

            @include('layouts.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">

                    @yield('content')

                </div>

                @include('layouts.footer')

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('template/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('template/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('template/assets/js/misc.js') }}"></script>
    <script src="{{ asset('template/assets/js/dashboard.js') }}"></script>

    @stack('js-page')

    @yield('scripts')

</body>

</html>