<?php

namespace App\Http\Controllers;

use App\Models\invoices_details;
use App\Models\invoices;
use App\Models\invoice_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice = invoices::where('id', $id)->first();
        $invoices_details = invoices_details::where('id_Invoice', $id)->get();
        $attachments = invoice_attachments::where('invoice_id', $id)->get();

        return view('invoices.details_invoices', compact('invoice', 'invoices_details',  'attachments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $attachment = invoice_attachments::find($id);
        if ($attachment) {
            Storage::disk('public_upload')->delete($attachment->invoice_number . '/' . $attachment->file_name);
            $attachment->delete();

            return redirect()->back()->with('success', 'تم حذف الملف بنجاح');
        }
        return redirect()->back()->with('error', 'لم يتم العثور على الملف');
    }

}
