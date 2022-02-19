<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Poli\PoliController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function(){
    return view('auth.login');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'],
    function()
        {
            Route::resource('/dashboard', DashboardController::class);

            // Route Poli
            Route::resource('/poli', PoliController::class);
                // Route Hapus
                Route::get('remove-poli', [PoliController::class, 'delete']);
        }
);
