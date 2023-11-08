<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Accounts Route
|--------------------------------------------------------------------------
*/
Route::resource('purchase-items', 'PurchaseItemController')->names('purchase-items');