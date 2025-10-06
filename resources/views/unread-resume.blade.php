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
                <button type="button" id="clearSkillsButton" class="btn btn-secondary px-5 py-2 me-2 flex-grow-1">
                    Clear
                </button>

                <input type="submit" value="Search" class="btn btn-primary px-5 py-2 flex-grow-1">
            </div>
        </form>
    </div>
    <hr>
    <div class="mt-5 mb-4 ps-5 w-100">
        <p class="text-2xl mt-1 font-medium fs-4 fw-bold mb-2">Results ({{$filtered_resume->count()}} file/s)</p>
        @forelse ($filtered_resume as $resume)
            <div class="resume-card mb-3 me-4">
                <form action="{{ route('resume-viewer.update-status', $resume->id) }}" method="POST" class="resume-action-form" data-resume-name="{{ $resume->resume_file_name }}">
                    @csrf
                    <input type="hidden" name="status_action" class="status-action-input" value="">
                    
                    <div class="border border-dark rounded-2 p-2 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center flex-grow-1">
                            <img src="{{ asset('images/pdf_icon.png') }}" alt="PDF" class="me-3" style="width: 25px; height: 30px;">
                            <p class="fw-medium mb-0 me-4 text-truncate" style="max-width: 250px;">
                                {{$resume->resume_file_name}}
                            </p>
                            <span class="fs-6 py-2 px-3">{{$resume->user->email}}</span>
                            @if ($resume->score > 0)
                                <span class="fs-6 py-2 px-3">
                                    Match <span class="fw-bold">{{ $resume->score }}</span>/{{ count($job_skills) }} skill
                                </span>
                            @endif
                        </div>
                        <div class="d-flex align-items-center ms-auto">
                            @if ($resume->resume_status == "unread")
                                <img src="{{ asset('images/marked_gray_icon.png') }}" 
                                    alt="Mark Icon" 
                                    class="me-3 action-button" 
                                    data-action="mark"
                                    style="width: auto; height: 30px; cursor: pointer;">
                            @else
                                <img src="{{ asset('images/marked_yellow_icon.png') }}" 
                                    alt="Mark Icon" 
                                    class="me-3 action-button" 
                                    data-action="mark"
                                    style="width: auto; height: 30px; cursor: pointer;">
                            @endif
                            <button type="button" 
                                    class="btn btn-sm btn-outline-danger me-2 action-button" 
                                    data-action="reject">
                                Reject
                            </button>
                            <button type="button" 
                                    class="btn btn-sm btn-success text-white action-button" 
                                    data-action="accept">
                                Accept
                            </button>
                        </div>
                    </div>
                </form>
                
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
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "ล้างแท็กทั้งหมด",
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.isConfirmed) {
                        for (let i = 0; i < skillSelect.options.length; i++) {
                            skillSelect.options[i].selected = false;
                        }
                        form.submit();
                    }
                });
            });
        }

        const actionButtons = document.querySelectorAll('.action-button');

        actionButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                
                const form = button.closest('.resume-action-form');
                if (!form) return;

                const actionType = button.getAttribute('data-action');
                const resumeName = form.getAttribute('data-resume-name');
                
                let title = '';
                let confirmText = '';
                let icon = 'question';
                let confirmButtonColor = '#3085d6';

                switch (actionType) {
                    case 'accept':
                        title = "ยืนยันการรับเข้าสัมภาษณ์?";
                        confirmText = `คุณยืนยันที่จะรับเข้าเรซูเม่ "${resumeName}" เข้าสัมภาษณ์หรือไม่?`;
                        icon = 'success';
                        confirmButtonColor = '#28a745'; // Green for success
                        break;
                    case 'reject':
                        title = "ยืนยันการปฏิเสธ?";
                        confirmText = `คุณยืนยันที่จะปฏิเสธเรซูเม่ "${resumeName}" หรือไม่?`;
                        icon = 'warning';
                        confirmButtonColor = '#dc3545'; // Red for danger
                        break;
                    case 'mark':
                        // title = "ยืนยันสถานะมาร์ค?";
                        // confirmText = `คุณต้องการสลับสถานะมาร์คของเรซูเม่ "${resumeName}" หรือไม่?`;
                        // icon = 'info';
                        const actionInput = form.querySelector('.status-action-input');
                        actionInput.value = actionType;
                        form.submit();
                        return;
                    default:
                        return;
                }

                Swal.fire({
                    title: title,
                    text: confirmText,
                    icon: icon,
                    showCancelButton: true,
                    confirmButtonColor: confirmButtonColor,
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.isConfirmed) {
                        const actionInput = form.querySelector('.status-action-input');
                        actionInput.value = actionType;
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<?php
    $_SESSION['currentPage'] = null;
?>
