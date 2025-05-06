@extends('layouts.layers')
@section('title', 'Download-list')
@section('section')
<div class="container">
    <div class="px-5 md:px-12">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-slate-600 font-medium md:text-md dark:text-slate-100">Download list data</p>
                <h1 class="text-slate-800 font-medium md:text-2xl text-base dark:text-slate-400">Project <span class="font-bold ml-2 underline">{{$project->project_name}}</span><span class="font-mono font-semibold text-blue-400"> ({{$project->project_id}})</span></h1>
            </div>
        </div>
        @php
            $a = 1
        @endphp
        <div class="mb-10">
            @if ($emp->isNotEmpty())
                @foreach ($items as $item)
                    @if ($item->data->isNotEmpty())
                        <div class="w-full mt-4 p-4 bg-white dark:bg-[#1D2125] border-[1.4px] rounded border-gray-300 dark:border-[#38414A]">
                            <div class="border-b-[1.4px] pb-2 border-gray-300 dark:border-[#38414A]">
                                <p class="text-xl font-bold text-gray-700 dark:text-gray-100">Data File Items {{$a++}}</p>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$item->items_name}} <span>({{$item->items_id}})</span></p>
                            </div>
                            <div class="grid md:grid-cols-4 gap-2 mt-4 grid-cols-2">
                                @foreach($item->data as $data)
                                    <div class="p-2 border-2 flex justify-between items-center rounded-md border-gray-300 dark:border-[#38414A]">
                                        <div class="flex items-center">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="28"  height="28"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-file text-gray-600 dark:text-gray-300">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005h5z" />
                                                <path d="M19 7h-4l-.001 -4.001z" />
                                            </svg>
                                            <div class="ml-2">
                                                <p class="text-sm text-gray-700 dark:text-gray-200">{{$data->costume_name}}.{{$data->extension}} ({{formatSizeUnits($data->size)}})</p>
                                                <p class="text-xs text-gray-500 mt-[-2px] dark:text-gray-400">{{$data->created_at->diffForHumans()}}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <x-dropdown align="right" width="48">
                                                <x-slot name="trigger">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical text-gray-600 dark:text-gray-300 cursor-pointer">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                        <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                        <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                    </svg>
                                                </x-slot>
                                                <x-slot name="content">
                                                    <div class="w-full p-1">
                                                        <a href="{{route('project.data.download', $data->data_id)}}">
                                                            <button class="items-center gap-3 flex w-full px-4 py-2 text-left text-sm leading-5 text-gray-600 hover:bg-gray-100 transition-all duration-150 ease-in-out focus:outline-none focus:bg-gray-100 dark:hover:bg-[#1D2125]">
                                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
                                                                Download
                                                            </button>
                                                        </a>
                                                        @if (Auth::user()->role == 'admin')
                                                            <form action="{{route('data.delete', $data->data_id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this File?');">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="items-center gap-3 flex w-full px-4 py-2 text-left text-sm leading-5 text-red-500 hover:bg-gray-100 transition-all duration-150 ease-in-out focus:outline-none focus:bg-gray-100 dark:hover:bg-[#1D2125]">
                                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                    </svg>
                                                                    Delete File
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </x-slot>
                                            </x-dropdown>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="w-full p-4 bg-white mt-4 dark:bg-[#1D2125] border-[1.4px] rounded border-gray-300 dark:border-[#38414A]">
                    <div class="mx-auto">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="40"  height="40"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-gray-600 mx-auto icon icon-tabler icons-tabler-outline icon-tabler-files-off dark:text-gray-300">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 3v4a1 1 0 0 0 1 1h4" /><path d="M17 17h-6a2 2 0 0 1 -2 -2v-6m0 -4a2 2 0 0 1 2 -2h4l5 5v7c0 .294 -.063 .572 -.177 .823" /><path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2" /><path d="M3 3l18 18" />
                        </svg>
                        <p class="text-center font-medium text-gray-600 dark:text-gray-400">Data file is empty.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection