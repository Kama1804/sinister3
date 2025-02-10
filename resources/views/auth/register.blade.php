<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="{{ asset('css/reg.css') }}">
</head>
<body>
<div class="container">
  <div class="forms-container">
    <div class="form-control signup-form">
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <h2>Sign Up</h2>
        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
        <input type="password" name="password" placeholder="Password" required />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        <button>Sign Up</button>
      </form>
    </div>
  </div>
  <div class="intros-container">
    <div class="intro-control signin-intro">
      <div class="intro-control__inner">
        <h2>Welcome back!</h2>
        <p>
          Welcome back! We are so happy to have you here. It's great to see you again. We hope you had a safe and enjoyable time away.
        </p>
        <a href="{{ route('login') }}"><button id="signin-btn">Already have an account? Sign in.</button></a>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.signup-form form');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = new FormData(this);
        
        // Get password fields
        const password = formData.get('password');
        const passwordConfirmation = formData.get('password_confirmation');
        
        // Only check for password-related validations
        if (!password || password.length < 8) {
            Swal.fire({
                icon: 'error',
                title: 'Weak Password',
                text: 'Password must be at least 8 characters long',
                confirmButtonColor: '#3085d6'
            });
            return;
        }
        
        if (password !== passwordConfirmation) {
            Swal.fire({
                icon: 'error',
                title: 'Password Mismatch',
                text: 'Passwords do not match',
                confirmButtonColor: '#3085d6'
            });
            return;
        }

        // If validations pass, submit the form
        this.submit();
    });
});
</script>

<script src="{{ asset('log/script.js') }}"></script>
</body>
</html>

   

