<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('order', 'OrderController');
    Route::controller(OrderController::class)->group(function(){
        Route::any('user_dashboard', 'user_dashboard')->name('user_dashboard');
        Route::any('order_datatable', 'order_datatable')->name('order_datatable');
        Route::any('order_multi_delete', 'order_multi_delete')->name('order_multi_delete');
        Route::any('check_quantity', 'check_quantity')->name('check_quantity');
    });
});

require __DIR__.'/auth.php';
