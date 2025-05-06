<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset password</title>
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
</head>
<body class="bg-slate-100 fade-in">
    <section class="mt-8 mx-auto">
        <div class="container">
            <div class="bg-white md:w-[400px] w-[350px] mx-auto py-8 px-8 rounded-md shadow-md">
                <div class="text-center">
                    <div class="w-fit mx-auto border-2 rounded mb-4 px-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 -5 24 34" stroke-width="1.5" stroke="currentColor" class="w-8 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>                          
                    </div>
                    <h1 class="font-semibold text-md mb-[-8px] text-slate-800">Set new password</h1>
                    <p class="font-medium mt-2 text-sm text-slate-500">Must be at least 8 character</p>
                </div>
                <div class="block mt-9">
                    <form action="{{route('password.reset')}}" method="POST">
                        @csrf
                        <div>
                            <p class="text-slate-800 font-medium text-sm">Paswword</p>
                            <input type="text" name="password" id="password" class="border-2 text-sm rouded outline-none w-full mt-1 py-2 px-3 rounded-md focus:ring-primary focus:border-primary transition duration-300" placeholder="Enter your email">
                        </div>
                        <div class="mt-3">
                            <p class="text-slate-800 font-medium text-sm">Confirm password</p>
                            <input type="text" name="password_confirmation" id="password_confirmation" class="border-2 text-sm rouded outline-none w-full mt-1 py-2 px-3 rounded-md focus:ring-primary focus:border-primary transition duration-300" placeholder="Enter your email">
                        </div>
                        <input type="submit" class="w-full bg-primary text-sm mt-6 py-2 rounded-md text-white font-semibold hover:bg-purple-700 transition duration-300 cursor-pointer" value="Reset password">
                    </form>
                </div>
                <div class="flex mt-6 text-center">
                    <div class="mx-auto flex">
                        <a href="{{route('login')}}" class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 -4 24 28" stroke-width="2.0" stroke="currentColor" class="w-3 my-auto mr-1 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            <p class="text-slate-400 font-medium text-sm">Back to login</p>
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-3 mt-16">
                    <div class="bg-slate-300 rounded-full py-1"></div>
                    <div class="bg-slate-300 rounded-full py-1"></div>
                    <div class="bg-blue-500 rounded-full py-1"></div>
                    <div class="bg-slate-300 rounded-full py-1"></div>
                </div>
            </div>
        </div>
    </section>
</body>
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
</html>