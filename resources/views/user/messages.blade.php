@include('user.header')
<link rel="stylesheet" href="{{ asset('css/message.css') }}">
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white text-uppercase mb-3 animated slideInDown">Messages</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white">Messages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">View Messages</li>
                </ol>
            </nav>
        </div>
    </div>
<div class="container-xxl py-5">
    <div class="container">
        <h2 class="text-center mb-5">My Messages</h2>
        <div class="row">
            @foreach($messages as $message)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $message->subject }}</h5>
                        <span class="badge {{ $message->is_read ? 'bg-success' : 'bg-warning' }}">
                            {{ $message->is_read ? 'Replied' : 'Pending' }}
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong>Your Message:</strong></p>
                        <p class="card-text">{{ $message->message }}</p>
                        
                        @if($message->admin_reply)
                        <hr>
                        <p class="card-text"><strong>Admin Reply:</strong></p>
                        <p class="card-text">{{ $message->admin_reply }}</p>
                        @endif
                    </div>
                    <div class="card-footer text-muted">
                        Sent on: {{ $message->created_at->format('Y-m-d H:i') }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $messages->links() }}
    </div>
</div>

@include('user.footer')