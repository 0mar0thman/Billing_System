@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    تعديل فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تعديل فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ url('invoices/update') }}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input type="hidden" name="invoice_id" value="{{ $invoices->id }}">
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" value="{{ $invoices->invoice_number }}" required>
                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoices->invoice_Date }}" required>
                            </div>

                            <div class="col">
                                <label>تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoices->Due_date }}" required>
                            </div>
                        </div>

                        {{-- 2 --}}
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputName" class="control-label">اسم البنك</label>
                                <select name="Section" class="form-control SlectBox" id="Section">
                                    <option value="{{ $invoices->section->id }}" selected>
                                        {{ $invoices->section->section_name }}</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">اسم العميل</label>
                                <select id="product" name="product" class="form-control">
                                    <option value="{{ $invoices->product }}">{{ $invoices->product }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input type="text" class="form-control" id="Amount_collection" name="Amount_collection"
                                    oninput="calculateCommissionAndVAT()" value="{{ $invoices->Amount_collection }}"
                                    required>
                            </div>
                        </div>

                        {{-- 3 --}}
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ العمولة</label>
                                <input type="text" class="form-control" id="Amount_Commission" name="Amount_Commission"
                                    value="{{ $invoices->Amount_Commission }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input type="text" class="form-control" id="Discount" name="Discount"
                                    value="{{ $invoices->Discount }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control"
                                    onchange="calculateCommissionAndVAT()">
                                    <option value="{{ $invoices->Rate_VAT }}" selected>{{ $invoices->Rate_VAT }}</option>
                                    @if ($invoices->Rate_VAT == 10)
                                        <option value="5%">5%</option>
                                    @else($invoices->Rate_VAT == 5)
                                        <option value="10%">10%</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        {{-- 4 --}}
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT"
                                    value="{{ $invoices->Value_VAT }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="Total"
                                    value="{{ $invoices->Total }}" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row mt-3">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3">{{ $invoices->note }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary" id="submitBtn">حفظ البيانات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

    <script>
        $(document).ready(function() {
            // AJAX for getting products based on section
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });
                }
            });
        });

        function calculateCommissionAndVAT() {
            var Amount_collection = parseFloat($('#Amount_collection').val()) || 0;
            var Rate_VAT = parseFloat($('#Rate_VAT').val()) || 0;

            // العمولة (20% من مبلغ التحصيل)
            var Amount_Commission = Amount_collection * 0.20;

            // الخصم (10% من العمولة إذا كان مبلغ التحصيل أقل من 500)
            var Discount = (Amount_collection < 500) ? Amount_Commission * 0.10 : 0;

            // العمولة بعد الخصم
            var CommissionAfterDiscount = Amount_Commission - Discount;

            // قيمة الضريبة
            var Value_VAT = CommissionAfterDiscount * (Rate_VAT / 100);

            // الإجمالي
            var Total = CommissionAfterDiscount + Value_VAT;

            // تحديث القيم في الحقول
            $('#Amount_Commission').val(Amount_Commission.toFixed(2));
            $('#Discount').val(Discount.toFixed(2));
            $('#Value_VAT').val(Value_VAT.toFixed(2));
            $('#Total').val(Total.toFixed(2));
        }

        // حساب القيم عند تحميل الصفحة
        $(window).on('load', function() {
            calculateCommissionAndVAT();
        });
    </script>
@endsection
