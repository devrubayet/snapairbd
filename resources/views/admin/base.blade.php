<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $settings->site_name ?? config('app.name'))</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin-end/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-end/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin-end/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-end/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-end/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-end/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admin-end/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin-end/assets/favicon_io/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin-end/assests/favicon_io/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin-end/assets/favicon_io/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('admin-end/assets/favicon_io/site.webmanifest') }}">
    <style>
        .fl-wrapper {
            top: 70px !important;
            /* navbar height onujayi adjust koro */
            right: 20px;
            /* optional: right offset */
            z-index: 1050;
            /* navbar er upore thakbe */
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->

        @include('admin.components.sidenav')
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.components.topnav')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- partial:partials/_footer.html -->
                @include('admin.components.footer')
                <!-- partial -->
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('admin-end/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('admin-end/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin-end/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('admin-end/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('admin-end/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin-end/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin-end/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin-end/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin-end/assets/js/misc.js') }}"></script>
    <script src="{{ asset('admin-end/assets/js/settings.js') }}"></script>
    <script src="{{ asset('admin-end/assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('admin-end/assets/js/dashboard.js') }}"></script>
   
        <script>
            // Clear button show/hide
    input.addEventListener('input', () => {
        clearBtn.style.display = input.value.length ? 'block' : 'none';
    });

    // Clear input on click
    clearBtn.addEventListener('click', () => {
        input.value = '';
        clearBtn.style.display = 'none';
        input.focus();
    });
        document.querySelectorAll('.btn-delete').forEach(function(button) {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        let form = this.closest('.delete-form');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // form submit হবে
            }
        });
    });
});

    </script>

    <!-- End custom js for this page -->
</body>

</html>
