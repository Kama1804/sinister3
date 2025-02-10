@include('admin.header')
<link rel="stylesheet" href="{{ asset('css/index_message.css') }}">

<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Message</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('admin')}}">Home</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Message</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Messages</h1>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr>
                            <td>{{ $message->created_at->format('Y-m-d') }}</td>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->subject }}</td>
                            <td>{{ Str::limit($message->message, 50) }}</td>
                            <td>
                            <span class="badge {{ $message->is_read ? 'bg-success' : 'bg-warning' }}">
                                {{ $message->is_read ? 'Replied' : 'Pending' }}
                            </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#replyModal{{ $message->id }}">
                                    {{ $message->is_read ? 'View/Reply' : 'Reply' }}
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Reply Modal -->
                        <div class="modal fade" id="replyModal{{ $message->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Reply to {{ $message->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('admin.messages.reply', $message) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Original Message:</label>
                                                <p>{{ $message->message }}</p>
                                            </div>
                                            
                                            @if($message->admin_reply)
                                                <div class="mb-3 p-3 bg-light rounded">
                                                    <h6 class="text-primary">Previous Reply</h6>
                                                    <p><strong>Replied by:</strong> {{ optional($message->admin)->name ?? 'Admin not available' }}</p>
                                                    <p><strong>Reply:</strong> {{ $message->admin_reply }}</p>
                                                    <p class="text-muted mb-0"><small>Replied on: {{ $message->updated_at->format('Y-m-d H:i') }}</small></p>
                                                </div>
                                            @endif

                                            <div class="mb-3">
                                                <label for="reply" class="form-label">Your Reply:</label>
                                                <textarea class="form-control" id="reply" name="reply" rows="4" required></textarea>
                                            </div>
                                        </div>
                                        @if(session('success'))
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                Swal.fire({
                                                    title: 'Success!',
                                                    text: "{{ session('success') }}",
                                                    icon: 'success',
                                                    confirmButtonColor: '#ff0000', // Matching your theme's red color
                                                    background: '#1a1a1a', // Dark background
                                                    color: '#ffffff' // White text
                                                });
                                            });
                                        </script>
                                    @endif

                                    @if(session('error'))
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                Swal.fire({
                                                    title: 'Error!',
                                                    text: "{{ session('error') }}",
                                                    icon: 'error',
                                                    confirmButtonColor: '#ff0000',
                                                    background: '#1a1a1a',
                                                    color: '#ffffff'
                                                });
                                            });
                                        </script>
                                    @endif
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Send Reply</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>
