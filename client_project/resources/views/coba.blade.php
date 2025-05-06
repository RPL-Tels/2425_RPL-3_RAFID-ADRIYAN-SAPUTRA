<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let addItemButton = document.getElementById('addItem');
            let itemsContainer = document.getElementById('itemsContainer');

            addItemButton.addEventListener('click', () => {
                let itemRow = `
                    <div class="flex space-x-2 mt-2">
                        <input type="text" name="items[][item_name]" placeholder="Item Name" 
                            class="block w-1/3 border-gray-300 rounded-md shadow-sm">
                        <input type="number" name="items[][quantity]" placeholder="Quantity" 
                            class="block w-1/6 border-gray-300 rounded-md shadow-sm">
                        <input 
                            type="text" 
                            name="items[][price]" 
                            placeholder="Price" 
                            class="block w-1/6 border-gray-300 rounded-md shadow-sm format-price"
                            data-input-type="currency"
                        >
                        <button type="button" class="removeItem text-red-600 hover:text-red-900">&times;</button>
                    </div>
                `;
                itemsContainer.insertAdjacentHTML('beforeend', itemRow);
            });

            itemsContainer.addEventListener('click', (e) => {
                if (e.target.classList.contains('removeItem')) {
                    e.target.parentElement.remove();
                }
            });
        });
    </script>
</head>
<body class="bg-gray-100 py-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-bold mb-4">Create Invoice</h2>
        @if(session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('invoices.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="flex space-x-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Invoice Number</label>
                    <input type="text" name="invoice_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('invoice_number') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Invoice Date</label>
                    <input type="date" name="invoice_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('invoice_date') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <h3 class="text-lg font-medium text-gray-900">Items</h3>
                <div id="itemsContainer">
                    <div class="flex space-x-2 mt-2">
                        <input type="text" name="items[][item_name]" placeholder="Item Name" 
                            class="block w-1/3 border-gray-300 rounded-md shadow-sm">
                        <input type="number" name="items[][quantity]" placeholder="Quantity" 
                            class="block w-1/6 border-gray-300 rounded-md shadow-sm">
                        <input 
                            type="text" 
                            name="items[][price]" 
                            placeholder="Price" 
                            class="block w-1/6 border-gray-300 rounded-md shadow-sm format-price"
                            data-input-type="currency"
                        >
                    </div>
                </div>
                <button type="button" id="addItem" 
                    class="mt-2 px-4 py-2 bg-green-500 text-white rounded-md">+ Add Item</button>
            </div>

            <div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save Invoice</button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const formatCurrency = (input, blur) => {
                let inputVal = input.value;
        
                // Hapus format Rp dan koma jika ada
                inputVal = inputVal.replace(/[^,\d]/g, '');
        
                // Pisahkan angka dan desimal
                const split = inputVal.split(',');
                let integerPart = split[0];
                const decimalPart = split[1] !== undefined ? ',' + split[1] : '';
        
                // Tambahkan pemisah ribuan
                const pattern = /\B(?=(\d{3})+(?!\d))/g;
                integerPart = integerPart.replace(pattern, '.');
        
                // Format hasil dengan "Rp"
                const result = integerPart + decimalPart;
                input.value = blur ? 'Rp. ' + result : result;
            };
        
            document.querySelectorAll('input[data-input-type="currency"]').forEach((input) => {
                input.addEventListener('keyup', () => formatCurrency(input, false));
                input.addEventListener('blur', () => formatCurrency(input, true));
            });
        });
        </script>        
</body>
</html>
