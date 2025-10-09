<?php
    $_SESSION['currentPage'] = "Add/Edit jobs";
?>

<x-app-layout>
    <div class="mt-10">
        <div class="w-75 mx-auto">
            @if (isset($job_for_edit))
                <h1 class="text-2xl font-medium fs-2 fw-bold">Edit job</h1>
                <form action="{{ route('edit-hiring-job.save') }}" method="post" class="mt-2 mb-2">
                    @csrf 
                    <input type="hidden" name="id" value="{{$job_for_edit->id}}">
                    <div class="row ">
                        <div class="col-5">
                            <label for="jobTitleInput" class="form-label">Job title</label>
                            <input name="jobTitle" type="text" class="form-control" id="jobTitleInput" value="{{$job_for_edit->job_title}}" required>
                            <label for="jobDescriptionInput" class="form-label mt-2">Job description</label>
                            <textarea name="jobDescription" type="text" class="form-control h-50" id="jobDescriptionInput" required>{{$job_for_edit->description}}</textarea>
                        </div>
                        <div class="col">
                            <label for="requiredSkills">Preferred Skills & Qualifications</label>
                            <?php $correct_string= str_replace('\n', "\n", $job_for_edit->skill_required); ?>
                            <textarea id="requiredSkills" class="w-100 h-100" name="requiredSkills" placeholder="Type skills required here..." required><?php echo $correct_string; ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <a href="{{ route('edit-hiring-job') }}" role="button" class="col btn btn-outline-secondary mt-5 mb-2 mx-2 w-100">
                            Back to Add Job
                        </a>
                        <input type="reset" value="Revert Changes" class="col btn btn-secondary mt-5 mb-2 mx-2 w-100">
                        <input type="button" value="Save" id="saveJobButton" class="col btn btn-primary mt-5 mb-2 mx-2 w-100">
                    </div>
                </form>
            @else
                <h1 class="text-2xl font-medium fs-2 fw-bold">Add job</h1>
                <form action="{{ route('edit-hiring-job.add') }}" method="post" class="mt-2 mb-2"> 
                    @csrf 
                    <div class="row ">
                        <div class="col-5">
                            <label for="jobTitleInput" class="form-label">Job title</label>
                            <input name="jobTitle" type="text" class="form-control" id="jobTitleInput" required>
                            <label for="jobDescriptionInput" class="form-label mt-2">Job description</label>
                            <textarea name="jobDescription" type="text" class="form-control h-50" id="jobDescriptionInput" required></textarea>
                        </div>
                        <div class="col">
                            <label for="requiredSkills">Preferred Skills & Qualifications</label>
                            <textarea id="requiredSkills" class="w-100 h-100" name="requiredSkills" placeholder="Type skills required here..." required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <input type="reset" value="Clear" class="col btn btn-secondary mt-5 mb-2 mx-2 w-100">
                        <input type="submit" value="Add Job" class="col btn btn-primary mt-5 mb-2 mx-2 w-100">
                    </div>
                </form>
            @endif
        </div>
        <hr>  
        <div class="w-75 mx-auto mt-10">
            <h1 class="text-2xl font-medium fs-2 fw-bold mb-3">Jobs</h1>
            @forelse ($all_job_opening as $item)
                <div class="border border-dark rounded-2 mb-3">
                    <div class="m-2 d-flex align-items-center">
                        <p class="fs-5 mb-0 me-auto">{{$item->job_title}}</p>
                        <a href="{{ route('edit-hiring-job.edit', $item->id) }}" class="text-decoration-none me-3">
                            <img src="{{ asset('images/yellow_pencil.png') }}" alt="Edit" style="width: 25px; height: 25px;">
                        </a>
                        <span class="border-end border-secondary mx-2 align-self-stretch" style="width: 4px;"></span>
                        <form id="deleteForm-{{ $item->id }}" action="{{ route('edit-hiring-job.delete', $item->id) }}" method="get" style="display:inline;">
                            @csrf
                            <button type="button" 
                                    class="btn p-0 bg-transparent border-0 delete-job-btn ms-3 me-2" 
                                    data-job-id="{{ $item->id }}" 
                                    data-job-title="{{ $item->job_title }}">
                                <img src="{{ asset('images/red_bin.png') }}" alt="Delete" style="width: 25px; height: 25px;">
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="font-medium text-danger fw-bold mt-3">--- No opening job ---</p>
            @endforelse
        </div>
    </div>
</x-app-layout>

<script>
    @if (session('updated_job_title'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            html: 'Job <strong>{{session('updated_job_title')}}</strong> has been saved successfully.',
            confirmButtonText: "Confirm",
        });
    @endif
    @if (session('deleted_job_title'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            html: 'Job <strong class="text-danger">{{session('deleted_job_title')}}</strong> has been deleted successfully.',
            confirmButtonText: "Confirm",
        });
    @endif

    document.addEventListener('DOMContentLoaded', function () {
        const saveButton = document.getElementById('saveJobButton');
        const deleteButton = document.getElementById('deleteButton');
        const form = saveButton ? saveButton.closest('form') : null;

        if (saveButton && form) {
            saveButton.addEventListener('click', function (e) {
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }
                
                Swal.fire({
                    title: "Save changes?",
                    text: "Do you want to save the changes?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Save",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else {
                    }
                });
            });
        }
    });

    document.querySelectorAll('.delete-job-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            const jobId = this.getAttribute('data-job-id');
            const jobTitle = this.getAttribute('data-job-title');
            const formId = `deleteForm-${jobId}`;

            Swal.fire({
                title: "Confirm Deletion?",
                html: `Are you sure you want to delete job <strong class="text-danger">${jobTitle}</strong>?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        });
    });
</script>

<?php
    $_SESSION['currentPage'] = null;
?>
