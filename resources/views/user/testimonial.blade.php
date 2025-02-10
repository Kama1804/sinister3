@include('user.header')

<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Testimonial</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Testimonial</li>
                </ol>
            </nav>
        </div>
    </div>
   <!-- Testimonial Start -->
   <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block bg-secondary text-primary py-1 px-4">Testimonial</p>
                <h1 class="text-uppercase">What Our Clients Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src='{{ asset('img/testimonial-2.jpg') }}' alt=''>">
                    <h4 class="text-uppercase">lee chong wei</h4>
                    <p class="text-primary">Profession</p>
                    <span class="fs-5">Hands down the best haircut I've ever had! The barbers here are true professionals, and they make you feel at home from the moment you walk in. The attention to detail is unmatched!</span>
                </div>
                <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src='{{ asset('img/testimonial-1.jpg') }}' alt=''>">
                    <h4 class="text-uppercase">sir ambatu</h4>
                    <p class="text-primary">Profession</p>
                    <span class="fs-5">I’ve been coming here for months, and they never disappoint. From the precision cuts to the relaxing vibe, this place is top-notch. Highly recommend for anyone looking to upgrade their look!</span>
                </div>
                <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src='{{ asset('img/testimonial-3.jpg') }}' alt=''>">
                    <h4 class="text-uppercase">Muhammad Danial(ciku)</h4>
                    <p class="text-primary">Profession</p>
                    <span class="fs-5">Amazing service! They take the time to listen to what you want and execute it perfectly. The team is friendly, the shop is clean, and I always leave feeling like a million bucks!</span>
                </div>
            </div>      
        </div>
    </div>
    <!-- Testimonial End -->

@include('user.footer')

    <!-- Back to Top -->
    <a href="{{route('testimonial')}}" class="btn btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
