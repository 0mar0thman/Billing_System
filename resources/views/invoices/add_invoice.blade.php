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
    اضافة فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf

                        <!-- الصف الأول -->
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" required>
                            </div>

                            <div class="col">
                                <label>تاريخ الاصدار</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="col">
                                <label>تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d', strtotime('+3 months')) }}" required>
                            </div>
                        </div>

                        <!-- الصف الثاني -->
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputName" class="control-label">اسم البنك</label>
                                <select name="Section" class="form-control SlectBox" id="Section" required>
                                    <option value="" selected disabled>حدد البنك</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">اسم العميل</label>
                                <select id="product" name="product" class="form-control" required>
                                    <option value="" selected disabled>حدد العميل</option>
                                    @isset($products)
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-email="{{ $product->email ?? '' }}"
                                                data-address="{{ $product->address ?? '' }}"
                                                data-phone="{{ $product->phone ?? '' }}">
                                                {{ $product->product_name ?? 'عميل بدون اسم' }}
                                            </option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ التحصيل (يجب ان يزيد عن
                                    {{ $SittingsInvoices->last()->Amount_collection ?? 0 }} لتخطي الخصم)</label>
                                <input type="hidden" name="Amount_collection_value"
                                    value="{{ $SittingsInvoices->last()->Amount_collection ?? 0 }}">
                                <input type="number" class="form-control" id="Amount_collection" name="Amount_collection"
                                    oninput="calculateCommissionAndVAT()" required>
                            </div>
                        </div>

                        <!-- الصف الثالث -->
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ العمولة
                                    ({{ $SittingsInvoices->last()->Amount_Commission ?? 0 }}%)</label>
                                <input type="hidden" name="Amount_Commission_value"
                                    value="{{ $SittingsInvoices->last()->Amount_Commission ?? 0 }}">
                                <input type="number" class="form-control" id="Amount_Commission" name="Amount_Commission"
                                    readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الخصم
                                    ({{ $SittingsInvoices->last()->Discount_Commission ?? 0 }}%)</label>
                                <input type="hidden" name="Discount_Commission_value"
                                    value="{{ $SittingsInvoices->last()->Discount_Commission ?? 0 }}">
                                <input type="number" class="form-control" id="Discount" name="Discount_Commission"
                                    value="0" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control"
                                    onchange="calculateCommissionAndVAT()" required>
                                    <option value="" selected disabled>حدد نسبة الضريبة</option>
                                    <option value="5">5%</option>
                                    <option value="10">10%</option>
                                </select>
                            </div>
                        </div>

                        <!-- الصف الرابع -->
                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="number" class="form-control" id="Value_VAT" name="Value_VAT" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="number" class="form-control" id="Total" name="Total" readonly>
                            </div>
                        </div>

                        <!-- حقول العميل المخفية -->
                        <div class="d-none">
                            <input type="hidden" id="email" name="email">
                            <input type="hidden" id="address" name="address">
                            <input type="hidden" id="phone" name="phone">
                        </div>

                        <!-- الصف الخامس -->
                        <div class="row mt-3">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                            </div>
                        </div>

                        <!-- المرفقات -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <p class="text-danger">* صيغة المرفق pdf, jpeg, .jpg, png</p>
                                <h5 class="card-title">المرفقات</h5>
                                <input type="file" name="pic" class="dropify"
                                    accept=".pdf,.jpg,.png,image/jpeg,image/png" data-height="70" />
                            </div>
                        </div>

                        <!-- زر الحفظ -->
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                            </div>
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
        // تاريخ الاصدار
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();


        $(document).ready(function() {
            // عند تغيير القسم
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $('select[name="product"]').append(
                                '<option value="" selected disabled>حدد العميل</option>');

                            $.each(data, function(key, value) {
                                $('select[name="product"]').append(
                                    '<option value="' + value.id + '" ' +
                                    'data-email="' + (value.email || '') + '" ' +
                                    'data-address="' + (value.address || '') +
                                    '" ' +
                                    'data-phone="' + (value.phone || '') + '">' +
                                    (value.product_name || 'عميل بدون اسم') +
                                    '</option>'
                                );
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                        }
                    });
                }
            });

            // عند تغيير العميل لتعيين الحقول المخفية
            $('select[name="product"]').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                $('#email').val(selectedOption.data('email') || '');
                $('#address').val(selectedOption.data('address') || '');
                $('#phone').val(selectedOption.data('phone') || '');
            });
        });
        // حساب العمولة والضريبة
        function calculateCommissionAndVAT() {
            const Amount_collection_value = parseFloat($('[name="Amount_collection_value"]').val()) || 0;
            const Amount_Commission_value = parseFloat($('[name="Amount_Commission_value"]').val()) || 0;
            const Discount_Commission_value = parseFloat($('[name="Discount_Commission_value"]').val()) || 0;

            const amountCollection = parseFloat($('#Amount_collection').val()) || 0;
            const rateVAT = parseFloat($('#Rate_VAT').val()) || 0;

            // حساب العمولة الأساسية
            const commission = amountCollection * (Amount_Commission_value / 100);

            // حساب الخصم
            let discount = 0;
            if (amountCollection <= Amount_collection_value) {
                discount = commission * (Discount_Commission_value / 100);
            }

            // العمولة بعد الخصم
            const commissionAfterDiscount = commission - discount;

            // حساب الضريبة
            const vatValue = commissionAfterDiscount * (rateVAT / 100);

            // الإجمالي
            const total = commissionAfterDiscount + vatValue;

            // تعبئة الحقول
            $('#Amount_Commission').val(commission.toFixed(2));
            $('#Discount').val(discount.toFixed(2));
            $('#Value_VAT').val(vatValue.toFixed(2));
            $('#Total').val(total.toFixed(2));
        }
    </script>
@endsection
