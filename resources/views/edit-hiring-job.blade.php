<?php
    $_SESSION['currentPage'] = "เพิ่ม/แก้ไขงานที่เปิดรับสมัคร";
?>

<x-app-layout>
    <div class="mt-10">
        <div class="w-75 mx-auto">
            <form action="">
                <div class="row ">
                    <div class="col-5">
                        <label for="jobTitleInput" class="form-label">Job title</label>
                        <input name="jobTitle" type="text" class="form-control" id="jobTitleInput">
                        <label for="jobDescriptionInput" class="form-label mt-2">Job description</label>
                        <textarea name="jobDescription" type="text" class="form-control h-50" id="jobDescriptionInput"></textarea>
                    </div>
                    <div class="col">
                        <label for="requiredSkills">Required skills</label>
                        <textarea id="requiredSkills" class="w-100 h-100" name="requiredSkills" placeholder="Type skills required here..."></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-5 mb-2 w-100">Submit</button>
            </form>
        </div>
        <hr>  
        <div class="w-75 mx-auto">
            <h1>This is render area</h1>
        </div>
    </div>
</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>
