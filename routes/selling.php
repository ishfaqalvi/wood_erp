<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Accounts Route
|--------------------------------------------------------------------------
*/
Route::resource('customers',     'CustomerController')->names('customers');

/*
|--------------------------------------------------------------------------
| Bills Route
|--------------------------------------------------------------------------
*/
Route::controller(InvoiceController::class)->prefix('invoices')->as('invoices.')->group(function () {
	Route::get('index',				 'index'  )->name('index'	);
	Route::get('create',			 'create' )->name('create'	);
	Route::post('store',			 'store'  )->name('store'	);
	Route::get('show/{id}',			 'show'	  )->name('show'	);
	Route::get('print/{id}',		 'print'  )->name('print'	);
	Route::get('edit/{id}',			 'edit'	  )->name('edit'	);
	Route::patch('update/{invoice}', 'update' )->name('update'	);
	Route::patch('publish/{invoice}','publish')->name('publish'	);
	Route::delete('delete/{id}',	 'destroy')->name('destroy'	);
});

/*
|--------------------------------------------------------------------------
| Bill Items Route
|--------------------------------------------------------------------------
*/
Route::controller(InvoiceItemController::class)->prefix('invoice/items')->group(function () {
	Route::post('store',			'store'	  )->name('invoice.items.store'	  );
	Route::post('check_quantity',	'checkQty')->name('invoice.items.checkQty');
	Route::post('update',			'update'  )->name('invoice.items.update'  );
	Route::delete('delete/{id}',	'destroy' )->name('invoice.items.destroy' );
});

/*
|--------------------------------------------------------------------------
| Payments Route
|--------------------------------------------------------------------------
*/
Route::controller(SalePaymentController::class)->prefix('sale-payments')->as('sale-payments.')->group(function () {
	Route::get('index',				 'index'  )->name('index'	);
	Route::get('create',			 'create' )->name('create'	);
	Route::post('store',			 'store'  )->name('store'	);
	Route::get('show/{id}',			 'show'	  )->name('show'	);
	Route::get('edit/{id}',			 'edit'	  )->name('edit'	);
	Route::patch('update/{payment}', 'update' )->name('update'	);
	Route::patch('approve/{payment}','approve')->name('approve'	);
	Route::delete('delete/{id}',	 'destroy')->name('destroy'	);
});