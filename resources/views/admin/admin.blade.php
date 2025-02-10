@include('admin.header')

<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Carousel Item 1 -->
            <div class="carousel-item active">
    <img class="w-100" src="{{ asset('img/carousel-1.jpg') }}" alt="Image">
    <div class="carousel-caption d-flex align-items-center justify-content-center text-start">
        <div class="mx-sm-5 px-5" style="max-width: 900px;">
            <h1 class="display-2 text-white text-uppercase mb-4 animated bounceInLeft">WELCOME BACK</h1>
            <h4 class="text-white text-uppercase mb-4 animated bounceInRight">
                <i class="fa fa-home text-primary me-3"></i>Welcome to Admin Page
            </h4>
            <h4 class="text-white text-uppercase mb-4 animated bounceInUp">
                <i class="fa fa-calendar-check text-primary me-3"></i>See the tasks and appointments
            </h4>
        </div>
    </div>
</div>


            <!-- Add additional carousel items for variety -->
            <div class="carousel-item">
            <img class="w-100" src="{{ asset('img/carousel-2.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex align-items-center justify-content-center text-start">
                    <div class="mx-sm-5 px-5" style="max-width: 900px;">
                        <h1 class="display-2 text-white text-uppercase mb-4 animated fadeInUp">Get Things Done</h1>
                        <h4 class="text-white text-uppercase mb-4 animated fadeInDown"><i class="fa fa-cogs text-primary me-3"></i>Manage Appointments with Ease</h4>
                        <h4 class="text-white text-uppercase mb-4 animated fadeInLeft"><i class="fa fa-check-circle text-primary me-3"></i>Track Your Progress</h4>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
            <img class="w-100" src="{{ asset('img/carousel-2.jpg') }}" alt="Image">
               <div class="carousel-caption d-flex align-items-center justify-content-center text-start">
                    <div class="mx-sm-5 px-5" style="max-width: 900px;">
                        <h1 class="display-2 text-white text-uppercase mb-4 animated slideInUp">Stay Ahead</h1>
                        <h4 class="text-white text-uppercase mb-4 animated slideInRight"><i class="fa fa-clock text-primary me-3"></i>Time Management Made Simple</h4>
                        <h4 class="text-white text-uppercase mb-4 animated slideInLeft"><i class="fa fa-clipboard-list text-primary me-3"></i>Organize Tasks and More</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->

</body>