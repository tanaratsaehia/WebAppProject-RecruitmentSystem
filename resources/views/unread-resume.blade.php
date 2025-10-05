<?php
    $_SESSION['currentPage'] = "Unread Resume";
    $_SESSION['all_job_opening'] = $all_job_opening;
    $_SESSION['selected_job_id'] = $selected_job_id;
    $_SESSION['base_url'] = route("resume-viewer.unread");
?>

<x-app-layout>
    <x-resume-viewer-menu></x-resume-viewer-menu>
    <hr>
    <x-job-selecter></x-job-selecter>
    <hr>
    <div class="mt-4 mb-4 ps-5 w-100">
        <p class="text-2xl mt-1 font-medium fs-4 fw-bold mb-2">Results ({{$filtered_resume->count()}} file/s)</p>
        @forelse ($filtered_resume as $resume)
            <div class="border border-dark rounded-2 mb-3 me-4">
                <div class="m-2 d-flex align-items-center row">
                    <img src="{{ asset('images/pdf_icon.png') }}" alt="PDF" class="col-1 p-0" style="width: 25px; height: 30px;">
                    <p class="col-auto">{{$resume->resume_file_name}}</p>
                </div>
            </div>
        @empty
            <h1 class="text-4xl font-medium text-danger text-center fs-4 fw-bold mt-5">--- ยังไม่มี resume ---</h1>
            <h1 class="text-5xl font-medium text-warning text-center fs-5 mt-5">*** สามารถรัน Seeder ได้นะครับ "php artisan migrate:fresh --seed" ***</h1>
        @endforelse
    </div>
</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>
