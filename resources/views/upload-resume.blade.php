<?php
    $_SESSION['currentPage'] = "Upload Resume";
?>

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Resume') }}
        </h1>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card m-md-4" style="width: 70rem;">
                <div class="card-body">
                    <h1 class="card-title fs-2 fw-bold">
                        {{$item->job_title}}
                    </h1>
                    <p class="card-text fs-4">{{$item->description}}</p>

                    <h3 class="mt-4 fw-bold fs-5">
                        Preferred Skills & Qualifications:
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
                <h1 class="fs-1 fw-bold pt-3">Apply</h1>
                @if(empty($uploaded) or empty($uploaded->resume_path))
                    <form id="resume-form"
                        action="{{ route('home.upload-resume.upload', $id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="p-4 rounded-lg bg-white text-center w-100">
                        @csrf
                        <div>
                            <div class="p-3 flex flex-row align-items-center">
                                <div class="col mx-3">
                                    <label for="Solf-Skill-Input" class="form-label d-flex justify-content-start ms-3 fs-5">Email</label>
                                    <input class="d-flex justify-content-start w-100" type="email" name="Email" id="Email" value="{{ auth()->user()->email }}" autocomplete="email" required>
                                </div>
                                <div class="col mx-3">
                                    <label for="Applying-Purpose-Input" class="form-label d-flex justify-content-start ms-3 fs-5">Tel</label>
                                    <input class="d-flex justify-content-start w-100" type="tel" name="Tel" id="Tel" value="{{ auth()->user()->phone_number }}" autocomplete="tel" pattern="[0-9]{10}" required>
                                </div>
                            </div>
                            <div class="p-3 flex flex-row align-items-center">
                                <div class="col mx-3">
                                    <label for="Solf-Skill-Input" class="form-label d-flex justify-content-start ms-3 fs-5">Solf Skills</label>
                                    <textarea name="soft_skill" id="Solf-Skill-Input" class="form-control" placeholder="Solf Skills required here..." required>{{ $lateInfo->soft_skill }}</textarea>
                                </div>
                                <div class="col mx-3">
                                    <label for="Applying-Purpose-Input" class="form-label d-flex justify-content-start ms-3 fs-5">Apply Purpose</label>
                                    <textarea name="applying_purpose" id="Applying-Purpose" class="form-control" placeholder="Applying Purpose required here..." required>{{ $lateInfo->applying_purpose }}</textarea>
                                </div>
                            </div>
                        </div>
                        {{-- กล่องลาก/คลิกเลือกไฟล์ --}}
                        <div id="drop-zone" class="border rounded p-4 mb-3" style="border:2px dashed #ccc; cursor:pointer;">
                            <label for="resume" class="d-block mb-2" style="cursor:pointer;">
                                <img src="{{ asset('images/upload_clone_icon.png') }}" class="rounded mx-auto d-block w-23 h-20" alt="upload_clone_icon">
                                <div class="fs-4 fw-bold">Upload your file here</div>
                                <div style="color:#666; margin-top:4px;">Files supported: PDF • Max 3MB</div>
                                <div class="btn btn-outline-primary mt-3 px-5">BROWSE</div>
                            </label>

                            <input type="file" name="resume" id="resume" accept="application/pdf" style="display:none;">
                            <div class="small text-muted mt-2">Or drag and drop your file here</div>
                        </div>

                        {{-- PREVIEW: แสดงไฟล์ที่เพิ่งเลือก (client-side) --}}
                        <div id="selected-preview" class="mb-3" style="display:none;">
                            <div class="card p-2 d-flex align-items-center" style="max-width:540px; margin:0 auto; background-color: #e5e0ecff;">
                                <div class="mb-2 fw-bold text-primary">
                                    Selected file for upload
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
                    </form>
                {{-- ถ้ามีไฟล์ที่เคยอัปโหลดแล้ว (จาก DB) ให้แสดงด้านล่าง --}}
                @elseif(isset($uploaded) && $uploaded && $uploaded->resume_path)
                    <div class="mt-3" style="margin:2rem auto;">
                        <div class="card p-2" style="width: 65rem;">
                            {{-- หัวข้อแจ้งผู้ใช้ --}}
                            <div class="mb-2 fw-bold text-primary text-center fs-4">
                                File uploaded successfully
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3" style="width:48px; height:48px; display:flex; align-items:center; justify-content:center;">
                                    <img src="{{ asset('images/pdf_icon.png') }}" class="w-8 h-10" alt="pdf">
                                </div>

                                {{-- ข้อมูลไฟล์ --}}
                                <div class="flex-grow-1 text-start me-3">
                                    {{--<div class="fw-bold">{{ $uploaded->resume_file_name }}</div>--}}
                                    <a href="{{ route('home.upload-resume.view', ['id' => $uploaded->job_opening_id]) }}" class="fw-bold">{{ $uploaded->resume_file_name }}</a>
                                    <div class="small text-muted">
                                        {{ number_format($uploaded->resume_size / 1024, 1) }} KB
                                        &nbsp;|&nbsp;
                                        Uploaded on {{ $uploaded->updated_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>

                                {{-- ปุ่ม Download และ view --}}
                                <div>
                                    <a href="{{ route('home.upload-resume.download', ['id' => $id]) }}" class="btn btn-sm btn-primary fs-5">Download</a>
                                    <a href="{{ route('home.upload-resume.view', ['id' => $id]) }}" target="_blank" class="btn btn-sm btn-outline-primary fs-5">View</a>
                                    <form action="{{ route('home.upload-resume.delete', ['id' => $id]) }}"
                                            method="POST"
                                            class="delete-form"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger fs-5">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        @if (session('updated_resume'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 2000,
                html: '<strong class="text-secondary">Update Information</strong> resume <strong>{{session('deleted_resume')}}</strong> Completed',
                showConfirmButton: "Confirm"
            });
        @endif
        @if (session('deleted_resume'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                html: '<strong class="text-danger">Delete</strong> resume <strong>{{session('deleted_resume')}}</strong> Completed',
                confirmButtonText: "Confirm",
            });
        @endif

        @if(session('error'))
            Swal.fire('error', '{{ session('error') }}', 'error');
        @endif

        document.addEventListener('DOMContentLoaded', function() {
            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('resume');
            const previewBox = document.getElementById('selected-preview');
            const previewFileName = document.getElementById('preview-filename');
            const previewFileSize = document.getElementById('preview-filesize');
            const clearBtn = document.getElementById('clear-selected');

            // format bytes
            function formatBytes(bytes){
                if(bytes===0) return '0 B';
                const k = 1024;
                const sizes = ['B','KB','MB','GB'];
                const i = Math.floor(Math.log(bytes)/Math.log(k));
                return parseFloat((bytes/Math.pow(k,i)).toFixed(1))+' '+sizes[i];
            }

            function showPreview(file){
                previewFileName.textContent = file.name;
                previewFileSize.textContent = formatBytes(file.size);
                previewBox.style.display = 'block';
            }

            function clearSelected(){
                fileInput.value = '';
                previewBox.style.display = 'none';
                previewFileName.textContent = '';
                previewFileSize.textContent = '';
            }

            if(fileInput){
                fileInput.addEventListener('change', (e)=>{
                    const file = e.target.files[0];
                    if(!file) return clearSelected();

                    if(file.type!=='application/pdf' && !file.name.toLowerCase().endsWith('.pdf')){
                        alert('Only PDF files are supported'); return clearSelected();
                    }
                    if(file.size > 3*1024*1024){
                        alert('File size must not exceed 3MB'); return clearSelected();
                    }
                    showPreview(file);
                });
            }

            if(dropZone){
                dropZone.addEventListener('dragover', e=>{
                    e.preventDefault(); dropZone.style.borderColor='#3b82f6';
                });
                dropZone.addEventListener('dragleave', e=>{
                    dropZone.style.borderColor='#ccc';
                });
                dropZone.addEventListener('drop', e=>{
                    e.preventDefault();
                    dropZone.style.borderColor='#ccc';
                    const file = e.dataTransfer.files[0];
                    if(!file) return;

                    if(file.type!=='application/pdf' && !file.name.toLowerCase().endsWith('.pdf')){
                        alert('Only PDF files are supported'); return;
                    }
                    if(file.size > 3*1024*1024){
                        alert('File size must not exceed 3MB'); return;
                    }

                    const dt = new DataTransfer();
                    dt.items.add(file);
                    fileInput.files = dt.files;
                    showPreview(file);
                });
            }

            if(clearBtn){
                clearBtn.addEventListener('click', clearSelected);
            }
        });
    </script>

</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>