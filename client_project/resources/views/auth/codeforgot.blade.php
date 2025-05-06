<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Code Confirmation</title>
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
    <section class="md:mt-8 mt-16 inset-x-0">
        <div class="container">
            <div class="bg-white md:w-[400px] w-[350px] mx-auto py-8 px-8 rounded-md shadow-md">
                <div class="text-center">
                    <div class="mb-4 border-2 rounded w-fit px-2 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 -5 24 34" stroke-width="1.5" stroke="currentColor" class="w-8 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
                        </svg>                          
                    </div>
                    <h1 class="font-semibold text-md text-slate-800 mb-[-8px]">Password reset</h1>
                    <p class="font-medium mt-2 text-sm text-slate-500">We sent a code to</p>
                    @error('otp')
                        <p>{{$message}}</p>
                    @enderror
                </div>
                <div class="block mt-9">
                    <form action="{{route('password.verify.code')}}" method="POST">
                        @csrf
                        <div class="grid grid-cols-6 md:gap-2 gap-2">
                            @for ($i = 0; $i < 6; $i++)
                                <input type="text" id="otp-{{ $i }}" maxlength="1" oninput="moveToNext(this, {{ $i }})" name="otp[]" required class="border-slate-300 outline-none border-2 text-center text-xl py-4 rounded-lg font-bold focus:ring-primary focus:border-primary transition duration-300 valid:border-primary" autocomplete="off" required>
                            @endfor
                        </div>
                        <input type="hidden" name="full_otp" id="full_otp">
                        <input type="submit" class="w-full bg-primary mt-6 py-2 text-sm rounded-md text-white font-semibold hover:bg-purple-700 transition duration-300 cursor-pointer" value="Continue">
                    </form>
                </div>
                <p class="text-center text-sm text-slate-400 mt-6">Didn't receive the email? <span class="underline text-primary">click to resend</span></p>
                <div class="flex mt-6 text-center">
                    <div class="mx-auto flex">
                        <a href="{{route('login')}}" class="flex hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 -4 24 28" stroke-width="2.0" stroke="currentColor" class="w-3 my-auto mr-1 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            <p class="text-slate-400 font-medium text-sm">Back to log in</p>
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-3 mt-24">
                    <div class="bg-slate-300 rounded-full py-1"></div>
                    <div class="bg-blue-500 rounded-full py-1"></div>
                    <div class="bg-slate-300 rounded-full py-1"></div>
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
<script>
    function moveToNext(elem, index) {
        const next = document.getElementById('otp-' + (index + 1));
        const prev = document.getElementById('otp-' + (index - 1));
        if (elem.value.length === 1 && next) {
            next.focus();
        }
        if (elem.value.length === 0 && prev) {
            prev.focus();
        }
        updateFullOtp();
    }
    function updateFullOtp() {
        let otp = '';
        for (let i = 0; i < 6; i++) {
            otp += document.getElementById('otp-' + i).value;
        }
        document.getElementById('full_otp').value = otp;
    }
</script>
</html>