<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Accounts Route
|--------------------------------------------------------------------------
*/
Route::resource('workers',     'WorkerController')->names('workers');

/*
|--------------------------------------------------------------------------
| Orders Route
|--------------------------------------------------------------------------
*/
Route::controller(OrderController::class)->prefix('orders')->as('orders.')->group(function () {
	Route::get('index',				'index'	 )->name('index'	);
	Route::get('create',			'create' )->name('create'	);
	Route::post('store',			'store'	 )->name('store'	);
	Route::get('show/{id}',			'show'	 )->name('show'		);
	Route::get('edit/{id}',			'edit'	 )->name('edit'		);
	Route::patch('update/{order}',	'update' )->name('update'	);
	Route::patch('post/{order}', 	'post'	 )->name('post'		);
	Route::patch('receive/{order}', 'receive')->name('receive'	);
	Route::delete('delete/{id}',	'destroy')->name('destroy'	);
});

/*
|--------------------------------------------------------------------------
| Order Issue Items Route
|--------------------------------------------------------------------------
*/
Route::controller(OrderIssueItemController::class)->prefix('orders/issue/items')->group(function () {
	Route::get('index/{id}',		'index'	 	)->name('order.issue.items.index'	);
	Route::post('store',			'store'	 	)->name('order.issue.items.store'	);
	Route::post('check_quantity',	'checkQty'	)->name('order.issue.items.checkQty');
	Route::patch('update/{item}',	'update' 	)->name('order.issue.items.update'	);
	Route::delete('delete/{id}',	'destroy'	)->name('order.issue.items.destroy' );
});

/*
|--------------------------------------------------------------------------
| Order Issue Items Route
|--------------------------------------------------------------------------
*/
Route::controller(OrderReceiveItemController::class)->prefix('orders/receive/items')->group(function () {
	Route::get('index/{id}',		'index'	 )->name('order.receive.items.index'  );
	Route::post('store',			'store'	 )->name('order.receive.items.store'  );
	Route::patch('update/{item}',	'update' )->name('order.receive.items.update' );
	Route::delete('delete/{id}',	'destroy')->name('order.receive.items.destroy');
});

/*
|--------------------------------------------------------------------------
| Payments Route
|--------------------------------------------------------------------------
*/
Route::controller(ProductionPaymentController::class)->prefix('production-payments')->as('production-payments.')->group(function () {
	Route::get('index',				 'index'  )->name('index'	);
	Route::get('create',			 'create' )->name('create'	);
	Route::post('store',			 'store'  )->name('store'	);
	Route::get('show/{id}',			 'show'	  )->name('show'	);
	Route::get('edit/{id}',			 'edit'	  )->name('edit'	);
	Route::patch('update/{payment}', 'update' )->name('update'	);
	Route::patch('approve/{payment}','approve')->name('approve'	);
	Route::delete('delete/{id}',	 'destroy')->name('destroy'	);
});