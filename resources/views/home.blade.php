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
            <div class="card m-md-4" style="width: 70rem;">
                <?php $id = 1;?>
                <div class="card-body">

                    <h1 class="card-title fs-2 fw-bold">
                    รับสมัคร {Job Title}
                    </h1>
                    <p class="card-text fs-4">{description}</p>

                    <h3 class="mt-4 fw-bold fs-4">
                        คุณสมบัติ:
                    </h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">● {skill_required}</li>
                    </ul>

                    <div class="col-12 d-flex justify-content-center mt-3">
                        <a href="{{ route('home.upload-resume', $id) }}" class="btn btn-outline-primary border-dark text-dark col-12 fw-bold fs-5">สมัครเลย</a>
                    </div>
                </div>
            </div>
            <div class="card m-md-4" style="width: 70rem;">
                <?php $id = 2; ?>
                <div class="card-body">

                    <h1 class="card-title fs-2 fw-bold">
                    รับสมัคร {Job Title}
                    </h1>
                    <p class="card-text fs-4">{description}</p>

                    <h3 class="mt-4 fw-bold fs-4">
                        คุณสมบัติ:
                    </h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">● {skill_required}</li>
                    </ul>

                    <div class="col-12 d-flex justify-content-center mt-3">
                        <a href="{{ route('home.upload-resume', $id) }}" class="btn border-dark text-dark col-12 fw-bold fs-5">สมัครเลย</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>