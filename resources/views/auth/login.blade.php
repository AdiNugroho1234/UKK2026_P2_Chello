<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | Chelloxiiweb</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
</head>

<body>

    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">

                <!-- LEFT LOGIN -->
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">

                                <!-- LOGO -->
                                <div class="mb-4 text-center">
                                    <a href="/" class="auth-logo">
                                        <img src="{{ asset('assets/images/logo-sm.svg') }}" height="28">
                                        <span class="logo-txt">Chelloxiiweb</span>
                                    </a>
                                </div>

                                <!-- CONTENT -->
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5>Welcome Back !</h5>
                                        <p class="text-muted">Login ke sistem parkir</p>
                                    </div>

                                    <!-- FORM LOGIN -->
                                    <form method="POST" action="{{ route('login') }}" class="mt-4">
                                        @csrf

                                        <!-- EMAIL -->
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email"
                                                name="email"
                                                class="form-control"
                                                value="{{ old('email') }}"
                                                required autofocus>

                                            @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- PASSWORD -->
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <label>Password</label>
                                                <a href="#" class="text-muted">Forgot?</a>
                                            </div>

                                            <div class="input-group">
                                                <input type="password"
                                                    name="password"
                                                    class="form-control"
                                                    required>

                                                <button class="btn btn-light" type="button">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>
                                            </div>

                                            @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- REMEMBER -->
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" name="remember" class="form-check-input">
                                                <label class="form-check-label">Remember me</label>
                                            </div>
                                        </div>

                                        <!-- BUTTON -->
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100">
                                                Login
                                            </button>
                                        </div>

                                    </form>

                                    <!-- REGISTER -->
                                    <div class="mt-4 text-center">
                                        <p class="text-muted">
                                            Belum punya akun?
                                            <a href="{{ route('register') }}" class="text-primary fw-semibold">
                                                Daftar
                                            </a>
                                        </p>
                                    </div>
                                </div>

                                <!-- FOOTER -->
                                <div class="mt-4 text-center">
                                    <p class="mb-0">
                                        © {{ date('Y') }} Chelloxiiweb
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE (ANIMASI / BANNER) -->
                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay bg-primary"></div>

                        <!-- efek bubble -->
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>

                        <div class="d-flex justify-content-center align-items-center w-100 text-white">
                            <div class="text-center">
                                <h2 class="fw-bold">Sistem Parkir Digital</h2>
                                <p>Kelola kendaraan masuk, keluar, dan pembayaran dengan mudah 🚗</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pace-js/pace.min.js') }}"></script>

</body>

</html>