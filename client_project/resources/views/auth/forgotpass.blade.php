<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
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
    <section class="fixed inset-x-0 mt-16 md:mt-14">
        <div class="container">
            <div class="bg-white md:w-[400px] w-[350px] mx-auto py-8 px-8 rounded-md shadow-md">
                <div class="text-center">
                    <div class="border-2 rounded w-fit mx-auto px-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 -5 24 34" stroke-width="1.5" stroke="currentColor" class="w-8 mx-auto rounded">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a7.464 7.464 0 0 1-1.15 3.993m1.989 3.559A11.209 11.209 0 0 0 8.25 10.5a3.75 3.75 0 1 1 7.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 0 1-3.6 9.75m6.633-4.596a18.666 18.666 0 0 1-2.485 5.33" />
                        </svg>
                    </div>
                    <h1 class="font-semibold text-md text-slate-800 mb-[-8px]">Forgot Password?</h1>
                    <p class="font-medium mt-2 text-sm text-slate-500">No wories, we'll send you reset instructions.</p>
                </div>
                <div class="block mt-9">
                    <form action="{{route('forgot.send')}}" method="POST">
                        @csrf
                        <div>
                            <p class="text-slate-800 font-medium ">Email</p>
                            <input type="email" name="email" class="border-2 rouded outline-none w-full mt-1 py-2 text-sm px-3 rounded-md focus:ring-primary focus:border-primary transition duration-300" placeholder="Enter your email">
                        </div>
                        <input type="submit" class="w-full bg-primary mt-4 py-2 text-sm rounded-md text-white font-semibold hover:bg-purple-700 transition duration-300 cursor-pointer" value="Reset password">
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
                <div class="grid grid-cols-4 gap-3 mt-24">
                    <div class="bg-blue-500 rounded-full py-1"></div>
                    <div class="bg-slate-300 rounded-full py-1"></div>
                    <div class="bg-slate-300 rounded-full py-1"></div>
                    <div class="bg-slate-300 rounded-full py-1"></div>
                </div>
            </div>
        </div>
    </section>
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