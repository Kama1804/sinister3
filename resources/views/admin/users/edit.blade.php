@include('admin.header')
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">User</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route ('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route ('admin.users.index') }}">User Management</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Edit User</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container mt-5 mb-4">
        <h2>Edit User</h2>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mb-3">Back to Users List</a>
        <form id="editUserForm" action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password (Leave blank to keep current)</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
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
document.getElementById('editUserForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Update User',
        text: 'Save changes to this user?',
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
    </div>