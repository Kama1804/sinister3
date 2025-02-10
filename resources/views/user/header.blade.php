<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HairCut - Hair Salon HTML Template</title>
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
   <!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.js"></script>

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-secondary navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="{{route('home')}}" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="mb-0 text-primary text-uppercase"><i class="fa fa-cut me-3"></i>SINESTER3 BARBER</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('service') }}" class="nav-item nav-link {{ request()->routeIs('service') ? 'active' : '' }}">Service</a>
                <a href="{{ route ('appointment')}}" class="nav-item nav-link {{ request()->routeIs('appointment') ? 'active' : '' }}">Appointment</a>
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('price', 'team', 'open', 'testimonial') ? 'active' : '' }}" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('price') }}" class="dropdown-item {{ request()->routeIs('price') ? 'active' : '' }}">Pricing Plan</a>
                        <a href="{{ route('team') }}" class="dropdown-item {{ request()->routeIs('team') ? 'active' : '' }}">Our Barber</a>
                        <a href="{{ route('open') }}" class="dropdown-item {{ request()->routeIs('open') ? 'active' : '' }}">Working Hours</a>
                        <a href="{{ route('testimonial') }}" class="dropdown-item {{ request()->routeIs('testimonial') ? 'active' : '' }}">Testimonial</a>
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>

                <!-- Messages Dropdown or Link -->
                @auth
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="messagesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-envelope"></i> Messages
                            @if(auth()->user() && auth()->user()->messages && auth()->user()->messages->where('is_read', false)->count() > 0)
                                <span class="badge bg-danger">{{ auth()->user()->messages->where('is_read', false)->count() }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="messagesDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.messages') }}">View Messages</a></li>
                        </ul>
                    </div>
                @endauth

                <!-- Profile Dropdown -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> Profile
                    </a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('user.profile') }}" class="dropdown-item">View Profile</a>
                        <a href="{{ route('user.appointments') }}" class="dropdown-item">My Appointments</a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <script>
        // Get all navbar links
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        // Loop through links and add event listeners
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                // Remove 'active' class from all links
                navLinks.forEach(nav => nav.classList.remove('active'));

                // Add 'active' class to the clicked link
                link.classList.add('active');
            });
        });
    </script>

</body>

</html>
