@include('user.header')

<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Service</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Service</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block bg-secondary text-primary py-1 px-4">Services</p>
                <h1 class="text-uppercase">What We Provide</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                        <div class="bg-dark d-flex flex-shrink-0 align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <img class="img-fluid" src="{{ asset('img/haircut.png') }}" alt="">
                        </div>
                        <div class="ps-4">
                            <h3 class="text-uppercase mb-3">Haircut</h3> 
                            <p>Any cut Any Hairstyle we FLexible</p>
                            <span class="text-uppercase text-primary">RM20</span>
                        </div>
                        <a class="btn btn-square" href=""><i class="fa fa-plus text-primary"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                        <div class="bg-dark d-flex flex-shrink-0 align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <img class="img-fluid" src="{{ asset('img/beard-trim.png') }}" alt="">
                        </div>
                        <div class="ps-4">
                            <h3 class="text-uppercase mb-3">Beard Trim</h3>
                            <p>Bread shave clear or trim</p>
                            <span class="text-uppercase text-primary">RM15</span>
                        </div>
                        <a class="btn btn-square" href=""><i class="fa fa-plus text-primary"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                        <div class="bg-dark d-flex flex-shrink-0 align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <img class="img-fluid" src="{{ asset('img/mans-shave.png') }}" alt="">
                        </div>
                        <div class="ps-4">
                            <h3 class="text-uppercase mb-3">Mans Shave</h3>
                            <p>Mans shave</p>
                            <span class="text-uppercase text-primary">RM15</span>
                        </div>
                        <a class="btn btn-square" href=""><i class="fa fa-plus text-primary"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                        <div class="bg-dark d-flex flex-shrink-0 align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <img class="img-fluid" src="{{ asset('img/hair-dyeing.png') }}" alt="">
                        </div>
                        <div class="ps-4">
                            <h3 class="text-uppercase mb-3">Hair Dyeing</h3>
                            <p>Apply any color that u want on your hair</p>
                            <span class="text-uppercase text-primary">RM200</span>
                        </div>
                        <a class="btn btn-square" href=""><i class="fa fa-plus text-primary"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                        <div class="bg-dark d-flex flex-shrink-0 align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <img class="img-fluid" src="{{ asset('img/mustache.png') }}" alt="">
                        </div>
                        <div class="ps-4">
                            <h3 class="text-uppercase mb-3">Mustache</h3>
                            <p>Importen look for a men. Can custim fashion mustache example like Keli style, Wak Doyok style or more</p>
                            <span class="text-uppercase text-primary">RM15</span>
                        </div>
                        <a class="btn btn-square" href=""><i class="fa fa-plus text-primary"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                        <div class="bg-dark d-flex flex-shrink-0 align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <img class="img-fluid" src="{{ asset('img/stacking.png') }}" alt="">
                        </div>
                        <div class="ps-4">
                            <h3 class="text-uppercase mb-3">dreadlock or braid</h3>
                            <p>its a really good fashion for unisex </p>
                            <span class="text-uppercase text-primary">RM300</span>
                        </div>
                        <a class="btn btn-square" href=""><i class="fa fa-plus text-primary"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    @include('user.footer')


    <!-- Back to Top -->
    <a href="{{route('service')}}" class="btn btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


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