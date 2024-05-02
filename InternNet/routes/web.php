<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('opportunities.index');
})->name('welcome');

Route::get('/search', [OpportunityController::class, 'search'])->name('search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::name('opportunities.')
    ->prefix("opportunities")
    ->middleware('auth')
    ->controller(OpportunityController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index')
            ->withoutMiddleware('auth');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/offers', 'showUserOffers')->name('offers');
        Route::get('/{opportunity}', 'show')->name('show')
            ->where('id', '[0-9]+')
            ->withoutMiddleware('auth');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');

    });

require __DIR__.'/auth.php';

Route::get('admin/dashboard', [AdminController::class, 'index'])
    ->name('admin-dashboard')
    ->middleware(['auth', 'admin']);

Route::name('admin.')
    ->prefix("admin")
    ->middleware(['auth', 'admin'])
    ->controller(ContractController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/dashboard', 'show')->name('admin-dashboard');

    });



