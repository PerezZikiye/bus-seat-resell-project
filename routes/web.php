<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\SeatPurchaseController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\BookingAdminController;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Welcome page with seats
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Alternatively, this was a duplicate route returning seats, so removed:
// Route::get('/', function () {
//     $seats = \App\Models\Seat::with('user')->where('status', 'available')->latest()->take(10)->get();
//     return view('welcome', compact('seats'));
// });

/*
|--------------------------------------------------------------------------
| Authentication Redirects
|--------------------------------------------------------------------------
*/

// Redirect user after login based on role
Route::get('/dashboard', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
})->middleware(['auth'])->name('dashboard');

// Optional extra redirect route if you want it
Route::get('/redirect-dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth'])->name('dashboard.redirect');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/bookings', [BookingAdminController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/export/csv', [BookingAdminController::class, 'exportCsv'])->name('bookings.export.csv');
    Route::get('/bookings/export/pdf', [BookingAdminController::class, 'exportPdf'])->name('bookings.export.pdf');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // User dashboard
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // Booking routes for regular users
    Route::resource('bookings', BookingController::class)->except(['edit', 'update', 'destroy']);
    Route::get('/bookings/payment/{id}', [BookingController::class, 'payment'])->name('bookings.payment');

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Wallet routes
    Route::get('/wallet/fund', [WalletController::class, 'showFundForm'])->name('wallet.fund');
    Route::post('/wallet/fund/process', [WalletController::class, 'processFund'])->name('wallet.fund.process');
    Route::get('/wallet/fund/callback', [WalletController::class, 'paymentCallback'])->name('wallet.fund.callback');

    // Seat purchase routes
    Route::get('/seat/buy/{id}', [SeatPurchaseController::class, 'buy'])->name('seat.buy');
    Route::post('/seats/buy/{seat_id}', [SeatPurchaseController::class, 'buy'])->name('seat.purchase');

    // Seat routes - view, create, edit, update, delete
    Route::resource('seats', SeatController::class);

    // Seat transactions/history
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
});

require __DIR__.'/auth.php';
