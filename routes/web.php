<?php

use App\Http\Controllers\LeadsController;
use App\Http\Controllers\ContactTrackingController;
use App\Http\Controllers\Settings;
use App\Http\Controllers\WaitingListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // Profile and appearance settings

    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');



    // Leads
    Route::get('/leads', [LeadsController::class, 'index'])->name('leads.index');
    Route::get('/leads/data', [LeadsController::class, 'getData'])->name('leads.data');
    Route::get('/leads/export', [LeadsController::class, 'export'])->name('leads.export');
    Route::get('/leads/filters', [LeadsController::class, 'getFilterOptions'])->name('leads.filters');
    Route::post('/leads/store', [LeadsController::class, 'store'])->name('leads.store');
    Route::get('/leads/{id}', [LeadsController::class, 'show']);
    Route::put('/leads/update/{id}', [LeadsController::class, 'update'])->name('leads.update');
    Route::delete('/leads/{id}', [LeadsController::class, 'destroy']);
    Route::post('/leads/import', [LeadsController::class, 'import_leads'])->name('leads.import');


});

require __DIR__.'/auth.php';
