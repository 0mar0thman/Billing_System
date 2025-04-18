@extends('layouts.master')
@section('title')
    البنوك
@stop

{{-- <head>
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
</head> --}}
@section('css')
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
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة بنك</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0" dir="rtl">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <!-- الزر والتنبيه داخل كول -->
                        <div class="col-sm-6 col-md-6 col-xl-4">
                            <div class="d-flex align-items-center gap-3 flex-wrap w-100">
                                <!-- زر إضافة قسم (على الشمال) -->
                                <a class="modal-effect btn btn-outline-primary flex-shrink-0 ms-auto"
                                    data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة بنك</a>

                                <!-- رسالة نجاح -->
                                @if (session()->has('Add'))
                                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-between m-0 mr-3 p-2"
                                        role="alert">
                                        <strong class="flex-grow-1 text-start " class="close ms-2" data-dismiss="alert"
                                            aria-label="Close"> {{ session()->get('Add') }} </strong>
                                    </div>
                                @endif

                                <!-- رسالة خطأ -->
                                @if (session()->has('Error'))
                                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-between m-0 mr-3 p-2 "
                                        role="alert">
                                        <strong class="flex-grow-1 text-start" class="close ms-2" data-dismiss="alert"
                                            aria-label="Close"> {{ session()->get('Error') }} </strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- أيقونة إضافية لو محتاج -->
                        {{-- <i class="mdi mdi-dots-horizontal text-gray"></i> --}}
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0 text-center">#</th>
                                    <th class="border-bottom-0 text-center">اسم البنك</th>
                                    <th class="border-bottom-0 text-center">الوصف</th>
                                    <th class="border-bottom-0 text-center">المضيف</th>
                                    <th class="border-bottom-0 text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $section['id'] }}</td>
                                        <td>{{ $section['section_name'] }}</td>
                                        <td>{{ $section['description'] }}</td>
                                        <td>{{ $section['created_by'] }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-outline-info" data-effect="effect-scale"
                                                data-id="{{ $section['id'] }}"
                                                data-section_name="{{ $section['section_name'] }}"
                                                data-description="{{ $section['description'] }}" data-toggle="modal"
                                                href="#exampleModal2" title="تعديل">
                                                <i class="las la-pen fa-lg"></i>
                                            </a>

                                            <a class="modal-effect btn btn-sm btn-outline-danger" data-effect="effect-scale"
                                                data-id="{{ $section['id'] }}"
                                                data-section_name="{{ $section['section_name'] }}" data-toggle="modal"
                                                href="#deleteModal9" title="حذف">
                                                <i class="las la-trash fa-lg"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Basic modal -->
        <!-- ADD -->
        <div class="modal" id="modaldemo8">

            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sections.store') }}" method='post'>
                            {{ @csrf_field() }}
                            <div class="form-group">
                                <label for="exampleFormControlInput1">اسم القسم</label>
                                <input class="form-control" id="exampleFormControlInput1" name="section_name"
                                    placeholder="ادخل اسم القسم">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">الوصف</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                                <small id="emailHelp" class="form-text text-muted mb-3">ملاحظات حول القسم.</small>

                            </div>
                            <div class="modal-footer">
                                <button class="btn ripple btn-primary" type="submit">تأكيد</button>
                                <button class="btn ripple btn-secondary" data-dismiss="modal"
                                    type="button">الغاء</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Basic modal -->
                <!--/div-->
            </div>
            <!-- row closed -->
        </div>

        <!-- edit -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل البنك</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="sections/update" method="post" autocomplete="off">
                            {{ method_field('patch') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="">
                                <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                                <input class="form-control" name="section_name" id="section_name" type="text">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">ملاحظات:</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Container closed -->

        <!-- delete -->
        <div class="modal fade" id="deleteModal9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="sections/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="section_name" id="section_name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script>
        $(document).ready(function() {
            var table = $('#example1').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json"
                }
            });
            // table.clear().draw();
        });
    </script>
    {{-- <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script> --}}
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
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>



    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
        })
    </script>

    <script>
        $('#deleteModal9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
        })
    </script>
@endsection
