@extends('layouts.master')
@section('title')
    العملاء
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Internal اضفنا هذا الخط لاستكمال النواقص -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/rowGroup.dataTables.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة عميل</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <!-- تم اضافة زر تصدير اكسل -->
            <div class="pr-1 mb-3 mb-xl-0">
                <button class="btn btn-info btn-icon ml-2" type="button">
                    <i class="mdi mdi-file-excel"></i> تصدير اكسل
                </button>
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

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('Edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- عرض رسائل الأخطاء -->
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
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center gap-3 flex-wrap w-100">
                            <!-- زر إضافة قسم (على الشمال) -->
                            <a class="modal-effect btn btn-outline-primary flex-shrink-0 ms-auto" data-effect="effect-scale"
                                data-toggle="modal" href="#modaldemo">اضافة عميل</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead class="text-center">
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم العميل</th>
                                    <th class="border-bottom-0">اسم البنك</th>
                                    <th class="border-bottom-0">الهاتف</th>
                                    <th class="border-bottom-0">العنوان</th>
                                    <th class="border-bottom-0">البريد الالكتروني</th>
                                    <th class="border-bottom-0">تاريخ الاضافة</th>
                                    <th class="border-bottom-0">عمليات</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product['id'] }}</td>
                                        <td>{{ $product['product_name'] }}</td>
                                        <td>{{ $product['section']['section_name'] }}</td>
                                        <td>{{ $product['phone'] }}</td>
                                        <td>{{ $product['address'] }}</td>
                                        <td>{{ $product['email'] }}</td>
                                        <td>{{ $product['created_at'] }}</td>
                                        <td>
                                            <button class="btn btn-outline-success btn-sm"
                                                data-name="{{ $product->product_name }}" data-pro_id="{{ $product->id }}"
                                                data-section_name="{{ $product->section->section_name }}"
                                                data-description="{{ $product->description }}"
                                                data-phone="{{ $product->phone }}"
                                                data-address="{{ $product->address }}"
                                                data-email="{{ $product->email }}"
                                                data-toggle="modal"
                                                data-target="#edit_Product">تعديل</button>

                                            <button class="btn btn-outline-danger btn-sm "
                                                data-pro_id="{{ $product->id }}"
                                                data-product_name="{{ $product->product_name }}" data-toggle="modal"
                                                data-target="#modaldemo9">حذف</button>
                                        </td>
                                        <td>{{ $product['description'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- add -->
        <div class="modal fade" id="modaldemo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة عميل</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('products.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">اسم العميل</label>
                                <input type="text" class="form-control" id="Product_name" name="product_name"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="my-1" for="inlineFormCustomSelectPref">تليفون العميل</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="my-1" for="inlineFormCustomSelectPref">عنوان العميل</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="my-1" for="inlineFormCustomSelectPref">البريد الالكتروني للعميل</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <label class="my-1" for="inlineFormCustomSelectPref">اسم البنك</label>
                            <select name="section_id" id="section_id" class="form-control" required>
                                <option value="" selected disabled> --حدد البنك--</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>

                            <div class="form-group mt-4">
                                <label for="exampleFormControlTextarea1">ملاحظات</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- edit -->
        <div class="modal fade" id="edit_Product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل منتج</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action='products/update' method="post">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="title">اسم المنتج :</label>

                                <input type="hidden" class="form-control" name="pro_id" id="pro_id"
                                    value="">

                                <input type="text" class="form-control" name="Product_name" id="Product_name">
                            </div>

                            <div class="form-group">
                                <label for="phone">تليفون العميل :</label>
                                <input type="text" class="form-control" name="phone" id="phone">
                            </div>

                            <div class="form-group">
                                <label for="address">عنوان العميل :</label>
                                <input type="text" class="form-control" name="address" id="address">
                            </div>

                            <div class="form-group">
                                <label for="email">البريد الالكتروني :</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>

                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                            <select name="section_name" id="section_name" class="custom-select my-1 mr-sm-2" required>
                                @foreach ($sections as $section)
                                    <option>{{ $section->section_name }}</option>
                                @endforeach
                            </select>

                            <div class="form-group">
                                <label for="des">ملاحظات :</label>
                                <textarea name="description" cols="20" rows="5" id='description' class="form-control"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- delete -->
        <div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">حذف المنتج</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="products/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="pro_id" id="pro_id" value="">
                            <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
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
                },
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'print'
                ]
            });
        });
    </script>
    <!-- تم اضافة السكربتات الناقصة -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>

    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

    <script>
        $('#edit_Product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var Product_name = button.data('name')
            var section_name = button.data('section_name')
            var pro_id = button.data('pro_id')
            var description = button.data('description')
            var phone = button.data('phone')
            var address = button.data('address')
            var email = button.data('email')
            var modal = $(this)
            modal.find('.modal-body #Product_name').val(Product_name);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #pro_id').val(pro_id);
            modal.find('.modal-body #phone').val(phone);
            modal.find('.modal-body #address').val(address);
            modal.find('.modal-body #email').val(email);
        })

        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var pro_id = button.data('pro_id')
            var product_name = button.data('product_name')
            var modal = $(this)

            modal.find('.modal-body #pro_id').val(pro_id);
            modal.find('.modal-body #product_name').val(product_name);
        })
    </script>
@endsection
