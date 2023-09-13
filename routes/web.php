<?php

use Illuminate\Support\Facades\Auth;
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

/* Route::get('/', function () {
    // return view('dashboard.settings.index');
    return view('dashboard.categories.index');
})->name('index'); */

/* Auth::routes([
    // 'login'=>false,
    // 'register'=>false,
    // 'reset'=>false, 
]); */

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// include('admin.php'); */

Auth::routes();

## Site ##
Route::get('/', [App\Http\Controllers\Site\HomeController::class, 'index'])->name('index');
Route::get('product/{id}', [App\Http\Controllers\Site\ProductController::class, 'show'])->name('product.show');