<?php

use App\Models\Bank;
use App\Models\Account;
use App\Models\Vendor;
use App\Models\PurchaseItem;

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
function purchaseItems()
{
    $items = PurchaseItem::all()->mapWithKeys(function ($item, $key) {
        $string = "{$item->name} ( L={$item->length} W={$item->width} T={$item->thikness} )";
        return [$item->id => $string];
    })->toArray();
    
    return $items;
}