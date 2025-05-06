@extends('layouts.layers')
@section('title', 'Settings-account')
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
                    <div class="w-full bg-slate-100 dark:bg-[#101214]">
                        <a href="{{route('setting')}}">
                            <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">My Account</p>
                        </a>
                    </div>
                    <div class="w-full">
                        <a href="{{route('security')}}">
                            <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Security</p>
                        </a>
                    </div>
                @else
                    <div class="w-full bg-slate-100 dark:bg-[#101214]">
                        <a href="{{route('setting')}}">
                            <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">My Account</p>
                        </a>
                    </div>
                    <div class="w-full">
                        <a href="{{route('security')}}">
                            <p class="px-5 py-4 font-medium text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">Security</p>
                        </a>
                    </div>
                @endif
            </div>
            <div class="w-4/5">
                <div class="border-b border-slate-300 px-4 py-4 dark:border-[#38414A]">
                    <h1 class="text-lg font-medium text-slate-800 dark:text-white">My Account</h1>
                    <p class="text-sm text-slate-500 font-medium dark:text-slate-400">Manage your profile information to control, protect and secure your account.</p>
                </div>
                <div class="flex">
                    <div class="w-2/3 border-r border-slate-300 dark:border-[#38414A]">
                        <form action="{{route('profile.update')}}" class="py-4" method="POST">
                            @csrf
                            @method('PUT')
                            <table class="w-full">
                                <tr>
                                    <td class="w-[25%] text-right pr-2 text-sm mb-4 pb-4 font-medium text-slate-500 dark:text-slate-300"></td>
                                    <td class="pr-6 pb-4">
                                        @if(session('success'))
                                            <div id="success-message" class="bg-green-200 py-4 px-4 w-full rounded-lg">
                                                <div class="flex mx-auto justify-between">
                                                    <div class="flex">
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="30"  height="30"  viewBox="0 0 24 20"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-circle-check text-green-500 my-auto mr-2">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" />
                                                        </svg>
                                                        <p class="font-medium my-auto text-slate-700">{{session('success')}}</p>
                                                    </div>
                                                    <button type="button" onclick="closeMessage()" class="text-slate-800 my-auto hover:text-slate-500">
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 20"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x my-auto">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M18 6l-12 12" />
                                                            <path d="M6 6l12 12" />
                                                        </svg>  
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($errors->any())
                                            <div id="error-message" class="bg-red-200 py-4 px-4 w-full rounded-lg">
                                                <div class="flex mx-auto justify-between">
                                                    <div class="flex">
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="30"  height="30"  viewBox="0 0 24 20"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-exclamation-circle my-auto text-red-500 mr-2">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M17 3.34a10 10 0 1 1 -15 8.66l.005 -.324a10 10 0 0 1 14.995 -8.336m-5 11.66a1 1 0 0 0 -1 1v.01a1 1 0 0 0 2 0v-.01a1 1 0 0 0 -1 -1m0 -7a1 1 0 0 0 -1 1v4a1 1 0 0 0 2 0v-4a1 1 0 0 0 -1 -1" />
                                                        </svg>
                                                        <ul class="mt-1">
                                                            @foreach ($errors->all() as $error)
                                                                <li class="font-medium my-auto text-slate-700">{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <button type="button" onclick="closeMessage2()" class="text-slate-800 my-auto hover:text-slate-500">
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 20"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x my-auto">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M18 6l-12 12" />
                                                            <path d="M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-[25%] text-right pr-2 text-sm mb-4 pb-4 font-medium text-slate-500 dark:text-slate-300">Username </td>
                                    <td class="pr-6 pb-4"><input type="text" name="name" value="{{Auth::user()->name}}" class="text-slate-600 w-full focus:ring-2 focus:border-blue-100 transition-all duration-300 py-1 px-2 rounded-md outline-none border-2 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200" readonly></td>
                                </tr>
                                <tr>
                                    <td class="w-[25%] text-right pr-2 text-sm pb-4 font-medium text-slate-500 dark:text-slate-300">Company </td>
                                    <td class="pr-6 pb-4"><input type="text" name="company" value="{{Auth::user()->company}}" class="text-slate-600 w-full focus:ring-2 focus:border-blue-100 transition-all duration-300 py-1 px-2 rounded-md outline-none border-2 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200" readonly></td>
                                </tr>
                                <tr>
                                    <td class="w-[25%] text-right pr-2 text-sm pb-4 font-medium text-slate-500 dark:text-slate-300">Address</td>
                                    <td class="pr-6 pb-4"><input type="text" name="addres" value="{{Auth::user()->addres}}" class="text-slate-600 w-full focus:ring-2 focus:border-blue-100 transition-all duration-300 py-1 px-2 rounded-md outline-none border-2 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200" readonly></td>
                                </tr>
                                <tr>
                                    <td class="w-[25%] text-right pr-2 text-sm pb-4 font-medium text-slate-500 dark:text-slate-300">Email </td>
                                    <td class="pr-6 pb-4"><input type="text" name="email" value="{{Auth::user()->email}}" autocomplete="off" class="text-slate-600 w-full focus:ring-2 focus:border-blue-100 transition-all duration-300 py-1 px-2 rounded-md outline-none border-2 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200"></td>
                                </tr>
                                <tr>
                                    <td class="w-[25%] text-right pr-2 text-sm font-medium text-slate-500 pb-4 dark:text-slate-300">Phone number </td>
                                    <td class="pr-6 pb-4"><input type="number" name="number" value="{{Auth::user()->number}}" class="text-slate-600 w-full focus:ring-2 focus:border-blue-100 transition-all duration-300 py-1 px-2 rounded-md outline-none border-2 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200"></td>
                                </tr>
                                <tr>
                                    <td class="w-[25%] text-right pr-2 text-sm font-medium text-slate-500 dark:text-slate-300">Created at </td>
                                    <td class="pr-6"><input type="text" name="created_at" class="text-slate-600 w-full focus:ring-2 focus:border-blue-100 transition-all duration-300 py-1 px-2 rounded-md outline-none border-2 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200" value="{{\carbon\carbon::parse(Auth::user()->created_at)->format('d F Y')}}" readonly></td>
                                </tr>
                                <tr>
                                    <td class="w-[25%] text-right pr-2 text-sm font-medium text-slate-500 dark:text-slate-300"></td>
                                    <td class="pr-6"><input type="submit" class="mt-4 bg-blue-500 text-white w-32 rounded py-1 font-medium cursor-pointer hover:bg-purple-700 transition-all duration-300"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="w-1/3  pt-6">
                        <div class="">
                            {{-- <div class="md:w-[98px] md:h-[98px] w-[60px] h-[60px] rounded-full bg-black bg-cover bg-center mx-auto" style="background-image: url({{asset('img/profile.png')}});"></div> --}}
                            <img id="default5" src="{{ Auth::user()->profile_photo ? asset('storage/profile_photos/' .  Auth::user()->profile_photo) : asset('img/default.png') }}" alt="" class="rounded-full md:w-[98px] md:h-[98px] object-cover object-center mx-auto">
                            <img id="default6" src="{{Auth::user()->profile_photo ? asset('storage/profile_photos/' .  Auth::user()->profile_photo) : asset('img/default3.png') }}" alt="" class="rounded-full md:w-[98px] md:h-[98px] object-cover object-center mx-auto hidden">
                        </div>
                        <div class="pt-5 px-8">
                            <form action="{{route('update-photo')}}" method="POST" enctype="multipart/form-data" id="profileForm">
                                @csrf
                                @method('PUT')
                                <label for="profile_photo" class="cursor-pointer inline-flex items-cente py-1 rounded w-full border-2 hover:ring-2 hover:border-blue-200 text-slate-400 hover:text-slate-600 font-medium transition-all duration-300 dark:border-[#38414A] dark:hover:border-blue-300 dark:hover:text-slate-200 dark:text-slate-400">
                                    <input type="file" name="profile_photo" id="profile_photo" class="hidden" onchange="document.getElementById('profileForm').submit();">
                                    <p class="w-full text-center">Change avatar</p>
                                </label>
                            </form>
                            @if($user->profile_photo)
                                <form action="{{route('delete-avatar')}}" method="POST" id="profile_del">
                                    @csrf
                                    @method('DELETE')
                                    <button id="" type="submit" class="w-full border-2 hover:ring-2 ring-rose-400 mt-2 hover:border-red-200 text-red-400 hover:text-red-600 rounded py-1 font-medium transition-all duration-300 dark:border-[#38414A] dark:hover:border-red-200">
                                        Delete avatar
                                    </button>
                                </form>
                            @endif  
                            <p class="text-slate-600 font-medium text-xs text-center mt-3 dark:text-slate-400">Maximum file image : 2MB</p>
                            <p class="text-slate-600 font-medium text-xs text-center dark:text-slate-400">Format Image : JPEG, JPG, PNG</p>
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
                                <div class="w-full bg-slate-100 dark:bg-[#101214] border-l border-r border-slate-300 dark:border-[#38414A]">
                                    <a href="{{route('setting')}}">
                                        <p class="px-5 py-4 font-medium md:text-base text-sm text-slate-700 dark:text-slate-300 dark:hover:text-blue-600 hover:text-blue-600">My Account</p>
                                    </a>
                                </div>
                                <div class="w-full dark:bg-[#1D2125] border-l border-r bg-white border-slate-300 dark:border-[#38414A]">
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
                <p class="text-base font-medium text-slate-700 text-center dark:text-slate-300">My account</p>
                <div class="mt-3 w-full">
                    {{-- <div class="md:w-[98px] md:h-[98px] w-[98px] h-[98px] mx-auto rounded-full bg-black bg-cover bg-center" style="background-image: url({{asset('img/profile.png')}});"></div> --}}
                    <img id="default7" src="{{ Auth::user()->profile_photo ? asset('storage/profile_photos/' .  Auth::user()->profile_photo) : asset('img/default.png') }}" alt="" class="rounded-full md:w-[98px] md:h-[98px] w-[98px] h-[98px] object-cover object-center mx-auto">
                    <img id="default8" src="{{Auth::user()->profile_photo ? asset('storage/profile_photos/' .  Auth::user()->profile_photo) : asset('img/default3.png') }}" alt="" class="rounded-full md:w-[98px] md:h-[98px] w-[98px] h-[98px] object-cover object-center mx-auto hidden">                
                </div>
                <div class="mt-4 px-16">
                    <form action="{{route('update-photo')}}" method="POST" enctype="multipart/form-data" id="profileForm">
                        @csrf
                        @method('PUT')
                        <label for="profile_photo" class="cursor-pointer inline-flex items-cente py-1 rounded w-full border-2 hover:ring-2 hover:border-blue-200 text-slate-400 hover:text-slate-600 font-medium transition-all duration-300 dark:border-[#38414A] dark:hover:border-blue-300 dark:hover:text-slate-200 dark:text-slate-400">
                            <input type="file" name="profile_photo" id="profile_photo" class="hidden" onchange="document.getElementById('profileForm').submit();">
                            <p class="w-full text-center">Change avatar</p>
                        </label>
                    </form>
                    @if($user->profile_photo)
                        <form action="{{route('delete-avatar')}}" method="POST" id="profile_del">
                            @csrf
                            @method('DELETE')
                            <button id="" type="submit" class="w-full border-2 hover:ring-2 ring-rose-400 mt-2 hover:border-red-200 text-red-400 hover:text-red-600 rounded py-1 font-medium transition-all duration-300 dark:border-[#38414A] dark:hover:border-red-200">
                                Delete avatar
                            </button>
                        </form>
                    @endif  
                    <p class="text-slate-600 font-medium text-xs text-center mt-3 dark:text-slate-400">Maximum file image : 5MB</p>
                    <p class="text-slate-600 font-medium text-xs text-center dark:text-slate-400">Format Image : JPEG, JPG, PNG</p>
                </div>
            </div>
            <div class="px-4 py-4">
                <form action="{{route('profile.update')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-300">Username </p>
                        <input type="text" value="{{Auth::user()->name}}" class="mt-2 text-slate-600 w-full focus:ring-2 focus:border-blue-100 transition-all duration-300 py-1 px-2 text-sm rounded-md outline-none border-2 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200" readonly>
                    </div>
                    <div class="mt-3">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-300">Company </p>
                        <input type="text" value="{{Auth::user()->company}}" class="mt-2 text-slate-600 w-full focus:ring-2 focus:border-blue-100 transition-all duration-300 py-1 px-2 text-sm rounded-md outline-none border-2 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200" readonly>
                    </div>
                    <div class="mt-3">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-300">Addres</p>
                        <input type="text" value="{{Auth::user()->addres}}" class="mt-2 text-slate-600 w-full focus:ring-2 focus:border-blue-100 transition-all duration-300 py-1 px-2 text-sm rounded-md outline-none border-2 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200" readonly>
                    </div>
                    <div class="mt-3">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-300">email </p>
                        <input type="text" value="{{Auth::user()->email}}" class="mt-2 text-slate-600 w-full focus:ring-2 focus:border-blue-100 transition-all duration-300 py-1 px-2 text-sm rounded-md outline-none border-2 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200">
                    </div>
                    <div class="mt-3">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-300">Phone number </p>
                        <input type="number" value="{{Auth::user()->number}}" class="mt-2 text-slate-600 w-full focus:ring-2 focus:border-blue-100 transition-all duration-300 py-1 px-2 text-sm rounded-md outline-none border-2 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200">
                    </div>
                    <div class="mt-3">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-300">Created at </p>
                        <input type="text" value="{{\carbon\carbon::parse(Auth::user()->created_at)->format('d F Y')}}" class="mt-2 text-slate-600 w-full focus:ring-2 focus:border-blue-100 transition-all duration-300 py-1 px-2 text-sm rounded-md outline-none border-2 dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200" readonly>
                    </div>
                    <input type="submit" class="mt-6 mb-2 bg-blue-500 text-white w-full rounded py-1 font-medium cursor-pointer hover:bg-purple-700 transition-all duration-300 text-sm">
                </form>
                @if ($errors->any())
                    <div id="error-message" class="bg-red-200 py-4 px-4 w-full rounded-lg">
                        <div class="flex mx-auto justify-between">
                            <div class="flex">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="30"  height="30"  viewBox="0 0 24 20"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-exclamation-circle my-auto text-red-500 mr-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M17 3.34a10 10 0 1 1 -15 8.66l.005 -.324a10 10 0 0 1 14.995 -8.336m-5 11.66a1 1 0 0 0 -1 1v.01a1 1 0 0 0 2 0v-.01a1 1 0 0 0 -1 -1m0 -7a1 1 0 0 0 -1 1v4a1 1 0 0 0 2 0v-4a1 1 0 0 0 -1 -1" />
                                </svg>
                                <ul class="mt-1">
                                    @foreach ($errors->all() as $error)
                                        <li class="font-medium my-auto text-slate-700">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
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
    <p class="text-center text-xs mb-6 text-slate-500 dark:text-slate-300">Are you sure want to dellete profile? This action cannot be undone</p>
    <div class="text-center">
        <button id="formConfirmButton3" class="w-full bg-red-400 rounded text-sm md:text-base py-[0.15rem] md:py-1 text-white font-medium hover:bg-red-800 transition-all duration-300">Yes</button>
        <button id="formCancelButton3" class="w-full rounded border-[1.5px] text-sm md:text-base dark:border-[#38414A] py-[0.15rem] md:py-1 font-medium mt-3 mb-2 text-slate-700 transition-all duration-300 hover:ring-2 hover:ring-red-400 hover:border-red-500 dark:hover:border-red-500 hover:text-red-400 dark:hover:text-red-400 dark:text-slate-300">Cancel</button>
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
    function closeMessage2() {
        document.getElementById('error-message').style.display = 'none';
    }
</script>
@endsection