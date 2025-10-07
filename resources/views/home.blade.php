<?php
    $_SESSION['currentPage'] = "Home";
?>

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h1>
    </x-slot>

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item fs-5 active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="py-12">
        <h1 class="text-2xl font-medium text-gray-900 text-center fs-1 fw-bold">
            ระบบจัดการรับสมัครงาน (Resume Parsing)
        </h1>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            @forelse ($all_job_opening as $item)
                <div class="card m-md-4" >
                    <div class="card-body">

                        <h1 class="card-title fs-2 fw-bold">
                        รับสมัคร {{$item->job_title}}
                        </h1>
                        <p class="card-text fs-4">{{$item->description}}</p>

                        <h3 class="mt-4 fw-bold fs-4">
                            คุณสมบัติ:
                        </h3>
                        <ul class="list-group list-group-flush">
                            <!-- <li class="list-group-item">● {skill_required}</li> -->
                            <?php $correct_string = str_replace('\n', "\n", $item->skill_required); ?>
                            @foreach (array_filter(explode("\n", $correct_string)) as $skill)
                                <li class="list-group-item ml-6 py-1 text-gray-700">
                                    ● {{ trim($skill) }}
                                </li>
                            @endforeach
                        </ul>

                        <div class="col-12 d-flex justify-content-center mt-3">
                            <a href="{{ route('home.upload-resume.form', $item->id) }}" class="btn btn-outline-primary border-dark text-dark col-12 fw-bold fs-5">สมัครเลย</a>
                        </div>
                    </div>
                </div>
            @empty
                <h1 class="text-4xl font-medium text-danger text-center fs-1 fw-bold mt-5">--- ขออภัยเรายังไม่เปิดรับสมัครพนักงาน ---</h1>
                <h1 class="text-5xl font-medium text-warning text-center mt-5">*** สามารถรัน Seeder ได้นะครับ "php artisan migrate:fresh --seed" ***</h1>
            @endforelse
        </div>
    </div>

</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>