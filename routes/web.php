<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');


Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('home')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/loan', [LoanController::class, 'bookAvailableSearcher'])->name('bookAvailableSearcher');
    Route::post('/loan', [LoanController::class, 'bookAvailableSearch']);
    Route::post('/loan/{boook}', [LoanController::class, 'newLoan'])->name('newLoan');
    Route::get('/return', [LoanController::class, 'returnList'])->name('returnList');
    Route::post('/return/{loan}', [LoanController::class, 'newReturn'])->name('newReturn');
    Route::get('/history', [LoanController::class, 'loanHistory'])->name('loanHistory');

    Route::get('/books', [SettingsController::class, 'bookList'])->name('bookList');
    Route::post('/books', [SettingsController::class, 'newBook']);
    Route::get('/books/edit/{book}', [SettingsController::class, 'editBook'])->name('editBook');
    Route::patch('/books/edit/{book}', [SettingsController::class, 'editedBook']);
    Route::delete('/books/delete/{book}', [SettingsController::class, 'deleteBook'])->name('deleteBook');
    Route::get('/on-shelves', [SettingsController::class, 'onShelveList'])->name('onShelveList');
    Route::get('/on-shelves/{book}', [SettingsController::class, 'onShelvesDetails'])->name('onShelvesDetails');
    Route::post('/on-shelves/{book}', [SettingsController::class, 'createOnShelve'])->name('createOnShelve');
    Route::delete('/on-shelves/{book}/delete/{onShelve}', [SettingsController::class, 'deleteOnShelve'])->name('deleteOnShelve');
    Route::get('/search', [SettingsController::class, 'loansPerUser'])->name('loansPerUser');
    Route::get('/search/{user}', [SettingsController::class, 'detailLoansPerUser'])->name('detailLoansPerUser');

});



