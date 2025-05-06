@extends('layouts.layers')
@section('title', 'Settings-Notifications')
@section('section')
<div class="container">
    <div class="md:px-12 pb-10 px-4 hidden md:block">
        <h1 class="font-medium text-slate-700 md:text-xl text-base dark:text-white">Account Settings</h1>
        <div class="w-full md:flex bg-white border border-slate-300 mt-8 rounded-lg dark:bg-[#161A1D] dark:border-[#38414A] flex-wrap hidden">
            <div class="w-1/5 border-r dark:border-[#38414A] border-slate-300">
                <div class="w-full px-5 py-4">
                    <h1 class="text-xs font-medium text-slate-500 dark:text-slate-500">BUSINNES SETTINGS</h1>
                </div>
                @if (Auth::user()->role === 'admin')
                    <div class="w-full">
                        <a href="{{route('setting')}}">
                            <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">My Account</p>
                        </a>
                    </div>
                    <div class="w-full bg-slate-100 dark:bg-[#101214]">
                        <a href="{{route('setnot')}}">
                            <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Notifications</p>
                        </a>
                    </div>
                    <div class="w-full">
                        <a href="{{route('security')}}">
                            <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Security</p>
                        </a>
                    </div>
                @else
                    <div class="w-full">
                        <a href="{{route('setting')}}">
                            <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">My Account</p>
                        </a>
                    </div>
                    <div class="w-full bg-slate-100 dark:bg-[#101214]">
                        <a href="{{route('setnot')}}">
                            <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Notifications</p>
                        </a>
                    </div>
                    <div class="w-full">
                        <a href="{{route('security')}}">
                            <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Security</p>
                        </a>
                    </div>
                    <div class="w-full">
                        <a href="{{route('invoice')}}">
                            <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Billing & Invoices</p>
                        </a>
                    </div>
                @endif
            </div>
            <div class="w-4/5">
                <div class="border-b border-slate-300 px-4 py-4 dark:border-[#38414A]">
                    <h1 class="text-lg font-medium text-slate-800 dark:text-white">Notifications</h1>
                    <p class="text-sm text-slate-500 font-medium dark:text-slate-400">Manage Your notifications for project informations.</p>
                </div>
                <div class="flex">
                    <div class="w-1/2 px-6 py-4">
                        <div class="bg-gray-100 border border-slate-300 px-5 py-3 rounded-t-md dark:bg-gray-900 dark:border-[#38414A]">
                            <p class="text-blue-500 font-medium">Email Notifications</p>
                        </div>
                        <div class="w-full px-5 py-4 border border-t-0 border-slate-300 rounded-b-md dark:border-[#38414A]">
                            <p class="mb-2 text-sm text-slate-600 dark:text-slate-400">Default Notifications Email</p>
                            <div class="w-full bg-slate-200 border-slate-400 border px-3 py-2 rounded-lg mb-3 dark:bg-[#161A1D] dark:border-[#38414A]">
                                <p class="text-slate-600 font-medium dark:text-slate-400">{{Auth::user()->email}}</p>
                            </div>
                            <p class="mb-2 text-slate-600 text-sm dark:text-slate-400">Chose which types of email updates you receive</p>
                            <form action="">
                                @csrf
                                <div class="flex">
                                    <input type="checkbox" class="mr-2 w-[0.9rem] dark:bg-[#161A1D]">
                                    <p class="mb-1 text-slate-600 dark:text-slate-400">Changes made to your account</p>
                                </div>
                                <div class="flex">
                                    <input type="checkbox" class="mr-2 w-[0.9rem] dark:bg-[#161A1D]">
                                    <p class="mb-1 text-slate-600 dark:text-slate-400">Project Report</p>
                                </div>
                                <div class="flex">
                                    <input type="checkbox" class="mr-2 w-[0.9rem] dark:bg-[#161A1D]">
                                    <p class="mb-1 text-slate-600 dark:text-slate-400">Project Status</p>
                                </div>
                                <div class="flex">
                                    <input type="checkbox" class="mr-2 w-[0.9rem] dark:bg-[#161A1D]">
                                    <p class="mb-1 text-slate-600 dark:text-slate-400">Deadline Warning</p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="w-1/2 px-6 py-4">
                        <div class="bg-gray-100 border border-slate-300 px-5 py-3 rounded-t-md dark:bg-gray-900 dark:border-[#38414A]">
                            <p class="text-blue-500 font-medium">Push Notifications</p>
                        </div>
                        <div class="w-full px-5 py-4 border border-t-0 border-slate-300 rounded-b-md dark:border-[#38414A]">
                            <p class="mb-2 text-sm text-slate-600 dark:text-slate-400">Default SMS number</p>
                            <div class="w-full bg-slate-200 border-slate-400 border px-3 py-2 rounded-lg mb-3 dark:bg-[#161A1D] dark:border-[#38414A]">
                                <p class="text-slate-600 font-medium dark:text-slate-400">{{Auth::user()->number}}</p>
                            </div>
                            <p class="mb-2 text-slate-600 text-sm dark:text-slate-400">Chose which types of email updates you receive</p>
                            <form action="">
                                @csrf
                                <div class="flex">
                                    <input type="checkbox" class="mr-2 w-[0.9rem]">
                                    <p class="mb-1 text-slate-600 dark:text-slate-400">Data Processing Results</p>
                                </div>
                                <div class="flex">
                                    <input type="checkbox" class="mr-2 w-[0.9rem]">
                                    <p class="mb-1 text-slate-600 dark:text-slate-400">Data Collection Progress</p>
                                </div>
                                <div class="flex">
                                    <input type="checkbox" class="mr-2 w-[0.9rem]">
                                    <p class="mb-1 text-slate-600 dark:text-slate-400">Project Security Alert</p>
                                </div>
                                <div class="flex">
                                    <input type="checkbox" class="mr-2 w-[0.9rem]">
                                    <p class="mb-1 text-slate-600 dark:text-slate-400">Chat Message</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full md:hidden px-3">
        <h1 class="font-medium text-slate-700 mb-4 text-base dark:text-white">Account Setting</h1>
        <div class="border border-slate-300 bg-white rounded-md dark:bg-[#161A1D] dark:border-[#38414A]">
            <div class="w-full px-4 py-1 flex border-b border-slate-300 dark:border-[#38414A]">
                <h1 class="text-xs font-medium text-slate-500 my-auto mr-1">BUSSINNES SETTINGS</h1>
                <div class="my-auto md:hidden" x-data="{open: false}">
                    <button class="" @click="open = !open">
                        <template x-if="!open">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2 text-slate-500 mt-[0.4rem]"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l16 0" /><path d="M4 12l16 0" /><path d="M4 18l16 0" /></svg>
                        </template>
                        <template x-if="open">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x text-slate-500 mt-[0.4em]"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                        </template>
                    </button>
                    <div @click.away="open = false" class="absolute w-full right-0 left-0  mt-1 bg-white dark:bg-[#101214] rounded" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-1" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-0">
                        <div class="bg-slate-100 w-full rounded-b-lg dark:bg-[#101214]">
                            <div class="px-5">
                                <div class="w-full  border-l border-r border-slate-300 dark:border-[#38414A] dark:bg-[#1D2125] bg-white">
                                    <a href="{{route('setting')}}">
                                        <p class="px-5 py-4 font-medium md:text-base text-sm text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">My Account</p>
                                    </a>
                                </div>
                                <div class="w-full bg-slate-100 dark:bg-[#101214] border-l border-r border-slate-300 dark:border-[#38414A]">
                                    <a href="{{route('setnot')}}">
                                        <p class="px-5 py-4 font-medium md:text-base text-sm text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Notifications</p>
                                    </a>
                                </div>
                                <div class="w-full dark:bg-[#1D2125] border-l border-r bg-white border-slate-300 dark:border-[#38414A]">
                                    <a href="{{route('security')}}">
                                        <p class="px-5 py-4 font-medium md:text-base text-sm text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Security</p>
                                    </a>
                                </div>
                                <div class="w-full dark:bg-[#1D2125] border-l border-r border-b bg-white border-slate-300 dark:border-[#38414A]">
                                    <a href="{{route('invoice')}}">
                                        <p class="px-5 py-4 font-medium md:text-base text-sm text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Billing & Invoices</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full px-4 py-4 border-b border-slate-300 dark:border-[#38414A]">
                <p class="text-base font-medium text-slate-700 text-center dark:text-slate-300">Notifications</p>
            </div>
            <div class="px-5 py-4">
                <div class="w-full bg-gray-100 px-4 py-2 rounded rounded-b-none border border-slate-300 dark:bg-gray-900 dark:border-[#38414A]">
                    <p class="text-blue-500 font-medium text-sm">Email Notifications</p>
                </div>
                <div class="border border-t-0 border-slate-300 px-4 py-2 rounded-b dark:border-[#38414A]">
                    <p class="text-xs text-slate-600 dark:text-slate-400">Default Notifications Email</p>
                    <div class="bg-slate-300 px-2 py-1 rounded  mt-2 border border-slate-400 dark:bg-[#161A1D] dark:border-[#38414A]">
                        <p class="text-sm font-medium text-slate-600 dark:text-slate-400">{{Auth::user()->email}}</p>
                    </div>
                    <p class="text-xs  mt-2 text-slate-600 mb-2 dark:text-slate-400">Chose which types of email updates you receive</p>
                    <form action="">
                        @csrf
                        <div class="flex">
                            <input type="checkbox" class="mr-2 w-[0.75rem] dark:bg-[#161A1D]">
                            <p class="mb-1 text-slate-600 dark:text-slate-400 text-sm">Changes made to your account</p>
                        </div>
                        <div class="flex">
                            <input type="checkbox" class="mr-2 w-[0.75rem] dark:bg-[#161A1D]">
                            <p class="mb-1 text-slate-600 dark:text-slate-400 text-sm">Project Report</p>
                        </div>
                        <div class="flex">
                            <input type="checkbox" class="mr-2 w-[0.75rem] dark:bg-[#161A1D]">
                            <p class="mb-1 text-slate-600 dark:text-slate-400 text-sm">Project Status</p>
                        </div>
                        <div class="flex">
                            <input type="checkbox" class="mr-2 w-[0.75rem] dark:bg-[#161A1D]">
                            <p class="mb-1 text-slate-600 dark:text-slate-400 text-sm">Deadline Warning</p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="px-5 pb-4">
                <div class="w-full bg-gray-100 px-4 py-2 rounded rounded-b-none border border-slate-300 dark:border-[#38414A] dark:bg-gray-900">
                    <p class="text-blue-500 font-medium text-sm">Push Notifications</p>
                </div>
                <div class="border border-t-0 border-slate-300 px-4 py-2 rounded-b dark:border-[#38414A]">
                    <p class="text-xs text-slate-600 dark:text-slate-400">Default SMS number</p>
                    <div class="bg-slate-300 px-2 py-1 rounded  mt-2 border border-slate-400 dark:border-[#38414A] dark:bg-[#161A1D]">
                        <p class="text-sm font-medium text-slate-600 dark:text-slate-400">{{Auth::user()->number}}</p>
                    </div>
                    <p class="text-xs  mt-2 text-slate-600 mb-2 dark:text-slate-400">Chose which types of email updates you receive</p>
                    <form action="">
                        @csrf
                        <div class="flex">
                            <input type="checkbox" class="mr-2 w-[0.75rem] dark:bg-[#161A1D]">
                            <p class="mb-1 text-slate-600 dark:text-slate-400 text-sm">Data Processing Results</p>
                        </div>
                        <div class="flex">
                            <input type="checkbox" class="mr-2 w-[0.75rem] dark:bg-[#161A1D]">
                            <p class="mb-1 text-slate-600 dark:text-slate-400 text-sm">Data Collection Progress</p>
                        </div>
                        <div class="flex">
                            <input type="checkbox" class="mr-2 w-[0.75rem] dark:bg-[#161A1D]">
                            <p class="mb-1 text-slate-600 dark:text-slate-400 text-sm">Project Security Alert</p>
                        </div>
                        <div class="flex">
                            <input type="checkbox" class="mr-2 w-[0.75rem] dark:bg-[#161A1D]">
                            <p class="mb-1 text-slate-600 dark:text-slate-400 text-sm">Chat Message</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="mt-5 md:mt-0 md:block">
    <div class="container">
        <div class="md:px-20 px-6 md:pb-10 pb-4 w-full justify-between flex">
            <div class="w-full">
                <p class="dark:text-slate-400 text-slate-600 text-center md:text-left text-xs md:text-base">Made By: © 2024 Rafid Adriyan. All rights reserved.</p>
               
            </div>
        </div>
    </div>
</footer>
@endsection