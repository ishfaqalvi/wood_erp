<?php

namespace App\Traits;

use App\Models\PurchaseDetail;
use App\Models\PurchaseStock;
use App\Models\SaleDetail;
use App\Models\SaleStock;

trait StockTransactions {

	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function purchaseStockIn($bill)
    {
        foreach($bill->billItems as $item)
        {
            PurchaseDetail::create([
                'purchase_item_id'=> $item->purchase_item_id,
                'type'            => 'In',
                'date'            => date('Y-m-d', $bill->bill_date),         
                'quantity'        => $item->quantity
            ]);
            $checkItem = PurchaseStock::where('purchase_item_id', $item->purchase_item_id)->first();
            if ($checkItem) {
                $checkItem->increment('quantity',$item->quantity);
            }else{
                PurchaseStock::create([
                    'purchase_item_id' => $item->purchase_item_id, 'quantity' => $item->quantity
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function purchaseStockOut($order)
    {
        foreach($order->issueItems as $item)
        {
            PurchaseDetail::create([
                'purchase_item_id'=> $item->purchase_item_id,
                'type'            => 'Out',
                'date'            => date('Y-m-d', $order->issue_date),         
                'quantity'        => $item->quantity
            ]);
            $checkItem = PurchaseStock::where('purchase_item_id', $item->purchase_item_id)->first();
            if ($checkItem) {
                $checkItem->decrement('quantity',$item->quantity);
            }else{
                PurchaseStock::create([
                    'purchase_item_id' => $item->purchase_item_id, 'quantity' => -($item->quantity)
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function saleStockIn($order)
    {
        foreach($order->receiveItems as $item)
        {
            SaleDetail::create([
                'sale_item_id'=> $item->sale_item_id,
                'type'        => 'In',
                'date'        => date('Y-m-d', $order->receive_date),         
                'quantity'    => $item->product_quantity
            ]);
            $checkItem = SaleStock::where('sale_item_id', $item->sale_item_id)->first();
            if ($checkItem) {
                $checkItem->increment('quantity',$item->product_quantity);
            }else{
                SaleStock::create([
                    'sale_item_id' => $item->sale_item_id, 'quantity' => $item->product_quantity
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function saleStockOut($invoice)
    {
        foreach($invoice->saleItems as $item)
        {
            SaleDetail::create([
                'sale_item_id'=> $item->sale_item_id,
                'type'        => 'Out',
                'date'        => date('Y-m-d', $invoice->invoice_date),         
                'quantity'    => $item->quantity
            ]);
            $checkItem = SaleStock::where('sale_item_id', $item->sale_item_id)->first();
            if ($checkItem) {
                $checkItem->decrement('quantity',$item->quantity);
            }else{
                SaleStock::create([
                    'sale_item_id' => $item->sale_item_id, 'quantity' => -($item->quantity)
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function purchaseStockRemove($invoice)
    {
        foreach($invoice->purchaseItems as $item)
        {
            PurchaseDetail::create([
                'purchase_item_id'=> $item->purchase_item_id,
                'type'            => 'Out',
                'date'            => date('Y-m-d', $invoice->invoice_date),         
                'quantity'        => $item->quantity
            ]);
            $checkItem = PurchaseStock::where('purchase_item_id', $item->purchase_item_id)->first();
            if ($checkItem) {
                $checkItem->decrement('quantity',$item->quantity);
            }else{
                PurchaseStock::create([
                    'purchase_item_id' => $item->purchase_item_id, 'quantity' => -($item->quantity)
                ]);
            }
        }
    }
}