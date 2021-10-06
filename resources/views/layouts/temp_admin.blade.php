@php
    $setting = App\Models\TbSetting::first();
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('storage/setting/'.$setting->setting_iconWeb) }}" type ="image/x-icon">
    <title>{{ $setting->setting_nameWeb }}</title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/css/paper-dashboard.css') }}" rel="stylesheet" />

    {{-- custom --}}
    <link href="{{ asset('assets/backend/css/custom.css?v=3') }}" rel="stylesheet" />

    @yield('css')

</head>
<body @yield('bodyeditor')>
    <div class="wrapper">
        @include('layouts.admin._temp.sidebar')

        <div class="main-panel">
            @include('layouts.admin._temp.navbar')
            <div class="content">
                @yield('content')
            </div>
            @include('layouts.admin._temp.footer')
        </div>
    </div>


    <!--   Core JS Files   -->
    <script src="{{ asset('assets/backend/js/core/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/backend/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/backend/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/backend/js/plugins/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/backend/js/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/backend/js/paper-dashboard.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/backend/js/plugins/bootstrap-selectpicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/backend/js/plugins/bootstrap-datetimepicker.js') }}"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="{{ asset('assets/backend/js/plugins/bootstrap-switch.js') }}"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    {{-- custom js --}}
    <script src="{{ asset('assets/backend/js/custom.js?v=2') }}"></script>

    @yield('js')

    @if(session('feedback'))
        <script>

            Swal.fire({
                title: "{{ session('feedback') }}",
                text: '',
                icon: 'success',
                confirmButtonText: 'ตกลง',
                timer: 2000
            })

        </script>
    @endif

</body>
</html>
