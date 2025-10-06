<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('auth.showLogin');
});

Route::prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::get('/login', [AccountController::class, 'showLogin'])->name('showLogin');
        Route::post('/login', [AccountController::class, 'postLogin'])->name('postLogin');
        Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
    });

Route::prefix('account')
    ->middleware('auth')
    ->name('account.')
    ->group(function () {
        Route::get('/', [AccountController::class, 'index'])->name('index');
        Route::get('/update/{user}', [AccountController::class, 'update'])->name('update');
        Route::get('/create', [AccountController::class, 'create'])->name('create');
        Route::get('/search', [AccountController::class, 'search'])->name('search');

        Route::post('/create', [AccountController::class, 'post'])->name('post');
        Route::get('/delete/{user}', [AccountController::class, 'delete'])->name('delete');
        Route::post('/update/{user}', [AccountController::class, 'put'])->name('put');
    });

Route::prefix('customer')
    ->middleware('auth')
    ->name('customer.')
    ->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/update/{customer}', [CustomerController::class, 'update'])->name('update');
        Route::get('/create', [CustomerController::class, 'create'])->name('create');
        Route::get('/search', [CustomerController::class, 'search'])->name('search');

        Route::post('/create', [CustomerController::class, 'post'])->name('post');
        Route::get('/delete/{customer}', [CustomerController::class, 'delete'])->name('delete');
        Route::post('/update/{customer}', [CustomerController::class, 'put'])->name('put');
    });

Route::prefix('contract')
    ->middleware('auth')
    ->name('contract.')
    ->group(function () {
        Route::get('/', [ContractController::class, 'index'])->name('index');
        Route::get('/update/{contract}', [ContractController::class, 'update'])->name('update');
        Route::get('/create', [ContractController::class, 'create'])->name('create');
        Route::get('/search', [ContractController::class, 'search'])->name('search');

        Route::post('/create', [ContractController::class, 'post'])->name('post');
        Route::get('/delete/{contract}', [ContractController::class, 'delete'])->name('delete');
        Route::post('/update/{contract}', [ContractController::class, 'put'])->name('put');
    });

Route::prefix('transaction')
    ->middleware('auth')
    ->name('transaction.')
    ->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/update/{transaction}', [TransactionController::class, 'update'])->name('update');
        Route::get('/create', [TransactionController::class, 'create'])->name('create');
        Route::get('/search', [TransactionController::class, 'search'])->name('search');

        Route::post('/create', [TransactionController::class, 'post'])->name('post');
        Route::get('/delete/{transaction}', [TransactionController::class, 'delete'])->name('delete');
        Route::post('/update/{transaction}', [TransactionController::class, 'put'])->name('put');
    });

Route::prefix('report')
    ->middleware('auth')
    ->name('report.')
    ->group(function () {
        Route::get('/contract', [ReportController::class, 'showContract'])->name('showContract');
        Route::get('/transaction}', [ReportController::class, 'showTransaction'])->name('showTransaction');
    });
