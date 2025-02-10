@include('admin.header')
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">User</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route ('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route ('admin.users.index') }}">User Management</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Create User</li>
                </ol>
            </nav>
        </div>
    </div>

<div class="container mb-4">
    <h1>Create New User</h1>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mb-3">Back to Users List</a>
    <form id="createUserForm" action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" id="name" class="form-control" required>
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" id="email" class="form-control" required>
    @error('email')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" id="password" class="form-control" required minlength="8">
    <div class="form-text text-muted">Password must be at least 8 characters long</div>
    @error('password')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>3cdfghjk
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
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
    <script>
document.getElementById('createUserForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Create New User',
        text: 'Are you sure you want to create this user?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, create it!'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
    
});
</script>


</div>
</body>
</html>
