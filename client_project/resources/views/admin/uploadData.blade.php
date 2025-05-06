<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload data project</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 dark:bg-[#101214]">
    <div class="container">
        <div class="px-1 bg-slate-300 mx-auto w-fit py-1 h-fit mt-10 rounded-lg shadow-lg mb-10 dark:bg-[#161A1D]">
            <div class="bg-white w-[500px] border-[1.5px] border-slate-300 rounded-2xl dark:bg-[#22272B] dark:border-[#161A1D]">
                <div class="px-6 py-4 border-b-[1.5px] border-slate-300 flex justify-between items-center dark:border-[#38414A]">
                    <div>
                        <p class="text-xl font-semibold text-slate-800 dark:text-white">Upload Data Form</p>
                        <p class="text-sm text-slate-500 font-medium dark:text-gray-400">Submit data 3d file</p>
                    </div>
                    <div class="">
                        <a href="{{ url()->previous() }}" class="hover:text-slate-800 text-slate-600">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M18 6l-12 12" />
                                <path d="M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>
                <form action="{{route('UploadDataStore')}}" method="POST" class="px-6 py-4" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <p class="text-slate-700 font-medium dark:text-gray-200">File Name</p>
                        <input type="text" name="costume_name" placeholder=" Costume file name..." class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" required autocomplete="OFF">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-slate-700 font-medium dark:text-gray-200">Project Id</p>
                            <input type="text" value="{{$data->project_id}}" name="project_id" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" readonly>
                        </div>
                        <div>
                            <p class="text-slate-700 font-medium dark:text-gray-200">Project Name</p>
                            <input type="text" value="{{$data->project_name}}" name="project_name" id="project_name" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" readonly>
                        </div>
                    </div>
                    <div class="mt-3 grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-slate-700 font-medium dark:text-gray-200">Client_id</p>
                            <input type="text" value="{{$data->client_id}}" name="user_id" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" readonly>
                        </div>
                        <div>
                            <p class="text-slate-700 font-medium dark:text-gray-200">Client Name</p>
                            <input type="text" value="{{$name->client_name}}" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" readonly>
                        </div>
                    </div>
                    <div class="flex mt-3">
                        <div class="md:w-1/2">
                            <p class="text-slate-700 font-medium dark:text-gray-200">Items Id</p>
                            <select name="items_id" id="items_id" class="border-[1.5px] mt-2 py-1 px-2 rounded-md text-slate-700 border-slate-300 w-[95%] outline-none focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300">
                                <option value="" selected disabled>Select Project</option>
                                @foreach ($items as $item)
                                    <option value="{{$item->items_id}}">{{$item->items_id}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/2">
                            <p class="text-slate-700 font-medium dark:text-gray-300">Items Name</p>
                            <input type="text" name="items_name" id="items_name" class="border-[1.5px] border-slate-300 w-full py-1 px-2 mt-2 rounded-md outline-none text-slate-700 truncate focus:ring-1 focus:border-blue-100 transition-all duration-150 dark:bg-[#22272B] dark:border-[#38414A] dark:text-gray-300 dark:focus:border-blue-300" readonly>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="mb-3 font-medium text-slate-700 dark:text-gray-200">Upload Files</p>
                        <div id="drop-zone" class="flex flex-col items-center justify-center p-4 border-2 dark:border-[#38414A] dark:hover:border-blue-500 border-dashed hover:border-blue-500 rounded-lg cursor-pointer text-gray-600 hover:bg-gray-50 dark:hover:bg-[#1D2125]">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="64"  height="64"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="text-slate-500 dark:text-gray-200 icon icon-tabler icons-tabler-outline icon-tabler-world-upload">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 12a9 9 0 1 0 -9 9" /><path d="M3.6 9h16.8" /><path d="M3.6 15h8.4" /><path d="M11.578 3a17 17 0 0 0 0 18" /><path d="M12.5 3c1.719 2.755 2.5 5.876 2.5 9" /><path d="M18 21v-7m3 3l-3 -3l-3 3" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-100">Tarik file ke sini atau klik untuk unggah</p>
                            <input id="file-input" name="file" type="file" class="hidden" multiple>
                        </div>
                        <div id="file-preview" class="mt-4 space-y-2"></div>
                    </div>
                    {{-- <input type="file" name="file_name"> --}}
                    <div class="mt-3">
                        <p class="text-sm text-slate-500 dark:text-gray-400">Format file : gltf, glb, fbx, obj, zip | Max : 52mb</p>
                    </div>
                    <input type="submit" class="w-full mt-10 mb-2 bg-blue-500  rounded-md py-2 text-white font-medium">
                </form>
                @foreach ($errors->all() as $error)
                    <li class="font-medium my-auto text-slate-700">{{ $error }}</li>
                @endforeach
            </div>
        </div>
    </div>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const itemsIdSelect = document.getElementById('items_id');
            const itemsNameInput = document.getElementById('items_name');
            itemsIdSelect.addEventListener('change', function() {
                const items_id = this.value
                fetch(`/get-items/${items_id}`)
                    .then(response => response.json())
                    .then(data => {
                        itemsNameInput.value = data.name;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            })
        })
    </script>
</body>
</html>