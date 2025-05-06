<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Login Page</title>
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
</head>
<body class="bg-slate-100 fade-in dark:bg-[#101214]">
    <section class="md:mt-6 mt-10">
        <div class="container px-5 md:px-0">
            <img src="{{asset('img/logo1.png')}}" alt="" class="w-[300px] mx-auto mb-4">
            <div class="bg-white mx-auto md:w-[900px] rounded-lg md:flex flex-wrap shadow-lg dark:bg-[#282E33]">
                <div class="md:w-1/2 md:px-10 md:py-14 px-8 py-8">
                    <div>
                        <p class="font-bold md:text-2xl text-xl text-slate-700 dark:text-gray-100">Login</p>
                        <p class="text-slate-500 dark:text-gray-400">Insert your account to login.</p>
                    </div>
                    <div class="mt-4">
                        <form action="{{route('auth')}}" method="POST">
                            @csrf
                            <div>
                                <p class="text-slate-700 dark:text-gray-200 text-sm  font-medium">Email Address</p>
                                <input type="text" value="{{old('email')}}" name="email" class="w-full outline-none border-2 py-2 px-2 rounded mt-2 focus:ring-primary focus:border-primary transition duration-300 dark:bg-[#282E33] dark:border-[#596773] dark:text-gray-200 dark:focus:ring-primary dark:focus:border-primary @error('email') border-red-500 @enderror" placeholder="you@example.com" autocomplete="off" required>
                                @error('email')
                                    <div class="text-red-500 text-sm">{{$message}}</div>
                                @enderror
                                @error('loginerror')
                                    <div class="text-red-500 text-xs">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <div class="flex justify-between">
                                    <p class="text-slate-700 font-medium dark:text-gray-200">Password</p>
                                    <a href="{{route('forgotpass')}}" class="text-sm hover:text-purple-500 underline text-blue-500 font-medium">Forgot Password</a>                                 
                                </div>
                                <div class="relative">
                                    <input type="password" value="{{old('password')}}" name="password" id="password" class="w-full outline-none border-2 py-2 pl-2 pr-12 rounded mt-2 focus:ring-primary focus:border-primary transition duration-300 dark:bg-[#282E33] dark:border-[#596773] dark:text-gray-200 dark:focus:ring-primary dark:focus:border-primary" placeholder="Enter 6 character or more" autocomplete="off" required>
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
                                @error('loginerror')
                                    <div class="text-red-500 text-xs">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mt-5">
                                <input type="submit" value="Login" class="bg-primary w-full text-white font-semibold py-2 rounded-lg hover:bg-purple-700 transition duration-300 cursor-pointer">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="md:w-1/2 hidden md:block h-[404px] overflow-y-auto rounded-r-lg" style="background: rgb(125,34,195); background: linear-gradient(0deg, rgba(125,34,195,1) 0%, rgba(45,49,253,1) 100%);">
                    <div class="text-center px-8">
                        <p class="text-white font-bold text-2xl mt-20">Client Management Project</p>
                        <p class="text-white text-justify mt-3">Website ini merupakan platform client management yang dirancang untuk perusahaan atau individu yang bergerak di bidang 3D modeling. Website ini memungkinkan klien untuk dengan mudah memantau dan mengelola proyek 3D mereka dalam satu tempat.</p>
                    </div>
                    <div class="mx-24 mt-6 mb-10">
                        <a href="https://waindo.co.id/"><button class="w-full border border-white rounded-full text-white py-2 hover:bg-white hover:text-black transition">More about Waindo</button></a>
                    </div>
                </div>
            </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
          if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
          } else {
            document.documentElement.classList.remove('dark');
          }
        });
    </script>
</body>
</html>