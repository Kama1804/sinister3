<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return redirect('login');
});

Route::get('/about', function () {
    return view('user.about');
})->name('about');

Route::get('/service', function () {
    return view('user.service');
})->name('service');

Route::get('/open', function () {
    return view('user.open');
})->name('open');

Route::get('/price', function () {
    return view('user.price');
})->name('price');

Route::get('/team', function () {
    return view('user.team');
})->name('team');

Route::get('/testimonial', function () {
    return view('user.testimonial');
})->name('testimonial');

Route::get('/contact', function () {
    return view('user.contact');
})->name('contact');

// Admin Authentication Routes
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login']);
Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Routes
Route::middleware(['admin'])->prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/', function () {
        return view('admin.admin');
    })->name('admin');

    // Admin User Management
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');

    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // Admin Appointment Management
    Route::get('/appointments/table', [AppointmentController::class, 'table'])->name('admin.appointments.table');
    Route::get('/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('admin.appointments.edit');
    Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('admin.appointments.update');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('admin.appointments.destroy');

 // Admin Barber Management - All barber routes should be here
 Route::prefix('barbers')->group(function () {
    Route::get('/table', [BarberController::class, 'table'])->name('admin.barbers.table');
    Route::get('/create', [BarberController::class, 'create'])->name('admin.barbers.create');
    Route::post('/store', [BarberController::class, 'store'])->name('admin.barbers.store');
    Route::get('/edit/{id}', [BarberController::class, 'edit'])->name('admin.barbers.edit');
    Route::put('/update/{id}', [BarberController::class, 'update'])->name('admin.barbers.update');
    Route::delete('/destroy/{id}', [BarberController::class, 'destroy'])->name('admin.barbers.destroy');
});
});

// User Authentication & Profile Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User Appointment Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment');
    Route::get('/check-availability', [AppointmentController::class, 'checkAvailability'])->name('appointments.check-availability');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
});

// Authentication Routes
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');


// User routes
Route::middleware(['auth'])->group(function () {
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/my-messages', [MessageController::class, 'userMessages'])->name('user.messages');
});

// Admin routes
Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('admin.messages.index');
    Route::post('/messages/{message}/reply', [AdminMessageController::class, 'reply'])->name('admin.messages.reply');
});


Route::get('messages/unread-count', [MessageController::class, 'getUnreadMessageCount'])->name('messages.unread-count');



Route::middleware(['auth'])->group(function () {
    // Profile page route
    Route::get('/profile', [UserProfileController::class, 'show'])->name('user.profile');
    
    // User appointments route
     Route::get('/appointments', [UserProfileController::class, 'appointments'])->name('user.appointments');
    
    // Update profile route (pointing to UserProfileController)
    Route::patch('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    
    // Cancel appointment route
    Route::delete('/appointments/{id}/cancel', [UserProfileController::class, 'cancelAppointment'])->name('appointments.cancel');
});

require __DIR__.'/auth.php';