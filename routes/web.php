<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [PageController::class, 'home'])->name('home');

// Users
Route::name('user.')->middleware(['auth'])->group(function () {
    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [UserController::class, 'show'])->name('show');
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}/picture', [UserController::class, 'destroyPicture'])->name('picture.destroy');
    });
    // Books
    // Route::prefix('books')->name('books.')->group(function () {
        // Route::get('/', [BookController::class, 'index'])->name('index');
    Route::resource('books', 'App\Http\Controllers\BookController');
    // });
});

Route::get('{page}', [PageController::class, 'redirectHome']);
Route::get('{page}/{subpage}', [PageController::class, 'redirectHome']);
