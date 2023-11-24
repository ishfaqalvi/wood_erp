<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\BankController;
// use App\Http\Controllers\ShopController;

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

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/', function(){
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth'],'namespace' => 'App\Http\Controllers'], function () {
	/*
	|--------------------------------------------------------------------------
	| Dashboard Route
	|--------------------------------------------------------------------------
	*/
	Route::get('dashboard', DashboardController::class)->name('dashboard');

	/*
	|--------------------------------------------------------------------------
	| Banks Route
	|--------------------------------------------------------------------------
	*/
	Route::resource('banks', BankController::class)->names('banks');

	/*
	|--------------------------------------------------------------------------
	| Shops Route
	|--------------------------------------------------------------------------
	*/
	Route::resource('shops', ShopController::class)->names('shops');

	/*
    |--------------------------------------------------------------------------
    | Items Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('item')->namespace('Item')->group(__DIR__.'/item.php');
	
	/*
    |--------------------------------------------------------------------------
    | Stocks Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('stock')->namespace('Stock')->group(__DIR__.'/stock.php');

    /*
	|--------------------------------------------------------------------------
	| Purchasing Routes
	|--------------------------------------------------------------------------
	*/
	Route::prefix('purchasing')->namespace('Purchasing')->group(__DIR__.'/purchasing.php');

	/*
	|--------------------------------------------------------------------------
	| Selling Routes
	|--------------------------------------------------------------------------
	*/
	Route::prefix('selling')->namespace('Selling')->group(__DIR__.'/selling.php');

	/*
	|--------------------------------------------------------------------------
	| Production Routes
	|--------------------------------------------------------------------------
	*/
	Route::prefix('production')->namespace('Production')->group(__DIR__.'/production.php');

	/*
	|--------------------------------------------------------------------------
	| Banking Routes
	|--------------------------------------------------------------------------
	*/
	Route::prefix('banking')->namespace('Banking')->group(__DIR__.'/banking.php');

    /*
    |--------------------------------------------------------------------------
    | Configuratioin Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('configuration')->namespace('Configuration')->group(__DIR__.'/configuration.php');
});