<?php

namespace App\Http\Controllers\Stock;
use App\Http\Controllers\Controller;

use App\Models\SaleStock;
use Illuminate\Http\Request;

/**
 * Class SaleStockController
 * @package App\Http\Controllers
 */
class SaleStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:saleStocks-list',  ['only' => ['index']]);
        $this->middleware('permission:saleStocks-view',  ['only' => ['show']]);
        $this->middleware('permission:saleStocks-create',['only' => ['create','store']]);
        $this->middleware('permission:saleStocks-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:saleStocks-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saleStocks = SaleStock::get();

        return view('stock.sale.index', compact('saleStocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $saleStock = new SaleStock();
        return view('stock.sale.create', compact('saleStock'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkItem = SaleStock::where('sale_item_id', $request->sale_item_id)->first();
        if ($checkItem) {
            $checkItem->increment('quantity',$request->quantity);
        }else{
            $purchaseStock = SaleStock::create($request->all());
        }
        return redirect()->route('sale-stocks.index')
            ->with('success', 'SaleStock item added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saleStock = SaleStock::find($id);

        return view('sale-stock.show', compact('saleStock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saleStock = SaleStock::find($id);

        return view('sale-stock.edit', compact('saleStock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SaleStock $saleStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleStock $saleStock)
    {
        $saleStock->update($request->all());

        return redirect()->route('sale-stocks.index')
            ->with('success', 'SaleStock updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $saleStock = SaleStock::find($id)->delete();

        return redirect()->route('sale-stocks.index')
            ->with('success', 'SaleStock deleted successfully');
    }
}
