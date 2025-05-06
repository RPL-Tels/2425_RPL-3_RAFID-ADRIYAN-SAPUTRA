<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Done</title>
    @vite('resources/css/app.css')
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
    <section class="md:mt-28 mt-32 mx-auto">
        <div class="container">
            <div class="bg-white w-[350px] md:w-[350px] mx-auto py-8 px-8 rounded-md shadow-md">
                <div class="text-center">
                    <div class="w-fit border-2 px-2 mx-auto rounded mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 -5 24 34" stroke-width="1.5" stroke="currentColor" class="w-8 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>                          
                    </div>
                    <h1 class="font-semibold text-md text-slate-800">All done!</h1>
                    <p class="font-medium text-sm text-slate-500">Your password has been reset.</p>
                </div>
                <div class="block mt-9">
                    <a href="{{route('login')}}" class=""><button class="w-full border-2 py-2 text-sm font-medium transition duration-300 rounded-lg hover:bg-blue-500 hover:text-white hover:border-blue-500">Back to login</button></a>
                </div>
                <div class="grid grid-cols-4 gap-3 mt-24">
                    <div class="bg-slate-300 rounded-full py-1"></div>
                    <div class="bg-slate-300 rounded-full py-1"></div>
                    <div class="bg-slate-300 rounded-full py-1"></div>
                    <div class="bg-blue-500 rounded-full py-1"></div>  
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