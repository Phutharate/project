<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\CalendarController;



//use App\Livewire\UserForm;

Route::get('/', function () {
    return view('auth.login');
});





Route::get('/user-profiles/{id}/edit', [UserProfileController::class, 'edit'])->name('user-profiles.edit');
Route::put('/user-profiles/{id}', [UserProfileController::class, 'update'])->name('user-profiles.update');





Route::post('/user-profiles/{id}/confirm', [UserProfileController::class, 'confirm'])->name('user-profiles.confirm');



//Route::get('/dashboard', function () {
//    return view('dashboard');
//});

//Route::get('/user', function () {
//   return view('user');
//});

Route::resource('user-profiles', UserProfileController::class);
//Route::resource('users', UserController::class);


//Route::resource('user-profiles', UserProfileController::class)->only([
 //   'index', 'create', 'store' , 
//]);




Route::get('/calendar-events/{id}/edit', [CalendarEventController::class, 'edit'])->name('calendar-events.edit');




//Route::get('/users', UserForm::class)->name('users.create');

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');





});

require __DIR__ . '/auth.php';


