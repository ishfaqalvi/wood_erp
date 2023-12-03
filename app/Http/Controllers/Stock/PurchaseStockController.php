<?php

namespace App\Http\Controllers\Stock;
use App\Http\Controllers\Controller;

use App\Models\PurchaseStock;
use Illuminate\Http\Request;

/**
 * Class PurchaseStockController
 * @package App\Http\Controllers
 */
class PurchaseStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:purchaseStocks-list',  ['only' => ['index']]);
        $this->middleware('permission:purchaseStocks-view',  ['only' => ['show']]);
        $this->middleware('permission:purchaseStocks-create',['only' => ['create','store']]);
        $this->middleware('permission:purchaseStocks-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:purchaseStocks-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseStocks = PurchaseStock::latest('id')->get();

        return view('stock.purchase.index', compact('purchaseStocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchaseStock = new PurchaseStock();
        return view('stock.purchase.create', compact('purchaseStock'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkItem = PurchaseStock::where('name', $request->name)
             ->where('length', $request->length)
             ->where('width', $request->width)
             ->where('thikness', $request->thikness)
             ->first();
        if ($checkItem) {
            $checkItem->increment('quantity',$request->quantity);
        }else{
            $purchaseStock = PurchaseStock::create($request->all());
        }
        return redirect()->route('purchase-stocks.index')
            ->with('success', 'PurchaseStock quantity added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseStock = PurchaseStock::find($id);

        return view('stock.purchase.show', compact('purchaseStock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchaseStock = PurchaseStock::find($id);

        return view('stock.purchase.edit', compact('purchaseStock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PurchaseStock $purchaseStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseStock $purchaseStock)
    {
        $purchaseStock->update($request->all());

        return redirect()->route('purchase-stocks.index')
            ->with('success', 'PurchaseStock updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $purchaseStock = PurchaseStock::find($id)->delete();

        return redirect()->route('purchase-stocks.index')
            ->with('success', 'PurchaseStock deleted successfully');
    }
}
