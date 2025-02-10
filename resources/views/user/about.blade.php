@include('user.header')

<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">About</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex flex-column">
                    <img class="img-fluid w-75 align-self-end" src="{{ asset('img/danial.jpeg') }}" alt="jpeg">
                        <div class="w-50 bg-secondary p-5" style="margin-top: -25%;">
                            <h1 class="text-uppercase text-primary mb-3">5 Years</h1>
                            <h2 class="text-uppercase mb-0">Experience</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="d-inline-block bg-secondary text-primary py-1 px-4">About Us</p>
                    <h1 class="text-uppercase mb-4">More Than Just A Haircut. Learn More About Us!</h1>
                    <p>Welcome to Sinister3 Barber, where style meets tradition. We're passionate about delivering fresh, sharp, and timeless looks in a friendly and relaxed atmosphere. Whether it's a classic cut, a modern style, or a precise beard trim, our skilled barbers take pride in making you look and feel your best.</p>
                    <p class="mb-4">Your satisfaction is our priority, and we aim to make every visit an experience you'll look forward to. Come in, sit back, and let us take care of the rest.</p>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h3 class="text-uppercase mb-3">Since 2020</h3>
                        </div>
                        <div class="col-md-6">
                            <h3 class="text-uppercase mb-3">500+ clients</h3>
                            <p class="mb-0">very very much people to cut hair.No angry we trio chill guy</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block bg-secondary text-primary py-1 px-4">The Founder</p>
                <h1 class="text-uppercase">The Founder</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="team-img position-relative overflow-hidden" style="height: 400px;">
                        <img class="img-fluid w-100 h-100" src="{{ asset('img/zaim.jpeg') }}" alt="jpeg" style="object-fit: cover;">
                            <div class="team-social">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-secondary text-center p-4">
                            <h5 class="text-uppercase">ZAIM KASYFUL AZHIM</h5>
                            <span class="text-primary">The Boss/Eco Grandeur</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item">
                        <div class="team-img position-relative overflow-hidden" style="height: 400px;">
                        <img class="img-fluid w-100 h-100" src="{{ asset('img/danial.jpeg') }}" alt="Danial's photo" style="object-fit: cover;">
                            <div class="team-social">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-secondary text-center p-4">
                            <h5 class="text-uppercase">DANIAL</h5>
                            <span class="text-primary">Vice President/Eco Grandeur</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item">
                        <div class="team-img position-relative overflow-hidden" style="height: 400px;">
                        <img class="img-fluid w-100 h-100" src="{{ asset('img/kama.jpeg') }}" alt="jpeg" style="object-fit: cover;">
                            <div class="team-social">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-secondary text-center p-4">
                            <h5 class="text-uppercase">KAMAPUTRA</h5>
                            <span class="text-primary">Vice President/Taman Ilmu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


@include('user.footer')


    <!-- Back to Top -->
    <a href="{{route('about')}}" class="btn btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


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