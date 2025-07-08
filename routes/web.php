<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//welcome page
Route::get('/', function () {
    return view('welcome');
});

//Dashboard redirects to books list (only for logged-in users)
Route::get('/dashboard', function () {
    return redirect()->route('books.index');
})->middleware(['auth'])->name('dashboard');

//Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Author Management
    Route::resource('authors', AuthorController::class);

    //Book Management
    Route::resource('books', BookController::class);

    //Report 
    Route::get('/reports', [ReportController::class, 'showForm'])->name('reports.form');
    Route::post('/reports', [ReportController::class, 'generate'])->name('reports.generate');
});

//Auth routes
require __DIR__.'/auth.php';
