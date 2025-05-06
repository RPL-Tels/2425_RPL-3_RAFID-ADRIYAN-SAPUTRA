@extends('layouts.layers')
@section('title', 'Create Invoice')
@section('section')
<div class="container pb-8">
    <div x-data="invoiceForm()" class="md:px-12 px-5 w-full md:flex">
        <div class="md:w-1/2">
            <div class="md:w-[99%] bg-white md:px-5 md:py-4 rounded-md shadow dark:bg-[#22272B]">
                <p class="md:text-xl text-lg font-medium text-gray-700 px-4 pt-4 md:px-0 md:pt-0 dark:text-white">Create invoice</p>
                <div class="w-full border-t-[1.5px] md:border-[1.5px] px-4 py-4 md:rounded mt-4 dark:border-[#454F59]">
                    <form action="{{route('admin.invoice.store')}}" method="POST">
                        @csrf
                        <div class="flex">
                            <div class="md:w-1/2">
                                <p class="text-slate-700 font-medium dark:text-gray-200">Project Id</p>
                                <select name="project_id" id="project_id" class="border-[1.5px] mt-2 py-1 px-2 rounded-md text-slate-700 border-slate-300 w-[95%] outline-none focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300">
                                    <option value="" selected disabled>Select Project</option>
                                    @foreach ($project as $project)
                                        <option value="{{$project->project_id}}">{{$project->project_id}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-1/2">
                                <p class="text-slate-700 font-medium dark:text-gray-300">Client Id</p>
                                <input type="text" name="user_id" id="user_id" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" readonly>
                            </div>
                        </div>
                        <div class="flex mt-3">
                            <div class="w-1/2">
                                <p class="text-slate-700 font-medium dark:text-gray-200">Due Date</p>
                                <input type="date" name="due_date" x-model="date" placeholder="2" @input="formatDate" class="border-[1.5px] py-1 rounded-md mt-2 px-2 w-[95%] border-slate-300 text-slate-700 focus:ring-1 focus:border-blue-100 transition-all duration-150 outline-none dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300">
                            </div>
                            <div class="w-1/2">
                                <p class="text-slate-700 font-medium dark:text-gray-200">Invoice Date</p>
                                <input type="text" value="{{date('F d, Y')}}" class="border-[1.5px] border-slate-300 w-full py-[5px] px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" readonly>
                            </div>
                        </div>
                        <div id="messageContainer" class="hidden"></div>
                        <input type="submit" id="submitButton" class="w-full bg-blue-500 text-white font-medium mt-6 py-2 rounded hover:bg-blue-600 cursor-pointer">
                        <a href="{{route('admin.invoice')}}" type="button" class="w-full text-center text-gray-600 border-[1.5px] mt-4 rounded-md py-2 font-medium ring-red-400 border-gray-400 hover:border-red-200 hover:ring-2 hover:text-red-400 dark:border-gray-300 dark:text-white dark:hover:text-red-400 dark:hover:border-red-400">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="md:w-1/2 hidden md:block">
            <div class="w-[99%] rounded-lg float-right shadow">
                <div class="px-6 py-8 bg-white rounded-md shadow">
                    <div class="flex items-center">
                        <img src="{{asset('img/logo.png')}}" alt="" class="w-12 h-12">
                        <p class="text-slate-700 font-bold ml-[-8px]">CMP</p>
                    </div>
                    <div class="px-3 pb-2 mt-2">
                        <div class="flex">
                            <div class="w-1/2 mr-2 text-sm border-[1.5px] rounded px-2 py-2">
                                <p class="text-xs text-gray-400 font-medium">FROM</p>
                                <p class="text-slate-700 font-medium text-base">{{Auth::user()->name}}</p>
                                <p class="font-medium text-gray-400 text-xs mt-1">{{Auth::user()->company}}</p>
                                <p class="font-medium text-xs text-gray-400">{{Auth::user()->addres}}</p>
                                <p class="font-medium text-gray-400 mt-2 text-xs">{{Auth::user()->email}}</p>
                                <p class="font-medium text-gray-400 text-xs">{{Auth::user()->number}}</p>
                            </div>
                            <div class="w-1/2 text-sm border-[1.5px] rounded px-2 py-2">
                                <p class="text-xs text-gray-400 font-medium">TO</p>
                                <input type="text" id="name" class="w-full outline-none text-slate-700 font-medium text-base" readonly placeholder="Name Client">
                                <input type="text" id="company" class="w-full outline-none font-medium text-gray-400 text-xs" readonly placeholder="Company">
                                <input type="text" id="addres" class="w-full outline-none font-medium text-xs text-gray-400 relative bottom-1" readonly placeholder="Address">
                                <input type="text" id="email" class="w-full outline-none font-medium text-xs text-gray-400 mt-2" readonly placeholder="Client@example.com">
                                <input type="text" id="number" class="w-full outline-none font-medium text-xs text-gray-400 relative bottom-1 bg-transparent" readonly placeholder="089XXXXXX">
                            </div>
                        </div>
                        <div class="px-3 mt-4 flex">
                            <div class="w-1/2">
                                <p class="text-xs font-medium text-gray-700">Invoice No : <span class="text-gray-400">INV-{{strtoupper(Str::random(5))}} (example)</span></p>
                                <div class="flex items-center">
                                    <p class="text-xs font-medium text-gray-700 mt-1">Project Id :</p>
                                    <input type="text" id="project" class="outline-none font-medium text-gray-400 text-xs mt-1 ml-1" readonly placeholder="P-S72J (Example)">
                                </div>
                            </div>
                            <div class="w-1/2 px-2">
                                <p class="text-xs font-medium text-gray-700">Invoice Date : <span class="text-gray-400">{{date('F d, Y')}}</span></p>
                                <p class="text-xs font-medium text-gray-700 mt-1">Due Date : <span x-text="formattedDate" class="text-gray-400"></span></p>
                            </div>
                        </div>
                        <div class="px-1 mt-4">
                            <p class="text-gray-800 font-medium">Invoice Details</p>
                            <table class="w-full table-auto text-xs text-left mt-4">
                                <thead class="border-y-[1.5px] text-gray-400">
                                    <tr>
                                        <th class="py-3 font-normal">Items</th>
                                        <th class="py-3 font-normal">Qty</th>
                                        <th class="py-3 font-normal">Unit Price</th>
                                        <th class="py-3 font-normal">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600" id="itemsContainer">
                                    <tr class="border-b-[1.5px]">
                                        <td class="py-3 font-medium" x-text="items"></td>
                                        <td class="py-3 font-medium" x-text="qty"></td>
                                        <td class="py-3 font-medium" x-text="price"></td>
                                        <td class="py-3 font-medium w-[10%]"><input type="text" id="amount2" class="w-20 m-0 outline-none" placeholder="Rp.0" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="px-1 mt-10">
                            <div class="flex">
                                <div class="w-2/3 text-gray-400">
                                    <p class="text-xs">Thanks for your business!</p>
                                    <p class="text-xs mt-4">If you have any question about this invoice.</p>
                                    <p class="text-xs">Please email us at {{Auth::user()->email}}</p>
                                    <p class="text-xs mt-4">Invoice cretaed by: {{Auth::user()->name}}</p>
                                </div>
                                <div class="w-1/3">
                                    <p class="text-xs text-gray-400">Invoice Summary</p>
                                    <div class="border-t-[1.5px] mt-2 flex pt-2">
                                        <div class="w-1/2">
                                            <p class="text-xs mt-2 text-gray-700 font-medium">Invoice total</p>
                                        </div>
                                        <div class="w-1/2 text-right">
                                            <div id="subtotalContainer" class="text-xs mt-2 text-gray-700 font-medium">Rp. 0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($errors->all() as $error)
        <li class="font-medium my-auto text-slate-700">{{ $error }}</li>
    @endforeach
</div>
<script>
    function invoiceForm() {
        return {
            project: 'P-UAKH (example)',
            price: '',
            qty: '',
            items: '',
            date: '',
            formattedDate: 'Month Day, Year',

            formatDate() {
                if (this.date) {
                    const options = { day: '2-digit', month: 'long', year: 'numeric' };
                    const parsedDate = new Date(this.date);
                    this.formattedDate = new Intl.DateTimeFormat('en-US', options).format(parsedDate);
                } else {
                    this.formattedDate = '';
                }
            }
        };
    }

    document.addEventListener("DOMContentLoaded", function () {
        const clientIdInput = document.getElementById("user_id");
        const clientEmailInput = document.getElementById("email");
        const clientNameInput = document.getElementById("name");
        const companyInput = document.getElementById("company");
        const addressInput = document.getElementById("addres");
        const numberInput = document.getElementById("number");
        const projectSelect = document.getElementById("project_id");
        const project = document.getElementById('project');
        const submitButton = document.getElementById("submitButton");
        const messageContainer = document.getElementById("messageContainer");
        const itemsContainer = document.getElementById("itemsContainer"); // Added here
        const subtotalContainer = document.getElementById("subtotalContainer"); // Added here

        projectSelect.addEventListener("change", function () {
            const projectId = this.value;

            fetch(`/get/project/invoice/${projectId}`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Project not found");
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.clientId) {
                        clientIdInput.value = data.clientId;
                        project.value = data.projectId;
                        // Trigger client fetch automatically
                        fetchClientData(data.clientId);

                        if (data.items && data.items.length > 0) {
                            submitButton.disabled = false; // Enable submit button
                            messageContainer.textContent = ""; // Clear message 
                            submitButton.className = "cursor-pointer w-full bg-blue-500 text-white font-medium mt-6 py-2 rounded hover:bg-blue-600 ";
                            messageContainer.className = "hidden";
                            displayItems(data.items);
                        } else {
                            submitButton.disabled = true; // Disable submit button
                            messageContainer.textContent = "The project does not have any items. Please add at least one item first!";
                            messageContainer.className = "bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4";
                            submitButton.className = "cursor-not-allowed w-full bg-blue-500 text-white font-medium mt-6 py-2 rounded hover:bg-blue-600 ";
                            clearItemsDisplay(); // Clear items display
                        }
                    }
                })
                .catch((error) => {
                    console.error(error);
                    clientIdInput.value = ""; // Clear client input
                    submitButton.disabled = true; // Disable submit button in case of error
                    messageContainer.textContent = "Error: " + error.message;
                    messageContainer.className = "bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4"; // Display error message
                    clearItemsDisplay(); // Clear items display
                });
        });

        function displayItems(items) {
            let subtotal = 0; // Initialize subtotal

            // Ensure itemsContainer and subtotalContainer exist before using them
            if (itemsContainer) {
                itemsContainer.innerHTML = ""; // Ensure correct casing: innerHTML

                items.forEach(item => {
                    const row = document.createElement("tr");
                    const amount = item.quantity * item.price;
                    const formattedPrice = formatter.format(item.price);
                    const formattedAmount = formatter.format(amount);

                    row.innerHTML = `
                        <td class="py-3 font-medium border-b-[1.5px]">${item.items_name}</td>
                        <td class="py-3 font-medium border-b-[1.5px]">${item.quantity}</td>
                        <td class="py-3 font-medium border-b-[1.5px]">${formattedPrice}</td>
                        <td class="py-3 font-medium border-b-[1.5px]">${formattedAmount}</td>
                    `;
                    itemsContainer.appendChild(row);

                    // Add the amount to the subtotal
                    subtotal += amount;
                });
            }

            if (subtotalContainer) {
                subtotalContainer.textContent = `${formatter.format(subtotal)}`;
            }
        }

        function clearItemsDisplay() {
            // Ensure itemsContainer and subtotalContainer exist before using them
            if (itemsContainer) {
                itemsContainer.innerHTML = ""; // Clear items display
            }

            if (subtotalContainer) {
                subtotalContainer.textContent = ""; // Clear subtotal display
            }
        }


        // Handle manual client ID input
        clientIdInput.addEventListener("input", function () {
            const clientId = this.value.trim();

            // Only fetch if input is not empty
            if (clientId) {
                fetchClientData(clientId);
            } else {
                clearClientDetails();
            }
        });

        // Fetch client data function
        function fetchClientData(clientId) {
            fetch(`/get/client/invoice/${clientId}`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Client not found");
                    }
                    return response.json();
                })
                .then((data) => {
                    clientEmailInput.value = data.email || "";
                    clientNameInput.value = data.name || "";
                    companyInput.value = data.company || "";
                    addressInput.value = data.addres || "";
                    numberInput.value = data.number || "";
                })
                .catch((error) => {
                    console.error(error);
                    clearClientDetails();
                });
        }

        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        });
        
        // Clear client details function
        function clearClientDetails() {
            clientEmailInput.value = "";
            clientNameInput.value = "";
            companyInput.value = "";
            addressInput.value = "";
            numberInput.value = "";
        }
    });
</script>
@endsection