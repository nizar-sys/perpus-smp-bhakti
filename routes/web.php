<?php

use App\Http\Controllers\AnggotaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReturnBookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\VisitorController;

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

# ------ Unauthenticated routes ------ #
Route::get('/', [AuthenticatedSessionController::class, 'create']);
require __DIR__.'/auth.php';


# ------ Authenticated routes ------ #
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [RouteController::class, 'dashboard'])->name('home'); # dashboard

    Route::prefix('profile')->group(function(){
        Route::get('/', [ProfileController::class, 'myProfile'])->name('profile');
        Route::put('/change-ava', [ProfileController::class, 'changeFotoProfile'])->name('change-ava');
        Route::put('/change-profile', [ProfileController::class, 'changeProfile'])->name('change-profile');
    }); # profile group

    Route::middleware('roles:admin')->group(function(){
        Route::resource('users', UserController::class);
    });

    Route::get('/members/print-out/{memberId}', [AnggotaController::class, 'printCard'])->name('members.print-out');
    Route::middleware('roles:petugas,admin')->group(function(){
        Route::resource('members', AnggotaController::class);
        Route::post('/borrows/return-book/{borrowId}', [BorrowController::class, 'returnBook'])->name('borrows.return');
        Route::resource('borrows', BorrowController::class);
        Route::resource('returns', ReturnBookController::class);
    });

    Route::middleware('roles:admin,petugas')->group(function(){
        Route::resource('stocks', StockOpnameController::class);
        Route::resource('visitors', VisitorController::class);
        Route::resource('categories', BookCategoryController::class);
    });

    Route::get('/books/borrows', [BookController::class, 'borrows'])->name('books.borrow.index');
    Route::get('/books/borrows/{id}', [BookController::class, 'borrowBook'])->name('books.borrow');
    Route::post('/books/borrows/{id}', [BookController::class, 'borrow'])->name('books.borrow.store');
    Route::resource('books', BookController::class);
    Route::resource('visitors', VisitorController::class)->only(['store']);
});
