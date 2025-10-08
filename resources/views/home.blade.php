<?php
    $_SESSION['currentPage'] = "Home";
?>
<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h1>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            @forelse ($all_job_opening as $item)
                <div class="card m-md-4" >
                    <div class="card-body">

                        <h1 class="card-title fs-2 fw-bold">
                            {{$item->job_title}}
                        </h1>
                        <p class="card-text fs-4">{{$item->description}}</p>

                        <h3 class="mt-4 fw-bold fs-5">
                            Preferred Skills & Qualifications:
                        </h3>
                        <ul class="list-group list-group-flush">
                            <?php $correct_string = str_replace('\n', "\n", $item->skill_required); ?>
                            @foreach (array_filter(explode("\n", $correct_string)) as $skill)
                                <li class="list-group-item ml-6 py-1 text-gray-700">
                                    ● {{ trim($skill) }}
                                </li>
                            @endforeach
                        </ul>

                        <div class="col-12 d-flex justify-content-center mt-3">
                            <a href="{{ route('home.upload-resume.form', $item->id) }}" class="btn btn-outline-primary border-dark text-dark col-12 fw-bold fs-5">Apply Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <h1 class="text-4xl font-medium text-danger text-center fs-1 fw-bold mt-5">--- No Opening Job ---</h1>
            @endforelse
        </div>
    </div>

</x-app-layout>
<script>
    @if (session('not_allowed'))
        Swal.fire({
            icon: 'warning',
            title: 'Page not allow!',
            confirmButtonText: "OK",
        });
    @endif
</script>
<?php
    $_SESSION['currentPage'] = null;
?>