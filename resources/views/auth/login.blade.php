    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login - Your Application</title>
  <link rel="stylesheet" href="{{ asset('css/log.css') }}">
</head>
<body>
<div class="container">
  <div class="forms-container">
    <div class="form-control signin-form">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2>Sign in</h2>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
        <input type="password" name="password" placeholder="Password" required />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
        <button>Sign in</button>
      </form>

    </div>
  </div>
  <div class="intros-container">
    <div class="intro-control signup-intro">
      <div class="intro-control__inner">
        <h2>Come join us!</h2>
        <p>
          We are so excited to have you here. If you haven't already, create an account to get access to exclusive offers, rewards, and discounts.
        </p>
        <a href="{{ route('register') }}"><button id="signup-btn">No account yet? Sign Up.</button></a>
        <a href="{{ route('admin.login') }}"><button id="signup-btn">Admin Login</button></a>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/log.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.signin-form form');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = new FormData(this);

        // Get CSRF token
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Submit form data
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': token
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (response.redirected) {
                // If login is successful, Laravel will redirect
                window.location.href = response.url;
                return;
            }
            return response.json();
        })
        .then(data => {
            if (data) {
                // Show error only if we have error data
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: 'These credentials do not match our records.',
                    confirmButtonColor: '#3085d6'
                });
            }
        })
        .catch(error => {
            // Only show error for actual errors, not redirects
            if (!window.location.href.includes('dashboard')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: 'These credentials do not match our records.',
                    confirmButtonColor: '#3085d6'
                });
            }
        });
    });
});
</script>
</body>
</html>

