<?php
    $_SESSION['currentPage'] = "Applied Status";
?>

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Applied Status') }}
        </h1>
    </x-slot>
    <main>
        <h1>Status</h1>
        <div class="container">
            @foreach ($all_resume as $resume)
                <div class="card">
                    <div>
                        <h2>{{}}</h2>
                    </div>
                    <div>
                        <p></p>
                    </div>
                </div>            
            @endforeach
        </div>
    </main>
</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>