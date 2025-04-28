<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('./assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/compiled/css/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">

    <style>
        .form-check {
            width: 18%; 
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .form-check {
                width: 45%; 
            }
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            max-width: 400px;
            width: 100%;
        }

        .input-group {
            position: relative;
        }

        .input-group .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .input-group input {
            padding-right: 30px; /* Make space for the icon */
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="card">
            <div class="card-header text-center">
                <h4>Login</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                            <i class="bi bi-person-fill input-group-text"></i> <!-- Icon -->
                        </div>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" class="form-control" name="password" required placeholder="Enter your password">
                            <i class="bi bi-eye-fill eye-icon" onclick="togglePasswordVisibility()"></i> <!-- Eye Icon -->
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if(Session::get('login_attempts') > 0)
                        <div class="text-center text-danger mb-2">
                            <strong>Attempts left: {{ 3 - Session::get('login_attempts') }}</strong>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <div>
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember" class="form-label">Remember Me</label>
                        </div>
                        <div>
                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        // Toggle password visibility
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var eyeIcon = document.querySelector('.eye-icon');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove('bi-eye-fill');
                eyeIcon.classList.add('bi-eye-slash-fill');
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove('bi-eye-slash-fill');
                eyeIcon.classList.add('bi-eye-fill');
            }
        }

        // Toast notifications
        @if (session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 5000
            });
        @elseif (session('warning'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'warning',
                title: '{{ session('warning') }}',
                showConfirmButton: false,
                timer: 5000
            });
        @elseif (session('info'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'info',
                title: '{{ session('info') }}',
                showConfirmButton: false,
                timer: 5000
            });
        @elseif (session('error'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    </script>
</body>
</html>
