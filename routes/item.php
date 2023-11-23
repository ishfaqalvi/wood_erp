<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Purchase Itmes Route
|--------------------------------------------------------------------------
*/
Route::resource('purchase-items', 'PurchaseItemController')->names('purchase-items');

/*
|--------------------------------------------------------------------------
| Sale Items Route
|--------------------------------------------------------------------------
*/
Route::resource('sale-items', 'SaleItemController')->names('sale-items');