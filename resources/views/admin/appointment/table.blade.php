@include('admin.header')

<link rel="stylesheet" href="{{ asset('css/table_appointment.css') }}">

<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Manage Appointment</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('admin')}}">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Manage Appointment</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
     
<div class="container">
    <h1>Manage Appointments</h1>
    <input type="text" id="appointmentSearch" class="form-control mb-3" placeholder="Search">

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Services</th>
                <th>Barber</th>
                <th>Date</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="appointmentTable">
    @foreach ($appointments as $appointment)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $appointment->customer_name }}</td>
        <td>{{ $appointment->phone }}</td>
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
        <td>{{ $appointment->barber->name }}</td>
        <td>{{ $appointment->appointment_date }}</td>
        <td>{{ $appointment->appointment_time }}</td>
        <td>
            <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;" class="delete-appointment-form">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" >Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>

    </table>

    <script>
document.querySelectorAll('.delete-appointment-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});
</script>

@if(session('success'))
    <script>
        window.onload = function() {
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#3085d6'
            });
        }
    </script>
@endif

@if(session('error'))
    <script>
        window.onload = function() {
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonColor: '#d33'
            });
        }
    </script>
@endif
</div>

<script>
    document.getElementById('appointmentSearch').addEventListener('keyup', function () {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('#appointmentTable tr').forEach(row => {
            const name = row.children[1].innerText.toLowerCase();
            const date = row.children[4].innerText.toLowerCase();
            row.style.display = name.includes(searchTerm) || date.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
