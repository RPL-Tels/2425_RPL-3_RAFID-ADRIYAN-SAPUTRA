<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice {{$invoice->invoice_number}}</title>
</head>
<body style="font-size: 14px">
    <div>
        <table style="width: 100%;">
            <tr>
                <th style="text-align: left; width: fit-content;"><img src="{{$src}}" alt="" style="width: 68                           px; height: 60px;"></th>
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
        <table style="width: 100%; margin-top: 20px;">
            <tr>
                <td style="border: 1.5px solid #cbd5e1; padding-top: 12px; padding-left: 12px; padding-bottom: 12px">
                    <p style="font-weight: bold; color: #9ca3af; margin-bottom: 20px">FROM</p>
                    <div>
                        <p style="font-weight: bold; color:#374151; font-size: 18px;">{{implode(' ', array_slice(explode(' ', $created_by->name), 0, 3))}}</p>
                        <p style="color:#9ca3af; font-weight: bold">{{$created_by->company}}</p>
                        <p style="color:#9ca3af; font-weight: bold">{{$created_by->addres}}</p>
                        <p style="color:#9ca3af; font-weight: bold">{{$created_by->email}}</p>
                        <p style="color:#9ca3af; font-weight: bold">{{$created_by->number}}</p>
                    </div>
                </td>
                <td></td>
                <td style="border: 1.5px solid #cbd5e1; padding-top: 12px; padding-left: 12px; padding-bottom: 12px">
                    <p style="font-weight: bold; color: #9ca3af;">TO</p>
                    <p style="font-weight: bold; color:#374151; font-size: 18px;">{{implode(' ', array_slice(explode(' ', $user->name), 0, 3))}}</p>
                    <p style="color:#9ca3af; font-weight: bold">{{$user->company}}</p>
                    <p style="color:#9ca3af; font-weight: bold">{{$user->addres}}</p>
                    <p style="color:#9ca3af; font-weight: bold">{{$user->email}}</p>
                    <p style="color:#9ca3af; font-weight: bold">{{$user->number}}</p>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 20px; color: #374151; font-weight: bold">
            <tr>
                <td style="width: 50%; padding-bottom: 5px; padding-left: 15px;">
                    <p>Invoice No : <span style="color: #6b7280;">{{$invoice->invoice_number}} </span></p>
                </td>
                <td style="padding-bottom: 5px; padding-left: 11px;">
                    <p>Invoice Date : <span style="color: #6b7280;">{{\carbon\carbon::parse($invoice->created_at)->format('d F Y')}}</span></p>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 15px">
                    <p>Project Id : <span style="color: #6b7280;">{{$invoice->project_id}}</span></p>
                </td>
                <td style="padding-left: 10px">
                    <p>Due Date : <span style="color:#6b7280">{{\carbon\carbon::parse($invoice->due_date)->format('d F Y')}}</span></p>
                </td>
            </tr>
        </table>
        <p style="font-weight: bold; font-size: 18px; color: #374151;">Invoice Detail</p>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px">
            <tr>
                <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; color:#6b7280;">Items</td>
                <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; color:#6b7280;">Qty</td>
                <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; color:#6b7280;">Unit Price</td>
                <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; color:#6b7280;">Amount</td>
            </tr>
            @foreach ($items as $item)
                <tr>
                    <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; border-top: none; color: #374151;">{{$item->items_name}}</td>
                    <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; border-top: none; color: #374151;">{{$item->quantity}}</td>
                    <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; border-top: none; color: #374151;">Rp. {{number_format($item->price)}}</td>
                    <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; border-top: none; color: #374151;">Rp. {{number_format($item->price * $item->quantity)}}</td>
                </tr>
            @endforeach
        </table>
        @if ($invoice->status === 'pending')
            <div style="padding: 10px; background-color: #fef9c3; border: 1.5px solid #fef08a; font-size: 12px; color: #eab308; font-weight: bold">
                Status : Unpaid
            </div>
        @elseif ($invoice->status === 'paid')
            <div style="padding: 10px; border: 1.5px solid #bbf7d0; font-size: 12px; color:#22c55e; background-color: #dcfce7;font-weight: bold">
                Status : Paid
            </div>
        @elseif ($invoice->status === 'overdue')
            <div style="padding: 10px; background-color: #fee2e2; border: 1.5px solid #fecaca; font-size: 12px; color:#f87171; font-weight: bold">
                Status : Overdue
            </div>
        @endif
        @if ($payments)
            <p style="font-weight: bold; font-size: 18px; color: #374151;">Payment Detail</p>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px">
                <tr>
                    <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; color:#6b7280;">Amount</td>
                    <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; color:#6b7280;">Payment Date</td>
                    <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; color:#6b7280;">Payment Method</td>
                </tr>
                <tr>
                    <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; border-top: none; color: #374151;">Rp. {{number_format($payments->amount)}}</td>
                    <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; border-top: none; color: #374151;">{{\carbon\carbon::parse($payments->payment_date)->format('d F Y')}}</td>
                    <td style="border-collapse: collapse ;border: 1.5px solid #9ca3af; border-left: none; border-right:none; padding: 10px 0px; border-top: none; color: #374151;">{{$payments->payment_method}}</td>
                </tr>
            </table>
        @endif
        <div style="width: 100%; margin-top: 60px; color: #6b7280;">
            <div style="width: 60%; float: left; line-height: 0.1;">
                <p style="margin-top: 0; line-height: 1.5">Thanks for your business!</p>
                <p style="margin-top: 35px">If you have any question about this invoice.</p>
                <p>Please email us at {{$created_by->email}}</p>
                <p style="margin-top: 40px">Invoice cretaed by: {{$created_by->name}}</p>
            </div>
            <div style="width: 40%; float: right">
                <p style="margin: 0">Invoice Summary</p>
                <hr style="margin: 0; margin-top:14px;">
                @if ($payments)
                <div style="width: 50%; float: left;">
                    <p style="color: #374151; font-weight: bold">Invoice Total</p>
                    <p style="color: #374151; font-weight: bold">Payment Total</p>
                </div>
                <div style="width: 50%; float: right; text-align: right">
                    <p style="color: #374151; font-weight: bold">Rp. {{number_format($invoice->total_amount)}}</p>
                    <p style="color: #374151; font-weight: bold">Rp. {{number_format($payments->amount)}}</p>
                </div>
                @else
                <div style="width: 50%; float: left;">
                    <p style="color: #374151; font-weight: bold">Invoice Total</p>
                </div>
                <div style="width: 50%; float: right; text-align: right">
                    <p style="color: #374151; font-weight: bold">Rp. {{number_format($invoice->total_amount)}}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>