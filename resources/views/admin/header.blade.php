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

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-secondary navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
    <a href="{{route('admin')}}" class="navbar-brand ms-4 ms-lg-0">
        <h1 class="mb-0 text-primary text-uppercase"><i class="fa fa-cut me-3"></i>SINISTER 3 ADMIN</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('admin.users.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">Users</a>
            <a href="{{ route('admin.barbers.table') }}" class="nav-item nav-link {{ request()->routeIs('admin.barbers.table') ? 'active' : '' }}">Barbers</a>
            <a href="{{ route('admin.appointments.table') }}" class="nav-item nav-link {{ request()->routeIs('admin.appointments.table') ? 'active' : '' }}">Appointments</a>
            <a href="{{ route('admin.messages.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.messages.index') ? 'active' : '' }}">Messages</a>
            
            <!-- Logout button for mobile -->
            <div class="nav-item d-lg-none">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link btn btn-primary w-100 text-white">
                        Logout <i class="fa fa-arrow-right ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Logout button for desktop -->
        <form action="{{ route('admin.logout') }}" method="POST" class="d-none d-lg-inline">
            @csrf
            <button type="submit" class="btn btn-primary rounded-0 py-2 px-lg-4">
                Logout<i class="fa fa-arrow-right ms-3"></i>
            </button>
        </form>
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
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>