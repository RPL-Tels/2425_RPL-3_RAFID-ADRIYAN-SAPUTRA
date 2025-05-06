@extends('layouts.layers')
@section('title', 'Settings-security')
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
                        <a href="{{route('security')}}">
                            <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Security</p>
                        </a>
                    </div>
                @endif
            </div>
            <div class="w-4/5">
                <div class="border-b border-slate-300 px-4 py-4 dark:border-[#38414A]">
                    <h1 class="text-lg font-medium text-slate-800 dark:text-white">Security</h1>
                    <p class="text-sm text-slate-500 font-medium dark:text-slate-400">Manage your Security and password.</p>
                </div>
                <div class="px-4 py-4">
                    <form action="{{route('updatepass')}}" class="px-4 py-2 border-slate-300 border rounded-md dark:border-[#38414A]" method="POST" id="myForm">
                        @csrf
                        <div class="mb-2">
                            <p class="text-slate-500 font-medium dark:text-slate-300">Curent password</p>
                            <input type="password" name="current_password" class="w-full rounded border-2 border-slate-200 mt-2 focus:ring-2 focus:border-blue-100 outline-none transition-all duration-300 px-2 py-1 text-slate-800 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-200 dark:text-slate-200" autocomplete="off" required>
                            @error('current_password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <p class="text-slate-500 font-medium dark:text-slate-300">New password</p>
                            <input type="password" name="new_password" class="w-full rounded border-2 border-slate-200 mt-2 focus:ring-2 focus:border-blue-100 outline-none transition-all duration-300 px-2 py-1 text-slate-800 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-200 dark:text-slate-200" autocomplete="off" required>
                            @error('new_password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <p class="text-slate-500 font-medium dark:text-slate-300">Confirm password</p>
                            <input type="password" name="new_password_confirmation" class="w-full rounded border-2 border-slate-200 mt-2 focus:ring-2 focus:border-blue-100 outline-none transition-all duration-300 px-2 py-1 text-slate-800 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-200 dark:text-slate-200" autocomplete="off" required>
                            @error('new_password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <input type="submit" value="Save" class="px-10 py-1 rounded-md bg-blue-500 text-white font-medium cursor-pointer hover:bg-purple-600 transition-all duration-300">
                        </div>
                    </form>
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
                                <div class="w-full bg-slate-100 dark:bg-[#1D2125] border-l border-r border-slate-300 dark:border-[#38414A]">
                                    <a href="{{route('setting')}}">
                                        <p class="px-5 py-4 font-medium md:text-base text-sm text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">My Account</p>
                                    </a>
                                </div>
                                <div class="w-full dark:bg-[#101214] border-l border-r bg-white border-slate-300 dark:border-[#38414A]">
                                    <a href="{{route('security')}}">
                                        <p class="px-5 py-4 font-medium md:text-base text-sm text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Security</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full px-4 py-4 border-b border-slate-300 dark:border-[#38414A]">
                <p class="text-base font-medium text-slate-700 text-center dark:text-slate-300">Security</p>
            </div>
            <div class="px-4 py-4">
                <form action="{{route('updatepass')}}" method="POST" id="mobileForm" class="px-4 py-2 border-slate-300 border rounded-md dark:border-[#38414A]">
                    @csrf
                    <div class="mb-2">
                        <p class="text-slate-500 font-medium dark:text-slate-300 md:text-base text-sm">Curent password</p>
                        <input type="password" name="current_password" class="w-full rounded border-2 border-slate-200 mt-2 text-sm md:text-base focus:ring-2 focus:border-blue-100 outline-none transition-all duration-300 px-2 py-1 text-slate-800 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-200 dark:text-slate-200" autocomplete="off" required>
                        @error('current_password')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <p class="text-slate-500 font-medium dark:text-slate-300 md:text-base text-sm">New password</p>
                        <input type="password" name="new_password" class="w-full rounded border-2 border-slate-200 mt-2 text-sm md:text-base focus:ring-2 focus:border-blue-100 outline-none transition-all duration-300 px-2 py-1 text-slate-800 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-200 dark:text-slate-200" autocomplete="off" required>
                        @error('new_password')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <p class="text-slate-500 font-medium dark:text-slate-300 md:text-base text-sm">Confirm password</p>
                        <input type="password" name="new_password_confirmation" class="w-full rounded border-2 border-slate-200 mt-2 text-sm md:text-base focus:ring-2 focus:border-blue-100 outline-none transition-all duration-300 px-2 py-1 text-slate-800 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-200 dark:text-slate-200" autocomplete="off" required>
                        @error('new_password_confirmation')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <input type="submit" value="Save" class="px-10 py-1 rounded-md bg-blue-500 text-white text-sm md:text-base font-medium cursor-pointer hover:bg-purple-600 transition-all duration-300">
                    </div>
                </form>
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
<div id="popupOverlay" class="popup-overlay"></div>
<div id="formPopup"  class="popup px-10 py-5 rounded-md bg-white dark:bg-[#22272B] shadow-md border md:w-[360px] w-[300px] dark:border-[#38414A]">
    <div class="w-fit mx-auto">
        <div class="bg-yellow-100 py-2 px-2 rounded-xl mt-2">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="34"  height="34"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help-triangle mx-auto text-yellow-500">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 16v.01" />
                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                <path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" />
            </svg>
        </div>
    </div>
    <p class="font-bold text-center text-lg mb-1 dark:text-white text-slate-700">Are you sure?</p>
    <p class="text-center text-xs mb-6 text-slate-500 dark:text-slate-300">Are you sure want to change password? This action cannot be undone</p>
    <div class="text-center">
        <button id="formConfirmButton" class="w-full bg-yellow-400 rounded text-sm md:text-base py-[0.15rem] md:py-1 text-white font-medium hover:bg-yellow-800 transition-all duration-300">Yes</button>
        <button id="formCancelButton" class="w-full rounded border-[1.5px] text-sm md:text-base dark:border-[#38414A] py-[0.15rem] md:py-1 font-medium mt-3 mb-2 text-slate-700 transition-all duration-300 hover:ring-2 hover:ring-red-400 hover:border-red-500 dark:hover:border-red-500 hover:text-red-400 dark:hover:text-red-400 dark:text-slate-300">Cancel</button>
    </div>
</div>
@endsection