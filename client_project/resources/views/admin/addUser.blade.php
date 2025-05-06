<!DOCTYPE html>
<html lang="en" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add user</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="dark:bg-[#101214] bg-white">
    <div class="container">
        <div class="px-1 bg-slate-300 mx-auto w-fit py-1 h-fit md:mt-4 mt-12 rounded-lg shadow-lg mb-10 dark:bg-[#161A1D]">
            <div class="bg-white w-[450px] border-[1.5px] border-slate-300 rounded-2xl dark:bg-[#22272B] dark:border-[#161A1D]">
                <div class="px-6 py-4 border-b-[1.5px] border-slate-300 flex justify-between items-center dark:border-[#38414A]">
                    <div>
                        <p class="text-xl font-semibold text-slate-800 dark:text-white">Add new user</p>
                        <p class="text-sm text-slate-500 font-medium dark:text-gray-400">Add new user account</p>
                    </div>
                    <div class="">
                        <a href="{{ url()->previous() }}" class="hover:text-slate-800 text-slate-600">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x dark:text-white">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M18 6l-12 12" />
                                <path d="M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <form action="{{route('validate')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <p class="text-slate-700 font-medium dark:text-gray-200">Name</p>
                            <input type="text" placeholder="User name..." name="name" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" required autocomplete="OFF">  
                        </div>
                        <div class="mb-3">
                            <p class="text-slate-700 font-medium dark:text-gray-200">Email</p>
                            <input type="text" placeholder="You@example.com" name="email" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" required autocomplete="OFF">  
                        </div>
                        <div class="mb-3">
                            <p class="text-slate-700 font-medium dark:text-gray-200">Phone number</p>
                            <input type="text" placeholder="089XXXXXX" name="number" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" required autocomplete="OFF">  
                        </div>
                        <div class="mb-3">
                            <p class="text-slate-700 font-medium dark:text-gray-200">Password</p>
                            <input type="password" placeholder="Enter 6 character or more..." name="password" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" required autocomplete="OFF">  
                        </div>
                        <div class="mb-3">
                            <p class="text-slate-700 font-medium dark:text-gray-200">Company</p>
                            <input type="text" placeholder="User company..." name="company" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" required autocomplete="OFF">  
                        </div>
                        <div class="">
                            <p class="text-slate-700 font-medium dark:text-gray-200">Addres</p>
                            <input type="text" placeholder="User company addres..." name="addres" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" required autocomplete="OFF">  
                        </div>
                        <input type="submit" class="w-full bg-blue-500 mt-8 mb-2 py-2 text-white font-medium rounded-md hover:bg-blue-700 transition-colors duration-150 cursor-pointer">
                    </form>
                </div>
            </div>
        </div>
        @foreach ($errors->all() as $error)
                    <li class="font-medium my-auto text-slate-700">{{ $error }}</li>
                @endforeach
    </div>
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