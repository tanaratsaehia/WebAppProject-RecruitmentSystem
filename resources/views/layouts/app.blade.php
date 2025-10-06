<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Join US!</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-custom.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container-fluid row align-items-start vh-100 p-0 m-0">
        <div class="col h-100 bg-secondary">
            <x-side-menu/>
        </div>

        <div class="col-10 h-100">
            <div class="row border sticky-top h-20">
                @livewire('navigation-menu') 
            </div>
            <div class="row w-fit border mt-0 mb-10 fixed-height-viewpoint" style="height: 90vh">
                <main class="p-0">
                    <!-- <h1>Hi</h1> -->
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>
</html>
