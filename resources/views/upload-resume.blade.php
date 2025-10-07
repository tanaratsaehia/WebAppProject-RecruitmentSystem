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
            <div class="card m-md-4" >
                    <div class="card-body">

                        <h1 class="card-title fs-2 fw-bold">
                        รับสมัคร {{$item->job_title}}
                        </h1>
                        <p class="card-text fs-4">{{$item->description}}</p>

                        <h3 class="mt-4 fw-bold fs-4">
                            คุณสมบัติ:
                        </h3>
                        <ul class="list-group list-group-flush">
                            <!-- <li class="list-group-item">● {skill_required}</li> -->
                            <?php $correct_string = str_replace('\n', "\n", $item->skill_required); ?>
                            @foreach (array_filter(explode("\n", $correct_string)) as $skill)
                                <li class="list-group-item ml-6 py-1 text-gray-700">
                                    ● {{ trim($skill) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            <div class="card m-md-4" style="width: 70rem;">
                <h1 class="fs-1 fw-bold pt-3">Add Resume File</h1>
                <form id="resume-form"
                    action="{{ route('home.upload-resume.upload', $id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="p-4 rounded-lg bg-white text-center w-100">
                    @csrf
                    @if(empty($uploaded) or empty($uploaded->resume_path))
                        {{-- กล่องลาก/คลิกเลือกไฟล์ --}}
                        <div id="drop-zone" class="border rounded p-4 mb-3" style="border:2px dashed #ccc; cursor:pointer;">
                            <label for="resume" class="d-block mb-2" style="cursor:pointer;">
                                <img src="{{ asset('images/upload_clone_icon.png') }}" class="rounded mx-auto d-block w-23 h-20" alt="upload_clone_icon">
                                <div class="fs-4 fw-bold">Upload your file here</div>
                                <div style="color:#666; margin-top:4px;">Files supported: PDF • Max 3MB</div>
                                <div class="btn btn-outline-primary mt-3 px-5">BROWSE</div>
                            </label>

                            <input type="file" name="resume" id="resume" accept="application/pdf" style="display:none;">
                            <div class="small text-muted mt-2">หรือ ลากไฟล์มาวางที่กล่องนี้</div>
                        </div>

                        {{-- PREVIEW: แสดงไฟล์ที่เพิ่งเลือก (client-side) --}}
                        <div id="selected-preview" class="mb-3" style="display:none;">
                            <div class="card p-2 d-flex align-items-center" style="max-width:540px; margin:0 auto; background-color: #e5e0ecff;">
                                <div class="mb-2 fw-bold text-primary">
                                    ไฟล์ที่กำลังเลือก สำหรับอัพโหลด
                                </div>
                                <div class="d-flex align-items-center w-100">
                                    <div class="me-3" style="width:48px; height:48px; display:flex; align-items:center; justify-content:center;">
                                        <img src="{{ asset('images/pdf_icon.png') }}" class="w-8 h-10" alt="pdf">
                                    </div>

                                    <div class="flex-grow-1 text-start">
                                        <div id="preview-filename" class="fw-bold"></div>
                                        <div id="preview-filesize" class="small text-muted"></div>
                                    </div>

                                    <div class="ms-3">
                                        <button type="button" id="clear-selected" class="btn btn-sm btn-outline-danger" title="Clear selected file">
                                            <img src="{{ asset('images/red_bin.png') }}" class="w-8 h-10" alt="red_bin">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- แสดง error validation (server-side) --}}
                        @error('resume')
                            <div class="text-danger mb-2">{{ $message }}</div>
                        @enderror

                        {{-- ปุ่ม submit --}}
                        <div style="margin-top:8px; text-align:center;">
                            <button class="btn btn-outline-dark" type="submit" style="padding:8px 6rem;">Submit</button>
                        </div>
                        <div class="mt-3" style="margin:0 auto;">
                            <div class="card p-2">
                                {{-- หัวข้อแจ้งผู้ใช้ --}}
                                <div class="text-4xl font-medium text-danger text-center fs-1 fw-bold mt-2">
                                    --- ยังไม่มีไฟล์ที่อัพโหลดแล้ว ในขณะนี้ ---
                                </div>
                            </div>
                        </div>
                    {{-- ถ้ามีไฟล์ที่เคยอัปโหลดแล้ว (จาก DB) ให้แสดงด้านล่าง --}}
                    @elseif(isset($uploaded) && $uploaded && $uploaded->resume_path)
                        {{-- กล่องลาก/คลิกเลือกไฟล์ --}}
                        <div id="drop-zone" class="border rounded p-4 mb-3" style="border:2px dashed #ccc; cursor:pointer;">
                            <label for="resume" class="d-block mb-2" style="cursor:pointer;">
                                <img src="{{ asset('images/upload_clone_icon.png') }}" class="rounded mx-auto d-block w-23 h-20" alt="upload_clone_icon">
                                <div class="fs-4 fw-bold">Upload your file here</div>
                                <div style="color:#666; margin-top:4px;">Files supported: PDF • Max 3MB</div>
                                <div class="btn btn-outline-primary mt-3 px-5">BROWSE</div>
                            </label>

                            <input type="file" name="resume" id="resume" accept="application/pdf" style="display:none;" disabled>
                            <div class="small text-muted mt-2">หรือ ลากไฟล์มาวางที่กล่องนี้</div>
                        </div>

                        {{-- PREVIEW: แสดงไฟล์ที่เพิ่งเลือก (client-side) --}}
                        <div id="selected-preview" class="mb-3" style="display:none;">
                            <div class="card p-2 d-flex align-items-center" style="max-width:540px; margin:0 auto; background-color: #e5e0ecff;">
                                <div class="mb-2 fw-bold text-primary">
                                    ไฟล์ที่กำลังเลือก สำหรับอัพโหลด
                                </div>
                                <div class="d-flex align-items-center w-100">
                                    <div class="me-3" style="width:48px; height:48px; display:flex; align-items:center; justify-content:center;">
                                        <img src="{{ asset('images/pdf_icon.png') }}" class="w-8 h-10" alt="pdf">
                                    </div>

                                    <div class="flex-grow-1 text-start">
                                        <div id="preview-filename" class="fw-bold"></div>
                                        <div id="preview-filesize" class="small text-muted"></div>
                                    </div>

                                    <div class="ms-3">
                                        <button type="button" id="clear-selected" class="btn btn-sm btn-outline-danger" title="Clear selected file">
                                            <img src="{{ asset('images/red_bin.png') }}" class="w-8 h-10" alt="red_bin">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- แสดง error validation (server-side) --}}
                        @error('resume')
                            <div class="text-danger mb-2">{{ $message }}</div>
                        @enderror

                        {{-- ปุ่ม submit --}}
                        <div style="margin-top:8px; text-align:center;">
                            <button class="btn btn-outline-dark" type="submit" style="padding:8px 6rem;" disabled>Submit</button>
                        </div>
                        <div class="mt-3" style="max-width:540px; margin:0 auto;">
                            <div class="card p-2">
                                {{-- หัวข้อแจ้งผู้ใช้ --}}
                                <div class="mb-2 fw-bold text-danger">
                                    อัปโหลดไฟล์ไปแล้ว
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="me-3" style="width:48px; height:48px; display:flex; align-items:center; justify-content:center;">
                                        <img src="{{ asset('images/pdf_icon.png') }}" class="w-8 h-10" alt="pdf">
                                    </div>

                                    {{-- ข้อมูลไฟล์ --}}
                                    <div class="flex-grow-1 text-start">
                                        <div class="fw-bold">{{ $uploaded->resume_file_name }}</div>
                                        <div class="small text-muted">
                                            {{ number_format($uploaded->resume_size / 1024, 1) }} KB
                                            &nbsp;|&nbsp;
                                            อัปโหลดเมื่อ {{ $uploaded->updated_at->format('d/m/Y H:i') }}
                                        </div>
                                    </div>

                                    {{-- ปุ่ม Download / Delete --}}
                                    <div>
                                        <a href="{{ route('home.upload-resume.download', ['id' => $id]) }}" class="btn btn-sm btn-primary">Download</a>

                                        <form action="{{ route('home.upload-resume.delete', ['id' => $id]) }}"
                                            method="POST"
                                            class="delete-form"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 fw-bold text-danger font-medium">--- หากต้องการอัพโหลดไฟล์ใหม่ ต้องลบไฟล์เก่าก่อน ถึงจะอัพโหลดได้ ---</p>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('resume');
        const previewBox = document.getElementById('selected-preview');
        const previewFileName = document.getElementById('preview-filename');
        const previewFileSize = document.getElementById('preview-filesize');
        const clearBtn = document.getElementById('clear-selected');

        // Format bytes to human readable
        function formatBytes(bytes) {
            if (bytes === 0) return '0 B';
            const k = 1024;
            const sizes = ['B','KB','MB','GB','TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
        }

        function showPreview(file) {
            previewFileName.textContent = file.name;
            previewFileSize.textContent = formatBytes(file.size);
            previewBox.style.display = 'block';
        }

        function clearSelected() {
            // clear input
            // Use two methods to support various browsers
            try {
                fileInput.value = '';
                // If DataTransfer used earlier, clear it
                if (fileInput.files && fileInput.files.length) {
                    const dt = new DataTransfer();
                    fileInput.files = dt.files;
                }
            } catch(e) {
                // fallback
                const form = document.getElementById('resume-form');
                form.reset();
            }
            // hide preview
            previewBox.style.display = 'none';
            previewFileName.textContent = '';
            previewFileSize.textContent = '';
        }

        // When user selects via browse
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) {
                clearSelected();
                return;
            }

            // client-side validation
            if (file.type !== 'application/pdf' && !file.name.toLowerCase().endsWith('.pdf')) {
                alert('รองรับเฉพาะไฟล์ PDF เท่านั้น');
                clearSelected();
                return;
            }
            if (file.size > 3 * 1024 * 1024) {
                alert('ขนาดไฟล์ต้องไม่เกิน 3MB');
                clearSelected();
                return;
            }

            showPreview(file);
        });

        // Dragover / dragleave
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('bg-light');
            dropZone.style.borderColor = '#3b82f6';
        });
        dropZone.addEventListener('dragleave', (e) => {
            dropZone.classList.remove('bg-light');
            dropZone.style.borderColor = '#ccc';
        });

        // Drop handling
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('bg-light');
            dropZone.style.borderColor = '#ccc';

            const file = e.dataTransfer.files[0];
            if (!file) return;

            // Basic validation
            if (file.type !== 'application/pdf' && !file.name.toLowerCase().endsWith('.pdf')) {
                alert('รองรับเฉพาะไฟล์ PDF เท่านั้น');
                return;
            }
            if (file.size > 3 * 1024 * 1024) {
                alert('ขนาดไฟล์ต้องไม่เกิน 3MB');
                return;
            }

            // Set file to the file input so form submit จะส่งไฟล์จริง
            if (typeof DataTransfer !== 'undefined') {
                const dt = new DataTransfer();
                dt.items.add(file);
                fileInput.files = dt.files;
            } else {
                // If DataTransfer not supported, try fallback (may not work in old browsers)
                fileInput.files = e.dataTransfer.files;
            }

            showPreview(file);
        });

        // clear button
        clearBtn.addEventListener('click', clearSelected);

        // If you want to hide preview initially when there's an error, ensure preview hidden
        if (!fileInput.files || !fileInput.files.length) {
            previewBox.style.display = 'none';
        }
    });
    </script>
    @if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'สำเร็จ',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

    @if(session('error'))
    <script>
    Swal.fire('ผิดพลาด', '{{ session('error') }}', 'error');
    </script>
    @endif

</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>