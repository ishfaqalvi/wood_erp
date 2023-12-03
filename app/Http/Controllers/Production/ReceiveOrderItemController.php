<?php

namespace App\Http\Controllers\Production;
use App\Http\Controllers\Controller;

use App\Models\ReceiveOrderItem;
use Illuminate\Http\Request;

/**
 * Class ReceiveOrderItemController
 * @package App\Http\Controllers
 */
class ReceiveOrderItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $receiveOrderItem = ReceiveOrderItem::create($request->all());
        return redirect()->back()->with('success', 'Item added successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        ReceiveOrderItem::find($id)->delete();

        return redirect()->back()->with('success', 'Item removed successfully.');
    }
}
