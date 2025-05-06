<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>@yield('title', 'default-tiltle')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 dark:bg-[#101214] transition-colors duration-300">
    <header class="fixed top-0 left-0 w-full md:flex items-center z-10 border-b-2 bg-white mt-[3.8rem] dark:bg-[#1D2125] transition-colors duration-300 hidden dark:border-[#161A1D]">
        <div class="container">
            <div class="flex my-auto ml-8 py-3">
                @if (Auth::user()->role === 'admin')
                    <a href="{{route('dashboard-admin')}}" class="mr-2 text-sm {{request()->is('dashboard') ? 'text-blue-500' : 'text-slate-600 dark:text-slate-200'}} font-semibold hover:text-blue-500 transition duration-300 hover:bg-blue-100 rounded px-4 py-1 flex my-auto dark:hover:text-blue-200 dark:hover:bg-blue-950">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home mr-1 my-auto">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{route('chat.index')}}" class="mr-2 text-sm {{request()->is('chat') ? 'text-blue-500' : 'text-slate-600 dark:text-slate-200'}} font-semibold hover:text-blue-500 transition duration-300 hover:bg-blue-100 rounded px-4 py-1 flex dark:hover:text-blue-200 dark:hover:bg-blue-950">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-message mr-1 my-auto">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M8 9h8" /><path d="M8 13h6" />
                            <path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                        </svg>
                        Chatt
                    </a>
                    <a href="{{route('admin-clients')}}" class="mr-2 text-sm {{request()->is('admin/clients*') ? 'text-blue-500' : 'text-slate-600 dark:text-slate-200'}} font-semibold hover:text-blue-500 transition duration-300 hover:bg-blue-100 rounded px-4 py-1 flex dark:hover:text-blue-200 dark:hover:bg-blue-950">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user mr-1 my-auto">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                        Client
                    </a>
                    <a href="{{route('admin.invoice')}}" class="mr-2 text-sm {{request()->is('admin/invoice*') ? 'text-blue-500' : 'text-slate-600 dark:text-slate-200'}} font-semibold hover:text-blue-500 transition duration-300 hover:bg-blue-100 rounded px-4 py-1 flex dark:hover:text-blue-200 dark:hover:bg-blue-950">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-invoice mr-1 my-auto">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25" />
                        </svg>
                        Invoice
                    </a>
                    <a href="{{route('admin.project')}}" class="mr-2 text-sm {{request()->is('admin/project*') || request()->is('Project/detail*') ? 'text-blue-500' : 'text-slate-600 dark:text-slate-200'}} font-semibold hover:text-blue-500 transition duration-300 hover:bg-blue-100 rounded px-4 py-1 flex dark:hover:text-blue-200 dark:hover:bg-blue-950">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-checklist mr-1 my-auto">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" />
                            <path d="M14 19l2 2l4 -4" />
                            <path d="M9 8h4" />
                            <path d="M9 12h2" />
                        </svg>
                        Project
                    </a>
                    <a href="{{route('admin.data.project')}}" class="mr-2 text-sm {{request()->is('admin/data-project*') ? 'text-blue-500' : 'text-slate-600 dark:text-slate-200'}} font-semibold hover:text-blue-500 transition duration-300 hover:bg-blue-100 rounded px-4 py-1 flex dark:hover:text-blue-200 dark:hover:bg-blue-950">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script mr-1 my-auto">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" />
                        </svg>
                        Data Project
                    </a>
                @else
                    <a href="{{route('user-dashboard')}}" class="mr-2 text-sm {{request()->is('dashboards') ? 'text-blue-500' : 'text-slate-600 dark:text-slate-200'}} font-semibold hover:text-blue-500 transition duration-300 hover:bg-blue-100 rounded px-4 py-1 flex my-auto dark:hover:text-blue-200 dark:hover:bg-blue-950">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user mr-1 my-auto">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                        Overview
                    </a>
                    <a href="{{route('chat.index')}}" class="mr-2 text-sm {{request()->is('chat') ? 'text-blue-500' : 'text-slate-600 dark:text-slate-200'}} font-semibold hover:text-blue-500 transition duration-300 hover:bg-blue-100 rounded px-4 py-1 flex dark:hover:text-blue-200 dark:hover:bg-blue-950">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-message mr-1 my-auto">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M8 9h8" /><path d="M8 13h6" />
                            <path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                        </svg>
                        Chatt
                    </a>
                    <a href="{{route('user.invoice')}}" class="mr-2 text-sm {{request()->is('invoice*') ? 'text-blue-500' : 'text-slate-600 dark:text-slate-200'}} font-semibold hover:text-blue-500 transition duration-300 hover:bg-blue-100 rounded px-4 py-1 flex dark:hover:text-blue-200 dark:hover:bg-blue-950">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-invoice mr-1 my-auto">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25" />
                        </svg>
                        Invoice
                    </a>
                    <a href="{{route('user.project')}}" class="mr-2 text-sm {{request()->is('project*') || request()->is('Project/detail*') ? 'text-blue-500' : 'text-slate-600 dark:text-slate-200'}} font-semibold hover:text-blue-500 transition duration-300 hover:bg-blue-100 rounded px-4 py-1 flex dark:hover:text-blue-200 dark:hover:bg-blue-950">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-checklist mr-1 my-auto">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" />
                            <path d="M14 19l2 2l4 -4" />
                            <path d="M9 8h4" />
                            <path d="M9 12h2" />
                        </svg>
                        Project
                    </a>
                    <a href="{{route('user.data-project')}}" class="mr-2 text-sm {{request()->is('data-project*') ? 'text-blue-500' : 'text-slate-600 dark:text-slate-200'}} font-semibold hover:text-blue-500 transition duration-300 hover:bg-blue-100 rounded px-4 py-1 flex dark:hover:text-blue-200 dark:hover:bg-blue-950">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script mr-1 my-auto">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" />
                        </svg>
                        Data Project
                    </a>
                @endif
            </div>
        </div>
    </header>
    <header class="fixed top-0 left-0 w-full flex items-center z-10 bg-white dark:bg-[#1D2125] border-b-2 dark:border-[#161A1D] transition-colors duration-300">
        <div class="w-full md:container md:px-0">
            <div class="flex flex-wrap md:px-8 px-4 relative justify-between w-full">
                <div class="my-auto md:hidden" x-data="{open: false}">
                    <button class="" @click="open = !open">
                        <template x-if="!open">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2 dark:text-white text-slate-500 mt-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l16 0" /><path d="M4 12l16 0" /><path d="M4 18l16 0" /></svg>
                        </template>
                        <template x-if="open">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x dark:text-white text-slate-500 mt-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                        </template>
                    </button>
                    <div @click.away="open = false" class="absolute w-full right-0 left-0 mt-4 bg-white dark:bg-[#1D2125] rounded" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-1" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-0">
                        <div class="bg-white w-full rounded-b-lg pb-2 dark:bg-[#1D2125]">
                            @if (Auth::user()->role === 'admin')
                                <div class="w-full flex">
                                    <a href="{{route('dashboard-admin')}}" class="flex w-full hover:bg-slate-200 dark:hover:bg-[#161A1D] py-2 px-5 {{request()->is('dashboard') ? 'text-blue-500 dark:bg-[#161A1D] bg-slate-200' : 'text-slate-600 dark:text-slate-200'}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home mr-2 my-auto">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                        Dashboard
                                    </a>
                                </div>
                                <div class="w-full">
                                    <a href="{{route('chat.index')}}" class="flex w-full hover:bg-slate-200 dark:hover:bg-[#161A1D] py-2 px-5 {{request()->is('#') ? 'text-blue-500 dark:bg-[#161A1D] bg-slate-200' : 'text-slate-600 dark:text-slate-200'}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-message mr-2 my-auto">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M8 9h8" /><path d="M8 13h6" />
                                            <path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                                        </svg>
                                        Chat
                                    </a>
                                </div>
                                <div class="w-full">
                                    <a href="{{route('admin-clients')}}" class="flex w-full hover:bg-slate-200 dark:hover:bg-[#161A1D] py-2 px-5 {{request()->is('admin/clients*') ? 'text-blue-500 dark:bg-[#161A1D] bg-slate-200' : 'text-slate-600 dark:text-slate-200'}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user mr-2 my-auto">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        </svg>
                                        Client
                                    </a>
                                </div>
                                <div class="w-full">
                                    <a href="{{route('admin.invoice')}}" class="flex w-full hover:bg-slate-200 dark:hover:bg-[#161A1D] py-2 px-5 {{request()->is('admin/invoice*') ? 'text-blue-500 dark:bg-[#161A1D] bg-slate-200' : 'text-slate-600 dark:text-slate-200'}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-invoice mr-2 my-auto">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25" />
                                        </svg>
                                        Invoice
                                    </a>
                                </div>
                                <div class="w-full">
                                    <a href="{{route('admin.project')}}" class="flex w-full hover:bg-slate-200 dark:hover:bg-[#161A1D] py-2 px-5 {{request()->is('admin/project*') || request()->is('Project/detail*') ? 'text-blue-500  dark:bg-[#161A1D] bg-slate-200' : 'text-slate-600 dark:text-slate-200'}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-checklist mr-2 my-auto">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" />
                                            <path d="M14 19l2 2l4 -4" />
                                            <path d="M9 8h4" />
                                            <path d="M9 12h2" />
                                        </svg>
                                        Project
                                    </a>
                                </div>
                                <div class="w-full">
                                    <a href="{{route('admin.data.project')}}" class="flex w-full hover:bg-slate-200 dark:hover:bg-[#161A1D] py-2 px-5 {{request()->is('admin/data-project*') ? 'text-blue-500 dark:bg-[#161A1D] bg-slate-200' : 'text-slate-600 dark:text-slate-200'}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script mr-2 my-auto">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" />
                                        </svg>
                                        Data Project
                                    </a>
                                </div>
                            @else
                                <div class="w-full flex">
                                    <a href="{{route('user-dashboard')}}" class="flex w-full hover:bg-slate-200 dark:hover:bg-[#161A1D] py-2 px-5 {{request()->is('dashboards') ? 'text-blue-500 dark:bg-[#161A1D] bg-slate-200' : 'text-slate-600 dark:text-slate-200'}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user mr-1 my-auto">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        </svg>
                                        Overview
                                    </a>
                                </div>
                                <div class="w-full">
                                    <a href="{{route('chat.index')}}" class="flex w-full hover:bg-slate-200 dark:hover:bg-[#161A1D] py-2 px-5 {{request()->is('#') ? 'text-blue-500' : 'text-slate-600 dark:text-slate-200'}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-message mr-2 my-auto">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M8 9h8" /><path d="M8 13h6" />
                                            <path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                                        </svg>
                                        Chatt
                                    </a>
                                </div>
                                <div class="w-full">
                                    <a href="{{route('user.invoice')}}" class="flex w-full hover:bg-slate-200 dark:hover:bg-[#161A1D] py-2 px-5 {{request()->is('invoice*') ? 'text-blue-500 dark:bg-[#161A1D] bg-slate-200' : 'text-slate-600 dark:text-slate-200'}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-invoice mr-2 my-auto">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25" />
                                        </svg>
                                        Invoice
                                    </a>
                                </div>
                                <div class="w-full">
                                    <a href="{{route('user.project')}}" class="flex w-full hover:bg-slate-200 dark:hover:bg-[#161A1D] py-2 px-5 {{request()->is('project*') || request()->is('Project/detail*') ? 'text-blue-500  dark:bg-[#161A1D] bg-slate-200' : 'text-slate-600 dark:text-slate-200'}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-checklist mr-2 my-auto">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" />
                                            <path d="M14 19l2 2l4 -4" />
                                            <path d="M9 8h4" />
                                            <path d="M9 12h2" />
                                        </svg>
                                        Project
                                    </a>
                                </div>
                                <div class="w-full">
                                    <a href="{{route('user.data-project')}}" class="flex w-full hover:bg-slate-200 dark:hover:bg-[#161A1D] py-2 px-5 {{request()->is('data-project*') ? 'text-blue-500 dark:bg-[#161A1D] bg-slate-200' : 'text-slate-600 dark:text-slate-200'}}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-script mr-2 my-auto">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M17 20h-11a3 3 0 0 1 0 -6h11a3 3 0 0 0 0 6h1a3 3 0 0 0 3 -3v-11a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v8" />
                                        </svg>
                                        Data Project
                                    </a>
                                </div>
                            @endif
                            <div class="w-full">
                                <button id="toggleDarkMode" class="mr-4 my-auto w-full hover:bg-slate-300 dark:hover:bg-[#161A1D] py-2 px-5">
                                    <div id="moonIcon" class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-moon text-slate-600 transition duration-500 my-auto"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
                                        <p class="my-auto ml-2 text-slate-600 dark:text-slate-200">Darkmode</p>
                                    </div>
                                    <div id="sunIcon" class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-sun text-slate-600 dark:text-white my-auto"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
                                        <p class="my-auto ml-2 text-slate-600 dark:text-slate-200">Lightmode</p>
                                    </div>
                                </button>
                            </div>
                            @if (Auth::user()->role == 'user')
                                <div class="w-full">
                                    <a href="{{route('notifications')}}" class="flex w-full items-center justify-between hover:bg-slate-200 dark:hover:bg-[#161A1D] py-2 px-5 {{request()->is('notifications*') ? 'text-blue-500 dark:bg-[#161A1D] bg-slate-200' : 'text-slate-600 dark:text-slate-200'}}">
                                        <div class="flex">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-bell my-auto mr-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                                            Notification
                                        </div>
                                        @if ($unread>0)
                                            <div class="w-2 h-2 bg-red-500 rounded-full {{request()->is('notifications*') ? 'hidden' : 'block'}}"></div>
                                        @endif
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap py-2 md:py-0">
                    <div class="flex">
                        <img src="{{asset('img/Frame3.png')}}" alt="" class="md:w-[60px] w-[50px] my-auto ml-[-0.1rem]" id="logo1">
                        <img src="{{asset('img/Frame3.png')}}" alt="" class="md:w-[60px] w-[50px] my-auto ml-[-0.1rem] hidden" id="logo2">
                        <p class="my-auto text-lg font-bold text-slate-700 ml-[-8px] dark:text-white">CMP</p>
                    </div>
                </div>
                <div class="flex my-auto">
                    <button id="toggleDarkMode2" class="my-auto hidden md:flex">
                        <svg id="moonIcon2"  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-moon text-slate-600 transition duration-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
                        <svg id="sunIcon2"  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-sun hidden text-slate-600 dark:text-white"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
                    </button>
                    @if (Auth::user()->role == 'user')
                        <a href="{{route('notifications')}}" class="my-auto hidden md:flex">
                            <div class="relative">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-bell ml-4 {{request()->is('notifications*') ? 'text-blue-500' : 'text-slate-600 dark:text-slate-200'}}"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                                @if ($unread>0)
                                    <div class="w-2 h-2 rounded-full bg-red-500 absolute left-7 bottom-3 items-center justify-center {{request()->is('notifications*') ? 'hidden' : 'block'}}"></div>
                                @endif
                            </div>
                        </a>
                    @endif
                    <div x-data="{ open: false }" class="">
                        <button @click.away="open = false" @click="open = !open" class="pl-4 py-2 flex my-auto">
                            <img id="default1" src="{{Auth::user()->profile_photo ? asset('storage/profile_photos/' .  Auth::user()->profile_photo) : asset('img/default.png') }}" alt="" class="w-[40px] h-[40px] mr-1 object-cover object-center rounded-lg">
                            <img id="default2" src="{{Auth::user()->profile_photo ? asset('storage/profile_photos/' .  Auth::user()->profile_photo) : asset('img/default3.png') }}" alt="" class="w-[40px] h-[40px] mr-1 object-cover object-center rounded-lg hidden">
                            {{-- <div class="bg-gray-500 w-[40px] h-[40px] rounded-lg mr-1 bg-cover bg-center" style="background-image: url({{Auth::user()->profile_photo ? asset('storage/profile_photos/' .  Auth::user()->profile_photo) : asset('img/default.png') }})"></div> --}}
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-down my-auto text-slate-500 dark:text-white" :class="{'rotate-180': open, 'rotate-0': !open}">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M6 9l6 6l6 -6" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-1" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-0" class="shadow-xl absolute right-0 md:max-w-[17rem] max-w-[14rem] w-full bg-white dark:bg-[#1D2125] rounded">
                            <div class="bg-white pt-6 pb-4 w-full rounded-b-lg dark:bg-[#1D2125]">
                                <div class="mx-auto">
                                    {{-- <div class="md:w-[75px] md:h-[75px] w-[60px] h-[60px] rounded-lg bg-black bg-cover bg-center mx-auto" style="background-image: url({{Auth::user()->profile_photo ? asset('storage/profile_photos/' .  Auth::user()->profile_photo) : asset('img/default.png') }});"></div> --}}
                                    <img id="default3" src="{{Auth::user()->profile_photo ? asset('storage/profile_photos/' .  Auth::user()->profile_photo) : asset('img/default.png') }}" alt="" class="md:w-[75px] md:h-[75px] w-[60px] h-[60px] mx-auto object-cover object-center rounded-lg">
                                    <img id="default4" src="{{Auth::user()->profile_photo ? asset('storage/profile_photos/' .  Auth::user()->profile_photo) : asset('img/default3.png') }}" alt="" class="md:w-[75px] md:h-[75px] w-[60px] h-[60px] mx-auto object-cover object-center rounded-lg hidden">
                                </div>
                                <div class="mt-2 line-clamp-1 px-4">
                                    <p class="text-slate-700 font-bold md:text-lg text-base text-center dark:text-slate-100"><span>{{Auth::user()->name}}</span></p>
                                </div>
                                <div class="hover:bg-slate-100 dark:hover:bg-[#161A1D] text-center cursor-pointer mt-2">
                                    <a href="{{route('setting')}}" class="w-full bg-red-100 text-slate-500 dark:text-slate-300 font-medium text-sm md:text-base">
                                        <p class="py-2">Settings</p>
                                    </a>
                                </div>
                                <div class="hover:bg-slate-100 dark:hover:bg-[#161A1D] text-center py-2">
                                    <form action="{{route('logout')}}" method="POST" id="logForm">
                                        @csrf
                                        <button class="text-red-500 font-medium cursor-pointer w-full md:text-base text-sm" id="logButton">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="md:mt-32 mt-24">
        @yield('section')
    </section>
    {{-- popup logout --}}
    <div id="popupOverlay" class="popup-overlay"></div>
    <div id="logPopup"  class="popup px-10 py-5 rounded-md bg-white dark:bg-[#22272B] shadow-md border md:w-[360px] w-[300px] dark:border-[#38414A]">
        <div class="w-fit mx-auto">
            <div class="bg-blue-100 py-2 px-2 rounded-xl mt-2">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="34"  height="34"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-logout mx-auto text-blue-500">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                    <path d="M9 12h12l-3 -3" />
                    <path d="M18 15l3 -3" />
                </svg>
            </div>
        </div>
        <p class="font-bold text-center text-lg mb-1 dark:text-white text-slate-700">Are you sure?</p>
        <p class="text-center text-xs mb-6 text-slate-500 dark:text-slate-300">Are you sure want to logout this page? This action cannot be undone</p>
        <div class="text-center">
            <button id="formConfirmButton2" class="w-full bg-blue-400 rounded text-sm md:text-base py-[0.15rem] md:py-1 text-white font-medium hover:bg-blue-800 transition-all duration-300">Yes</button>
            <button id="formCancelButton2" class="w-full rounded border-[1.5px] text-sm md:text-base dark:border-[#38414A] py-[0.15rem] md:py-1 font-medium mt-3 mb-2 text-slate-700 transition-all duration-300 hover:ring-2 hover:ring-red-400 hover:border-red-500 dark:hover:border-red-500 hover:text-red-400 dark:hover:text-red-400 dark:text-slate-300">Cancel</button>
        </div>
    </div>
    <script src="{{asset('js/popup_settings.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
</body>
</html>