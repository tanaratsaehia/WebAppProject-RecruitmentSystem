<?php
    $_SESSION['currentPage'] = "Marked Resume";
    $_SESSION['all_job_opening'] = $all_job_opening;
    $_SESSION['selected_job_id'] = $selected_job_id;
    $_SESSION['base_url'] = route("resume-viewer.marked");
?>

<x-app-layout>
    <x-resume-viewer-menu></x-resume-viewer-menu>
    <hr>
    <x-job-selecter></x-job-selecter>
    
</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>
