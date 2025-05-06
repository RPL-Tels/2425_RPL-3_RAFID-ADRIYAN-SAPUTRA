@extends('layouts.layers')
@section('title', 'Dashboard-admin')
@section('section')
<div class="container">
    <div class="md:px-12 px-5">
        <div class="md:grid flex justify-between md:grid-cols-2 w-full">
            <div class="my-auto">
                <p class="text-slate-600 font-medium md:text-sm text-xs dark:text-slate-100">OVERVIEW</p>
                <h1 class="text-slate-800 font-bold md:text-xl text-base dark:text-slate-500">Dashboard</h1>
            </div>
            <div class="flex my-auto justify-end">
                <p class="my-auto mr-4 md:text-lg text-sm text-slate-700 dark:text-slate-100 font-medium hidden md:block"><span class="text-slate-900 dark:text-gray-100 font-bold">{{implode(' ', array_slice(explode(' ', Auth::user()->name), 0, 3))}}</span></p>
                <p class="my-auto mr-4 md:text-lg text-xs text-slate-700 dark:text-slate-100 font-medium md:hidden"><span class="text-slate-900 dark:text-gray-100 font-bold">{{implode(' ', array_slice(explode(' ', Auth::user()->name), 0, 2))}}</span></p>
                <img id="default5" src="{{ Auth::user()->profile_photo ? asset('storage/profile_photos/' .  Auth::user()->profile_photo) : asset('img/default.png') }}" alt="" class="rounded-lg md:w-[50px] md:h-[50px] w-10 h-10 object-cover object-center">
                <img id="default6" src="{{Auth::user()->profile_photo ? asset('storage/profile_photos/' .  Auth::user()->profile_photo) : asset('img/default3.png') }}" alt="" class="rounded-lg md:w-[50px] md:h-[50px] w-10 h-10 object-cover object-center hidden">
            </div>
        </div>
        <div class="grid md:grid-cols-4 grid-cols-1 gap-2 md:gap-4 pt-4">
            <a href="{{route('admin.project')}}" class="group md:hover:shadow-md active:shadow-md">
                <div class="w-full shadow rounded flex">
                    <span class="px-1 bg-blue-500 rounded-l md:group-hover:bg-blue-800 group-active:bg-blue-800"></span>
                    <div class="px-4 py-4 bg-white dark:bg-[#1D2125] w-full rounded-r flex">
                        <div class="w-3/4 my-auto">
                            <p class="text-gray-500 font-medium uppercase text-sm dark:text-gray-400">Total Project</p>
                            <p class="text-gray-700 font-medium text-xl dark:text-gray-300">{{$totalProject}}</p>
                        </div>
                        <div class="my-auto w-1/4">
                            <div class="bg-blue-400 group-hover:bg-blue-800 rounded-full p-3 w-fit float-right hidden md:block">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="34"  height="34"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-briefcase-2 text-white dark:text-[#1D2125]"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M3 9a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9z" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                </svg>
                            </div>
                            <div class="bg-blue-400 group-active:bg-blue-800 rounded-full p-3 w-fit float-right md:hidden">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-briefcase-2 text-white dark:text-[#1D2125]"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M3 9a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9z" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{route('admin.project', ['category' => 'Complete'])}}" class="group md:hover:shadow-md active:shadow-md">
                <div class="w-full shadow rounded flex">
                    <span class="px-1 bg-green-400 rounded-l md:group-hover:bg-green-800 group-active:bg-green-800"></span>
                    <div class="px-4 py-4 bg-white w-full rounded-r flex dark:bg-[#1D2125]">
                        <div class="w-3/4 my-auto">
                            <p class="text-gray-500 font-medium uppercase text-sm dark:text-gray-400">Project Complete</p>
                            <p class="text-gray-700 font-medium text-xl dark:text-gray-300">{{$complete}}</p>
                        </div>
                        <div class="my-auto w-1/4">
                            <div class="bg-green-400 group-hover:bg-green-800 rounded-full p-3 w-fit float-right hidden md:block">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="34"  height="34"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-white icon icon-tabler icons-tabler-outline icon-tabler-square-check dark:text-[#1D2125]">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" />
                                </svg>
                            </div>
                            <div class="bg-green-400 rounded-full group-active:bg-green-800 p-3 w-fit float-right md:hidden">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="25"  height="25"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-white icon icon-tabler icons-tabler-outline icon-tabler-square-check dark:text-[#1D2125]">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M9 12l2 2l4 -4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{route('admin-clients')}}" class="group md:hover:shadow-md active:shadow-md">
                <div class="w-full shadow rounded flex">
                    <span class="px-1 bg-red-500 rounded-l md:group-hover:bg-red-800 group-active:bg-red-800"></span>
                    <div class="px-4 py-4 bg-white dark:bg-[#1D2125] w-full rounded-r flex">
                        <div class="w-3/4 my-auto">
                            <p class="text-gray-500 font-medium uppercase text-sm dark:text-gray-400">Total Clients</p>
                            <p class="text-gray-700 font-medium text-xl dark:text-gray-300">{{$client}}</p>
                        </div>
                        <div class="my-auto w-1/4">
                            <div class="bg-red-500 rounded-full group-hover:bg-red-800 p-3 w-fit float-right hidden md:block">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="34"  height="34"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-white icon icon-tabler icons-tabler-outline icon-tabler-users dark:text-[#1D2125]">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                            </div>
                            <div class="bg-red-500 rounded-full group-active:bg-red-800 p-3 w-fit float-right md:hidden">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="25"  height="25"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-white icon icon-tabler icons-tabler-outline icon-tabler-users dark:text-[#1D2125]">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{route('admin.invoice', ['time_period' => 'every_time', 'status' => 'paid'])}}" class="group md:shadow-md active:shadow-md">
                <div class="w-full shadow rounded flex">
                    <span class="px-1 bg-violet-500 rounded-l md:group-hover:bg-violet-800 group-active:bg-violet-800"></span>
                    <div class="px-4 py-4 bg-white w-full rounded-r flex dark:bg-[#1D2125]">
                        <div class="w-3/4 my-auto">
                            <p class="text-gray-500 font-medium uppercase text-sm dark:text-gray-400">Total Amounts</p>
                            <p class="text-gray-700 font-medium dark:text-gray-300">Rp. {{number_format($amount)}}</p>
                        </div>
                        <div class="my-auto w-1/4">
                            <div class="bg-violet-500 group-hover:bg-violet-800 rounded-full p-3 w-fit float-right hidden md:block">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="34"  height="34"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cash text-white dark:text-[#1D2125]">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                    <path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" />
                                </svg>
                            </div>
                            <div class="bg-violet-500 rounded-full group-active:bg-violet-800 p-3 w-fit float-right md:hidden">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="25"  height="25"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cash text-white dark:text-[#1D2125]">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                    <path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="w-full md:flex mt-10 gap-4">
            <div class="bg-white px-4 py-6 md:w-1/4 rounded-2xl border-[1.5px] border-gray-300 dark:border-gray-800 dark:bg-[#1D2125]">
                <p class="text-gray-800 font-medium text-xl text-center dark:text-gray-200">Invoice Overview</p>
                @if ($paid === 0 && $pending === 0 && $overdue === 0)
                <div class="md:mt-12 mt-4 mb-4 md:mb-0">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="70"  height="70"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-gray-500 mx-auto icon icon-tabler icons-tabler-outline icon-tabler-chart-pie dark:text-gray-100">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 3.2a9 9 0 1 0 10.8 10.8a1 1 0 0 0 -1 -1h-6.8a2 2 0 0 1 -2 -2v-7a.9 .9 0 0 0 -1 -.8" /><path d="M15 3.5a9 9 0 0 1 5.5 5.5h-4.5a1 1 0 0 1 -1 -1v-4.5" />
                    </svg>
                    <p class="text-center text-lg font-medium text-gray-500 dark:text-gray-300">Invoice is Empty!</p>
                </div>
                @else
                <div class="w-[11.7rem] h-[11.7rem] mx-auto mt-6">
                    <canvas id="invoiceOverview"></canvas>
                </div>
                <div class="flex mt-4 text-center">
                    <div class="mx-auto flex">
                        <div class="flex items-center mr-3">
                            <div class="w-2 h-2 rounded-full bg-[#22c55e]"></div>
                            <p class="ml-1 text-green-500">Paid ({{$paid}})</p>
                        </div>
                        <div class="flex items-center mr-3">
                            <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                            <p class="ml-1 text-yellow-500">Pending ({{$pending}})</p>
                        </div>
                    </div>
                </div>
                <div class="flex text-center">
                    <div class="mx-auto flex">
                        <div class="flex items-center mr-3">
                            <div class="w-2 h-2 rounded-full bg-red-500"></div>
                            <p class="ml-1 text-red-500">Overdue ({{$overdue}})</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="bg-white px-6 py-6 md:w-3/4 mt-4 md:mt-0 rounded-2xl border-[1.5px] border-gray-300 dark:bg-[#1D2125] dark:border-gray-800">
                <p class="text-xl font-medium text-gray-800 dark:text-gray-200">Last Invoice</p>
                <div class="overflow-x-scroll md:overflow-auto">
                    <table class="md:w-full w-[900px] mt-4">
                        <thead class="text-left">
                            <tr>
                                <th class="py-1 font-medium text-gray-700 bg-gray-200 px-4 dark:bg-[#161A1D] dark:text-gray-300 rounded-l">Inv Id</th>
                                <th class="py-1 font-medium text-gray-700 bg-gray-200 px-4 dark:bg-[#161A1D] dark:text-gray-300">Product</th>
                                <th class="py-1 font-medium text-gray-700 bg-gray-200 px-4 dark:bg-[#161A1D] dark:text-gray-300">Date</th>
                                <th class="py-1 font-medium text-gray-700 bg-gray-200 px-4 dark:bg-[#161A1D] dark:text-gray-300">Amount</th>
                                <th class="py-1 font-medium text-gray-700 bg-gray-200 px-4 dark:bg-[#161A1D] dark:text-gray-300 rounded-r">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice as $invoices)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                                <td class="border-b-[1.5px] border-gray-200 text-gray-600 md:text-sm px-4 py-1 dark:text-gray-400 dark:border-gray-800">
                                    <p class="font-medium text-slate-700 dark:text-gray-300">{{implode(' ', array_slice(explode(' ', $invoices->user->name), 0, 3))}}</p>
                                    <p class="text-xs">{{$invoices->invoice_number}}</p>
                                </td>
                                <td class="border-b-[1.5px] border-gray-200 text-gray-600 md:text-sm px-4 py-1 dark:text-gray-400 dark:border-gray-800">@foreach ($invoices->project as $items) {{implode(' ', array_slice(explode(' ', $items->project_name), 0, 4))}} @endforeach</td>
                                <td class="border-b-[1.5px] border-gray-200 text-gray-600 md:text-sm px-4 py-1 dark:text-gray-400 dark:border-gray-800">{{\carbon\carbon::parse($invoices->created_at)->format('d F Y')}}</td>
                                <td class="border-b-[1.5px] border-gray-200 text-gray-600 md:text-sm px-4 py-1 dark:text-gray-400 dark:border-gray-800">Rp. {{number_format($invoices->total_amount)}}</td>
                                <td class="border-b-[1.5px] border-gray-200 text-gray-600 md:text-sm px-4 py-1 dark:text-gray-400 dark:border-gray-800 text-left">
                                    @if ($invoices->status === 'paid')
                                        <span class="bg-green-500 py-1 px-2 text-white font-medium rounded-full text-xs capitalize">{{$invoices->status}}</span>
                                    @elseif ($invoices->status === 'pending')
                                        <span class="bg-yellow-400 py-1 px-2 text-white font-medium rounded-full text-xs capitalize">{{$invoices->status}}</span>
                                    @elseif ($invoices->status === 'overdue')
                                        <span class="bg-red-500 py-1 px-2 text-white font-medium rounded-full text-xs capitalize">{{$invoices->status}}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($invoice->isEmpty())
                    <div class="w-full bg-gray-100 dark:bg-[#101214] py-10 rounded-b">
                        <div class="mx-auto">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="40"  height="40"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-gray-600 mx-auto icon icon-tabler icons-tabler-outline icon-tabler-files-off dark:text-gray-300">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 3v4a1 1 0 0 0 1 1h4" /><path d="M17 17h-6a2 2 0 0 1 -2 -2v-6m0 -4a2 2 0 0 1 2 -2h4l5 5v7c0 .294 -.063 .572 -.177 .823" /><path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2" /><path d="M3 3l18 18" />
                            </svg>
                            <p class="text-center font-medium text-gray-600 dark:text-gray-400">Invoice is Empty!</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="w-full md:flex mt-8 gap-4">
            <div class="bg-white px-6 py-6 md:w-3/4 rounded-2xl border-[1.5px] border-gray-300 dark:bg-[#1D2125] dark:border-gray-800">
                <p class="text-xl font-medium text-gray-800 dark:text-gray-200">Last Project</p>
                <div class="overflow-x-scroll md:overflow-auto">
                    <table class="md:w-full w-[950px] mt-4 overflow-hidden">
                        <thead class="text-left">
                            <tr>
                                <th class="py-1 font-medium text-gray-700 bg-gray-200 px-4 dark:bg-[#161A1D] dark:text-gray-300 rounded-l">Name</th>
                                <th class="py-1 font-medium text-gray-700 bg-gray-200 px-4 dark:bg-[#161A1D] dark:text-gray-300">Client</th>
                                <th class="py-1 font-medium text-gray-700 bg-gray-200 px-4 dark:bg-[#161A1D] dark:text-gray-300">Start</th>
                                <th class="py-1 font-medium text-gray-700 bg-gray-200 px-4 dark:bg-[#161A1D] dark:text-gray-300">Deadline</th>
                                <th class="py-1 font-medium text-gray-700 bg-gray-200 px-4 dark:bg-[#161A1D] dark:text-gray-300 rounded-r w-40">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($project as $projects)
                           <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                                <td class="border-b-[1.5px] border-gray-200 text-gray-600 text-sm px-4 py-1 dark:text-gray-400 dark:border-gray-800">
                                    <p class="font-medium text-slate-700 dark:text-gray-300">{{implode(' ', array_slice(explode(' ', $projects->project_name), 0, 3))}}</p>
                                    <p>{{$projects->project_id}}</p>
                                </td>
                                <td class="border-b-[1.5px] border-gray-200 text-gray-600 text-sm px-4 py-1 dark:text-gray-400 dark:border-gray-800">
                                    <div class="flex items-center">
                                        <img src="{{$projects->user->profile_photo ? asset('storage/profile_photos/' .  $projects->user->profile_photo) : asset('img/default.png') }}" class="w-8 h-8 rounded-full">
                                        <p class="ml-2">{{implode(' ', array_slice(explode(' ', $projects->client_name), 0, 3))}}</p>
                                    </div>
                                </td>
                                <td class="border-b-[1.5px] border-gray-200 text-gray-600 text-sm px-4 py-1 dark:text-gray-400 dark:border-gray-800">{{\carbon\carbon::parse($projects->created_at)->format('d F Y')}}</td>
                                <td class="border-b-[1.5px] border-gray-200 text-gray-600 text-sm px-4 py-1 dark:text-gray-400 dark:border-gray-800">{{\carbon\carbon::parse($projects->due_date)->format('d F Y')}}</td>
                                <td class="border-b-[1.5px] border-gray-200 text-gray-600 text-sm px-4 py-1 dark:text-gray-400 dark:border-gray-800 w-40">
                                    @if ($projects->category === 'Complete')
                                        <span class="bg-green-500 py-1 px-2 text-white font-medium rounded-full text-xs capitalize">{{$projects->category}}</span>
                                    @elseif ($projects->category === 'Pending')
                                        <span class="bg-yellow-400 py-1 px-2 text-white font-medium rounded-full text-xs capitalize">{{$projects->category}}</span>
                                    @elseif ($projects->category === 'In progress')
                                        <span class="bg-slate-500 py-1 px-2 text-white font-medium rounded-full text-xs capitalize">{{$projects->category}}</span>
                                    @elseif ($projects->category === 'Due contract')
                                        <span class="bg-red-500 py-1 px-2 text-white font-medium rounded-full text-xs capitalize">{{$projects->category}}</span>
                                    @else
                                        <span class="bg-red-500 py-1 px-2 text-white font-medium rounded-full text-xs capitalize">{{$projects->category}}</span>
                                    @endif
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($project->isEmpty())
                    <div class="w-full bg-gray-100 dark:bg-[#101214] py-10 rounded-b">
                        <div class="mx-auto">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="40"  height="40"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-gray-600 mx-auto icon icon-tabler icons-tabler-outline icon-tabler-files-off dark:text-gray-300">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 3v4a1 1 0 0 0 1 1h4" /><path d="M17 17h-6a2 2 0 0 1 -2 -2v-6m0 -4a2 2 0 0 1 2 -2h4l5 5v7c0 .294 -.063 .572 -.177 .823" /><path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2" /><path d="M3 3l18 18" />
                            </svg>
                            <p class="text-center font-medium text-gray-600 dark:text-gray-400">Project is Empty!</p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="bg-white px-4 py-6 mt-4 md:mt-0 md:w-1/4 rounded-2xl border-[1.5px] border-gray-300 dark:bg-[#1D2125] dark:border-gray-800">
                <p class="text-center text-gray-800 font-medium text-xl dark:text-gray-300">Total Project</p>
                @if ($projectComplete === 0 && $projectPending === 0 && $projectOverdue === 0 && $projectInProgress === 0)
                <div class="md:mt-12 mt-4 mb-4 md:mb-0">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="70"  height="70"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-gray-500 dark:text-gray-100 mx-auto icon icon-tabler icons-tabler-outline icon-tabler-chart-pie">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 3.2a9 9 0 1 0 10.8 10.8a1 1 0 0 0 -1 -1h-6.8a2 2 0 0 1 -2 -2v-7a.9 .9 0 0 0 -1 -.8" /><path d="M15 3.5a9 9 0 0 1 5.5 5.5h-4.5a1 1 0 0 1 -1 -1v-4.5" />
                    </svg>
                    <p class="text-center text-lg font-medium text-gray-500 dark:text-gray-300">Project is Empty!</p>
                </div>
                @else
                <div class="w-[11.7rem] h-[11.7rem] mx-auto mt-6">
                    <canvas id="projectChart"></canvas>
                </div>
                <div class="flex mt-4 text-center">
                    <div class="mx-auto flex">
                        <div class="flex items-center mr-3">
                            <div class="w-2 h-2 rounded-full bg-[#22c55e]"></div>
                            <p class="ml-1 text-green-500">Complete ({{$projectComplete}})</p>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                            <p class="ml-1 text-yellow-500">Pending ({{$projectPending}})</p>
                        </div>
                    </div>
                </div>
                <div class="flex text-center">
                    <div class="mx-auto flex">
                        <div class="flex items-center mr-3">
                            <div class="w-2 h-2 rounded-full bg-red-500"></div>
                            <p class="ml-1 text-red-500">Overdue ({{$projectOverdue}})</p>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full bg-slate-500"></div>
                            <p class="ml-1 text-slate-500">In progress ({{$projectInProgress}})</p>  
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <footer class="mt-5 md:mt-10 md:block">
        <div class="container">
            <div class="md:px-12 px-6 md:pb-4 pb-4 w-full justify-between flex">
                <div class="w-full">
                    <p class="dark:text-slate-400 text-slate-600 text-center md:text-left text-xs md:text-sm">Made By: © 2024 Rafid Adriyan. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let chartBorderColor = isDarkMode() ? '#1D2125' : '#ffffff';
    let chartBorderColor2 = isDarkMode() ? '#1D2125' : '#ffffff';
    const ctxinvocie = document.getElementById('invoiceOverview').getContext('2d');
    const chart = new Chart(ctxinvocie, {
        type: 'doughnut',
        data: {
            labels: ['Paid', 'Pending', 'Overdue'],
            datasets: [{
                data: [{{$paid}}, {{$pending}}, {{$overdue}}],
                backgroundColor: ['#4ade80', '#fcd34d', '#ef4444'],
                hoverBackgroundColor: ['#22c55e', '#fbbf24', '#dc2626'],
                borderColor: chartBorderColor,
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
                            return `${label}: ${value}  `;
                        }
                    }
                }
            },
        }
    });

    const ctxProject = document.getElementById('projectChart').getContext('2d');
    const charta = new Chart(ctxProject, {
        type: 'doughnut',
        data: {
            labels: ['Complete', 'Pending', 'Overdue', 'In progresss'],
            datasets: [{
                data: [{{$projectComplete}}, {{$projectPending}}, {{$projectOverdue}}, {{$projectInProgress}}],
                backgroundColor: ['#4ade80', '#fcd34d', '#ef4444', '#64748b'],
                hoverBackgroundColor: ['#22c55e', '#fbbf24', '#dc2626', '#64748b'],
                borderColor: chartBorderColor2,
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
                            return `${label}: ${value}  `;
                        }
                    }
                }
            },
        }
    });

    // Deteksi perubahan mode (opsional jika mode dapat berubah secara dinamis)
    // Deteksi perubahan mode
    const darkModeObserver = new MutationObserver(() => {
        const isDark = isDarkMode();
        
        // Perbarui borderColor untuk chart pertama
        chart.data.datasets[0].borderColor = isDark ? '#1D2125' : '#ffffff';
        chart.update();

        // Perbarui borderColor untuk chart kedua
        charta.data.datasets[0].borderColor = isDark ? '#1D2125' : '#ffffff';
        charta.update();
    });

    // Observasi perubahan mode gelap
    darkModeObserver.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class'] // Observasi perubahan pada atribut 'class'
    });

    // Helper function
    function isDarkMode() {
        return document.documentElement.classList.contains('dark');
    }
</script>
@endsection