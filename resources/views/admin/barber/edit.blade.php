@include('admin.header')
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Barber</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route ('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route ('admin.barbers.table') }}">Barber Management</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Edit Barber</li>
                </ol>
            </nav>
        </div>
    </div>

<div class="container mb-4">
    <h1>Edit Barber</h1>
    
    <!-- Back Button -->
    <a href="{{ route('admin.barbers.table') }}" class="btn btn-secondary mb-3">Back to Barbers List</a>
    <form id="editBarberForm" action="{{ route('admin.barbers.update', $barber->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $barber->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="outlet" class="form-label">Outlet</label>
            <select name="outlet" id="outlet" class="form-control" required>
                <option value="eco_grandeur" {{ old('outlet', $barber->outlet ?? '') === 'eco_grandeur' ? 'selected' : '' }}>Eco Grandeur</option>
                <option value="taman_ilmu" {{ old('outlet', $barber->outlet ?? '') === 'taman_ilmu' ? 'selected' : '' }}>Taman Ilmu</option>
            </select>
            @error('outlet')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Update Barber</button>
    </form>
    <script>
document.getElementById('editBarberForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Update Barber',
        text: 'Save changes to this barber?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, save changes!'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});
</script>
<!-- Add this right after your <body> tag in each view -->
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

