@extends('layouts.master')
@section('title')
    القسم
@stop
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة الفواتير</span> <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ القسم</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12  p-1">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="main-content-label mg-b-20">
                        استعلام
                    </div>
                    {{-- <p class="mg-b-20">It is Very Easy to Customize and it uses in your website apllication.</p> --}}
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">التفاصيل</a>
                                            </li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                        <div class="tab-pane active " id="tab4">

                                            <!-- row -->
                                            <div class="row row-sm">
                                                <div class="col-md-12 col-xl-12">
                                                    <div class="main-content-body-invoice">
                                                        <div class="card card-invoice">
                                                            <div class="card-body">
                                                                <div class="invoice-header">
                                                                    <h1 class="invoice-title">فاتورة</h1>

                                                                </div><!-- invoice-header -->
                                                                <div class="row mg-t-20">
                                                                    <div class="col-md">
                                                                        <label class="tx-gray-600">العميل</label>
                                                                        <div class="billed-to">
                                                                            <h6> {{ $invoice->product }}</h6>
                                                                            <p>العنوان: {{ $invoice->address }}<br>
                                                                                هاتف: {{ $invoice->phone }}<br>
                                                                                البريد الإلكتروني: {{ $invoice->email }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md">
                                                                        <label class="tx-gray-600">معلومات الفاتورة</label>
                                                                        <p class="invoice-info-row"><span>رقم
                                                                                الفاتورة</span>
                                                                            <span>{{ $invoice->invoice_number }}</span>
                                                                        </p>
                                                                        <p class="invoice-info-row"><span>تاريخ
                                                                                الفاتورة</span>
                                                                            <span>{{ $invoice->invoice_Date ?? 'غير محدد' }}</span>
                                                                        </p>
                                                                        <p class="invoice-info-row"><span>تاريخ
                                                                                الاستحقاق</span>
                                                                            <span>{{ $invoice->Due_date ?? 'غير محدد' }}</span>
                                                                        </p>
                                                                        <p class="invoice-info-row"><span>حالة الدفع</span>
                                                                            <span>
                                                                                @if ($invoice->Value_Status == 1)
                                                                                    <span
                                                                                        class="badge bg-success text-white">مدفوع</span>
                                                                                @elseif ($invoice->Value_Status == 2)
                                                                                    <span
                                                                                        class="badge bg-danger text-white">غير
                                                                                        مدفوع</span>
                                                                                @elseif ($invoice->Value_Status == 3)
                                                                                    <span
                                                                                        class="badge bg-warning text-dark">مدفوع
                                                                                        جزئيًا</span>
                                                                                @else
                                                                                    <span class="badge bg-secondary">غير
                                                                                        محدد</span>
                                                                                @endif
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive mg-t-40">
                                                                    <table
                                                                        class="table table-invoice border text-md-nowrap mb-0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="wd-20p">البند</th>
                                                                                <th class="wd-60p">القيمة</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>تاريخ الدفع</td>
                                                                                <td>{{ $invoice->Payment_Date ?? 'غير محدد' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>اسم العميل</td>
                                                                                <td>{{ $invoice->product }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>اسم البنك</td>
                                                                                <td>{{ $invoice->section?->section_name ?? 'قسم غير معروف' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>مبلغ التحصيل</td>
                                                                                <td>{{ $invoice->Amount_collection ?? 0 }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>مبلغ العمولة</td>
                                                                                <td>{{ $invoice->Amount_Commission ?? 0 }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>الخصم</td>
                                                                                <td>{{ $invoice->Discount ?? 0 }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>نسبة الضريبة</td>
                                                                                <td>{{ $invoice->Rate_VAT ?? 0 }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>قيمة الضريبة</td>
                                                                                <td>{{ $invoice->Value_VAT ?? 0 }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td
                                                                                    class="tx-right tx-uppercase tx-bold tx-inverse">
                                                                                    الإجمالي</td>
                                                                                <td class="tx-right">
                                                                                    <h4 class="tx-primary tx-bold">
                                                                                        {{ $invoice->Total ?? 0 }}</h4>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="mg-t-40">
                                                                    <div class="invoice-notes">
                                                                        <label
                                                                            class="main-content-label tx-13">ملاحظات</label>
                                                                        <p>{{ $invoice->note ?? 'لا يوجد ملاحظات' }}</p>
                                                                    </div>
                                                                </div>
                                                                <hr class="mg-b-40">
                                                                <div class="d-flex">
                                                                    <a href="{{ route('invoices.print', $invoice->id) }}" target="_blank" class="btn btn-primary ml-auto">
                                                                        <i class="fas fa-print ml-1"></i> طباعة
                                                                    </a>

                                                                    @if ($invoice->Value_Status != 1)
                                                                        <a href="{{ URL::route('Status_show', [$invoice->id]) }}"
                                                                            class="btn btn-purple mr-2">
                                                                            <i class="fas fa-money-bill-wave ml-1"></i> دفع
                                                                            الآن
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- COL-END -->
                                            </div>
                                            <!-- row closed -->
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            <div class="card-body p-0 m-0">
                                                <div class="table-responsive">
                                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>#</th>
                                                                <th>رقم الفاتورة</th>
                                                                <th>المنتج</th>
                                                                <th>القسم</th>
                                                                <th>الحالة</th>
                                                                <th>قيمة الحالة</th>
                                                                <th>تاريخ الدفع</th>
                                                                <th>ملاحظات</th>
                                                                <th>المستخدم</th>
                                                                <th>تاريخ الإنشاء</th>
                                                                <th>تاريخ التحديث</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-center">
                                                            @foreach ($invoices_details as $index => $invoice)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ $invoice->invoice_number ?? 'غير متوفر' }}</td>
                                                                    <td>{{ $invoice->product ?? '-' }}</td>
                                                                    <td>{{ $invoice->Section ?? '-' }}</td>

                                                                    {{-- شرط الحالة مع تلوين حسب القيمة --}}
                                                                    <td>
                                                                        @if ($invoice->Value_Status == 1)
                                                                            <span
                                                                                class="badge bg-success text-white">{{ $invoice->Status ?? 'مدفوع' }}</span>
                                                                        @elseif($invoice->Value_Status == 2)
                                                                            <span
                                                                                class="badge bg-danger text-white">{{ $invoice->Status ?? 'غير مدفوع' }}</span>
                                                                        @elseif($invoice->Value_Status == 3)
                                                                            <span
                                                                                class="badge bg-warning text-dark">{{ $invoice->Status ?? 'مدفوع جزئيًا' }}</span>
                                                                        @else
                                                                            <span class="badge bg-secondary">غير
                                                                                محدد</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $invoice->Value_Status ?? '-' }}</td>

                                                                    <td>{{ $invoice->Payment_Date ?? 'غير محدد' }}</td>
                                                                    <td>{{ $invoice->note ?? '-' }}</td>
                                                                    <td>{{ $invoice->user ?? '-' }}</td>
                                                                    <td>{{ $invoice->created_at ?? '-' }}</td>
                                                                    @if ($invoice->updated_at == $invoice->created_at)
                                                                        <td>لم يحدث</td>
                                                                    @else
                                                                        <td>{{ $invoice->updated_at ?? '-' }}</td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane " id="tab5">
                                            <!--المرفقات-->
                                            <div class="card card-statistics">
                                                {{-- @can('اضافة مرفق') --}}
                                                <div class="card-body">
                                                    <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                    <h5 class="card-title">اضافة مرفقات</h5>
                                                    <form method="post" action="{{ url('/InvoiceAttachments') }}"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="customFile" name="file_name" required>
                                                            <input type="hidden" name="invoice_number"
                                                                value="{{ $invoice->invoice_number }}">
                                                            <input type="hidden" id="invoice_id" name="invoice_id"
                                                                value="{{ $invoice->id }}">
                                                            <label class="custom-file-label" for="customFile">حدد
                                                                المرفق</label>

                                                        </div><br><br>
                                                        <button type="submit" class="btn btn-primary btn-sm "
                                                            name="uploadedFile">تاكيد</button>
                                                    </form>
                                                </div>
                                                {{-- @endcan --}}
                                                <br>
                                                <div class="card-body p-0 m-0">
                                                    <div class="table-responsive">
                                                        <table id="example1" class="table key-buttons text-md-nowrap">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th class="border-bottom-0">#</th>
                                                                    <th class="border-bottom-0">اسم الملف</th>
                                                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                                                    <th class="border-bottom-0">أنشئت بواسطة</th>
                                                                    <th class="border-bottom-0">معرّف الفاتورة</th>
                                                                    <th class="border-bottom-0">تاريخ الإنشاء</th>
                                                                    <th class="border-bottom-0">العمليات</th>
                                                                    <!-- عمود العمليات -->
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center">
                                                                @foreach ($attachments as $index => $invoice)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>
                                                                            <a href="{{ url('Attachments/' . $invoice->invoice_number . '/' . $invoice->file_name) }}"
                                                                                target="_blank">
                                                                                {{ $invoice->file_name }}
                                                                            </a>
                                                                        </td>
                                                                        <td>{{ $invoice->invoice_number ?? 'غير متوفر' }}
                                                                        </td>
                                                                        <td>{{ $invoice->Created_by ?? 'غير متوفر' }}</td>
                                                                        <td>{{ $invoice->invoice_id ?? 'غير متوفر' }}</td>
                                                                        <td>{{ $invoice->created_at ?? 'غير متوفر' }}</td>
                                                                        <td> <!-- عمود الأزرار -->
                                                                            <!-- زر العرض -->
                                                                            <a href="{{ url('Attachments/' . $invoice->invoice_number . '/' . $invoice->file_name) }}"
                                                                                target="_blank"
                                                                                class="btn btn-info btn-sm">
                                                                                عرض
                                                                            </a>

                                                                            <!-- زر التحميل -->
                                                                            <a href="{{ url('Attachments/' . $invoice->invoice_number . '/' . $invoice->file_name) }}"
                                                                                download class="btn btn-primary btn-sm">
                                                                                تحميل
                                                                            </a>

                                                                            <!-- زر الحذف -->
                                                                            <form
                                                                                action="{{ route('attachments.destroy', $invoice->id) }}"
                                                                                method="POST"
                                                                                id="delete-form-{{ $invoice->id }}"
                                                                                style="display: inline;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm"
                                                                                    onclick="confirmDelete({{ $invoice->id }})">
                                                                                    حذف
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!---Prism Pre code-->
            </div>
            <!-- /div -->
        </div>
    </div>

@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script>
        function confirmDelete(invoiceId) {
            // عرض SweetAlert2 برومبت للتأكيد
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: 'لن يمكنك استرجاع الملف بعد الحذف!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'نعم، احذف الملف!',
                cancelButtonText: 'إلغاء',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // إذا وافق المستخدم، يتم إرسال النموذج
                    document.getElementById('delete-form-' + invoiceId).submit();
                }
            });
        }
    </script>
    <script>
        function printInvoice() {
            window.print();
        }
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.querySelector('.custom-file-input');
            const fileLabel = document.querySelector('.custom-file-label');

            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    fileLabel.textContent = fileInput.files[0].name;
                }
            });
        });
    </script>



@endsection
