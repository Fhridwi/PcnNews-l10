<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenNews - Latest Updates</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    @include('frontend.layouts.navbar')

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4 mb-md-0">
                    <h4 class="footer-title">GreenNews</h4>
                    <p>Delivering accurate and timely news from around the world with a focus on environmental sustainability and positive change.</p>
                    <div class="mt-3">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h4 class="footer-title">Quick Links</h4>
                    <a href="#" class="footer-link">About Us</a>
                    <a href="#" class="footer-link">Contact</a>
                    <a href="#" class="footer-link">Advertise</a>
                    <a href="#" class="footer-link">Careers</a>
                    <a href="#" class="footer-link">Submit a Tip</a>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h4 class="footer-title">Categories</h4>
                    <a href="#" class="footer-link">Politics</a>
                    <a href="#" class="footer-link">Business</a>
                    <a href="#" class="footer-link">Technology</a>
                    <a href="#" class="footer-link">Health</a>
                    <a href="#" class="footer-link">Environment</a>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-title">Newsletter</h4>
                    <p>Subscribe to get daily news updates straight to your inbox.</p>
                    <form class="mt-3">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Your Email">
                            <button class="btn btn-success" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="copyright text-center">
                <p class="mb-0">© 2023 GreenNews. All Rights Reserved. | <a href="#" class="footer-link">Privacy Policy</a> | <a href="#" class="footer-link">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>