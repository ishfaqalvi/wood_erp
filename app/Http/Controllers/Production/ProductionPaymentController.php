<?php

namespace App\Http\Controllers\Production;
use App\Http\Controllers\Controller;

use App\Models\ProductionPayment;
use App\Models\Account;
use Illuminate\Http\Request;
use DB;

/**
 * Class ProductionPaymentController
 * @package App\Http\Controllers
 */
class ProductionPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:productionPayments-list',  ['only' => ['index']]);
        $this->middleware('permission:productionPayments-view',  ['only' => ['show']]);
        $this->middleware('permission:productionPayments-create',['only' => ['create','store']]);
        $this->middleware('permission:productionPayments-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:productionPayments-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productionPayments = ProductionPayment::get();

        return view('production.payment.index', compact('productionPayments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productionPayment = new ProductionPayment();
        return view('production.payment.create', compact('productionPayment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $productionPayment = ProductionPayment::create($request->all());
        return redirect()->route('production-payments.index')
            ->with('success', 'Production Payment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productionPayment = ProductionPayment::find($id);

        return view('production.payment.show', compact('productionPayment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productionPayment = ProductionPayment::find($id);

        return view('production.payment.edit', compact('productionPayment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProductionPayment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductionPayment $payment)
    {
        $payment->update($request->all());

        return redirect()->route('production-payments.index')
            ->with('success', 'Production Payment updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProductionPayment $purchasePayment
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, ProductionPayment $payment)
    {
        DB::transaction(function () use ($payment) {
            $account = Account::whereNotNull('default')->first();
            $transaction = $payment->updateBalance($account->id, $payment->amount, 'Outgoing', 'Production');
            $payment->worker->details()->create([
                'reference' => $transaction->transaction_id,
                'detail'    => 'Payment Paid',
                'date'      => date('Y-m-d', $payment->date),
                'type'      => 'Paid',
                'amount'    => $payment->amount
            ]);
            $payment->update(['status' => 'Approved']);
        });
        return redirect()->route('production-payments.index')
            ->with('success', 'Production Payment approved successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $productionPayment = ProductionPayment::find($id)->delete();

        return redirect()->route('production-payments.index')
            ->with('success', 'Production Payment deleted successfully.');
    }
}
