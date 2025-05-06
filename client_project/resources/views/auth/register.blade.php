<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite('resources/css/app.css')
    {{-- tansisi web masuk dan keluar --}}
    <style>
        body {
            transition: opacity 0.5s ease;
            opacity: 1;
        }

        body.fade-out {
            opacity: 0;
        }

        body.fade-in {
            opacity: 0;
        }

        .fade-in-active {
            animation: fadeIn 0.5s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-slate-100 fade-in">
    <section class="mt-16">
        <div class="container">
            <div class="bg-white mx-auto w-[900px] rounded-lg flex flex-wrap shadow-lg">
                <div class="w-1/2 rounded-l-lg" style="background: #2d31fd; background: linear-gradient(0deg, #2d31fd 0%, #7d22c3 100%);">
                    <div class="text-center">
                        <p class="text-white font-bold text-3xl mt-48">Nazaru Payroll Website</p>
                        <p class="text-white font-medium mt-3">Total solution for digital information</p>
                    </div>
                    <div class="mx-24 mt-6">
                        <a href="https://waindo.co.id/"><button class="w-full border border-white rounded-full text-white py-2 hover:bg-white hover:text-black transition">More about Nazaru</button></a>
                    </div>
                </div>
                <div class="w-1/2 px-10 py-14">
                    <div>
                        <p class="font-bold text-2xl text-slate-700">Register</p>
                        <p class="text-slate-500">Already have an account?<a href="{{route('login')}}" class="underline text-primary hover:text-purple-700 transition duration-300"> Sign in</a></p>
                    </div>
                    <div class="mt-4">
                        <form action="{{route('validate')}}" method="POST">
                            @csrf
                            <div>
                                <p class="text-slate-700 font-medium">Name</p>
                                <input type="text" value="{{old('name')}}" name="name" class="w-full outline-none border-2 py-2 px-2 rounded mt-2 focus:ring-primary focus:border-primary transition duration-300 @error('name') border-red-500 @enderror" placeholder="you@example.com" autocomplete="off" required>
                                @error('name')
                                    <div class="text-red-500 text-sm">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <p class="text-slate-700 font-medium">Email Address</p>
                                <input type="text" value="{{old('email')}}" name="email" class="w-full outline-none border-2 py-2 px-2 rounded mt-2 focus:ring-primary focus:border-primary transition duration-300 @error('email') border-red-500 @enderror" placeholder="you@example.com" autocomplete="off" required>
                                @error('email')
                                    <div class="text-red-500 text-sm">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <p class="text-slate-700 font-medium">Company</p>
                                <input type="text" value="{{old('company')}}" name="company" class="w-full outline-none border-2 py-2 px-2 rounded mt-2 focus:ring-primary focus:border-primary transition duration-300 @error('company') border-red-500 @enderror" placeholder="you@example.com" autocomplete="off" required>
                                @error('company')
                                    <div class="text-red-500 text-sm">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <p class="text-slate-700 font-medium">Addres</p>
                                <input type="text" value="{{old('addres')}}" name="addres" class="w-full outline-none border-2 py-2 px-2 rounded mt-2 focus:ring-primary focus:border-primary transition duration-300 @error('addres') border-red-500 @enderror" placeholder="you@example.com" autocomplete="off" required>
                                @error('addres')
                                    <div class="text-red-500 text-sm">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <p class="text-slate-700 font-medium">Phone number</p>
                                <input type="number" value="{{old('number')}}" name="number" class="w-full outline-none border-2 py-2 px-2 rounded mt-2 focus:ring-primary focus:border-primary transition duration-300 @error('number') border-red-500 @enderror" placeholder="you@example.com" autocomplete="off" required>
                                @error('number')
                                    <div class="text-red-500 text-sm">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <div class="flex justify-between">
                                    <p class="text-slate-700 font-medium">Password</p>
                                </div>
                                <div class="relative">
                                    <input type="password" value="{{old('password')}}" name="password" id="password" class="w-full outline-none border-2 py-2 pl-2 pr-12 rounded mt-2 focus:ring-primary focus:border-primary transition duration-300 @error('password') border-red-500 @enderror" placeholder="Enter 6 character or more" autocomplete="current-password" required>
                                    <div class="absolute inset-y-0 right-0 pr-4 pt-2 flex items-center text-sm leading-5">
                                        <button type="button" id="togglePassword" class="text-gray-500 focus:outline-none focus:text-gray-600 hover:text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="eyeOpen" height="24px" viewBox="0 -960 960 960" width="24px" fill="#cbd5e1"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" id="eyeClosed" height="24px" viewBox="0 -960 960 960" width="24px" fill="#cbd5e1" class="hidden"><path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/></svg>
                                        </button>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="text-red-500 text-sm">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mt-10">
                                <input type="submit" value="Register" class="bg-primary w-full text-white font-semibold py-2 rounded-lg hover:bg-purple-700 transition duration-300 cursor-pointer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @error('message')
                <p>{{$message}}</p>
            @enderror
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>
    <script>
        // fungsi tombol visible password
        document.addEventListener('DOMContentLoaded', (event) => {
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');
        const eyeOpenIcon = document.getElementById('eyeOpen');
        const eyeClosedIcon = document.getElementById('eyeClosed');

        togglePasswordButton.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            if (type === 'password') {
                eyeOpenIcon.classList.remove('hidden');
                eyeClosedIcon.classList.add('hidden');
            } else {
                eyeOpenIcon.classList.add('hidden');
                eyeClosedIcon.classList.remove('hidden');
            }
        });
        });
    </script>
    <script>
        // fungsi masuk dan keluar transisi web
        document.addEventListener("DOMContentLoaded", function () {
            document.body.classList.add("fade-in-active");
        });

        document.addEventListener("click", function (event) {
            if (event.target.tagName === "A") {
                event.preventDefault();
                const href = event.target.getAttribute("href");

                document.body.classList.add("fade-out");

                setTimeout(function () {
                    window.location.href = href;
                }, 500);
            }
        });
    </script>
</body>
</html>