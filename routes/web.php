<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventDetailController;
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

// Authentication routes
require __DIR__.'/auth.php';
