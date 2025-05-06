<!DOCTYPE html>
<html lang="en">
<head>`
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/styla.css')}}">
    <style>
        .page-break {
            page-break-before: always; /* Tambahkan halaman baru sebelum elemen ini */
        }
    </style>
</head>
<body>
    <table style="width: 100%;">
        <tr>
            <th style="text-align: left; width: fit-content;"><img src="{{$src}}" alt="" style="width: 68   px; height: 60px;"></th>
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
    <p style="font-weight: bold; font-size: 14px">PROGRES PROJECT 3D REPORT</p>
    <p>{{ date('d F Y') }}</p>
    <p style="margin-top: 30px;">Project name : {{$project->project_name}} <span style="font-weight: bold">({{$project->project_id}})</span></p>
    <p>Client name : {{implode(' ', array_slice(explode(' ', $project->client_name), 0, 3))}}</p>
    <p>Start project : {{\carbon\carbon::parse($project->start)->format('d F Y')}}</p>
    <p>Due project : {{\carbon\carbon::parse($project->due_contract)->format('d F Y')}}</p>
    <div style="text-align: center; margin-top: 30px;">
        <img src="{{public_path('storage/'. $project->tumbnail)}}" alt="" style="width: 400px; height: auto; margin: 0; display: block; border: 1px solid black; border-radius: 10px;">
    </div>
    <p style="text-align: center">Project Thumbnail</p>
    <p style="margin-top: 40px; font-size: 14px; font-weight: bold">Project description :</p>
    <p style="line-height: 1.5; text-align: justify">{{$project->description}}</p>
    @if ($project->category === 'Pending')
        <div style="padding: 10px; background-color: #fef9c3; border: 1.5px solid #fef08a; font-size: 12px; color: #eab308; font-weight: bold">
            Status : {{$project->category}}
        </div>
    @elseif ($project->category === 'In progress')
        <div style="padding: 10px; border: 1.5px solid #cbd5e1; font-size: 12px; color:#64748b; font-weight: bold">
            Status : {{$project->category}}
        </div>
    @elseif ($project->category === 'Due contract')
        <div style="padding: 10px; background-color: #fee2e2; border: 1.5px solid #fecaca; font-size: 12px; color:#f87171; font-weight: bold">
            Status : {{$project->category}}
        </div>
    @elseif ($project->category === 'Complete')
        <div style="padding: 10px; background-color:#dcfce7; border: 1.5px solid  #bbf7d0; font-size: 12px; color:#22c55e; font-weight: bold">
            Status : {{$project->category}}
        </div>
    @endif
    <div style="margin-top: 30px; text-align: center">
        <img src="{{public_path('img/info.png')}}" alt="" style="width: 180px;">
    </div>
    <div style="margin-top: 10px; text-align: center">
        <img src="{{ $chartImage }}" alt="Chart Image" style="width: 100px; height: auto; display: block; margin: 0 auto;">
        <p>Progres : {{number_format($percent)}}%</p>
    </div>
    <div style="position: fixed; bottom: 0; width: 100%;">
        <div style="width: 50%; float: left;">
            <p>© {{ date('Y') }} Nazaru Company. All rights reserved.</p>
        </div>
        <div style="width: 50%; float:  right;">
            <p style="text-align: right">{{ date('d F Y') }}</p>
        </div>        
        <hr>
    </div>
    @if ($items->isNotEmpty())
        <div class="page-break"></div>
        <p style="font-size: 16px; font-weight: bold; margin-top: 15px; color: #374151;">Detail Items</p>
        <table style="width: 100%; border-collapse: collapse">
            <tr>
                <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">No</td>
                <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Items Id</td>
                <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Items Name</td>
                <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Progres</td>
                <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Stage</td>
                <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Status</td>
            </tr>
            @php $no=1 @endphp
            @foreach ($items as $item)
                <tr>
                    <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{$no++}}</td>
                    <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{$item->items_id}}</td>
                    <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{$item->items_name}}</td>
                    <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{number_format($item->progres)}}%</td>
                    <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{$item->stage}}</td>
                    <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{$item->category}}</td>
                </tr>
            @endforeach
        </table>
        @if($history->isNotEmpty())
            <p style="font-size: 16px; font-weight: bold; margin-top: 40px; color: #374151; font-family: monospace;">Project Update History <span style="font-weight: normal;">({{ date('F Y') }})</span></p>
            <table style="width: 100%; border-collapse: collapse">
                <tr>
                    <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Date</td>
                    <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Time</td>
                    <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Name</td>
                    <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Id</td>
                    <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Update by</td>
                    <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Description</td>
                    <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Progress</td>
                    <td style="border-bottom: 1px solid #e5e7eb; background-color: #e5e7eb;padding: 10px; border-collapse: collapse; font-size:11px;font-weight: bold; color:#4b5563;">Status</td>

                </tr>
                @foreach ($history as $histori)
                    <tr>
                        <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{\carbon\carbon::parse($histori->created_at)->format('d F Y')}}</td>
                        <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{\carbon\carbon::parse($histori->created_at)->format('H.i')}}</td>
                        <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{implode(' ', array_slice(explode(' ', $histori->name), 0, 4))}}</td>
                        <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">
                            @if($histori->items_id == null)
                                {{$histori->project_id}}
                            @else
                                {{$histori->items_id}}
                            @endif
                        </td>
                        <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{implode(' ', array_slice(explode(' ', $histori->by), 0, 3))}}</td>
                        <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{implode(' ', array_slice(explode(' ', $histori->description), 0, 6))}}</td>
                        <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{$histori->progress}}%</td>
                        <td style="border-bottom: 1px solid #e5e7eb; color: #4b5563; padding: 10px; border-collapse: collapse; font-size:11px;">{{$histori->status}}</td>
                    </tr>
                @endforeach
            </table>
        @endif
        <div style="position: fixed; bottom: 0; width: 100%;">
            <div style="width: 50%; float: left;">
                <p>© {{ date('Y') }} Nazaru Company. All rights reserved.</p>
            </div>
            <div style="width: 50%; float:  right;">
                <p style="text-align: right">{{ date('d F Y') }}</p>
            </div>        
            <hr>
        </div>
    @endif
</body>
</html>