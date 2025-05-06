@extends('layouts.layers')
@section('title', 'admin-clients')
@section('section')
<div class="container">
    <div class="md:px-12 px-5">
        <div class="flex justify-between items-center">
            <div class="md:text-base text-sm">
                <p class="text-slate-600 font-medium md:text-md dark:text-slate-100">Clients</p>
                <h1 class="text-slate-800 font-bold md:text-2xl text-base dark:text-slate-400">List clients</h1>
            </div>
            <div>
                <a href="{{route('admin.add.user')}}"><button class="border-[1.5px] bg-white px-8 text-sm md:text-base py-1 rounded text-slate-500 hover:bg-blue-500 hover:text-white dark:bg-[#1D2125] dark:border-[#282E33] dark:text-white dark:hover:bg-blue-500 dark:hover:border-blue-500">Add User</button></a>
            </div>
        </div>
        <div class="md:flex md:mt-6 mt-10 justify-between">
            <div class="mt-4 md:mt-0">
                <form action="{{route('admin.client.search')}}" method="GET">
                    @csrf
                    <input type="search" placeholder="Seacrh name, email or user_id..." name="query" value="{{request('query')}}" class="py-2 border-[1.5px] md:w-[300px] w-full px-4 rounded-full border-slate-300 focus:ring-2 focus:border-blue-100 transition-all duration-300 text-sm outline-none dark:bg-[#161A1D] dark:border-[#38414A] dark:focus:border-blue-300 dark:text-slate-200"">
                </form>
            </div>
        </div>
        <hr class="border-[1.5px] mt-4 border-slate-300 dark:border-[#22272B]">
        <div class="mt-6">
            <div class="overflow-x-scroll md:overflow-visible">
                <table class="md:w-full w-[1200px] table-auto border-collapse shadow">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 dark:bg-[#2C333A] dark:text-gray-200 leading-normal">
                            <th class="py-3 px-6 text-left">User Name</th>
                            <th class="py-3 px-6 text-left">Company</th>
                            <th class="py-3 px-6 text-left">Address</th>
                            <th class="py-3 px-6 text-left">Role</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-left">Phone Number</th>
                            <th class="py-3 px-6 text-left"></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 bg-white dark:text-gray-400">
                        @foreach ($data as $user)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 dark:bg-[#161A1D] dark:border-[#282E33] dark:hover:bg-[#282E33]">
                                <td class="py-3 px-6 flex items-center">
                                    <img src="{{$user->profile_photo ? asset('storage/profile_photos/' .  $user->profile_photo) : asset('img/default.png') }}" alt="" class="w-12 h-12 rounded-full object-cover object-center">
                                    <div class="ml-2">
                                        <p class="truncate font-medium text-gray-600 dark:text-gray-200">{{implode(' ', array_slice(explode(' ', $user->name), 0, 3))}}</p>
                                        <p class="text-sm">{{$user->user_id}}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-6">{{$user->company}}</td>
                                <td class="py-3 px-6">{{$user->addres}}</td>
                                <td class="py-3 px-6">{{$user->role}}</td>
                                <td class="py-3 px-6">{{$user->email}}</td>
                                <td class="py-3 px-6">{{$user->number}}</td>
                                <td class="py-3 w-[1%] text-center">
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
                                                <a href="{{route('user.profile', $user->user_id)}}">
                                                    <button class="items-center gap-3 flex w-full px-4 py-2 text-left text-sm leading-5 text-gray-500 hover:bg-gray-100 transition-all duration-150 ease-in-out focus:outline-none focus:bg-gray-100 dark:hover:bg-[#1D2125] dark:text-gray-300">
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                                        </svg>
                                                        View Profile
                                                    </button>
                                                </a>
                                                @if ($user->user_id === Auth::user()->user_id)
                                                @else
                                                    <a href="{{route('admin.edite.user', $user->user_id)}}">
                                                        <button class="items-center gap-3 flex w-full px-4 py-2 text-left text-sm leading-5 text-blue-500 hover:bg-gray-100 transition-all duration-150 ease-in-out focus:outline-none focus:bg-gray-100 dark:hover:bg-[#1D2125]">
                                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                <path d="M16 5l3 3" />
                                                            </svg>
                                                            Edit User
                                                        </button>
                                                    </a>
                                                    <form action="{{route('admin.user.delete', $user->user_id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="items-center gap-3 flex w-full px-4 py-2 text-left text-sm leading-5 text-red-500 hover:bg-gray-100 transition-all duration-150 ease-in-out focus:outline-none focus:bg-gray-100 dark:hover:bg-[#1D2125]">
                                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                            </svg>
                                                            Delete User
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
            {{-- <div class="bg-white dark:bg-[#1D2125] shadow-md py-8 px-4 rounded-b-lg">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-slate-500 dark:text-gray-400 w-24 h-24 mx-auto icon icon-tabler icons-tabler-outline icon-tabler-user-x">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                    <path d="M22 22l-5 -5" /><path d="M17 22l5 -5" />
                </svg>
                <p class="text-center text-xl font-medium text-slate-400 dark:text-gray-300">User not found!</p>
            </div> --}}
            <div class="mt-4 px-6">
                {{ $data->links('pagination::tailwind') }}
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
@endsection