<?php

namespace App\Http\Controllers;

use App\Models\sections;
use App\Models\invoices;
use App\Models\invoices_details;
use App\Models\invoice_attachments;
use App\Models\invoices_sittings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = invoices::all();
        return view('invoices.invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $SittingsInvoices = invoices_sittings::all();
        $invoices = invoices::all();
        $sections = sections::all();
        return view('invoices.add_invoice', compact('sections', 'invoices', 'SittingsInvoices'));
    }

    public function store(Request $request)
    {
        // التحقق من البيانات المدخلة
        $validator = Validator::make(
            $request->all(),
            [
                'invoice_number' => 'required|unique:invoices,invoice_number',
                'invoice_Date' => 'required|date',
                'Due_date' => 'required|date|after_or_equal:invoice_Date',
                'product' => 'required|string|max:255',
                'Section' => 'required|exists:sections,id',
                'Amount_collection' => 'required|numeric|min:0',
                'Amount_Commission' => 'required|numeric|min:0',
                'Discount_Commission' => 'nullable|numeric|min:0',
                'Total' => 'required|numeric|min:0',
                'note' => 'nullable|string|max:255',
                'pic' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:2048', // التحقق من صورة
            ],
            [
                'invoice_number.required' => 'رقم الفاتورة مطلوب',
                'invoice_number.unique' => 'رقم الفاتورة مستخدم من قبل',

                'invoice_Date.required' => 'تاريخ الفاتورة مطلوب',
                'invoice_Date.date' => 'تاريخ الفاتورة غير صالح',

                'Due_date.required' => 'تاريخ الاستحقاق مطلوب',
                'Due_date.after_or_equal' => 'تاريخ الاستحقاق يجب أن يكون بعد أو يساوي تاريخ الفاتورة',

                'product.required' => 'اسم المنتج مطلوب',
                'product.max' => 'اسم المنتج طويل جداً',

                'Section.required' => 'القسم مطلوب',
                'Section.exists' => 'القسم غير موجود في النظام',

                'Amount_collection.required' => 'مبلغ التحصيل مطلوب',
                'Amount_collection.numeric' => 'مبلغ التحصيل يجب أن يكون رقماً',

                'Amount_Commission.required' => 'مبلغ العمولة مطلوب',
                'Amount_Commission.numeric' => 'مبلغ العمولة يجب أن يكون رقماً',

                'Discount_Commission.numeric' => 'الخصم يجب أن يكون رقماً',

                'Value_VAT.required' => 'قيمة الضريبة مطلوبة',
                'Value_VAT.numeric' => 'قيمة الضريبة يجب أن تكون رقماً',

                'Total.required' => 'الإجمالي مطلوب',
                'Total.numeric' => 'الإجمالي يجب أن يكون رقماً',

                'note.max' => 'الملاحظة طويلة جداً',


                'pic.mimes' => 'امتداد الملف يجب أن يكون: jpeg، png، jpg، gif، pdf',
                'pic.max' => 'حجم الملف لا يجب أن يتعدى 2 ميجابايت',
            ]
        );

        // إذا كانت البيانات غير صحيحة، عرض الأخطاء
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // إضافة الفاتورة
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount_Commission' => $request->Discount_Commission,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT ?? 0,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return back();
    }



    /**
     * Display the specified resource.
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invoices $invoices)
    {
        return view('invoices.sittings_invoices');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices $invoices) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invoices $invoices)
    {
        //
    }

    // public function getproducts($id)
    // {
    //     $products = DB::table('products')->where('section_id', '=', $id)->pluck('product_name', 'id');
    //     return json_encode($products);
    // }

    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");

        return response()->json($products);
    }
}
