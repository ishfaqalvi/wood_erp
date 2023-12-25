<?php

namespace App\Traits;

use App\Models\PurchaseDetail;
use App\Models\PurchaseStock;
use App\Models\SaleDetail;
use App\Models\SaleStock;
use App\Models\Warehouse;
use App\Models\WarehouseDetail;

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
            $checkItem = PurchaseStock::where([['name', $item->name],['length', $item->length],['width', $item->width],['thikness', $item->thikness]])->first();
            if ($checkItem) {
                $checkItem->increment('quantity',$item->quantity);
            }else{
                PurchaseStock::create([
                    'name' => $item->name,
                    'length' => $item->length,
                    'width' => $item->width,
                    'thikness' => $item->thikness,
                    'quantity' => $item->quantity
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
    public function purchaseStockOut()
    {
        foreach($this->items as $item)
        {
            PurchaseStock::find($item->purchase_stock_id)->decrement('quantity',$item->quantity);
            $this->shop->details()->create([
                'purchase_stock_id' => $item->purchase_stock_id,
                'date'        => date('m-d-Y', $this->date),         
                'quantity'    => $item->quantity
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function saleStockIn()
    {
        foreach($this->items as $item)
        {
            SaleDetail::create([
                'sale_item_id'=> $item->sale_item_id,
                'type'        => 'In',
                'date'        => date('Y-m-d', $this->date),         
                'quantity'    => $item->quantity
            ]);
            $checkItem = SaleStock::where('sale_item_id', $item->sale_item_id)->first();
            if ($checkItem) {
                $checkItem->increment('quantity',$item->quantity);
            }else{
                SaleStock::create([
                    'sale_item_id' => $item->sale_item_id, 'quantity' => $item->quantity
                ]);
            }
            $checkWarehouseItem = WarehouseDetail::where([['warehouse_id',$this->warehouse_id],['sale_item_id',$this->sale_item_id]])->first();
            if ($checkWarehouseItem) {
                $checkWarehouseItem->increment('quantity',$item->quantity);
            }else{
                $this->warehouse->details()->create([
                    'sale_item_id' => $item->sale_item_id,
                    'quantity'    => $item->quantity
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
    public function returnSaleStockIn()
    {
        foreach($this->saleItems as $item)
        {
            SaleDetail::create([
                'sale_item_id'=> $item->sale_item_id,
                'type'        => 'In',
                'date'        => date('Y-m-d', $this->date),         
                'quantity'    => $item->quantity
            ]);
            $checkItem = SaleStock::where('sale_item_id', $item->sale_item_id)->first();
            if ($checkItem) {
                $checkItem->increment('quantity',$item->quantity);
            }else{
                SaleStock::create([
                    'sale_item_id' => $item->sale_item_id, 'quantity' => $item->quantity
                ]);
            }
            $checkWarehouseItem = WarehouseDetail::where([['warehouse_id',$item->warehouse_id],['sale_item_id',$item->sale_item_id]])->first();
            if ($checkWarehouseItem) {
                $checkWarehouseItem->increment('quantity',$item->quantity);
            }else{
                WarehouseDetail::create([
                    'warehouse_id' => $item->warehouse_id,
                    'sale_item_id' => $item->sale_item_id,
                    'quantity'    => $item->quantity
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
            $warehouseItme = $item->warehouse->details()->where('sale_item_id',$item->sale_item_id)->first();
            if ($warehouseItme) {
                $warehouseItme->decrement('quantity',$item->quantity);
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
            PurchaseStock::find($item->purchase_stock_id)->decrement('quantity',$item->quantity);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function purchaseStockReturn($invoice)
    {
        foreach($invoice->purchaseItems as $item)
        {
            PurchaseStock::find($item->purchase_stock_id)->increment('quantity',$item->quantity);
        }
    }
}