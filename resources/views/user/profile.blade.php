@include('user.header')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Profile</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white">Profile</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">View Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Profile Section -->
            <div class="col-md-6">
                <div class="profile-section">
                    <div class="form-container">
                        <h2 class="section-title">My Profile</h2>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
                            </div>

                            <!-- Password Field (Optional) -->
                            <div class="form-group">
                                <label for="password">New Password (Leave blank to keep current)</label>
                                <input type="password" class="form-control" name="password" minlength="8">
                            </div>
                           
                            
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>        
        </div>
    </div>

    @include('user.footer')
