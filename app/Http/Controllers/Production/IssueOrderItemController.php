<?php

namespace App\Http\Controllers\Production;
use App\Http\Controllers\Controller;

use App\Models\IssueOrderItem;
use App\Models\PurchaseStock;
use Illuminate\Http\Request;

/**
 * Class IssueOrderItemController
 * @package App\Http\Controllers
 */
class IssueOrderItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        IssueOrderItem::create($request->all());
        return redirect()->back()->with('success', 'Item added successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        IssueOrderItem::find($id)->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkQty(Request $request)
    {
        $item = PurchaseStock::where('id',$request->stock_id)->first();
        if ($item->quantity >= $request->quantity) { echo "true"; }else{ echo "false"; }
    }
}
