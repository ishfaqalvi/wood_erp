<?php

namespace App\Http\Controllers\Production;
use App\Http\Controllers\Controller;

use App\Models\ReceiveOrder;
use App\Models\ReceiveOrderItem;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use DB;

/**
 * Class ReceiveOrderController
 * @package App\Http\Controllers
 */
class ReceiveOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:receiveOrders-list',  ['only' => ['index']]);
        $this->middleware('permission:receiveOrders-view',  ['only' => ['show']]);
        $this->middleware('permission:receiveOrders-create',['only' => ['create','store']]);
        $this->middleware('permission:receiveOrders-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:receiveOrders-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receiveOrders = ReceiveOrder::orderBy('id','DESC')->get();

        return view('production.receive-order.index', compact('receiveOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $receiveOrder = new ReceiveOrder();
        return view('production.receive-order.create', compact('receiveOrder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $receiveOrder = ReceiveOrder::create($request->all());
        return redirect()->route('receive-orders.index')
            ->with('success', 'ReceiveOrder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receiveOrder = ReceiveOrder::find($id);
        $ids = ReceiveOrderItem::where('order_id',$id)->pluck('sale_item_id')->toArray();
        $items = SaleItem::whereNotIn('id',$ids)->pluck('name','id');

        return view('production.receive-order.show', compact('receiveOrder','items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $receiveOrder = ReceiveOrder::find($id);

        return view('production.receive-order.edit', compact('receiveOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ReceiveOrder $receiveOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReceiveOrder $order)
    {
        $order->update($request->all());

        return redirect()->route('receive-orders.index')
            ->with('success', 'ReceiveOrder updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  IssueOrder $issueOrder
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request, ReceiveOrder $order)
    {
        DB::transaction(function () use ($order) {
            $order->worker->details()->create([
                'reference' => $order->order_number,
                'detail'    => "Order Received",
                'date'      => date('Y-m-d', $order->date),
                'type'      => "Received",
                'amount'    => $order->calculateTotalAmount()
            ]);
            $order->saleStockIn();
            $order->update(['status' => 'Posted']);
        });
        return redirect()->back()->with('success', 'Receive Order posted successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $receiveOrder = ReceiveOrder::find($id)->delete();

        return redirect()->route('receive-orders.index')
            ->with('success', 'ReceiveOrder deleted successfully');
    }
}
