<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->Middleware('auth');
// Route::prefix('profile')->group(function ()) {
// Route::get('/', [StudentController::class,'index']);
//     Route::get('/{nama}', [StudentController::class, 'Profile']);
// }

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'isAdmin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
