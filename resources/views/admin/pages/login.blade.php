<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $site_infos->sitename ?? config('app.name'))</title>
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
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('admin-end/assests/favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('admin-end/assets/favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('admin-end/assets/favicon_io/site.webmanifest') }}">

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->


        <!-- partial -->


        <!-- partial:partials/_navbar.html -->
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                    

                                <!-- Login Form -->
                                <div id="loginForm" style="{{ $errors->register->any() ? 'display:none' : 'display:block' }}"">
                                    <h3 class="card-title text-left mb-3">Login</h3>

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label>Email *</label>
                                            <input type="email" class="form-control p_input" name="email">
                                        </div>

                                        <div class="form-group">
                                            <label>Password *</label>
                                            <input type="password" class="form-control p_input" name="password">
                                        </div>

                                        <div class="form-group d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="remember" class="form-check-input">
                                                    Remember me
                                                </label>
                                            </div>

                                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                                        </div>
                                        @if($errors->login->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->login->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

                                        <button class="btn btn-primary btn-block">Login</button>

                                        <p class="text-center mt-3">
                                            Don't have an account?
                                            <a href="#" id="showRegister">Register</a>
                                        </p>

                                    </form>
                                </div>

                                <!-- Register Form -->
                                <div id="registerForm"  style="{{ $errors->register->any() ? 'display:block' : 'display:none' }}">

                                    <h3 class="card-title text-left mb-3">Register</h3>

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label>Name *</label>
                                            <input id="name" class="form-control p_input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                                        </div>

                                        <div class="form-group">
                                            <label>Email *</label>
                                            <input id="email" class="form-control p_inputl" type="email" name="email" :value="old('email')" required autocomplete="username">
                                        </div>

                                        <div class="form-group">
                                            <label>Password *</label>
                                            <input id="password" class="form-control p_input"
                            type="password"
                            name="password"
                            required autocomplete="new-password">
                                        </div>

                                        <div class="form-group">
                                            <label>Confirm Password *</label>
                                            <input id="password_confirmation" class="form-control p_input"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password">
                                        </div>

                                        @if($errors->register->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->register->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
                                        <button class="btn btn-success btn-block">
                                            Register
                                        </button>

                                        <p class="text-center mt-3">
                                            Already have an account?
                                            <a href="#" id="showLogin">Login</a>
                                        </p>

                                    </form>

                                </div>

                            </div>
                        
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
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
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');

        document.getElementById('showRegister').addEventListener('click', function(e) {
            e.preventDefault();

            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
        });

        document.getElementById('showLogin').addEventListener('click', function(e) {
            e.preventDefault();

            registerForm.style.display = 'none';
            loginForm.style.display = 'block';
        });

        $("#showRegister").click(function(e){
    e.preventDefault();
    $("#loginForm").fadeOut(200,function(){
        $("#registerForm").fadeIn(200);
    });
});

$("#showLogin").click(function(e){
    e.preventDefault();
    $("#registerForm").fadeOut(200,function(){
        $("#loginForm").fadeIn(200);
    });
});

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
