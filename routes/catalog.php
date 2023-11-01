<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Banks Route
|--------------------------------------------------------------------------
*/
Route::resource('banks', 'BankController')->names('banks');