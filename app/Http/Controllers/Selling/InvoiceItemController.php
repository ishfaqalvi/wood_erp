<?php

namespace App\Http\Controllers\Selling;
use App\Http\Controllers\Controller;

use App\Models\InvoiceSaleItem;
use App\Models\InvoicePurchaseItem;
use App\Models\PurchaseStock;
use App\Models\SaleStock;
use App\Models\WarehouseDetail;
use Illuminate\Http\Request;

/**
 * Class InvoiceItemController
 * @package App\Http\Controllers
 */
class InvoiceItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->type == 'Fancy') {
            InvoiceSaleItem::create($request->all());   
        }else{
            InvoicePurchaseItem::create($request->all());
        }
        return redirect()->back()->with('success', 'Item added successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  InvoiceItem $invoiceItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->type == 'Fancy') {
            $item = InvoiceSaleItem::find($request->id);   
        }else{
            $item = InvoicePurchaseItem::find($request->id);
        }
        $item->update($request->all());

        return redirect()->back()->with('success', 'Item updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, $id)
    {
        if ($request->type == 'Fancy') {
            $item = InvoiceSaleItem::find($request->id);   
        }else{
            $item = InvoicePurchaseItem::find($request->id);
        }
        $item->delete();

        return redirect()->back()->with('success', 'Item removed successfully.');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkQty(Request $request)
    {
        if($request->type == 'Purchase'){
            $item = PurchaseStock::find($request->item_id);
        }else{
            $item = WarehouseDetail::where([['warehouse_id',$request->warehouse_id],['sale_item_id',$request->item_id]])->first();
        }
        if ($item && $item->quantity >= $request->quantity) { echo "true"; }else{ echo "false"; }
    }
}