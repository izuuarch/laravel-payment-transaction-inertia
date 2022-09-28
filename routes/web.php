<?php

use App\Http\Controllers\paymentcontroller;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/payment',[paymentcontroller::class,'index'])->name('payment');
Route::post('/pay',[paymentcontroller::class,'pay'])->name('pay');
Route::get('/newpay',[paymentcontroller::class,'new'])->name('newpay');
Route::get('/users',[paymentcontroller::class,'users'])->name('users');
require __DIR__.'/auth.php';
