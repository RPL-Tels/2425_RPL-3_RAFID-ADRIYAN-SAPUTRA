<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mark as Paid invoice</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 dark:bg-[#101214]">
    <div class="container">
        <div class="px-6 py-6 w-[400px] mt-24 mx-auto bg-white rounded shadow dark:bg-[#22272B]">
            <p class="text-xl font-bold text-gray-800 dark:text-gray-200">Mark Invoice as Paid</p>
            <form action="{{route('invoice.mark', $data->invoice_number)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-5">
                    <p class="font-medium text-gray-700 dark:text-gray-300">Amount</p>
                    <input type="text" id="amount" name="amount" placeholder="" autocomplete="OFF" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300">
                </div>
                <div class="mt-3">
                    <p class="font-medium text-gray-700 dark:text-gray-300">Payment Date</p>
                    <input type="date" name="payment_date" placeholder="" autocomplete="OFF" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300">
                </div>
                <div class="mt-3">
                    <p class="font-medium text-gray-700 dark:text-gray-300">Payment Method</p>
                    <select name="payment_method" id="" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300">
                        <option value="" selected disabled>Select Method</option>
                        <option value="Bank_transfer">Bank Transfer</option>
                        <option value="Credit_Card">Credit Card</option>
                        <option value="Paypal">Paypal</option>
                    </select>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="{{route('admin.invoice')}}" class="py-2 px-4 bg-gray-500 text-white rounded mr-2">Cancel</a>
                    <input type="submit" class="bg-green-500 text-white py-2 px-4 rounded">
                </div>
            </form>
        </div>
    </div>
    @foreach ($errors->all() as $error)
        <li class="font-medium my-auto text-slate-700">{{ $error }}</li>
    @endforeach
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const currencyInput = document.getElementById("amount");
    
            // Fungsi untuk memformat angka menjadi format rupiah
            function formatNumber(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
    
            // Event listener untuk input
            currencyInput.addEventListener("input", function () {
                let value = this.value.replace(/[^\d]/g, ""); // Hapus semua karakter selain angka
                if (value) {
                    this.value = "Rp. " + formatNumber(value); // Format angka dengan "Rp."
                } else {
                    this.value = "Rp. "; // Jika kosong, kembalikan ke awalan
                }
            });
    
            // Mencegah pengguna menghapus awalan "Rp."
            currencyInput.addEventListener("keydown", function (event) {
                if (this.selectionStart <= 3 && (event.key === "Backspace" || event.key === "ArrowLeft")) {
                    event.preventDefault(); // Cegah penghapusan atau navigasi sebelum "Rp."
                }
            });
    
            // Fokus otomatis ke akhir input
            currencyInput.addEventListener("focus", function () {
                const length = this.value.length;
                this.setSelectionRange(length, length); // Kursor di akhir teks
            });
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