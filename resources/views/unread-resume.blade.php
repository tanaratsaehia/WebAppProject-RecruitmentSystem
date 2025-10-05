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
        <form action="{{ route('resume-viewer.unread', ['id' => $selected_job_id]) }}" method="post" class="">
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

            <div class="mt-3 ">
                <input type="submit" value="Search" class="btn btn-primary px-5 py-2 w-100">
            </div>
        </form>
    </div>
    <hr>
    <div class="mt-5 mb-4 ps-5 w-100">
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    new Choices("#exampleSelect", {
            removeItemButton: true,
            placeholderValue: 'Select options...',
            searchPlaceholderValue: 'Search...',
        });
    });
</script>

<?php
    $_SESSION['currentPage'] = null;
?>
