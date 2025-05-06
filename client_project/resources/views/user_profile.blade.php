@extends('layouts.layers')
@section('title', 'User profile')
@section('section')
    <div class="container pt-12">
        <div class="md:px-12 px-5">
            <div class="bg-white md:w-[915px] rounded-md shadow-md dark:shadow-gray-800 md:flex block mx-auto dark:bg-[#161A1D]">
                <div class="md:w-1/2 w-full hidden md:block rounded-l-md bg-cover bg-center" style="background-image: url('{{$data->profile_photo ? asset('storage/profile_photos/' .  $data->profile_photo) : asset('img/default.png') }}')">
                    {{-- <img src="{{$data->profile_photo ? asset('storage/profile_photos/' .  $data->profile_photo) : asset('img/default.png') }}" class="w-auto h-auto object-cover object-center rounded-l-md"> --}}
                </div>
                <div class="md:w-1/2 h-44 w-full md:hidden rounded-t-md bg-cover bg-center" style="background-image: url('{{$data->profile_photo ? asset('storage/profile_photos/' .  $data->profile_photo) : asset('img/default.png') }}')">
                    {{-- <img src="{{$data->profile_photo ? asset('storage/profile_photos/' .  $data->profile_photo) : asset('img/default.png') }}" class="w-auto h-auto object-cover object-center rounded-l-md"> --}}
                </div>
                <div class="md:w-1/2 md:px-6 px-4 py-5">
                    <div class="flex items-center">
                        <p class="text-xl font-medium text-slate-700 md:max-w-xs md:truncate dark:text-gray-200">{{implode(' ', array_slice(explode(' ', $data->name), 0, 3))}}</p>
                    </div>
                    <p class="text-slate-600 capitalize dark:text-slate-400">{{$data->role}} <span>({{$data->user_id}})</span></p>
                    @if($data->isOnline())
                        <span class="text-green-500">● Online</span>
                    @else
                        <span class="text-gray-500">● Offline</span>
                    @endif
                    <div class="mt-4 mb-4 flex md:text-base text-sm">
                        <div>
                            <p class="text-slate-800 font-medium dark:text-gray-200">Name</p>
                            <p class="text-slate-800 font-medium dark:text-gray-200">Email</p>
                            <p class="text-slate-800 font-medium dark:text-gray-200">Phone</p>
                            <p class="text-slate-800 font-medium dark:text-gray-200">Company</p>
                            <p class="text-slate-800 font-medium dark:text-gray-200">Address</p>
                        </div>
                        <div class="ml-2">
                            <p class="text-slate-800 font-medium dark:text-gray-200">:</p>
                            <p class="text-slate-800 font-medium dark:text-gray-200">:</p>
                            <p class="text-slate-800 font-medium dark:text-gray-200">:</p>
                            <p class="text-slate-800 font-medium dark:text-gray-200">:</p>
                            <p class="text-slate-800 font-medium dark:text-gray-200">:</p>
                        </div>
                        <div class="ml-2">
                            <p class="text-slate-600 dark:text-slate-400">{{implode(' ', array_slice(explode(' ', $data->name), 0, 3))}}</p>
                            <p class="text-slate-600 dark:text-slate-400">{{$data->email}}</p>
                            <p class="text-slate-600 dark:text-slate-400">{{$data->number}}</p>
                            <p class="text-slate-600 dark:text-slate-400">{{$data->company}}</p>
                            <div class="flex">
                                <p class="text-slate-600 dark:text-slate-400">{{$data->addres}}</p>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->user_id === $data->user_id)
                        <a href="{{route('admin-clients')}}">
                            <x-secondary-button >
                                Back
                            </x-secondary-button>
                        </a>
                    @else
                        <a href="{{route('message', $data->id)}}">
                            <x-primary-button>
                                Message
                            </x-primary-button>
                        </a>
                        <a href="{{url()->previous()}}" class="ml-2">
                            <x-secondary-button >
                                Back
                            </x-secondary-button>
                        </a>
                    @endif
                </div>
                <div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection