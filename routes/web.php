<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('account', BankAccountController::class);
Route::get('/account', [BankAccountController::class, 'view'])->middleware(['auth'])->name('account');
Route::get('/account/create', [BankAccountController::class, 'create'])->middleware(['auth'])->name('account.create');
Route::post('/account/create', [BankAccountController::class, 'store'])->middleware(['auth'])->name('account.store');
Route::delete('/account/delete', [BankAccountController::class, 'delete'])->middleware(['auth'])->name('account.delete');
Route::get('/transactions', [TransactionController::class, 'view'])->middleware(['auth'])->name('transactions');
Route::get('/transactions/create', [TransactionController::class, 'create'])->middleware(['auth'])->name('transactions.create');
Route::post('/transactions/create', [TransactionController::class, 'store'])->middleware(['auth'])->name('transactions.store');
Route::get('/transactions/history', [TransactionController::class, 'history'])->middleware(['auth'])->name('transactions.history');
Route::get('/investments', [InvestmentController::class, 'view'])->middleware(['auth'])->name('investments');
Route::get('/investments/create', [InvestmentController::class, 'create'])->middleware(['auth'])->name('investments.create');
Route::get('/investments/create', [InvestmentController::class, 'create'])->name('investments.create');
Route::post('/investments/store', [InvestmentController::class, 'store'])->middleware(['auth'])->name('investments.store');
Route::post('/investments/create-account', [InvestmentController::class, 'create'])->middleware(['auth'])->name('investments.create-account');
Route::middleware(['auth'])->group(function () {

    Route::get('/crypto/buy', [CryptoController::class, 'buyCrypto'])->name('crypto.buycrypto');

    Route::post('crypto/purchases', [CryptoController::class, 'processBuyCrypto'])->name('crypto.processBuyCrypto');

    Route::get('crypto/purchases', [CryptoController::class, 'purchases'])->name('crypto.purchases');
});


require __DIR__ . '/auth.php';
