<?php
    $_SESSION['currentPage'] = "Applied Status";
?>

<x-app-layout>
    <main>
        <div class="container">
            @forelse ($all_resume as $resume)
                <div class="border border-dark rounded-2 p-2 my-4">
                    <p class="text-2xl mt-1 font-medium fs-5 fw-bold mb-2">{{$resume->jobOpening->job_title}}</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/pdf_icon.png') }}" alt="PDF" class="me-3" style="width: 25px; height: 30px;">
                            <a href="{{ route('home.upload-resume.view', ['id' => $resume->job_opening_id]) }}"
                                class="fw-medium mb-0 me-4 text-truncate" style="max-width: 250px;">
                                {{$resume->resume_file_name}}
                            </a>
                        </div>
                        <div class="d-flex align-items-center py-2 px-3">
                            <p>Your soft skill: {{$resume->applyInfomation->soft_skill}}</p>
                        </div>
                        <div class="d-flex align-items-center ms-auto me-5" style="width: 15%;">
                            @if ($resume->resume_status == "accepted")
                                <p class="p-1 w-100 rounded fs-5 bg-success text-white text-center">Accepted</p>
                            @elseif ($resume->resume_status == "rejected")
                                <p class="p-1 w-100 rounded fs-5 bg-danger text-white text-center">Rejected</p>
                            @else
                                <p class="p-1 w-100 rounded fs-5 bg-info text-white text-center">Waiting Response</p>
                            @endif
                        </div>
                    </div>
                    <hr class="my-2 mx-2">
                    <p>Your purpose: {{$resume->applyInfomation->applying_purpose}}</p>
                </div>  
            @empty
                <p class="text-2xl mt-1 font-medium fs-5 fw-bold mb-2">Apply us!</p>
            @endforelse
        </div>
    </main>
</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>