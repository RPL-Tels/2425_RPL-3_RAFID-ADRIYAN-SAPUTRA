@extends('layouts.layers')
@section('title', 'Settings-invoice')
@section('section')
<div class="container">
    <div class="md:px-12 pb-10 px-4 hidden md:block">
        <h1 class="font-medium text-slate-700 md:text-xl text-base dark:text-white">Account Settings</h1>
        <div class="w-full md:flex bg-white border border-slate-300 mt-8 rounded-lg dark:bg-[#161A1D] dark:border-[#38414A] flex-wrap hidden">
            <div class="w-1/5 border-r dark:border-[#38414A] border-slate-300">
                <div class="w-full px-5 py-4">
                    <h1 class="text-xs font-medium text-slate-500 dark:text-slate-500">BUSINNES SETTINGS</h1>
                </div>
                <div class="w-full">
                    <a href="{{route('setting')}}">
                        <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">My Account</p>
                    </a>
                </div>
                <div class="w-full">
                    <a href="{{route('setnot')}}">
                        <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Notifications</p>
                    </a>
                </div>
                <div class="w-full">
                    <a href="{{route('security')}}">
                        <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Security</p>
                    </a>
                </div>
                <div class="w-full bg-slate-100 dark:bg-[#101214]">
                    <a href="{{route('invoice')}}">
                        <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Billing & Invoices</p>
                    </a>
                </div>
            </div>
            <div class="w-4/5">
                <div class="border-b border-slate-300 px-4 py-4 dark:border-[#38414A]">
                    <h1 class="text-lg font-medium text-slate-800 dark:text-white">Billing & Invoices</h1>
                    <p class="text-sm text-slate-500 font-medium dark:text-slate-400">Billing & Invoice section. Here, you can manage and track all your financial transactions with us.</p>
                </div>
                <div class="px-4 py-4 flex">
                    <div class="bg-blue-500 rounded rounded-r-none w-[0.4rem] shadow"></div>
                    <div class="mr-6 px-4 w-[17rem] py-4 rounded rounded-l-none border shadow">
                        <p class="text-sm text-slate-400">Current monthly bill</p>
                        <p class="text-lg text-slate-700 font-medium">$<span>20.00</span></p>
                        <button class="text-sm text-blue-500 flex hover:underline mt-2">
                            <p>Switch to yearly billing</p>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="14"  height="14"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-right my-auto mt-[0.35rem] text-blue-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M13 18l6 -6" /><path d="M13 6l6 6" /></svg>
                        </button>
                    </div>
                    <div class="bg-purple-500 rounded rounded-r-none w-[0.4rem] shadow"></div>
                    <div class="px-4 w-[17rem] py-4 rounded rounded-l-none border shadow">
                        <p class="text-sm text-slate-400">Next payment due</p>
                        <p class="text-lg text-slate-700 font-medium">July 15</p>
                        <button class="text-sm text-purple-500 flex hover:underline mt-2">
                            <p>View payment history billing</p>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="14"  height="14"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-right my-auto mt-[0.35rem] text-purple-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M13 18l6 -6" /><path d="M13 6l6 6" /></svg>
                        </button>
                    </div>
                </div>
                <div class="px-4 py-4">
                    <div class="bg-gray-100 px-4 py-2 border rounded-md rounded-b-none justify-between flex">
                        <div class="my-auto">
                            <p class="text-blue-500 font-medium">Billing History</p>
                        </div>
                        <div class="flex">
                            <input type="search" class="rounded-md px-2 py-1 border border-slate-400 outline-none">
                        </div>
                    </div>
                    <div class="border border-t-0">
                        <table class="w-full">
                            <thead>
                                <tr class="border border-t-0 border-l-0 border-r-0">
                                    <td class="w-[25%] px-4 py-2 text-slate-600 font-medium">Transaction ID</td>
                                    <td class="w-[25%] px-4 py-2 text-slate-600 font-medium">Date</td>
                                    <td class="w-[25%] px-4 py-2 text-slate-600 font-medium">Amount</td>
                                    <td class="w-[25%] px-4 py-2 text-slate-600 font-medium">Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border border-t-0 border-l-0 border-r-0">
                                    <td class="w-[25%] px-4 py-2 text-slate-400">#39201</td>
                                    <td class="w-[25%] px-4 py-2 text-slate-400">06/15/2021</td>
                                    <td class="w-[25%] px-4 py-2 text-slate-400">$29.99</td>
                                    <td class="w-[25%] px-4 py-2">
                                        <div class="border w-16 rounded-lg bg-slate-200">
                                            <p class="text-xs px-1 py-[0.10rem] text-center font-medium">Pending</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border border-t-0 border-l-0 border-r-0">
                                    <td class="w-[25%] px-4 py-2 text-slate-400">#39201</td>
                                    <td class="w-[25%] px-4 py-2 text-slate-400">06/15/2021</td>
                                    <td class="w-[25%] px-4 py-2 text-slate-400">$29.99</td>
                                    <td class="w-[25%] px-4 py-2">
                                        <div class="border w-12 rounded-lg bg-green-500">
                                            <p class="text-xs px-1 py-[0.10rem] text-center font-medium text-white">Paid</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border border-t-0 border-l-0 border-r-0">
                                    <td class="w-[25%] px-4 py-2 text-slate-400">#39201</td>
                                    <td class="w-[25%] px-4 py-2 text-slate-400">06/15/2021</td>
                                    <td class="w-[25%] px-4 py-2 text-slate-400">$29.99</td>
                                    <td class="w-[25%] px-4 py-2">
                                        <div class="border w-12 rounded-lg bg-green-500">
                                            <p class="text-xs px-1 py-[0.10rem] text-center font-medium text-white">Paid</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border border-t-0 border-l-0 border-r-0">
                                    <td class="w-[25%] px-4 py-2 text-slate-400">#39201</td>
                                    <td class="w-[25%] px-4 py-2 text-slate-400">06/15/2021</td>
                                    <td class="w-[25%] px-4 py-2 text-slate-400">$29.99</td>
                                    <td class="w-[25%] px-4 py-2">
                                        <div class="border w-12 rounded-lg bg-green-500">
                                            <p class="text-xs px-1 py-[0.10rem] text-center font-medium text-white">Paid</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
                                <div class="w-full bg-slate-100 dark:bg-[#101214] border-l border-r border-slate-300 dark:border-[#38414A]">
                                    <a href="{{route('setting')}}">
                                        <p class="px-5 py-4 font-medium md:text-base text-sm text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">My Account</p>
                                    </a>
                                </div>
                                <div class="w-full dark:bg-[#1D2125] border-l border-r bg-white border-slate-300 dark:border-[#38414A]">
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
                <p class="text-base font-medium text-slate-700 text-center dark:text-slate-300">My account</p>
            </div>
            <div class="px-4 py-4">
                
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