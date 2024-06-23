<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventDetailController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// Root route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route with auth and verified middleware
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes with auth and admin middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    
});

// Launch event route with auth middleware
Route::get('/launchevent', function () {
    return view('launchevent');
})->name('launchevent')->middleware('auth');
// welcome page route 
Route::get('/welcome', function () {
    return view('welcome'); 
})->name('welcome');

//route for the EventController
//store the form infos 
Route::post('/events', [EventController::class, 'store'])->name('events.store');
// read the events stored 
Route::get('/events', [EventController::class, 'index'])->name('events.index');
//route for the EventDetailsController
// read full details about an event 
Route::get('/events/{id}', [EventDetailController::class, 'show'])->name('events.show');
Route::post('/events/{id}/comment', [EventDetailController::class, 'storeComment'])->name('events.comment');
Route::post('/events/{id}/rating', [EventDetailController::class, 'storeRating'])->name('events.rating');
Route::post('comments/{id}/delete', [EventDetailController::class, 'deleteComment'])->name('comments.delete');
//update an event
Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');


//user dashboard 
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::delete('/events/{event}', [UserDashboardController::class, 'destroy'])->name('events.destroy');
});
//admin dashboard 
Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
Route::delete('/events/{event}', [HomeController::class, 'destroy'])->name('events.destroy');
Route::get('/admin/reservations', [HomeController::class, 'reservations'])->name('admin.reservations');
Route::post('/admin/reservations/{id}/delete', [HomeController::class, 'deleteReservation'])->name('admin.reservations.delete');


//reservation route
Route::middleware(['auth'])->group(function () {
    Route::post('/events/{event}/reserve', [ReservationController::class, 'reserve'])->name('events.reserve');
});
Route::post('events/{event}/delete-reservation', [ReservationController::class, 'deleteReservation'])->name('events.deleteReservation');

Route::get('/admin/reservations', [HomeController::class, 'reservations'])->name('admin.reservations');
Route::post('/admin/reservations/{id}/delete', [HomeController::class, 'deleteReservation'])->name('admin.reservations.delete');

// Authentication routes
require __DIR__.'/auth.php';
