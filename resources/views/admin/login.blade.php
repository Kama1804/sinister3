<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Login - HairCut</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Oswald:wght@600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset ('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset ('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset ('css/style.css') }}" rel="stylesheet">

    <style>
        /* Dark theme styling with red accents */
        body {
            /* Dark gradient background with subtle pattern */
            background: linear-gradient(145deg, #1a1a1a 0%, #2d2d2d 100%);
        }

        /* Main container styling */
        .login-container {
            background-color: #2a2a2a !important;
            border: 1px solid #3d3d3d !important;
            border-radius: 15px !important;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5) !important;
        }

        /* Heading and text colors */
        .text-primary {
            color: #ff3333 !important;  /* Bright red for emphasis */
        }

        h1 {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Form controls styling */
        .form-control {
            background-color: #333333 !important;
            border: 1px solid #444444 !important;
            color: #ffffff !important;
        }

        .form-control:focus {
            background-color: #3a3a3a !important;
            border-color: #ff3333 !important;
            box-shadow: 0 0 0 0.2rem rgba(255, 51, 51, 0.25) !important;
        }

        /* Label styling */
        .form-floating label {
            color: #999999 !important;
        }

        /* Button styling */
        .btn-primary {
            background-color: #ff3333 !important;
            border-color: #ff3333 !important;
            color: #ffffff !important;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #cc0000 !important;
            border-color: #cc0000 !important;
            box-shadow: 0 0 15px rgba(255, 51, 51, 0.4);
        }

        /* Spinner styling */
        .spinner-grow {
            background-color: #ff3333 !important;
        }

        /* Error message styling */
        .invalid-feedback {
            color: #ff6666 !important;
        }

        /* Custom hr line */
        hr.bg-primary {
            background-color: #ff3333 !important;
            height: 3px !important;
            opacity: 1;
        }

        /* Add to existing styles */
        html, body {
            height: 100% !important;
            margin: 0 !important;
        }

        .container-fluid {
            min-height: 100vh !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
    </style>
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Login Form Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-container p-5 shadow-lg">
                        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                            <h1 class="text-primary text-uppercase">Admin Login</h1>
                            <hr class="w-25 mx-auto bg-primary">
                        </div>
                        
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                               id="username" name="username" placeholder="Username" required>
                                        <label for="username">Username</label>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               id="password" name="password" placeholder="Password" required>
                                        <label for="password">Password</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <a class="text-white" href="{{route('login')}}" style="text-align: center;">Home</a>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">
                                        <i class="fas fa-sign-in-alt me-2"></i>Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Form End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>