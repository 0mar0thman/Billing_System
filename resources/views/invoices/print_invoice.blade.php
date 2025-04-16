<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طباعة فاتورة {{ $invoice->invoice_number }}</title>
    <style>
        /* أساسيات التصميم */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #fff;
            color: #495057;
            line-height: 1.5;
            margin: 0;
            padding: 15mm;
        }

        /* تصميم البطاقة */
        .card-invoice {
            background-color: #fff;
            border-radius: 5px;
        }

        /* ترويسة الفاتورة */
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        /* معلومات العميل والفاتورة */
        .mg-t-20 {
            margin-top: 20px;
        }

        .billed-to h6 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .tx-gray-600 {
            color: #6c757d;
            font-weight: 600;
            margin-bottom: 15px;
            display: block;
        }

        .invoice-info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        /* جدول الفاتورة */
        .table-invoice {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .table-invoice th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            padding: 12px 15px;
            text-align: right;
            border: 1px solid #dee2e6;
        }

        .table-invoice td {
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            text-align: right;
        }

        .tx-bold {
            font-weight: 700;
        }

        .tx-primary {
            color: #467fcf;
        }

        /* الملاحظات */
        .invoice-notes {
            margin-top: 30px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .main-content-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        /* البادجات */
        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            border-radius: 3px;
        }

        .bg-success {
            background-color: #2dce89 !important;
        }

        .bg-danger {
            background-color: #f5365c !important;
        }

        .bg-warning {
            background-color: #fb6340 !important;
        }

        .bg-secondary {
            background-color: #6c757d !important;
        }

        .text-white {
            color: #fff !important;
        }

        .text-dark {
            color: #212529 !important;
        }

        /* تعديلات الطباعة */
        @media print {
            body {
                padding: 0;
                font-size: 12pt;
                background: none;
            }

            @page {
                size: A4;
                margin: 15mm;
            }

            .no-print {
                display: none !important;
            }

            .table-invoice {
                font-size: 10pt;
            }

            .invoice-title {
                font-size: 20pt;
            }
        }

        /* QR Code */
        .qr-code {
            text-align: center;
            margin: 20px 0;
        }

        .qr-code img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="card card-invoice">
        <div class="card-body">
            <div class="invoice-header">
                <h1 class="invoice-title">فاتورة ضريبية</h1>
                <p>رقم الفاتورة: {{ $invoice->invoice_number }}</p>
            </div>

            <div class="row mg-t-20">
                <div class="col-md">
                    <label class="tx-gray-600">معلومات العميل</label>
                    <div class="billed-to">
                        <h6>{{ $invoice->product }}</h6>
                        <p>
                            العنوان: {{ $invoice->address }}<br>
                            الهاتف: {{ $invoice->phone }}<br>
                            البريد الإلكتروني: {{ $invoice->email }}
                        </p>
                    </div>
                </div>
                <div class="col-md">
                    <label class="tx-gray-600">معلومات الفاتورة</label>
                    <p class="invoice-info-row">
                        <span>تاريخ الفاتورة:</span>
                        <span>{{ $invoice->invoice_Date ?? 'غير محدد' }}</span>
                    </p>
                    <p class="invoice-info-row">
                        <span>تاريخ الاستحقاق:</span>
                        <span>{{ $invoice->Due_date ?? 'غير محدد' }}</span>
                    </p>
                    <p class="invoice-info-row">
                        <span>حالة الدفع:</span>
                        <span>
                            @if ($invoice->Value_Status == 1)
                                <span class="badge bg-success text-white">مدفوع</span>
                            @elseif ($invoice->Value_Status == 2)
                                <span class="badge bg-danger text-white">غير مدفوع</span>
                            @elseif ($invoice->Value_Status == 3)
                                <span class="badge bg-warning text-dark">مدفوع جزئيًا</span>
                            @else
                                <span class="badge bg-secondary">غير محدد</span>
                            @endif
                        </span>
                    </p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-invoice">
                    <thead>
                        <tr>
                            <th>البند</th>
                            <th>القيمة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>تاريخ الدفع</td>
                            <td>{{ $invoice->Payment_Date ?? 'غير محدد' }}</td>
                        </tr>
                        <tr>
                            <td>اسم البنك</td>
                            <td>{{ $invoice->section?->section_name ?? 'قسم غير معروف' }}</td>
                        </tr>
                        <tr>
                            <td>مبلغ التحصيل</td>
                            <td>{{ number_format($invoice->Amount_collection, 2) }} ر.س</td>
                        </tr>
                        <tr>
                            <td>مبلغ العمولة</td>
                            <td>{{ number_format($invoice->Amount_Commission, 2) }} ر.س</td>
                        </tr>
                        <tr>
                            <td>الخصم</td>
                            <td>{{ number_format($invoice->Discount, 2) }} ر.س</td>
                        </tr>
                        <tr>
                            <td>نسبة الضريبة</td>
                            <td>{{ $invoice->Rate_VAT }}%</td>
                        </tr>
                        <tr>
                            <td>قيمة الضريبة</td>
                            <td>{{ number_format($invoice->Value_VAT, 2) }} ر.س</td>
                        </tr>
                        <tr>
                            <td class="tx-bold">الإجمالي شامل الضريبة</td>
                            <td class="tx-primary tx-bold">{{ number_format($invoice->Total, 2) }} ر.س</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- QR Code -->
            <div class="qr-code no-print">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode("فاتورة رقم: $invoice->invoice_number\nالمبلغ: {$invoice->Total} ر.س\nالتاريخ: $invoice->invoice_Date") }}"
                     alt="QR Code للفاتورة">
                <p>مسح الضوئي للتحقق من الفاتورة</p>
            </div>

            <div class="invoice-notes">
                <label class="main-content-label">ملاحظات</label>
                <p>{{ $invoice->note ?? 'لا يوجد ملاحظات' }}</p>
            </div>

            <div class="no-print" style="text-align: center; margin-top: 30px;">
                <button onclick="window.print()" style="padding: 10px 20px; background: #467fcf; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    <i class="fas fa-print"></i> طباعة الفاتورة
                </button>
                <button onclick="window.close()" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px;">
                    <i class="fas fa-times"></i> إغلاق
                </button>
            </div>
        </div>
    </div>

    <script>
        // طباعة الصفحة تلقائياً عند فتحها
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);

            // إغلاق النافذة بعد الطباعة (إذا كانت نافذة منبثقة)
            window.onafterprint = function() {
                setTimeout(function() {
                    window.close();
                }, 1000);
            };
        };
    </script>
</body>
</html>
