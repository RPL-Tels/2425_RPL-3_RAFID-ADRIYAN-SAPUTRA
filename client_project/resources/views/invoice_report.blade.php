<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Report</title>
    <style>
        body {
            line-height: 0.5;
            font-size: 12px;
            font-family: 'Times New Roman', Times, serif;
        }
        p {
            margin: 0;
        }
    </style>
</head>
<body>
    <table style="width: 100%;">
        <tr>
            <th style="text-align: left; width: fit-content;"><img src="{{public_path('img/Untitled-2.png')}}" alt="" style="width: 68px; height: 60px;"></th>
            <th style="text-align: left">
                <p style="font-size: 18px; font-family: Helvetica; font-weight: bold;">CMP</p>
                <p style="font-size: 14px; font-family: Helvetica; font-weight: bold;">PT Waindo Specterra</p>
            </th>
            <th style="text-align: right;">
                <p style="font-weight: normal; font-family: Helvetica;">12510 Jakarta, South Jakarta City, Indonesia</p>
                <p style="font-weight: normal; font-family: Helvetica;">(021) 7986405</p>
                <p style="font-weight: normal; font-family: Helvetica;">Info@gmail.com</p>
                <p style="font-weight: normal; font-family: Helvetica;">www.waindo.co.id</p>
            </th>
        </tr>
    </table>
    <hr>
    <p style="font-size: 16px; font-weight: bold; margin-top: 15px; color: #374151;">Invoice Report</p>
    <p style="font-weight: bold; color: #6b7280; margin-top: 14px;">Your Invoice data over {{$timePeriod}}</p>
    <p style="margin-top: 10px;font-weight: bold; color: #6b7280;">Created at : {{date('d F Y')}}</p>
    <table style="width: 100%; margin-top: 20px;">
        <tr>
            <td style="border: 1px solid #4b5563;padding: 10px">
                <p style="color:#4b5563;">TOTAL</p>
                <p style="color:#374151; font-weight: bold; font-size: 16px">Rp. {{number_format($totalAmount)}}</p>
                <p style="color: #4b5563">{{$totalInvoice}} Invoice</p>
            </td>
            <td style="border: 1px solid #4b5563;padding: 10px">
                <p style="color:#4b5563;">PAID</p>
                <p style="color:#374151; font-weight: bold; font-size: 16px">Rp. {{number_format($paidAmount)}}</p>
                <p style="color: #4b5563">{{$paidInvoice}} Invoice</p>
            </td>
            <td style="border: 1px solid #4b5563;padding: 10px">
                <p style="color:#4b5563;">UNPAID</p>
                <p style="color:#374151; font-weight: bold; font-size: 16px">Rp. {{number_format($unpaidAmount)}}</p>
                <p style="color: #4b5563">{{$unpaidInvoice}} Invoice</p>
            </td>
        </tr>
    </table>
    <table style="width: 100%; margin-top:30px">
        <tr>
            <td style="width: fit-content">
                <div>
                    <img src="{{ $chartImage }}" alt="Chart Image" style="width: 120px; height: auto; display: block; margin: 0 auto;">
                </div>
            </td>
            <td style="width: fit-content; padding-left: 10px; padding-right: 20px">
                <img src="{{public_path('img/Frame2.png')}}" alt="" style="width: 70px;">
            </td>
            <td>
                <p style="font-weight: bold; font-size: 9px; color:#4b5563;">Paid Invoice {{number_format($paid)}}%</p>
                <p style="font-weight: bold; font-size: 9px; color:#4b5563;">Total Amount : Rp. {{number_format($totalAmount)}}</p>
                <p style="font-weight: bold; font-size: 9px; color:#4b5563;">Total Invoice : {{$paidInvoice}}</p>
            </td>
            <td>
                <p style="font-weight: bold; font-size: 9px; color:#4b5563;">Pending Invoice {{number_format($pending)}}%</p>
                <p style="font-weight: bold; font-size: 9px; color:#4b5563;">Total Amount : Rp. {{number_format($pendingAmount)}}</p>
                <p style="font-weight: bold; font-size: 9px; color:#4b5563;">Total Invoice : {{$pendingInvoice}}</p>
            </td>
            <td>
                <p style="font-weight: bold; font-size: 9px; color:#4b5563;">Overdue Invoice {{number_format($overdue)}}%</p>
                <p style="font-weight: bold; font-size: 9px; color:#4b5563;">Total Amount : Rp. {{number_format($overdueAmount)}}</p>
                <p style="font-weight: bold; font-size: 9px; color:#4b5563;">Total Invoice : {{$overdueInvoice}}</p>
            </td>
        </tr>
    </table>
    <table style="width: 100%; margin-top: 30px; border-collapse: collapse">
        <tr>
            <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Inv.ID</td>
            <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Client Name</td>
            <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Project</td>
            <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Date</td>
            <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Due Date</td>
            <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Amount</td>
            <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Status</td>
        </tr>
        @foreach ($data as $datas)
        <tr>
            <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{$datas->invoice_number}}</td>
            <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{implode(' ', array_slice(explode(' ', $datas->user->name), 0, 3))}}</td>
            <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">@foreach ($datas->project as $items){{$items->project_name}}@endforeach</td>
            <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{\carbon\carbon::parse($datas->created_at)->format('d F Y')}}</td>
            <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{\carbon\carbon::parse($datas->overdue)->format('d F Y')}}</td>
            <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">Rp. {{number_format($datas->total_amount)}}</td>
            <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{$datas->status}}</td>
        </tr>
        @endforeach
    </table>
    <p style="text-align: center; margin-top: 15px; color: #6b7280; font-size: 10px">Table list invoice {{date('d F Y')}}</p>
</body>
</html>