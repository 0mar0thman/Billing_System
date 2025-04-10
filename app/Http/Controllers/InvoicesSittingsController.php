<?php

namespace App\Http\Controllers;

use App\Models\invoices_sittings;
use Illuminate\Http\Request;

class InvoicesSittingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $SittingsInvoices = invoices_sittings::all();
        return view('invoices.sittings_invoices' , compact('SittingsInvoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        invoices_sittings::create([
            'Discount_Commission' => $request->Discount_Commission,
            'Amount_Commission' => $request->Amount_Commission,
            'Amount_collection' => $request->Amount_collection,
            // 'Amount_collection' => Auth::user()->name,
        ]);
        // session()->flash('Add' , 'تم اضافة المنتج بنجاح') ;
        return redirect(route('invoices.create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(invoices_sittings $SittingsInvoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invoices_sittings $SittingsInvoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices_sittings $SittingsInvoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invoices_sittings $SittingsInvoices)
    {
        //
    }
}
