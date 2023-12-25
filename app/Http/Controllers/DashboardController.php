<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Worker;
use App\Models\Customer;
use App\Models\VendorDetail;
use App\Models\WorkerDetail;
use App\Models\CustomerDetail;
use App\Models\Account;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data['vendors'] = Vendor::count();
        $data['workers'] = Worker::count();
        $data['customers'] = Customer::count();
        
        $vendorReceived = VendorDetail::whereType('Received')->sum('amount');
        $vendorPaid = VendorDetail::whereType('Paid')->sum('amount');
        $data['vendorBalance'] = $vendorReceived - $vendorPaid;
        
        $workerReceived = WorkerDetail::whereType('Received')->sum('amount');
        $workerPaid = WorkerDetail::whereType('Paid')->sum('amount');
        $data['workerBalance'] = $workerPaid - $workerReceived;
        
        $customerReceived = CustomerDetail::whereType('Received')->sum('amount');
        $customerPaid = CustomerDetail::whereType('Paid')->sum('amount');
        $data['customerBalance'] = $customerPaid - $customerReceived;

        $data['accounts'] = Account::whereNull('default')->count();
        $data['accountBalance'] = Account::whereNull('default')->sum('balance');
        $data['defaultAccountBalance'] = Account::whereNotNull('default')->sum('balance');

        return view('dashboard', compact('data'));
    }
}
