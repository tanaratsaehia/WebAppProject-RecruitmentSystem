<?php
    $_SESSION['currentPage'] = "Unread Resume";
    $_SESSION['all_job_opening'] = $all_job_opening;
    $_SESSION['selected_job_id'] = $selected_job_id;
    $_SESSION['base_url'] = route("resume-viewer.unread");
?>

<x-app-layout>
    <x-resume-viewer-menu></x-resume-viewer-menu>
    <hr>
    <div class="mt-5">
        <x-job-selecter></x-job-selecter>
    </div>
    <div class="mt-4 mb-5 me-4 ps-5">
        <form action="{{ route('resume-viewer.unread', ['id' => $selected_job_id]) }}" method="post" class="" id="skill-form">
            @csrf
            <div class="row g-4">
                <!-- Multiple selector power by Choices.js -->
                <div class="col-12 col-md-6">
                    <label for="exampleSelect" class="form-label fw-semibold fs-5">Skills</label>
                    <select class="form-select" id="exampleSelect" multiple name="skills[]">
                        @php
                            $selectedSkillIds = $job_skills->pluck('id')->toArray();
                        @endphp
                        @forelse ($all_skills as $skill)
                            <option value="{{ $skill->id }}" 
                                {{ in_array($skill->id, $selectedSkillIds) ? 'selected' : '' }}> 
                                {{ $skill->name }}
                            </option>
                        @empty
                            <option value="" disabled>Not have any skill in DB</option>
                        @endforelse
                    </select>
                </div>

                <div class="col-12 col-md-6">
                <label for="searchText" class="form-label fw-semibold row m-0 mb-2 fs-5">
                    Text 
                    <span class="text-danger col ">**text feature not implement!</span>
                </label>
                <textarea 
                    name="jobDescription" 
                    id="searchText" 
                    class="form-control" 
                    rows="3" 
                    placeholder="Write a short description of the job..."
                ></textarea>
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-between">
                <button type="button" id="clearSkillsButton" class="btn btn-outline-danger px-5 py-2 me-2 flex-grow-1">
                    Clear All Tags
                </button>

                <input type="submit" value="Search" class="btn btn-primary px-5 py-2 flex-grow-1">
            </div>
        </form>
    </div>
    <hr>
    <div class="mt-5 mb-4 ps-5 w-100">
        <p class="text-2xl mt-1 font-medium fs-4 fw-bold mb-2">Results ({{$filtered_resume->count()}} file/s)</p>
        @forelse ($filtered_resume as $resume)
            <div class="resume-card">
                <div class="border border-dark rounded-2 mb-3 me-4">
                    <div class="m-2 d-flex align-items-center row">
                        <img src="{{ asset('images/pdf_icon.png') }}" alt="PDF" class="col-1 p-0" style="width: 25px; height: 30px;">
                        <p class="col-4">{{$resume->resume_file_name}}</p>
                        @if ($resume->score > 0)
                            <p class="col">Match<span class="fw-bold"> {{ $resume->score }}</span> / {{ count($job_skills) }} tags</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p>No resumes match the selected job and skills.</p>
        @endforelse
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        new Choices("#exampleSelect", {
            removeItemButton: true,
            placeholderValue: 'Select options...',
            searchPlaceholderValue: 'Search...',
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        const clearButton = document.getElementById('clearSkillsButton');
        const skillSelect = document.getElementById('exampleSelect');
        const form = document.getElementById('skill-form');

        if (clearButton && form && skillSelect) {
            clearButton.addEventListener('click', function (e) {
                // 1. Show Confirmation Dialog
                Swal.fire({
                    title: "ยืนยันการล้างแท็ก?",
                    text: "คุณต้องการล้างแท็กทั้งหมดสำหรับงานนี้หรือไม่",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33", // Use red for destructive action
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "ล้างแท็กทั้งหมด",
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // 2. Clear all selections in the dropdown
                        // This step is mostly for visual confirmation, but important
                        for (let i = 0; i < skillSelect.options.length; i++) {
                            skillSelect.options[i].selected = false;
                        }
                        form.submit();
                    }
                });
            });
        }
    });
</script>

<?php
    $_SESSION['currentPage'] = null;
?>
