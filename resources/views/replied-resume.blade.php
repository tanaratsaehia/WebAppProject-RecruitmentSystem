<?php
    $_SESSION['currentPage'] = "Resume Viewer";
    $_SESSION['all_job_opening'] = $all_job_opening;
    $_SESSION['selected_job_id'] = $selected_job_id;
    $_SESSION['base_url'] = route("resume-viewer.replied");
?>

<x-app-layout>
    <x-resume-viewer-menu></x-resume-viewer-menu>
    <hr>
    <div class="mt-5">
        <x-job-selecter></x-job-selecter>
    </div>
    <div class="mt-5 mb-4 ps-5 w-100">
        <p class="text-2xl mt-1 font-medium fs-5 mb-2">Replied ({{$filtered_resume->count()}} files)</p>
        @forelse ($filtered_resume as $resume)
            <div class="resume-card mb-4 me-4">
                <form action="{{ route('resume-viewer.update-status', $resume->id) }}" method="POST" class="resume-action-form" data-resume-name="{{ $resume->resume_file_name }}">
                    @csrf
                    <input type="hidden" name="status_action" class="status-action-input" value="">
                    
                    <div class="border border-dark rounded-2 p-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/pdf_icon.png') }}" alt="PDF" class="me-3" style="width: 25px; height: 30px;">
                                
                                <a href="{{ route('home.upload-resume.viewUser',['job_id' => $resume->jobOpening->id, 'user_id'=>$resume->user->id]) }}"
                                    class="fw-medium mb-0 me-4 text-truncate" style="max-width: 250px;">
                                    {{$resume->resume_file_name}}
                                </a>
                                <span class="fs-6 py-2 px-3">{{$resume->user->email}}</span>
                                @if ($resume->score > 0)
                                    <span class="fs-6 py-2 px-3">
                                        Match <span class="fw-bold">{{ $resume->score }}</span>/{{ count($job_skills) }} skill
                                    </span>
                                @endif
                            </div>
                            <div class="d-flex align-items-center py-2 px-3">
                                <p>Soft skill: {{$resume->applyInfomation->soft_skill}}</p>
                            </div>
                            <div class="d-flex align-items-center ms-auto me-5" style="width: 10%;">
                                @if ($resume->resume_status == "accepted")
                                    <p class="p-1 w-100 rounded fs-5 bg-success text-white text-center">Accepted</p>
                                @elseif ($resume->resume_status == "rejected")
                                    <p class="p-1 w-100 rounded fs-5 bg-danger text-white text-center">Rejected</p>
                                @else
                                    <p class="p-1 w-100 rounded fs-5 bg-warning text-dark text-center">Unknow</p>
                                @endif
                            </div>
                        </div>
                        <hr class="my-2 mx-2">
                        <p>Purpose: {{$resume->applyInfomation->applying_purpose}}</p>
                    </div>
                </form>
                
            </div>
        @empty
            <p>No replied resumes match the selected job</p>
        @endforelse
    </div>
</x-app-layout>
<?php
    $_SESSION['currentPage'] = null;
?>
