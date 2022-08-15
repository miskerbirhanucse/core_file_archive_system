<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CORE_DRAMS</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('backend/asset/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/asset/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('backend/asset/vendors/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/asset/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/asset/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/asset/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('backend/asset/css/style.css')}}">
    <!-- End layout styles -->

    <link href="{{ asset('landing/asset/img/favicon3.png')}}" rel="icon">

    <!-- link bootstrap -->

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('layouts.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('layouts.top_header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @include('layouts.flash_message')

                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer bg-secondary">
                    <div class="d-sm-flex justify-content-center  justify-content-sm-between">
                        <span class="text-dark text-center text-sm-left d-block d-sm-inline-block"> © 2022 Core Consulting Engineers. All rights reserved.</span>

                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('backend/asset/vendors/js/vendor.bundle.base.js')}}">
    </script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('backend/asset/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('backend/asset/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{asset('backend/asset/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{asset('backend/asset/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('backend/asset/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('backend/asset/js/off-canvas.js')}}"></script>
    <script src="{{asset('backend/asset/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('backend/asset/js/misc.js')}}"></script>
    <script src="{{asset('backend/asset/js/settings.js')}}"></script>
    <script src="{{asset('backend/asset/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('backend/asset/js/dashboard.js')}}"></script>
    <!-- End custom js for this page -->
</body>

</html>