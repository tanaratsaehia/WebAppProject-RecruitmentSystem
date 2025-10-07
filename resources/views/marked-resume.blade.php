<?php
    $_SESSION['currentPage'] = "Resume Viewer";
    $_SESSION['all_job_opening'] = $all_job_opening;
    $_SESSION['selected_job_id'] = $selected_job_id;
    $_SESSION['base_url'] = route("resume-viewer.marked");
?>

<x-app-layout>
    <x-resume-viewer-menu></x-resume-viewer-menu>
    <hr>
    <div class="mt-5">
        <x-job-selecter></x-job-selecter>
    </div>
    <div class="mt-5 mb-4 ps-5 w-100">
        <p class="text-2xl mt-1 font-medium fs-5 mb-2">Marked ({{$filtered_resume->count()}} files)</p>
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
                        <hr class="my-2">
                        <p>Purpose: {{$resume->applyInfomation->applying_purpose}}</p>
                    </div>
                </form>
                
            </div>
        @empty
            <p>No marked resumes match the selected job</p>
        @endforelse
    </div>
</x-app-layout>
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{session('success')}}',
            confirmButtonText: "ยืนยัน",
        });
    @endif
    document.addEventListener("DOMContentLoaded", function () {
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
