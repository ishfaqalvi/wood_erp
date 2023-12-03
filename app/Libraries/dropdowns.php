<?php

use App\Models\Bank;
use App\Models\Shop;
use App\Models\Warehouse;
use App\Models\Account;
use App\Models\Vendor;
use App\Models\Customer;
use App\Models\Worker;
use App\Models\PurchaseItem;
use App\Models\SaleItem;

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function banks()
{
    return Bank::pluck('title','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function shops()
{
    return Shop::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function warehouses()
{
    return Warehouse::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function accounts()
{
    return Account::pluck('title','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function vendors()
{
    return Vendor::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function customers()
{
    return Customer::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function workers()
{
    return Worker::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function purchaseItems()
{
    $items = PurchaseItem::all()->mapWithKeys(function ($item, $key) {
        $string = "{$item->name} ( L={$item->length} W={$item->width} T={$item->thikness} )";
        return [$item->id => $string];
    })->toArray();
    
    return $items;
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function saleItems()
{
    return SaleItem::pluck('name','id');
}