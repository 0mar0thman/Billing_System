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
                                            <div class="card-body p-0 m-0">
                                                <div class="table-responsive">
                                                    <table id="example1"
                                                        class="table table-bordered text-md-nowrap text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>العنوان</th>
                                                                <th>المحتوى</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>رقم الفاتورة</td>
                                                                <td>{{ $invoice->invoice_number }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>تاريخ الفاتورة</td>
                                                                <td>{{ $invoice->invoice_Date ?? 'غير محدد' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>تاريخ الاستحقاق</td>
                                                                <td>{{ $invoice->Due_date ?? 'غير محدد' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>الحالة الان</td>
                                                                <td>
                                                                    @if ($invoice->Value_Status == 1)
                                                                        <span
                                                                            class="badge bg-success text-white">مدفوع</span>
                                                                    @elseif ($invoice->Value_Status == 2)
                                                                        <span class="badge bg-danger text-white">غير
                                                                            مدفوع</span>
                                                                    @elseif ($invoice->Value_Status == 3)
                                                                        <span class="badge bg-warning text-dark">مدفوع
                                                                            جزئيًا</span>
                                                                    @else
                                                                        <span class="badge bg-secondary">غير محدد</span>
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>تاريخ الدفع</td>
                                                                <td>{{ $invoice->Payment_Date ?? 'غير محدد' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>المنتج</td>
                                                                <td>{{ $invoice->product }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>القسم</td>
                                                                <td>{{ $invoice->section?->section_name ?? 'قسم غير معروف' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>مبلغ التحصيل</td>
                                                                <td>{{ $invoice->Amount_collection ?? 0 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>مبلغ العمولة</td>
                                                                <td>{{ $invoice->Amount_Commission ?? 0 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>الخصم</td>
                                                                <td>{{ $invoice->Discount_Commission ?? 0 }}</td>
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
                                                                <td>الإجمالي</td>
                                                                <td>{{ $invoice->Total ?? 0 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>ملاحظات</td>
                                                                <td>{{ $invoice->note ?? 'لا يوجد' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>تاريخ الإنشاء</td>
                                                                <td>{{ $invoice->created_at ?? 'غير محدد' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>تاريخ التحديث</td>
                                                                @if ($invoice->updated_at == $invoice->created_at)
                                                                    <td>لم يحدث</td>
                                                                @else
                                                                    <td>{{ $invoice->updated_at ?? '-' }}</td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td>رقم المعرف</td>
                                                                <td>{{ $invoice->id }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
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
                                                                            <span class="badge bg-secondary">غير محدد</span>
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
                                        <div class="tab-pane" id="tab5">
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
                                                                    <td>{{ $invoice->invoice_number ?? 'غير متوفر' }}</td>
                                                                    <td>{{ $invoice->Created_by ?? 'غير متوفر' }}</td>
                                                                    <td>{{ $invoice->invoice_id ?? 'غير متوفر' }}</td>
                                                                    <td>{{ $invoice->created_at ?? 'غير متوفر' }}</td>
                                                                    <td> <!-- عمود الأزرار -->
                                                                        <!-- زر العرض -->
                                                                        <a href="{{ url('Attachments/' . $invoice->invoice_number . '/' . $invoice->file_name) }}"
                                                                            target="_blank" class="btn btn-info btn-sm">
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
                    <!---Prism Pre code-->
                </div>
                <!-- /div -->
            </div>
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
@endsection
