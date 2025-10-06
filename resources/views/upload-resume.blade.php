<?php
    $_SESSION['currentPage'] = "Upload Resume";
?>

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Resume') }}
        </h1>
    </x-slot>

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item fs-5"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item fs-5 active" aria-current="page">Upload Resume</li>
        </ol>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card m-md-4" style="width: 70rem;">
                <form id="upload-form" 
                    action="#" 
                    method="POST" 
                    enctype="multipart/form-data"
                    class="p-10 rounded-lg bg-white text-center w-96 relative">
                    @csrf
                    <div class="card-body">

                        <h1 class="card-title fs-2 fw-bold">
                        Add Resume File
                        
                        <div class="card">
                            <div id="drop-zone" 
                                class="flex flex-col justify-center items-center border-2 border-dashed border-gray-400 rounded-lg p-6 cursor-pointer transition hover:border-blue-400">
                                
                                <!-- Icon -->
                                <svg class="w-16 h-16 text-blue-500 mb-3" fill="none" stroke="currentColor" stroke-width="2" 
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0l-4 4m4-4l4 4"/>
                                </svg>

                                <p class="text-lg font-semibold mb-2">Upload your file here</p>
                                <p class="text-sm text-gray-500 mb-3">Files supported: PDF</p>

                                <label for="file-upload"
                                    class="btn btn-outline-primary cursor-pointer px-4 py-2 bg-blue-500 rounded hover:bg-blue-600">
                                    Browse
                                </label>
                                <input id="file-upload" name="file" type="file" accept="application/pdf" class="hidden">

                                <p class="mt-3 text-sm text-gray-500">Maximum size: 3MB</p>
                            </div>
                        </div>

                        <!-- ปุ่ม Submit -->
                        <div class="mt-6">
                            <button type="submit"
                                    class="btn btn-outline-primary w-full px-4 py-2 bg-green-500 rounded hover:bg-green-600">
                                Upload
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card m-md-4" style="width: 90rem;">
                <p>test</p>
            </div>
        </div>
    </div>
    <script>
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file-upload');

        // Highlight ตอน drag เข้า
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-blue-500', 'bg-blue-50');
        });

        // ลบ highlight ตอนออก
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        });

        // เวลา drop ไฟล์
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
            
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
            }
        });
    </script>
</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>