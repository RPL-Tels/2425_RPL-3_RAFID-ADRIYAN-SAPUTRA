@extends('layouts.layers')
@section('title', 'List Invoice')
@section('section')
    <div class="container">
        <div class="md:px-12 px-5">
            <div class="w-full mt-6 md:flex">
                <div class="md:w-2/3 hidden md:block">
                    <p class="text-xl text-slate-700 font-medium mt-1 dark:text-gray-300">Overview</p>
                    <div class="w-[97%] px-8 py-6 bg-white dark:bg-[#1D2125] dark:border-[#22272B] mt-4 rounded-md border-[1.5px] grid grid-cols-3 gap-4 border-slate-300">
                        <div>
                            <p class="text-slate-500 font-mono mb-3 dark:text-gray-300">TOTAL</p>
                            <p class="font-sans text-2xl font-semibold dark:text-white">Rp. {{number_format($totalAmount)}}</p>
                            <button class="text-xs font-sans font-medium px-4 bg-gray-200 text-slate-600 rounded-full py-1 mt-5 dark:bg-[#282E33] dark:text-gray-200 cursor-text">{{$totalInvoice}} Invoice</button>
                        </div>
                        <div>
                            <p class="text-slate-500 font-mono mb-3 dark:text-gray-300">PAID</p>
                            <p class="font-sans text-2xl font-semibold dark:text-white">Rp. {{number_format($paidAmount)}}</p>
                            <button class="text-xs font-sans font-medium px-4 bg-gray-200 text-slate-600 rounded-full py-1 mt-5 dark:bg-[#282E33] dark:text-gray-200 cursor-text">{{$paidInvoices}} Invoice</button>
                        </div>
                        <div>
                            <p class="text-slate-500 font-mono mb-3 dark:text-gray-300">UNPAID</p>
                            <p class="font-sans text-2xl font-semibold dark:text-white">Rp. {{number_format($pendingAmount)}}</p>
                            <button class="text-xs font-sans font-medium px-4 bg-gray-200 text-slate-600 rounded-full py-1 mt-5 dark:bg-[#282E33] dark:text-gray-200 cursor-text">{{$unpaidInvoices}} Invoice</button>
                        </div>
                    </div>
                </div>
                <div class="md:hidden w-full grid grid-cols-1 gap-3">
                    <div class="bg-white flex w-full p-4 rounded border-[1.5px] border-slate-300 shadow dark:bg-[#1D2125] dark:border-[#22272B]">
                        <div class="w-1/2">
                            <p class="text-slate-500 font-mono dark:text-gray-300">TOTAL</p>
                            <p class="font-sans text-xl font-semibold dark:text-white truncate">Rp. {{number_format($totalAmount)}}</p>
                        </div>
                        <div class="w-1/2">
                            <button class="float-right text-xs font-sans font-medium px-4 bg-gray-200 text-slate-600 rounded-full py-1 mt-5 dark:bg-[#282E33] dark:text-gray-200 cursor-text">{{$totalInvoice}} Invoice</button>
                        </div>
                    </div>
                    <div class="bg-white flex w-full p-4 rounded border-[1.5px] border-slate-300 shadow dark:bg-[#1D2125] dark:border-[#22272B]">
                        <div class="w-1/2">
                            <p class="text-slate-500 font-mono dark:text-gray-300">Paid</p>
                            <p class="font-sans text-xl font-semibold dark:text-white truncate">Rp. {{number_format($paidAmount)}}</p>
                        </div>
                        <div class="w-1/2">
                            <button class="float-right text-xs font-sans font-medium px-4 bg-gray-200 text-slate-600 rounded-full py-1 mt-5 dark:bg-[#282E33] dark:text-gray-200 cursor-text">{{$paidInvoices}} Invoice</button>
                        </div>
                    </div>
                    <div class="bg-white flex w-full p-4 rounded border-[1.5px] border-slate-300 shadow dark:bg-[#1D2125] dark:border-[#22272B]">
                        <div class="w-1/2">
                            <p class="text-slate-500 font-mono dark:text-gray-300">Unpaid</p>
                            <p class="font-sans text-xl font-semibold dark:text-white truncate">Rp. {{number_format($pendingAmount)}}</p>
                        </div>
                        <div class="w-1/2">
                            <button class="float-right text-xs font-sans font-medium px-4 bg-gray-200 text-slate-600 rounded-full py-1 mt-5 dark:bg-[#282E33] dark:text-gray-200 cursor-text">{{$unpaidInvoices}} Invoice</button>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/3 mt-8 md:mt-0">
                    <div class="justify-between flex items-center">
                        <p class="text-xl text-slate-700 font-medium dark:text-gray-300">Invoice status</p>
                        <form action="{{route('report.invoice')}}" method="POST" target="_blank">
                            @csrf
                            <input type="hidden" id="chartImage" name="chartImage">
                            <input type="text" value="{{$timePeriod}}" name="time_period" hidden>
                            <button type="submit" class="bg-blue-500 px-4 text-white py-1 rounded">Generate Report</button>
                        </form>
                    </div>
                    <div class="w-full px-6 py-4 bg-white mt-4 rounded-md border-[1.5px] border-slate-300 grid grid-cols-2 gap-2 items-center dark:bg-[#1D2125] dark:border-[#22272B]">
                        <div class="h-32 w-32 mx-auto">
                            <canvas id="invoiceChart"></canvas>
                        </div>
                        <div class="ml-4">
                            <div class="flex items-center">
                                <div class="h-2 w-2 bg-green-400 mr-2 rounded-full"></div>
                                <p class="text-green-400 font-medium font-sans text-sm">Paid - {{number_format($paid)}}%</p>
                            </div>
                            <div class="flex items-center mt-2">
                                <div class="h-2 w-2 bg-yellow-400 mr-2 rounded-full"></div>
                                <p class="text-yellow-400 font-medium font-sans text-sm">Pending - {{number_format($pending)}}%</p>
                            </div>
                            <div class="flex items-center mt-2">
                                <div class="h-2 w-2 bg-red-400 mr-2 rounded-full"></div>
                                <p class="text-red-400 font-medium font-sans text-sm">Overdue - {{number_format($overdue)}}%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative mt-8">
                <!-- Tabs -->
                <div class="md:flex  items-center justify-between">
                    @if (Auth::user()->role === 'admin')
                        <a href="{{route('admin.create.invoice')}} " class="md:hidden"><button class="px-4 py-2 bg-blue-500 rounded-md text-white w-full text-sm mb-2">Create Invoice</button></a>
                    @endif
                    <div class="flex mb-4 md:mb-0 justify-center md:justify-normal">
                        <form @if(Auth::user()->role === 'admin') action="{{ route('admin.invoice') }}" @else action="{{ route('user.invoice') }}" @endif method="GET">
                            <select name="time_period" onchange="this.form.submit()" class="border-[1.5px] mt-2 py-1  px-2 rounded-md text-slate-500 border-slate-300 outline-none focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#1D2125] dark:border-[#22272B] dark:text-gray-200 dark:focus:border-blue-300">
                                <option value="every_time" {{ request('time_period') === 'every_time' ? 'selected' : '' }}>Every Time</option>
                                <option value="this_week" {{ request('time_period') === 'this_week' ? 'selected' : '' }}>This Week</option>
                                <option value="last_week" {{ request('time_period') === 'last_week' ? 'selected' : '' }}>Last Week</option>
                                <option value="this_month" {{ request('time_period') === 'this_month' ? 'selected' : '' }}>This Month</option>
                                <option value="last_month" {{ request('time_period') === 'last_month' ? 'selected' : '' }}>Last Month</option>
                                <option value="this_year" {{ request('time_period') === 'this_year' ? 'selected' : '' }}>This Year</option>
                                <option value="last_year" {{ request('time_period') === 'last_year' ? 'selected' : '' }}>Last Year</option>
                            </select>
                            <select name="status" onchange="this.form.submit()" class="border-[1.5px] mt-2 py-1 px-2 rounded-md text-slate-500 border-slate-300 outline-none focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#1D2125] dark:border-[#22272B] dark:text-gray-200 dark:focus:border-blue-300">
                                <option value="">All Status</option>
                                <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="overdue" {{ request('status') === 'overdue' ? 'selected' : '' }}>Overdue</option>
                            </select>
                        </form>
                    </div>
                    <div class="flex items-center justify-center md:justify-normal">
                        <form @if(Auth::user()->role === 'admin') action="{{route('admin.search.invoice')}}" @else action="{{route('invoice.search')}}" @endif method="GET">
                            @csrf
                            <input type="search" placeholder="Seacrh invoice ID, date and due date..." name="query" value="{{request('query')}}" class="py-1.5 border-[1.5px] w-[290px] px-4 rounded-full border-slate-300 focus:ring-2 focus:border-blue-100 transition-all duration-300 text-sm outline-none dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200">
                        </form>
                        @if (Auth::user()->role === 'admin')
                            <a href="{{route('admin.create.invoice')}}" class="hidden md:block"><button class="px-4 py-2 bg-blue-500 rounded-md text-white ml-2 text-sm">Create Invoice</button></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="overflow-x-scroll md:overflow-visible">
                    <table class="md:w-full w-[1200px]  ">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 text-sm leading-normal dark:bg-[#2C333A] dark:text-gray-200">
                                <th class="py-3 px-6 text-left">Inv. ID</th>
                                <th class="py-3 px-6 text-left">Client Name</th>
                                <th class="py-3 px-6 text-left">Project</th>
                                <th class="py-3 px-6 text-left">Date</th>
                                <th class="py-3 px-6 text-left">Due Date</th>
                                <th class="py-3 px-6 text-left">Amount</th>
                                <th class="py-3 px-6 text-left">Status</th>
                                <th class="py-3 px-6 text-left"></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 bg-white text-sm dark:text-gray-400">
                            @foreach ($data as $datas)
                                <tr class="border-b border-gray-200 hover:bg-gray-100 dark:bg-[#161A1D] dark:border-[#282E33] dark:hover:bg-[#282E33]">
                                    <td class="py-3 px-6">{{$datas->invoice_number}}</td>
                                    <td class="py-3 px-6 flex items-center">
                                            <img src="{{$datas->user->profile_photo ? asset('storage/profile_photos/' .  $datas->user->profile_photo) : asset('img/default.png') }}" alt="" class="w-8 h-8 rounded-full">
                                            <p class="truncate ml-2">{{implode(' ', array_slice(explode(' ', $datas->user->name), 0, 3))}}</p>
                                    </td>
                                    <td class="py-3 px-6">@foreach ($datas->project as $project){{implode(' ', array_slice(explode(' ', $project->project_name), 0, 3))}}@endforeach</td>
                                    <td class="py-3 px-6">{{\carbon\carbon::parse($datas->created_at)->format('d F Y')}}</td>
                                    <td class="py-3 px-6">{{\carbon\carbon::parse($datas->due_date)->format('d F Y')}}</td>
                                    <td class="py-3 px-6">Rp. {{ number_format($datas->total_amount) }}</td>
                                    <td class="py-3 px-6">
                                        @if ($datas->status === 'pending')
                                            <span class="text-white bg-yellow-400 px-2 py-1 rounded-full text-xs font-medium">Pending</span>
                                        @elseif ($datas->status === 'paid')
                                            <span class="text-white bg-green-500 px-2 py-1 rounded-full text-xs font-medium">Paid</span>
                                        @elseif ($datas->status === 'overdue')
                                            <span class="text-white bg-red-500 px-2 py-1 rounded-full text-xs font-medium">Overdue</span>
                                        @endif
                                    </td>
                                    <td class="py-3 w-[1%] text-center">
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-three-dots-vertical w-5 h-5 text-gray-700 dark:text-gray-200" viewBox="0 0 16 16">
                                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                    </svg>
                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                <div class="w-full p-1">
                                                    <a href="{{route('invoice.detail', $datas->invoice_number)}}">
                                                        <button class="items-center gap-3 flex w-full px-4 py-2 text-left text-sm leading-5 text-gray-500 hover:bg-gray-100 transition-all duration-150 ease-in-out focus:outline-none focus:bg-gray-100 dark:hover:bg-[#1D2125] dark:text-gray-300">
                                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-invoice">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25" />
                                                            </svg>
                                                            View Invoice
                                                        </button>
                                                    </a>
                                                    @if ($datas->status === 'paid' || $datas->status === 'overdue')
                                                    @else
                                                        @if (Auth::user()->role === 'admin')
                                                            <a href="{{route('mark.invoice', $datas->invoice_number)}}">
                                                                <button class="items-center gap-3 flex w-full px-4 py-2 text-left text-sm leading-5 text-green-400 hover:bg-gray-100 transition-all duration-150 ease-in-out focus:outline-none focus:bg-gray-100 dark:hover:bg-[#1D2125]">
                                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-receipt-2">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                                                                        <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5" />
                                                                    </svg>
                                                                    Mark As Paid
                                                                </button>
                                                            </a>
                                                        @endif
                                                    @endif
                                                    @if (Auth::user()->role === 'admin')
                                                        <form action="{{route('invoice.delete', $datas->invoice_number)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Invoice?');">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="items-center gap-3 flex w-full px-4 py-2 text-left text-sm leading-5 text-red-500 hover:bg-gray-100 transition-all duration-150 ease-in-out focus:outline-none focus:bg-gray-100 dark:hover:bg-[#1D2125]">
                                                                <span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                                    </svg>
                                                                </span>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </x-slot>
                                        </x-dropdown>
                                    </td>
                                </tr>   
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($data->isEmpty())
                    <div class="w-full bg-white shadow-sm py-6 dark:bg-[#1D2125]">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="50"  height="50"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-gray-500 dark:text-gray-300 mx-auto icon icon-tabler icons-tabler-outline icon-tabler-file-excel">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2" /><path d="M10 12l4 5" /><path d="M10 17l4 -5" />
                        </svg>
                        <p class="text-center font-medium text-gray-400 dark:text-gray-200">Invoice is Empty!</p>
                    </div>
                @else
                    <div class="bg-gray-200 py-2 px-6 shadow dark:bg-[#2C333A] dark:text-gray-200">
                        {{ $data->links('pagination::tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <footer class="mt-5 md:mt-16 md:block">
        <div class="container">
            <div class="md:px-12 px-6 md:pb-4 pb-4 w-full justify-between flex">
                <div class="w-full">
                    <p class="dark:text-slate-400 text-slate-600 text-center md:text-left text-xs md:text-sm">Made By: © 2024 Rafid Adriyan. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('invoiceChart').getContext('2d');
        const invoiceChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Paid', 'Pending', 'Overdue'],
                datasets: [{
                    label: 'Invoice Status',
                    data: [
                        {{number_format($paid)}},
                        {{number_format($pending)}},
                        {{number_format($overdue)}}
                    ],
                    backgroundColor: [
                        '#4ade80', // Warna Paid (Hijau)
                        '#facc15', // Warna Pending (Kuning)
                        '#ef4444 '  // Warna Overdue (Merah)
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                return `${label}: ${value}%`;
                            }
                        }
                    }
                },
                animation: {
                    onComplete: function () {
                        const chartImage = ctx.canvas.toDataURL('image/png');
                        document.getElementById('chartImage').value = chartImage;
                    }
                }
            }
        });
    </script>
@endsection