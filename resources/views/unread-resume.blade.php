<?php
    $_SESSION['currentPage'] = "Unread Resume";
?>

<x-app-layout>
    <x-resume-viewer-menu></x-resume-viewer-menu>
</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>
