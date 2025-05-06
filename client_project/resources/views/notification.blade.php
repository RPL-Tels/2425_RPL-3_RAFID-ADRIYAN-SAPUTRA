@extends('layouts.layers')
@section('title', 'Notifications')
@section('section')
    <div class="container">
        <div class="md:px-12 px-5">
            @if (session()->has('success'))
                <div id="success-message" class="px-4 py-2 mx-auto w-fit bg-green-200 rounded fixed z-10 flex inset-x-0 items-center">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-circle-check text-green-500 mr-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" />
                    </svg>
                    <p class="text-gray-600 font-medium">Notification Deleted</p>
                    <button type="button" onclick="closeMessage()" class="text-gray-600 ml-4">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            <div>
                <p class="text-slate-600 font-medium md:text-md dark:text-slate-100">Notifications</p>
                <h1 class="text-slate-800 font-bold md:text-2xl text-base dark:text-slate-400">Log Notifications</h1>
            </div>
            @if ($notif->isNotEmpty())
                <div class="mt-8 grid md:grid-cols-2 gap-4 w-full mb-10">
                    @foreach ($notif as $notifs)
                        <div class="w-full bg-white p-4 rounded-md border-[1.5px] border-gray-300 flex dark:bg-[#22272B] dark:border-[#38414A]">
                            <div class="flex justify-between w-full">
                                <div class="w-14 h-14 
                                        @if($notifs->type2 == "pending")
                                            bg-yellow-500
                                        @elseif($notifs->type2 == "In progress")
                                            border-2 border-gray-500 dark:border-gray-200
                                        @elseif($notifs->type2 == "Complete")
                                            bg-green-500
                                        @else
                                            bg-red-500
                                        @endif
                                        rounded-full items-center @if($notifs->type2 == "In progress") p-2.5 @else p-3 @endif relative">
                                    @if ($notifs->type == 'project')
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-checklist @if($notifs->type2 == "In progress") text-gray-500 dark:text-gray-300 @else text-white dark:text-[#22272B] @endif mx-auto">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" />
                                            <path d="M14 19l2 2l4 -4" /><path d="M9 8h4" /><path d="M9 12h2" />
                                        </svg>
                                    @else
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-invoice @if($notifs->type2 == "In progress") text-gray-500 dark:text-gray-300 @else text-white dark:text-[#22272B] @endif"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25" />
                                        </svg>
                                    @endif
                                    <div class="bg-white dark:bg-[#22272B] rounded-full w-fit @if($notifs->type2 == "In progress") left-8 @else left-9 @endif bottom-[-6px] absolute">
                                        @if ($notifs->type2 == "pending" || $notifs->type2 == "In progress")
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-info-circle text-blue-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2c5.523 0 10 4.477 10 10a10 10 0 0 1 -19.995 .324l-.005 -.324l.004 -.28c.148 -5.393 4.566 -9.72 9.996 -9.72zm0 9h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" /></svg>
                                        @elseif($notifs->type2 == "Complete")
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-circle-check text-blue-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg>
                                        @else
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-circle-x text-blue-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-6.489 5.8a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z" /></svg>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-full ml-5">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="
                                                @if($notifs->type2 == "pending")
                                                    bg-yellow-500 py-1 px-2 text-white dark:text-[#22272B]
                                                @elseif($notifs->type2 == "In progress")
                                                    border-[1.5px] border-gray-500 py-0.5 px-1.5 text-gray-500 dark:border-gray-200 dark:text-gray-200
                                                @elseif($notifs->type2 == "Complete")
                                                    bg-green-500 py-1 px-2 text-white dark:text-[#22272B]
                                                @else
                                                    bg-red-500 py-1 px-2 text-white dark:text-[#22272B]
                                                @endif  rounded w-fit font-medium text-sm">
                                                <p>
                                                    @if ($notifs->type == 'project')
                                                        @foreach ($notifs->project as $project)
                                                            Project ({{$project->project_id}})
                                                        @endforeach
                                                    @else
                                                        Invoice ({{$notifs->second_id}})
                                                    @endif
                                                </p>
                                            </div>
                                            <p class="text-xs ml-2 font-medium text-gray-400">{{\carbon\carbon::parse($notifs->created_at)->format('d F Y')}} at {{\carbon\carbon::parse($notifs->created_at)->format('H.i')}}</p>
                                        </div>
                                        @if ($notifs->read == 'no')
                                            <div class="w-2 h-2 bg-red-600 rounded-full"></div>
                                        @else
                                            <form action="{{route('notification.delete', $notifs->id)}}" method="POST" id="profile_del">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="21"  height="21"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash text-gray-600 dark:text-gray-300">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-700 text-sm dark:text-white">{{$notifs->title}}</p>
                                        <p class="text-xs text-gray-600 leading-4 dark:text-gray-300">{{$notifs->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    @endforeach
                </div>
            @else
                <div class="w-full p-4 bg-white mt-4 dark:bg-[#1D2125] border-[1.4px] rounded border-gray-300 dark:border-[#38414A]">
                    <div class="mx-auto">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="40"  height="40"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-gray-600 mx-auto icon icon-tabler icons-tabler-outline icon-tabler-bell-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.346 5.353c.21 -.129 .428 -.246 .654 -.353a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3m-1 3h-13a4 4 0 0 0 2 -3v-3a6.996 6.996 0 0 1 1.273 -3.707" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /><path d="M3 3l18 18" /></svg>
                        <p class="text-center font-medium text-gray-600 dark:text-gray-400">No notifications.</p>
                    </div>
                </div>
            @endif
        </div>
        <div id="profile_del_Popup"  class="popup px-10 py-5 rounded-md bg-white dark:bg-[#22272B] shadow-md border md:w-[360px] w-[300px] dark:border-[#38414A]">
            <div class="w-fit mx-auto">
                <div class="bg-red-100 py-2 px-2 rounded-xl mt-2">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="34"  height="34"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-tras mx-auto text-red-500">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 7l16 0" />
                        <path d="M10 11l0 6" />
                        <path d="M14 11l0 6" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg>
                </div>
            </div>
            <p class="font-bold text-center text-lg mb-1 dark:text-white text-slate-700">Are you sure?</p>
            <p class="text-center text-xs mb-6 text-slate-500 dark:text-slate-300">Are you sure want to dellete notifications? This action cannot be undone</p>
            <div class="text-center">
                <button id="formConfirmButton3" class="w-full bg-red-400 rounded text-sm md:text-base py-[0.15rem] md:py-1 text-white font-medium hover:bg-red-800 transition-all duration-300">Yes</button>
                <button id="formCancelButton3" class="w-full rounded border-[1.5px] text-sm md:text-base dark:border-[#38414A] py-[0.15rem] md:py-1 font-medium mt-3 mb-2 text-slate-700 transition-all duration-300 hover:ring-2 hover:ring-red-400 hover:border-red-500 dark:hover:border-red-500 hover:text-red-400 dark:hover:text-red-400 dark:text-slate-300">Cancel</button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profile_del = document.getElementById('profile_del');
            const popupOverlay = document.getElementById('popupOverlay');
            const profile_del_Popup = document.getElementById('profile_del_Popup');
            const formConfirmButton3 = document.getElementById('formConfirmButton3');
            const formCancelButton3 = document.getElementById('formCancelButton3');

            profile_del.addEventListener('submit', function(event) {
                event.preventDefault();
                popupOverlay.style.display = 'block';
                profile_del_Popup.style.display = 'block';
            });

            formCancelButton3.addEventListener('click', function() {
                popupOverlay.style.display = 'none';
                profile_del_Popup.style.display = 'none';
            });

            formConfirmButton3.addEventListener('click', function(){
                popupOverlay.style.display = 'none';
                profile_del_Popup.style.display = 'none';
                profile_del.submit();
            });
        });
        function closeMessage() {
            document.getElementById('success-message').style.display = 'none';
        }
    </script>
@endsection