<!DOCTYPE html>
<html lang="en">
@include('auth.include.login_head')
<body class="account-body accountbg">
<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content">
        <div class="container-fluid">
        @yield('content')
        <!-- container -->

        </div>
    </div>
    <!-- end page content -->
</div>
<!-- end page-wrapper -->

<!-- jQuery  -->
<script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/assets/js/metismenu.min.js') }}"></script>
<script src="{{ asset('public/assets/js/waves.js') }}"></script>
<script src="{{ asset('public/assets/js/feather.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery-ui.min.js') }}"></script>

<script src="{{ asset('public/assets/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('public/assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('public/assets/plugins/flot-chart/jquery.canvaswrapper.js') }}"></script>
<script src="{{ asset('public/assets/plugins/flot-chart/jquery.colorhelpers.js') }}"></script>
<script src="{{ asset('public/assets/plugins/flot-chart/jquery.flot.js') }}"></script>
<script src="{{ asset('public/assets/plugins/flot-chart/jquery.flot.saturated.js') }}"></script>
<script src="{{ asset('public/assets/plugins/flot-chart/jquery.flot.browser.js') }}"></script>
<script src="{{ asset('public/assets/plugins/flot-chart/jquery.flot.drawSeries.js') }}"></script>
<script src="{{ asset('public/assets/plugins/flot-chart/jquery.flot.uiConstants.js') }}"></script>
<script src="{{ asset('public/assets/plugins/flot-chart/jquery.flot-dataType.js') }}"></script>
<script src="{{ asset('public/assets/pages/jquery.crm_dashboard.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('public/assets/js/app.js') }}"></script>
</body>
</html>