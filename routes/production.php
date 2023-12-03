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
| Issue Orders Route
|--------------------------------------------------------------------------
*/
Route::controller(IssueOrderController::class)->prefix('issue-orders')->as('issue-orders.')->group(function () {
	Route::get('index',				'index'	 )->name('index'	);
	Route::get('create',			'create' )->name('create'	);
	Route::post('store',			'store'	 )->name('store'	);
	Route::get('show/{id}',			'show'	 )->name('show'		);
	Route::get('edit/{id}',			'edit'	 )->name('edit'		);
	Route::patch('update/{order}',	'update' )->name('update'	);
	Route::patch('post/{order}', 	'post'	 )->name('post'		);
	Route::delete('delete/{id}',	'destroy')->name('destroy'	);
});

/*
|--------------------------------------------------------------------------
| Issue Order Items Route
|--------------------------------------------------------------------------
*/
Route::controller(IssueOrderItemController::class)->prefix('issue-orders/items')->group(function () {
	Route::post('store',			'store'	  )->name('issue-orders.items.store'   );
	Route::post('check_quantity',	'checkQty')->name('issue-orders.items.checkQty');
	Route::patch('update/{item}',	'update'  )->name('issue-orders.items.update'  );
	Route::delete('delete/{id}',	'destroy' )->name('issue-orders.items.destroy' );
});

/*
|--------------------------------------------------------------------------
| Receive Orders Route
|--------------------------------------------------------------------------
*/
Route::controller(ReceiveOrderController::class)->prefix('receive-orders')->as('receive-orders.')->group(function () {
	Route::get('index',				'index'	 )->name('index'	);
	Route::get('create',			'create' )->name('create'	);
	Route::post('store',			'store'	 )->name('store'	);
	Route::get('show/{id}',			'show'	 )->name('show'		);
	Route::get('edit/{id}',			'edit'	 )->name('edit'		);
	Route::patch('update/{order}',	'update' )->name('update'	);
	Route::patch('post/{order}', 	'post'	 )->name('post'		);
	Route::delete('delete/{id}',	'destroy')->name('destroy'	);
});

/*
|--------------------------------------------------------------------------
| Receive Order Items Route
|--------------------------------------------------------------------------
*/
Route::controller(ReceiveOrderItemController::class)->prefix('receive-orders/items')->group(function () {
	Route::post('store',			'store'	 )->name('receive-orders.items.store'  );
	Route::patch('update/{item}',	'update' )->name('receive-orders.items.update' );
	Route::delete('delete/{id}',	'destroy')->name('receive-orders.items.destroy');
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