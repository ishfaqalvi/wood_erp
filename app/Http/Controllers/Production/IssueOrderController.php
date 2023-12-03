<?php

namespace App\Http\Controllers\Production;
use App\Http\Controllers\Controller;

use App\Models\IssueOrder;
use App\Models\IssueOrderItem;
use App\Models\PurchaseStock;
use Illuminate\Http\Request;
use DB;

/**
 * Class IssueOrderController
 * @package App\Http\Controllers
 */
class IssueOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:issueOrders-list',  ['only' => ['index']]);
        $this->middleware('permission:issueOrders-view',  ['only' => ['show']]);
        $this->middleware('permission:issueOrders-create',['only' => ['create','store']]);
        $this->middleware('permission:issueOrders-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:issueOrders-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issueOrders = IssueOrder::orderBy('id','DESC')->get();

        return view('production.issue-order.index', compact('issueOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $issueOrder = new IssueOrder();
        return view('production.issue-order.create', compact('issueOrder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $issueOrder = IssueOrder::create($request->all());
        return redirect()->route('issue-orders.index')
            ->with('success', 'IssueOrder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $issueOrder = IssueOrder::find($id);
        $ids   = IssueOrderItem::where('order_id',$id)->pluck('purchase_stock_id')->toArray();
        $items = PurchaseStock::whereNotIn('id',$ids)->where('quantity', '>', 0)->get()->mapWithKeys(function ($item, $key) {
            $string = "{$item->name} ( L={$item->length} W={$item->width} T={$item->thikness} )";
            return [$item->id => $string];
        })->toArray();

        return view('production.issue-order.show', compact('issueOrder','items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $issueOrder = IssueOrder::find($id);

        return view('production.issue-order.edit', compact('issueOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  IssueOrder $issueOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IssueOrder $order)
    {
        $order->update($request->all());

        return redirect()->route('issue-orders.index')
            ->with('success', 'IssueOrder updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  IssueOrder $issueOrder
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request, IssueOrder $order)
    {
        DB::transaction(function () use ($order) {
            $order->purchaseStockOut();
            $order->update(['status' => 'Posted']);
        });
        return redirect()->back()->with('success', 'Issue Order posted successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $issueOrder = IssueOrder::find($id)->delete();

        return redirect()->route('issue-orders.index')
            ->with('success', 'IssueOrder deleted successfully');
    }
}
