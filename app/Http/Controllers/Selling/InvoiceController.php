<?php

namespace App\Http\Controllers\Selling;
use App\Http\Controllers\Controller;

use App\Models\Invoice;
use App\Models\SaleItem;
use App\Models\PurchaseItem;
use App\Models\InvoiceSaleItem;
use App\Models\InvoicePurchaseItem;
use App\Models\PurchaseStock;
use Illuminate\Http\Request;
use DB;

/**
 * Class InvoiceController
 * @package App\Http\Controllers
 */
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:invoices-list',  ['only' => ['index']]);
        $this->middleware('permission:invoices-view',  ['only' => ['show']]);
        $this->middleware('permission:invoices-create',['only' => ['create','store']]);
        $this->middleware('permission:invoices-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:invoices-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::latest('id')->get();

        return view('selling.invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoice = new Invoice();
        return view('selling.invoice.create', compact('invoice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $invoice = Invoice::create($request->all());
        return redirect()->route('invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);
        if ($invoice->type == 'Fancy') {
            $view = 'selling.invoice.sale-item.index';
            $ids = InvoiceSaleItem::where('invoice_id',$id)->pluck('sale_item_id')->toArray();
            $items = SaleItem::whereNotIn('id',$ids)->pluck('name','id');
        }else{
            $view = 'selling.invoice.purchase-item.index';
            $ids = InvoicePurchaseItem::where('invoice_id',$id)->pluck('purchase_stock_id')->toArray();
            if ($invoice->return == 'Yes') {
                $items = PurchaseStock::whereNotIn('id',$ids)->get()->mapWithKeys(function ($item, $key) {
                    $string = "{$item->name} ( L={$item->length} W={$item->width} T={$item->thikness} )";
                    return [$item->id => $string];
                })->toArray();
            }else{
                $items = PurchaseStock::whereNotIn('id',$ids)->where('quantity','>',0)->get()->mapWithKeys(function ($item, $key) {
                    $string = "{$item->name} ( L={$item->length} W={$item->width} T={$item->thikness} )";
                    return [$item->id => $string];
                })->toArray();
            } 
        }
        return view($view, compact('invoice','items'));
    }

    /**
     * Print the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $invoice = Invoice::find($id);
        return view('selling.invoice.print', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::find($id);

        return view('selling.invoice.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update($request->all());

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request, Invoice $invoice)
    {
        DB::transaction(function () use ($invoice) {
            if ($invoice->return == 'Yes') {
                $invoice->customer->details()->create([
                    'reference' => $invoice->invoice_number,
                    'detail'    => "Return Invoice Posted",
                    'date'      => date('Y-m-d', $invoice->invoice_date),
                    'type'      => "Received",
                    'amount'    => $invoice->calculateTotalAmount()
                ]);
                $invoice->type == 'Fancy'?$invoice->returnSaleStockIn():$invoice->purchaseStockReturn($invoice);
            }else{
                $invoice->customer->details()->create([
                    'reference' => $invoice->invoice_number,
                    'detail'    => "Invoice Posted",
                    'date'      => date('Y-m-d', $invoice->invoice_date),
                    'type'      => "Paid",
                    'amount'    => $invoice->calculateTotalAmount()
                ]);
                $invoice->type == 'Fancy'?$invoice->saleStockOut($invoice):$invoice->purchaseStockRemove($invoice);
            }
            $invoice->update(['status' => 'Posted']);
        });

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice Posted successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id)->delete();

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice deleted successfully');
    }
}
