<?php

namespace App\Http\Controllers\Selling;
use App\Http\Controllers\Controller;

use App\Models\SalePayment;
use App\Models\Account;
use Illuminate\Http\Request;
use DB;

/**
 * Class SalePaymentController
 * @package App\Http\Controllers
 */
class SalePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:salePayments-list',  ['only' => ['index']]);
        $this->middleware('permission:salePayments-view',  ['only' => ['show']]);
        $this->middleware('permission:salePayments-create',['only' => ['create','store']]);
        $this->middleware('permission:salePayments-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:salePayments-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salePayments = SalePayment::get();

        return view('selling.payment.index', compact('salePayments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salePayment = new SalePayment();
        return view('selling.payment.create', compact('salePayment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salePayment = SalePayment::create($request->all());
        return redirect()->route('sale-payments.index')
            ->with('success', 'Sale Payment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salePayment = SalePayment::find($id);

        return view('selling.payment.show', compact('salePayment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salePayment = SalePayment::find($id);

        return view('selling.payment.edit', compact('salePayment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SalePayment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalePayment $payment)
    {
        $payment->update($request->all());

        return redirect()->route('sale-payments.index')
            ->with('success', 'Sale Payment updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SalePayment $purchasePayment
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, SalePayment $payment)
    {
        DB::transaction(function () use ($payment) {
            $account = Account::whereNotNull('default')->first();
            $transaction = $payment->updateBalance($account->id, $payment->amount, 'Incoming', 'Sale');
            $payment->customer->details()->create([
                'reference' => $transaction->transaction_id,
                'detail'    => 'Payment Received',
                'date'      => date('Y-m-d', $payment->date),
                'type'      => 'Received',
                'amount'    => $payment->amount
            ]);
            $payment->update(['status' => 'Approved']);
        });
        return redirect()->route('sale-payments.index')
            ->with('success', 'Sale Payment approved successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salePayment = SalePayment::find($id)->delete();

        return redirect()->route('sale-payments.index')
            ->with('success', 'Sale Payment deleted successfully.');
    }
}
