<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\VendorDetail;
use Illuminate\Http\Request;

/**
 * Class VendorDetailController
 * @package App\Http\Controllers
 */
class VendorDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:vendorDetails-list',  ['only' => ['index']]);
        $this->middleware('permission:vendorDetails-view',  ['only' => ['show']]);
        $this->middleware('permission:vendorDetails-create',['only' => ['create','store']]);
        $this->middleware('permission:vendorDetails-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:vendorDetails-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendorDetails = VendorDetail::get();

        return view('admin.vendor-detail.index', compact('vendorDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendorDetail = new VendorDetail();
        return view('admin.vendor-detail.create', compact('vendorDetail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $vendorDetail = VendorDetail::create($request->all());
        return redirect()->route('vendor-details.index')
            ->with('success', 'VendorDetail created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendorDetail = VendorDetail::find($id);

        return view('admin.vendor-detail.show', compact('vendorDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendorDetail = VendorDetail::find($id);

        return view('admin.vendor-detail.edit', compact('vendorDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  VendorDetail $vendorDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorDetail $vendorDetail)
    {
        $vendorDetail->update($request->all());

        return redirect()->route('vendor-details.index')
            ->with('success', 'VendorDetail updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $vendorDetail = VendorDetail::find($id)->delete();

        return redirect()->route('vendor-details.index')
            ->with('success', 'VendorDetail deleted successfully');
    }
}
