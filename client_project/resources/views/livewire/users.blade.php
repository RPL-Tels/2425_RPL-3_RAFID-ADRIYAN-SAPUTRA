<div class="md:px-12 px-12 mx-auto">
    @if (Auth::user()->role === 'user')
        <h5 class="text-center md:text-5xl text-2xl font-bold mb-8 dark:text-white">Admin</h5>
    @else
        <h5 class="text-center md:text-5xl text-2xl font-bold mb-8 dark:text-white">Users</h5>
    @endif
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @foreach ($users as $key=> $user)
        {{-- child --}}
        <div class="w-full bg-white border border-gray-200 rounded-lg p-5 shadow dark:bg-[#1D2125] dark:border-[#2C333A]">
            <div class="flex flex-col items-center pb-10">
                <img id="default1" src="{{$user->profile_photo ? asset('storage/profile_photos/' .  $user->profile_photo) : asset('img/default.png') }}" alt="" class="w-24 h-24 object-cover object-center rounded-full">
                <img id="default2" src="{{$user->profile_photo ? asset('storage/profile_photos/' .  $user->profile_photo) : asset('img/default3.png') }}" alt="" class="w-24 h-24 object-cover object-center rounded-full hidden">
                <h5 class="mb-1 text-xl font-medium text-gray-900 text-center mt-2 dark:text-gray-200" >
                    {{implode(' ', array_slice(explode(' ', $user->name), 0, 3))}}
                </h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{$user->email}} </span>
                @if($user->isOnline())
                    <span class="text-green-500">● Online</span>
                @else
                    <span class="text-gray-500">● Offline</span>
                @endif
                <div class="flex mt-4 space-x-1 md:mt-6">
                    <x-primary-button wire:click="message({{$user->id}})" >
                        Message
                    </x-primary-button>
                    <a href="{{route('user.profile', $user->user_id)}}">
                        <x-secondary-button>
                            View Profile
                        </x-secondary-button>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>