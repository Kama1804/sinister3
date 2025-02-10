@include('user.header')
<link rel="stylesheet" href="{{ asset('css/my_appointment.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">  
</head>
<body>
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Profile</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white">Profile</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">My Appointment</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Appointments Section -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="appointments-section">
                    <div class="appointments-container">
                        <h2 class="section-title">My Appointments</h2>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Barber</th>
                                        <th>Services</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->appointment_date }}</td>
                                        <td>{{ $appointment->appointment_time }}</td>
                                        <td>{{ $appointment->barber->name }}</td>
                                        <td>
                                            @if(is_array($appointment->services))
                                                <ul>
                                                    @foreach ($appointment->services as $service)
                                                        <li>{{ $serviceNames[$service] ?? $service }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                {{ $serviceNames[$appointment->services] ?? $appointment->services }}
                                            @endif
                                        </td>
                                        <td>
                                        @if(Carbon\Carbon::parse($appointment->appointment_date)->gt(now()))
                                            <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST" class="cancel-appointment-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger cancel-appointment-btn">Cancel</button>
                                            </form>
                                        @else
                                            <span class="text-muted">Past</span>
                                        @endif
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <script>
                               document.addEventListener('DOMContentLoaded', function() {
    const cancelButtons = document.querySelectorAll('.cancel-appointment-btn');
    
    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.cancel-appointment-form');
            
            Swal.fire({
                title: 'Cancel Appointment',
                text: 'Are you sure you want to cancel this appointment?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff0000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, cancel it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Get the form action URL
                    const url = form.getAttribute('action');
                    
                    // Create form data
                    const formData = new FormData(form);
                    
                    // Send AJAX request
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                title: 'Cancelled!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonColor: '#3085d6'
                            }).then(() => {
                                // Reload the page to show updated appointments
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.message,
                                icon: 'error',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong while cancelling the appointment.',
                            icon: 'error',
                            confirmButtonColor: '#3085d6'
                        });
                    });
                }
            });
        });
    });
});
                            </script>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('user.footer')
