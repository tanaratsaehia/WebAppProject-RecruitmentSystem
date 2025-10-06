<?php
    $_SESSION['currentPage'] = "Processing Resume";
    $groupedResumes = $filtered_resume->groupBy('jobOpening.job_title');
?>

<x-app-layout>
    <x-resume-viewer-menu></x-resume-viewer-menu>
    <hr>
    <div class="mt-5 mb-4 ps-5 w-100">
        <p class="text-2xl mt-1 font-medium fs-4 fw-bold mb-3">
            Processing ({{ $filtered_resume->count() }} files)
        </p>

        @forelse ($groupedResumes as $jobTitle => $resumes)
            {{-- Job Group Header --}}
            <div class="mb-4">
                <h5 class="fw-bold text-primary mb-3">{{ $jobTitle }} ({{ $resumes->count() }} files)</h5>
                {{-- List of Resumes for this Job --}}
                @foreach ($resumes as $resume)
                    <div class="resume-card mb-3 me-4">
                        <div class="border border-dark rounded-2 p-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center flex-grow-1">
                                <img src="{{ asset('images/pdf_icon.png') }}" alt="PDF" class="me-3" style="width: 25px; height: 30px;">
                                
                                {{-- Resume Name and User Email --}}
                                <p class="fw-medium mb-0 me-4 text-truncate" style="max-width: 250px;">
                                    {{ $resume->resume_file_name }}
                                </p>
                                <span class="fs-6 py-2 px-3">{{ $resume->user->email }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @empty
            <p>No resumes are currently in "processing" status.</p>
        @endforelse
    </div>
</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>
