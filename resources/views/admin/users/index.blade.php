@include('admin.header')
<link rel="stylesheet" href="{{ asset('css/index_user.css') }}">
<body>
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">User</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('admin')}}">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">User Management</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
<div class="container mb-4">
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create New User</a>
    <input type="text" id="userSearch" class="form-control mb-3" placeholder="Search">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="userTable">
        @foreach($users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;" class="delete-user-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" >Delete</button>
            </form>
        </td>
    </tr>
@endforeach
<script>
document.querySelectorAll('.delete-user-form').forEach(form => {
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
        </tbody>
    </table>
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

<script>
    document.getElementById('userSearch').addEventListener('keyup', function () {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('#userTable tr').forEach(row => {
            const name = row.children[1].innerText.toLowerCase();
            row.style.display = name.includes(searchTerm) ? '' : 'none';
        });
    });
</script>