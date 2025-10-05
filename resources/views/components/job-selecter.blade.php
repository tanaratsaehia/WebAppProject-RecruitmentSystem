<?php
    $all_job_opening = $_SESSION['all_job_opening'];
    $selected_job_id = $_SESSION['selected_job_id'];
?>

<div class="mb-4 ps-5 pe-4 w-100">
    <div class="w-100">
        <!-- <label for="jobSelect" class="form-label text-2xl mt-1 font-medium fs-4 fw-bold col-1" style="width: 5%">Job</label> -->
        <label for="jobSelect" class="form-label fw-semibold fs-5">Job</label>
        <div class="col w-100 p-0">
            <select class="form-select form-select-lg " id="jobSelect" name="job_id">
                @forelse ($all_job_opening as $job)
                    <option value="{{ $job->id }}" {{ (string) $job->id == $selected_job_id ? 'selected' : '' }}> 
                        {{ $job->job_title }}
                    </option>
                @empty
                    <option disabled selected>No job available</option>
                @endforelse
            </select>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jobSelect = document.getElementById('jobSelect');
        if (jobSelect) {
            jobSelect.addEventListener('change', function() {
                const selectedId = this.value;
                const baseUrl = '{{ $_SESSION['base_url'] }}';
                console.log('base url' + baseUrl);
                window.location.href = baseUrl.replace(/\/$/, '') + '/' + selectedId;
            });
        }
    });
</script>