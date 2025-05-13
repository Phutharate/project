<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;

//use App\Livewire\UserForm;

Route::get('/', function () {
    return view('auth.login');
});





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





//Route::get('/users', UserForm::class)->name('users.create');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


