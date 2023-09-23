<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Nette\Utils\Type;

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
Route::get('tracking/show', function (Type $var = null) {
    return view('tracking');
})->name('tracking.show');

Route::get('tracking/', function () {
    $data =  [
        [30.05842470746372, 31.302239696082736],
        [30.027470584769212, 31.315624059797774],
        [30.02072510744215, 31.34558905318965],
        [30.016746790297862, 31.400125341162862],
        [30.016746790297862, 31.500125341162862]
    ];

    // $data = (json_encode($data, JSON_FORCE_OBJECT));

    return response()->json($data);
})->name('tracking');
