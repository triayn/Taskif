<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts & CSS -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
                                <img src="{{ asset('assets/img/logo-long.png') }}" class="img-fluid p-4 ms-5" style="max-height: 400px;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                    </div>
                                    <form method="POST" action="{{ route('register') }}" class="user">
                                        @csrf

                                        <div class="form-group">
                                            <input id="name" type="text" name="name"
                                                class="form-control form-control-user @error('name') is-invalid @enderror"
                                                placeholder="Full Name" value="{{ old('name') }}" required autofocus>
                                            @error('name')
                                            <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input id="phone_number" type="text" name="phone_number"
                                                class="form-control form-control-user @error('phone_number') is-invalid @enderror"
                                                placeholder="Phone Number" value="{{ old('phone_number') }}" required>
                                            @error('phone_number')
                                            <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input id="email" type="email" name="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                placeholder="Email Address" value="{{ old('email') }}" required>
                                            @error('email')
                                            <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                            @enderror
                                        </div>

                                        <div class="form-group position-relative">
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                placeholder="Password" required>
                                            <span toggle="#password" class="fas fa-eye toggle-password position-absolute" style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;"></span>
                                            @error('password')
                                            <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                            @enderror
                                        </div>

                                        <div class="form-group position-relative">
                                            <input type="password" id="password-confirm" name="password_confirmation"
                                                class="form-control form-control-user"
                                                placeholder="Confirm Password" required>
                                            <span toggle="#password-confirm" class="fas fa-eye toggle-password position-absolute" style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;"></span>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Register Account
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End Nested Row -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Toggle Password Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".toggle-password").forEach(function (toggle) {
                toggle.addEventListener("click", function () {
                    const target = document.querySelector(this.getAttribute("toggle"));
                    const type = target.getAttribute("type") === "password" ? "text" : "password";
                    target.setAttribute("type", type);
                    this.classList.toggle("fa-eye");
                    this.classList.toggle("fa-eye-slash");
                });
            });
        });
    </script>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
</body>

</html>