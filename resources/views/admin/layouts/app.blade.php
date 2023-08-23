<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.layouts.partials.head')
    @stack('style')
    <style media="screen">
        form label {
            display: inline-block;
            width: 100%;
        }

        form div {
            margin-bottom: 10px;
        }

        .error {
            color: red;
            margin-left: 5px;
        }

        label.error {
            display: inline;
        }

        @media (max-width: 991px) {
            .sidebar {
                z-index: 999;
                margin-left: -175px;
                visibility: inherit;
            }

            .main-wrapper .page-wrapper {
                margin-left: 70px !important;
                width: 80% !important;
            }
        }

        .select2-container {
            width: 100% !important;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #ffc800 !important;
            border-color: #ffc800 !important;
        }

        .btn-primary.disabled,
        .swal2-modal .swal2-actions button.disabled.swal2-confirm,
        .wizard>.actions a.disabled,
        .btn-primary:disabled,
        .swal2-modal .swal2-actions button.swal2-confirm:disabled,
        .wizard>.actions a:disabled {
            color: #fff;
            background-color: #ffc800;
            border-color: #ffc800;
        }

        .btn-primary {
            color: #000000;
            background-color: #ffc800;
            border-color: #ffc800;
        }

        .btn-primary:hover {
            color: #000000;
            background-color: #ffc800;
            border-color: #ffc800;
        }

        .btn-primary:not(:disabled):not(.disabled):active {
            color: #000000;
            background-color: #ffc800;
            border-color: #ffc800;
        }

        .fs-4 {
            font-size: calc(1.275rem + .3vw) !important;
        }

        .fs-5 {
            font-size: 1.25rem !important;
        }

        @media only screen and (max-width: 767px) {
            .dataTables_wrapper.dt-bootstrap4 .dataTables_filter {
                text-align: left;
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="sidebar-dark">
    @php
        $balance=0;
        $balance = auth()->user()->wallet()->first() ? auth()->user()->wallet()->first()->balance : 0.00;
    @endphp
    <div class="main-wrapper">
        @include('admin.layouts.partials.sidebar')
        <div class="page-wrapper">
            @include('admin.layouts.partials.navbar',['balance',$balance])
            @yield('content')
            @include('admin.layouts.partials.footer')
        </div>
    </div>
    @include('admin.layouts.partials.footer-scripts')
    @include('admin.includes.scripts')



    @stack('scripts')
</body>

</html>
