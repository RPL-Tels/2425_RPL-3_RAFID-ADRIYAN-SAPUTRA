@extends('layouts.layers')
@section('title', 'Project-Details')
@section('section')
    <div class="container">
        <div class="md:px-12 px-5">
            <div class="flex justify-between">
                <div class="mt-4 w-full md:w-52">
                    <form id="chartForm" method="POST" action="{{ route('project.report', $data->project_id) }}">
                        @csrf
                        <input type="hidden" id="chartImage" name="chartImage">
                        <button type="submit" class="w-full border-[1.5px] border-blue-300 px-10 bg-blue-500 dark:border-blue-500 text-white rounded-full py-1 font-medium transition-colors duration-100 hover:bg-blue-600">
                            Generate Report
                        </button>
                    </form>
                </div>
                <div class="md:flex mt-4 hidden">
                    @if (Auth::user()->role === 'admin')
                        <form action="{{route('project.delete', $data->project_id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="border-[1.5px] border-slate-300 px-10 mr-2 dark:bg-[#2C333A] dark:border-[#38414A] dark:text-gray-300 bg-white rounded-full py-1 font-medium text-slate-600 hover:bg-red-100 hover:border-red-500 hover:text-red-500 transition-colors duration-100 cursor-pointer dark:hover:bg-red-300 dark:hover:text-red-800 dark:hover:border-red-300">
                        </form>
                        <a href="{{route('project.form.update', $data->project_id)}}" class="border-[1.5px] border-slate-300 dark:bg-[#2C333A] dark:border-[#38414A] dark:text-gray-300 px-10 mr-2 bg-white rounded-full py-1 font-medium text-slate-600 hover:bg-green-100 hover:text-green-500 hover:border-green-500 transition-colors duration-100 dark:hover:bg-green-300 dark:hover:text-green-800 dark:hover:border-green-300">Edit</a>
                        <a href="{{route('admin.project')}}" class="border-[1.5px] border-slate-300 px-10 mr-2 dark:bg-[#2C333A] dark:border-[#38414A] dark:text-gray-300 bg-white rounded-full py-1 font-medium text-slate-600 hover:bg-blue-100 hover:border-blue-500 hover:text-blue-500 transition-colors duration-100 dark:hover:bg-blue-300 dark:hover:text-blue-800 dark:hover:border-blue-300">Back</a>
                    @else
                        <a href="{{route('user.project')}}" class="border-[1.5px] border-slate-300 px-10 mr-2 dark:bg-[#2C333A] dark:border-[#38414A] dark:text-gray-300 bg-white rounded-full py-1 font-medium text-slate-600 hover:bg-blue-100 hover:border-blue-500 hover:text-blue-500 transition-colors duration-100 dark:hover:bg-blue-300 dark:hover:text-blue-800 dark:hover:border-blue-300">Back</a>
                    @endif
                </div>
            </div>
            <div class="md:hidden mt-4">
                @if (Auth::user()->role === 'admin')
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <form action="{{route('project.delete', $data->project_id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="w-full border-[1.5px] text-sm border-slate-300 px-8 dark:bg-[#2C333A] dark:border-[#38414A] dark:text-gray-300 bg-white rounded-full py-1 font-medium text-slate-600 hover:bg-red-100 hover:border-red-500 hover:text-red-500 transition-colors duration-100 cursor-pointer dark:hover:bg-red-300 dark:hover:text-red-800 dark:hover:border-red-300">
                            </form>
                        </div>
                        <div>
                            <a href="{{route('project.form.update', $data->project_id)}}"><button class="w-full py-1 rounded-full text-sm border-[1.5px] font-medium text-slate-600 border-slate-300 bg-white hover:bg-green-100 hover:border-green-500 hover:text-green-500 transition-colors duration-100 dark:hover:bg-green-300 dark:hover:text-green-800 dark:hover:border-green-300 dark:bg-[#2C333A] dark:border-[#38414A] dark:text-gray-300">Edit</button></a>
                        </div>
                        <div>
                            <a href="{{route('admin.project')}}"><button class="w-full py-1 rounded-full text-sm border-[1.5px] font-medium text-slate-600 border-slate-300 bg-white hover:bg-blue-100 hover:border-blue-500 hover:text-blue-500 transition-colors duration-100 dark:hover:bg-blue-300 dark:hover:text-blue-800 dark:hover:border-blue-300 dark:bg-[#2C333A] dark:border-[#38414A] dark:text-gray-300">Back</button></a>
                        </div>
                    </div>
                @else
                    <a href="{{route('user.project')}}"><button class="w-full py-1 rounded-full text-sm border-[1.5px] font-medium text-slate-600 border-slate-300 bg-white hover:bg-blue-100 hover:border-blue-500 hover:text-blue-500 transition-colors duration-100 dark:hover:bg-blue-300 dark:hover:text-blue-800 dark:hover:border-blue-300 dark:bg-[#2C333A] dark:border-[#38414A] dark:text-gray-300">Back</button></a>
                @endif
            </div>
            <div class="md:w-[50%] w-full h-52 mt-5 md:hidden bg-gray-300 bg-cover bg-center rounded-t-md" style="background-image: url({{asset('storage/'.$data->tumbnail)}})"></div>
                {{-- @if ($modelUrl === url('storage'))
                    <div class="md:w-[50%] w-full h-52 mt-5 md:hidden bg-gray-300 bg-cover bg-center rounded-t-md" style="background-image: url({{asset('storage/'.$data->tumbnail)}})"></div>
                @else
                    <div class="md:w-[50%] w-full h-52 mt-5 bg-gray-300 rounded-r-md md:hidden" id="kotak2"></div>
                @endif --}}
            <div class="w-full h-fit bg-white md:mt-8 rounded-b-md md:rounded-md border-[1.5px] border-slate-300 block md:flex dark:bg-[#22272B] dark:border-[#282E33]">
                <div class="md:w-[50%] w-full px-6 py-6">
                    <div class="flex justify-between items-center">
                        <div class="w-[75%]">
                            <p class="md:text-xl font-medium text-slate-700 capitalize dark:text-white">{{$data->project_name}} project ({{$data->project_id}})</p>
                            <p class="md:text-sm text-xs text-slate-500 dark:text-gray-400">Created : {{\carbon\carbon::parse($data->created_at)->format('d F Y')}}</p>
                        </div>
                        <div class="hidden md:flex">
                            @if ($data->category === "Pending")
                                <button class="px-7 py-1 border-[1.5px] rounded-full text-sm border-yellow-200 text-yellow-500 bg-yellow-100 dark:bg-yellow-300 dark:text-yellow-800 dark:border-yellow-300 font-medium cursor-default">{{$data->category}}</button>
                            @elseif ($data->category === "Complete")
                                <button class="px-7 py-1 border-[1.5px] rounded-full text-sm border-green-200 text-green-500 bg-green-100 font-medium cursor-default dark:bg-green-300 dark:text-green-800 dark:border-green-300">{{$data->category}}</button>
                            @elseif ($data->category === "In progress")
                                <button class="px-7 py-1 border-[1.5px] rounded-full text-sm border-slate-300 text-slate-500 font-medium cursor-default dark:bg-slate-300 dark:text-slate-800 dark:border-slate-300">{{$data->category}}</button>
                            @elseif ($data->category === "Due contract")
                                <button class="px-7 py-1 border-[1.5px] rounded-full text-sm border-red-200 text-red-400 bg-red-100 font-medium cursor-default dark:bg-red-300 dark:text-red-800 dark:border-red-300">{{$data->category}}</button>
                            @elseif ($data->category === "Payment overdue")
                                <button class="px-7 py-1 border-[1.5px] rounded-full text-sm border-red-200 text-red-400 bg-red-100 font-medium cursor-default dark:bg-red-300 dark:text-red-800 dark:border-red-300">{{$data->category}}</button>
                            @endif
                        </div>
                    </div>
                    <p class="text-sm text-slate-500 truncate dark:text-gray-400">Clients : {{implode(' ', array_slice(explode(' ', $data->client_name), 0, 3))}}</p>
                    <div class="md:hidden mt-4 w-full">
                        @if ($data->category === "Pending")
                            <button class="px-7 py-1 border-[1.5px] rounded-full text-sm w-full border-yellow-200 text-yellow-500 bg-yellow-100 dark:bg-yellow-300 dark:text-yellow-800 dark:border-yellow-300 font-medium cursor-default">{{$data->category}}</button>
                        @elseif ($data->category === "Complete")
                            <button class="px-7 py-1 border-[1.5px] rounded-full text-sm w-full border-green-200 text-green-500 bg-green-100 font-medium cursor-default dark:bg-green-300 dark:text-green-800 dark:border-green-300">{{$data->category}}</button>
                        @elseif ($data->category === "In progress")
                            <button class="px-7 py-1 border-[1.5px] rounded-full text-sm w-full border-slate-300 text-slate-500 font-medium cursor-default dark:bg-slate-300 dark:text-slate-800 dark:border-slate-300">{{$data->category}}</button>
                        @elseif ($data->category === "Due contract")
                            <button class="px-7 py-1 border-[1.5px] rounded-full text-sm w-full border-red-200 text-red-400 bg-red-100 font-medium cursor-default dark:bg-red-300 dark:text-red-800 dark:border-red-300">{{$data->category}}</button>
                        @elseif ($data->category === "Payment overdue")
                            <button class="px-7 py-1 border-[1.5px] rounded-full text-sm w-full border-red-200 text-red-400 bg-red-100 font-medium cursor-default dark:bg-red-300 dark:text-red-800 dark:border-red-300">{{$data->category}}</button>
                        @endif
                    </div>
                    <p class="mt-3 text-slate-800 text-justify dark:text-gray-200 text-xs md:text-base">{{$data->description}}</p>
                    <div class="mt-3 flex items-center">
                        <div class="w-24 h-24 ml-5" style="position: absolute; top: -9999px; left:">
                            <canvas id="completionChart"></canvas>
                        </div>
                    </div>
                    <div class="w-full items-center">
                        <div class="w-full flex items-center mt-2">
                            <div class="w-full bg-gray-200 dark:bg-[#101214] rounded-full">
                                <div class="bg-blue-500 py-1.5 rounded-full" style="width: {{number_format($percent)}}%;"></div>
                            </div>
                            <p class="items-center ml-2 text-gray-700 font-medium dark:text-gray-300">{{number_format($percent)}}%</p>
                        </div>
                    </div>
                    <p class="mt-4 text-slate-500 dark:text-gray-400 text-sm md:text-base">Due : {{\carbon\carbon::parse($data->due_contract)->format('d F Y')}}</p>
                </div>
                <div class="md:w-[50%] w-full bg-gray-300 bg-cover bg-center hidden md:flex rounded-md rounded-l-none" style="background-image: url({{asset('storage/'.$data->tumbnail)}})"></div>
                {{-- @if ($modelUrl === url('storage'))
                    <div class="md:w-[50%] w-full bg-gray-300 bg-cover bg-center hidden md:flex rounded-md rounded-l-none" style="background-image: url({{asset('storage/'.$data->tumbnail)}})"></div>
                @else
                    <div class="md:w-[50%] w-full bg-gray-300 rounded-r-md hidden md:flex" id="kotak"></div>
                @endif --}}
            </div>
            <div class="w-full mt-8">
                <div class="flex w-full justify-between items-center">
                    <div class="flex items-center">
                        <p class="text-xl font-medium text-gray-700 dark:text-gray-300">Project Product</p>
                        <div class="ml-3">
                            <!-- Trigger Button -->
                            @if ($has->isEmpty())
                                @if (Auth::user()->role === "admin")
                                    <button id="openModal" class="px-4 py-1.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                        Add Product
                                    </button>
                                @endif
                            @endif
                            <!-- Modal -->
                            <div id="modal" class="fixed inset-0 hidden items-center justify-center z-10 bg-[#00000080] bg-opacity-75">
                                <div class="bg-white rounded-lg shadow-lg md:w-1/3 p-6 w-80 dark:bg-[#1D2125]">
                                    <h2 class="text-xl font-semibold mb-4 dark:text-white">Add Product</h2>
                                    <form id="addProductForm" method="POST" action="{{route('items.store', $data->project_id)}}">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Product Name</label>
                                            <input type="text" name="items_name" placeholder="ex: 3d model..." class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" autocomplete="OFF" required>
                                        </div>
                                        <div class="mb-4 grid grid-cols-2 gap-2">
                                            <div>
                                                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Quantity</label>
                                                <input type="number" id="qty" min="1" max="5" name="quantity" value="1"  class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" autocomplete="OFF" required>
                                            </div>
                                            <div>
                                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Price</label>
                                                <input type="text" name="price" id="unit_price" placeholder="ex: Rp 200.000" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" autocomplete="OFF" required>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Amount</label>
                                            <input type="text" name="amount" id="amount" placeholder="Rp. 200.000" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" autocomplete="OFF" readonly required>
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button type="button" id="closeModal"
                                                class="px-4 py-2 text-gray- 700 bg-gray-200 rounded-lg hover:bg-gray-300">Cancel</button>
                                            <button type="submit"
                                                class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Add Product</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full grid md:grid-cols-2 gap-4 mt-6 grid-cols-1">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($items as $item)
                    <div class="w-full border-[1.5px] border-slate-300 rounded dark:border-[#282E33]">
                        <div class="w-full">
                            <div class="w-full h-60 bg-gray-300 rounded-r-md" id="kotak{{$loop->index}}" data-model-url="{{ asset('storage/' . $item->file_path) }}"></div>
                            {{-- @if ($modelUrl === url('storage'))
                                <div class="md:w-full w-full h-80 bg-gray-300 bg-cover bg-center rounded-t-md" style="background-image: url({{asset('storage/'.$data->tumbnail)}})"></div>
                            @else
                                <div class="md:w-[50%] w-full h-52 mt-5 bg-gray-300 rounded-r-md" id="kotak"></div>
                            @endif --}}
                        </div>
                        <div class="w-full px-4 py-4 bg-white border-t-[1.5px] border-slate-300 rounded-b dark:bg-[#22272B] dark:border-[#282E33]">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-medium text-slate-700 capitalize dark:text-white">{{$item->items_name}}<span>({{$item->items_id}})</span></p>
                                    <p class="text-xs md:text-sm text-slate-500 dark:text-gray-400">{{$item->stage}}</p>
                                </div>
                                <div class="flex items-center">
                                    <div class="mr-2 hidden md:block">
                                        @if ($item->category === "Pending")
                                            <button class="px-7 py-1 border-[1.5px] rounded-full text-sm border-yellow-200 text-yellow-500 bg-yellow-100 dark:bg-yellow-300 dark:text-yellow-800 dark:border-yellow-300 font-medium cursor-default">{{$item->category}}</button>
                                        @elseif ($item->category === "Complete")
                                            <button class="px-7 py-1 border-[1.5px] rounded-full text-sm border-green-200 text-green-500 bg-green-100 font-medium cursor-default dark:bg-green-300 dark:text-green-800 dark:border-green-300">{{$item->category}}</button>
                                        @elseif ($item->category === "In progress")
                                            <button class="px-7 py-1 border-[1.5px] rounded-full text-sm border-slate-300 text-slate-500 font-medium cursor-default dark:bg-slate-300 dark:text-slate-800 dark:border-slate-300">{{$item->category}}</button>
                                        @elseif ($item->category === "Due contract")
                                            <button class="px-7 py-1 border-[1.5px] rounded-full text-sm border-red-200 text-red-400 bg-red-100 font-medium cursor-default dark:bg-red-300 dark:text-red-800 dark:border-red-300">{{$item->category}}</button>
                                        @elseif ($item->category === "Payment overdue")
                                            <button class="px-7 py-1 border-[1.5px] rounded-full text-sm border-red-200 text-red-400 bg-red-100 font-medium cursor-default dark:bg-red-300 dark:text-red-800 dark:border-red-300">{{$item->category}}</button>
                                        @endif
                                    </div>
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-three-dots-vertical w-5 h-5 text-gray-700 dark:text-gray-300" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <div class="w-full p-1">
                                                <a href="{{route('ai', $item->items_id)}}">
                                                    <button class="items-center gap-3 flex w-full px-4 py-2 text-left text-sm leading-5 text-gray-500 hover:bg-gray-100 transition-all duration-150 ease-in-out focus:outline-none focus:bg-gray-100 dark:hover:bg-[#1D2125] dark:text-gray-300">
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18    "  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cube">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 16.008v-8.018a1.98 1.98 0 0 0 -1 -1.717l-7 -4.008a2.016 2.016 0 0 0 -2 0l-7 4.008c-.619 .355 -1 1.01 -1 1.718v8.018c0 .709 .381 1.363 1 1.717l7 4.008a2.016 2.016 0 0 0 2 0l7 -4.008c.619 -.355 1 -1.01 1 -1.718z" /><path d="M12 22v-10" /><path d="M12 12l8.73 -5.04" /><path d="M3.27 6.96l8.73 5.04" />
                                                        </svg>
                                                        View Full 3D
                                                    </button>
                                                </a>
                                                @if (Auth::user()->role === 'admin')
                                                    @if ($item->category !== "Complete")
                                                        <a href="{{route('items.update', $item->items_id)}}">
                                                            <button class="items-center gap-3 flex w-full px-4 py-2 text-left text-sm leading-5 text-blue-500 hover:bg-gray-100 transition-all duration-150 ease-in-out focus:outline-none focus:bg-gray-100 dark:hover:bg-[#1D2125]">
                                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                    <path d="M16 5l3 3" />
                                                                </svg>
                                                                Edit/Upload
                                                            </button>
                                                        </a>
                                                    @endif
                                                    @if ($has->isEmpty())
                                                        <form action="{{route('items.delete', $item->items_id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this items?');">
                                                            @csrf
                                                            @method('DELETE')
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
                                                @endif
                                            </div>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </div>
                            <div class="md:hidden mt-2 w-full">
                                @if ($data->category === "Pending")
                                    <button class="px-7 py-1 border-[1.5px] rounded-full text-sm w-full border-yellow-200 text-yellow-500 bg-yellow-100 dark:bg-yellow-300 dark:text-yellow-800 dark:border-yellow-300 font-medium cursor-default">{{$data->category}}</button>
                                @elseif ($data->category === "Complete")
                                    <button class="px-7 py-1 border-[1.5px] rounded-full text-sm w-full border-green-200 text-green-500 bg-green-100 font-medium cursor-default dark:bg-green-300 dark:text-green-800 dark:border-green-300">{{$data->category}}</button>
                                @elseif ($data->category === "In progress")
                                    <button class="px-7 py-1 border-[1.5px] rounded-full text-sm w-full border-slate-300 text-slate-500 font-medium cursor-default dark:bg-slate-300 dark:text-slate-800 dark:border-slate-300">{{$data->category}}</button>
                                @elseif ($data->category === "Due contract")
                                    <button class="px-7 py-1 border-[1.5px] rounded-full text-sm w-full border-red-200 text-red-400 bg-red-100 font-medium cursor-default dark:bg-red-300 dark:text-red-800 dark:border-red-300">{{$data->category}}</button>
                                @elseif ($data->category === "Payment overdue")
                                    <button class="px-7 py-1 border-[1.5px] rounded-full text-sm w-full border-red-200 text-red-400 bg-red-100 font-medium cursor-default dark:bg-red-300 dark:text-red-800 dark:border-red-300">{{$data->category}}</button>
                                @endif
                            </div>
                            <div class="w-full items-center">
                                <div class="w-full flex items-center mt-2">
                                    <div class="w-full bg-gray-200 dark:bg-[#101214] rounded-full">
                                        <div class="bg-blue-500 py-1.5 rounded-full" style="width: {{$item->progres}}%;"></div>
                                    </div>
                                    <p class="items-center ml-2 text-gray-700 font-medium dark:text-gray-300">{{$item->progres}}%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-8">
                {{ $items->links('pagination::tailwind') }}
            </div>
            <div class="w-full border-[1.4px] mt-8 border-gray-200 dark:border-[#1D2125]"></div>
            @if ($history->isNotEmpty())
                <div class="mt-6">
                    <span class="font-semibold font-mono text-xl dark:text-white">Project update history</span>
                    <div class="w-full mt-4 max-h-72 overflow-y-scroll">
                        <table class="md:w-full w-[1180px] table-auto border-collapse shadow">
                            <thead class="sticky top-0">
                                <tr class="bg-gray-200 text-gray-600 text-sm leading-normal dark:bg-[#2C333A] dark:text-gray-200">
                                    <th class="py-3 px-6 text-left">Date</th>
                                    <th class="py-3 px-6 text-left">Time</th>
                                    <th class="py-3 px-6 text-left">Name</th>
                                    <th class="py-3 px-6 text-left">Id</th>
                                    <th class="py-3 px-6 text-left">Update by</th>
                                    <th class="py-3 px-6 text-left">Description</th>
                                    <th class="py-3 px-6 text-center">Progress</th>
                                    <th class="py-3 px-6 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 bg-white text-sm dark:text-gray-400">
                                @foreach ($history as $histori)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100 dark:bg-[#161A1D] dark:border-[#282E33] dark:hover:bg-[#282E33]">
                                        <td class="py-5 px-6">{{\carbon\carbon::parse($histori->created_at)->format('d F Y')}}</td>
                                        <td class="py-5 px-6">{{\carbon\carbon::parse($histori->created_at)->format('H.i')}}</td>
                                        <td class="py-5 px-6">{{implode(' ', array_slice(explode(' ', $histori->name), 0, 4))}}</td>
                                        @if($histori->items_id == null)
                                            <td class="py-3 px-6">{{$histori->project_id}}</td>
                                        @else
                                            <td class="py-3 px-6">{{$histori->items_id}}</td>
                                        @endif
                                        <td class="py-5 px-6">{{implode(' ', array_slice(explode(' ', $histori->by), 0, 3))}}</td>
                                        <td class="py-5 px-6">{{implode(' ', array_slice(explode(' ', $histori->description), 0, 6))}}</td>
                                        <td class="py-5 px-6 text-center">{{$histori->progress}}%</td>
                                        <td class="py-5 px-6 text-center">
                                            @if($histori->status === "Complete")
                                                <span class="text-white bg-green-500 px-2 py-1 rounded-full text-xs font-medium">{{$histori->status}}</span>
                                            @elseif($histori->status === "In progress")
                                                <span class="px-2 py-1 border border-gray-500 rounded-full text-xs font-medium">{{$histori->status}}</span>
                                            @elseif($histori->status === "Pending")
                                                <span class="text-white bg-yellow-400 px-2 py-1 rounded-full text-xs font-medium">{{$histori->status}}</span>
                                            @else()
                                                <span class="text-white bg-red-500 px-2 py-1 rounded-full text-xs font-medium">{{$histori->status}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <footer class="mt-5 md:mt-10 md:block inset-x-0">
        <div class="container">
            <div class="md:px-12 px-6 md:pb-10 pb-4 w-full justify-between flex">
                <div class="w-full">
                    <p class="dark:text-slate-400 text-slate-600 text-center md:text-left text-xs md:text-base">Made By: © 2024 Rafid Adriyan. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    @foreach ($errors->all() as $error)
        <li class="font-medium my-auto text-slate-700">{{ $error }}</li>
    @endforeach
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.modelUrl = "{{ $modelUrl }}";

        let chartBorderColor = isDarkMode() ? '#22272B' : '#ffffff';
        const completionPercentage = {{ number_format($percent, 2) }};
        const ctx = document.getElementById('completionChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Not Completed'],
                datasets: [{
                    data: [completionPercentage, 100 - completionPercentage],
                    backgroundColor: ['#3498db', '#bdc3c7'],
                    hoverBackgroundColor: ['#2980b9', '#95a5a6'],
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

        const darkModeObserver = new MutationObserver(() => {
            const isDark = isDarkMode();
            
            // Perbarui borderColor untuk chart pertama
            chart.data.datasets[0].borderColor = isDark ? '#22272B' : '#ffffff';
            chart.update();
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

        document.addEventListener("DOMContentLoaded", () => {
            const openModal = document.getElementById("openModal");
            const closeModal = document.getElementById("closeModal");
            const modal = document.getElementById("modal");
            openModal.addEventListener("click", () => {
                modal.classList.remove("hidden");
                modal.classList.add("flex");
            });

            closeModal.addEventListener("click", () => {
                modal.classList.add("hidden");
                modal.classList.remove("flex");
            });

            modal.addEventListener("click", (e) => {
                if (e.target === modal) {
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const unitPriceInput = document.getElementById("unit_price");
            const qtyInput = document.getElementById("qty");
            const amountInput = document.getElementById("amount");
            // Fungsi untuk memformat angka ke dalam Rupiah
            function formatRupiah(number) {
                if (!number) return "";
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0,
                }).format(number).trim(); // Hilangkan simbol Rp jika diinginkan
            }
            // Fungsi untuk menghitung total amount
            function calculateAmount() {
                const unitPrice = parseInt(unitPriceInput.value.replace(/[^0-9]/g, ""), 10) || 0; // Bersihkan format
                const qty = parseInt(qtyInput.value, 10) || 0;
                let totalAmount = 0;
                if (qty <= 1) {
                    totalAmount = unitPrice; // Jika qty 1 atau kurang
                } else {
                    totalAmount = unitPrice * qty; // Jika qty lebih dari 1
                }
                // Set nilai hanya jika elemen ditemukan
                value = formatRupiah(totalAmount);
                amountInput.value = formatRupiah(totalAmount);
            }
            // Tambahkan event listener untuk input
            unitPriceInput.addEventListener("input", calculateAmount);
            qtyInput.addEventListener("input", calculateAmount);
        });

        document.addEventListener("DOMContentLoaded", function () {
            const currencyInput = document.getElementById("unit_price");

            // Fungsi untuk mencegah penghapusan awalan "Rp."
            currencyInput.addEventListener("input", function () {
                if (!this.value.startsWith("Rp ")) {
                    this.value = "Rp " + this.value.replace(/^Rp\./, ""); // Pastikan awalan selalu "Rp."
                }
            });

            // Fungsi untuk memposisikan kursor setelah "Rp."
            currencyInput.addEventListener("focus", function () {
                const length = this.value.length;
                this.setSelectionRange(length, length); // Kursor di akhir teks
            });

            // Mencegah kursor berada sebelum "Rp."
            currencyInput.addEventListener("keydown", function (event) {
                if (this.selectionStart < 3 && (event.key === "Backspace" || event.key === "ArrowLeft")) {
                    event.preventDefault(); // Cegah penghapusan awalan atau navigasi ke posisi awal
                }
            });
        });
    </script>
@endsection