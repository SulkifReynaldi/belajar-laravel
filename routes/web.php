<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

Route::prefix('/book')->group(function(){
    Route::get('/', [BookController::class, 'index'])->name('book.index');
    Route::get('/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/store', [BookController::class, 'store'])->name('book.store');
    Route::get('/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::post('/update/{id}', [BookController::class, 'update'])->name('book.update');
    Route::get('/delete/{id}', [BookController::class, 'delete'])->name('book.delete');

});

});

require __DIR__.'/auth.php';
