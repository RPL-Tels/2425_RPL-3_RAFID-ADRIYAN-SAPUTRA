<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add new project</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body class="bg-slate-100 dark:bg-[#101214]">
    <div class="container">
        <div class="px-1 bg-slate-300 mx-auto w-fit py-1 h-fit mt-4 rounded-lg shadow-lg mb-10 dark:bg-[#161A1D]">
            <div class="bg-white w-[500px] border-[1.5px] border-slate-300 rounded-2xl dark:bg-[#22272B] dark:border-[#161A1D]">
                <div class="px-6 py-4 border-b-[1.5px] border-slate-300 flex justify-between items-center dark:border-[#38414A]">
                    <div>
                        <p class="text-xl font-semibold text-slate-800 dark:text-white">Add Project Form</p>
                        <p class="text-sm text-slate-500 font-medium dark:text-gray-400">Submit new project</p>
                    </div>
                    <div class="">
                        <a href="{{ url()->previous() }}" class="hover:text-slate-800 text-slate-600">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="dark:text-white icon icon-tabler icons-tabler-outline icon-tabler-x">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M18 6l-12 12" />
                                <path d="M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <form action="{{route('projeckForm.store')}}" method="POST" enctype="multipart/form-data" id="uploadForm">
                        @csrf
                        <div>
                            <p class="text-slate-700 font-medium dark:text-gray-200">Project Name</p>
                            <input type="text" name="project_name" placeholder="Project name..." class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" required autocomplete="OFF">
                        </div>
                        <div class="flex">
                            <div class="mt-3 w-1/2">
                                <p class="text-slate-700 font-medium dark:text-gray-200">Client id</p>
                                <div class="relative">
                                    <input type="text" id="search" name="client_id" class="border-[1.5px] mt-2 py-1 px-2 rounded-md text-slate-700 border-slate-300 w-full outline-none focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" required placeholder="Insert Id..." autocomplete="off">
                                    <div id="results" class="absolute bg-white border border-gray-300 w-full mt-1 rounded shadow-lg hidden"></div>
                                </div>
                            </div>
                            <div class="mt-3 w-1/2 ml-3">
                                <p class="text-slate-700 font-medium dark:text-gray-200">Client Name</p>
                                <input type="text" placeholder="Client name..." id="client_name" name="client_name" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" readonly>  
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="text-slate-700 font-medium mb-3 dark:text-gray-200">Description</p>
                            <textarea id="description" placeholder="Insert description here..." required cols="30" rows="10" name="description" class="border-[1.5px] w-full px-2 py-2 border-slate-300 rounded-md outline-none text-slate-700 h-32 focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300"></textarea>
                        </div>
                        <div class="mt-3 grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-slate-700 font-medium dark:text-gray-200">Project started</p>
                                <input type="date" name="start" id="start" class="border-[1.5px] py-1 rounded-md mt-2 px-2 w-full border-slate-300 text-slate-700 focus:ring-1 focus:border-blue-100 transition-all duration-150 outline-none dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" required>
                            </div>
                            <div>
                                <p class="text-slate-700 font-medium dark:text-gray-200">Project ended</p>
                                <input type="date" name="due_contract" id="due_contract" class="border-[1.5px] py-1 rounded-md mt-2 px-2 w-full border-slate-300 text-slate-700 focus:ring-1 focus:border-blue-100 transition-all duration-150 outline-none dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" required>
                            </div>
                        </div>
                        <p class="mt-4 mb-3 text-slate-700 font-medium dark:text-gray-200">Thumbnail</p>
                        <div id="drop-zone" class="flex flex-col items-center justify-center p-4 border-2 dark:border-[#38414A] dark:hover:border-blue-500 border-dashed hover:border-blue-500 rounded-lg cursor-pointer text-gray-600 hover:bg-gray-50 dark:hover:bg-[#1D2125]">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="64"  height="64"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-slate-500 dark:text-gray-200 icon icon-tabler icons-tabler-outline icon-tabler-world-upload">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 12a9 9 0 1 0 -9 9" /><path d="M3.6 9h16.8" /><path d="M3.6 15h8.4" /><path d="M11.578 3a17 17 0 0 0 0 18" /><path d="M12.5 3c1.719 2.755 2.5 5.876 2.5 9" /><path d="M18 21v-7m3 3l-3 -3l-3 3" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-100">Tarik file ke sini atau klik untuk unggah</p>
                            <input id="file-input" name="tumbnail" type="file" class="hidden" multiple>
                        </div>
                        <div id="file-preview" class="mt-4 space-y-2"></div>
                        <input type="submit" class="w-full bg-blue-500 mt-10 mb-2 py-2 text-white font-medium rounded-md hover:bg-blue-700 transition-colors duration-150"> 
                    </form>          
                </div>
            </div>
        </div>
    </div>
    @foreach ($errors->all() as $error)
        <li class="font-medium my-auto text-slate-700">{{ $error }}</li>
    @endforeach
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const clientIdSelect = document.getElementById("search");
        const clientNameInput = document.getElementById("client_name");

        clientIdSelect.addEventListener("input", function () {
            const user_id = this.value; // Ambil nilai dari user_id

            // Lakukan request AJAX ke server
            fetch(`/users/${user_id}`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Client not found");
                    }
                    return response.json();
                })
                .then((data) => {
                    clientNameInput.value = data.name; // Isi nama klien
                })
                .catch((error) => {
                    console.error(error);
                    clientNameInput.value = ""; // Kosongkan input jika terjadi error
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const resultsDiv = document.getElementById('results');
    
            searchInput.addEventListener('input', function () {
                const query = this.value;
    
                if (query.length > 1) {
                    fetch(`{{ route('projeckForm.view') }}?query=${query}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        resultsDiv.innerHTML = '';
    
                        if (data.length > 0) {
                            data.forEach(item => {
                                const div = document.createElement('div');
                                div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                                div.textContent = item.user_id;
    
                                div.addEventListener('click', function () {
                                    searchInput.value = item.user_id;
                                    resultsDiv.classList.add('hidden');
                                });
    
                                resultsDiv.appendChild(div);
                            });
    
                            resultsDiv.classList.remove('hidden');
                        } else {
                            resultsDiv.classList.add('hidden');
                        }
                    });
                } else {
                    resultsDiv.classList.add('hidden');
                }
            });
    
            searchInput.addEventListener('blur', function () {
                setTimeout(() => resultsDiv.classList.add('hidden'), 200);
            });
        });
    </script>
    <script>
        // Elemen drop-zone
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file-input');
        const previewContainer = document.getElementById('file-preview');
    
        // Fungsi untuk memformat ukuran file
        function formatFileSize(size) {
            if (size >= 1024 * 1024) {
                return (size / (1024 * 1024)).toFixed(2) + " MB";
            } else {
                return (size / 1024).toFixed(2) + " KB";
            }
        }
    
        // Fungsi untuk memilih ikon berdasarkan jenis file
        function getFileIcon(fileType) {
            if (fileType.includes('pdf')) {
                return `<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V8.414A2 2 0 0015.586 7L11 3.414A2 2 0 009.414 2H4zM8 9h4v2H8V9z" />
                </svg>`;
            } else if (fileType.includes('word')) {
                return `<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V8.414A2 2 0 0015.586 7L11 3.414A2 2 0 009.414 2H4zM6 8h4v1H6V8z" />
                </svg>`;
            } else if (fileType.includes('excel')) {
                return `<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V8.414A2 2 0 0015.586 7L11 3.414A2 2 0 009.414 2H4zM6 10h4v1H6v-1z" />
                </svg>`;
            } else {
                return `<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V8.414A2 2 0 0015.586 7L11 3.414A2 2 0 009.414 2H4z" />
                </svg>`;
            }
        }
    
        // Fungsi untuk menampilkan preview file
        function handleFiles(files) {
            previewContainer.innerHTML = ""; // Kosongkan preview sebelumnya
            Array.from(files).forEach(file => {
                const fileReader = new FileReader();
    
                fileReader.onload = function(e) {
                    const fileItem = document.createElement('div');
                    fileItem.classList.add('flex', 'items-center', 'space-x-4', 'p-2', 'border', 'rounded', 'shadow-sm', 'dark:border-[#596773]');
    
                    const fileType = file.type.startsWith('image/')
                        ? `<img src="${e.target.result}" alt="${file.name}" class="h-12 w-12 object-cover rounded-lg">`
                        : getFileIcon(file.type);
    
                    fileItem.innerHTML = `
                        ${fileType}
                        <div>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">${file.name}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">${formatFileSize(file.size)}</p>
                        </div>
                    `;
                    previewContainer.appendChild(fileItem);
                };
    
                fileReader.readAsDataURL(file);
            });
        }
    
        // Klik untuk membuka dialog file
        dropZone.addEventListener('click', () => fileInput.click());
    
        // Tangkap file dari input biasa
        fileInput.addEventListener('change', () => handleFiles(fileInput.files));
    
        // Drag & drop file
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('bg-gray-100');
        });
    
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('bg-gray-100');
        });
    
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('bg-gray-100');
            handleFiles(e.dataTransfer.files);
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