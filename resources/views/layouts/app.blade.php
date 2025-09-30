<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container-fluid row align-items-start vh-100">
        <div class="col h-100 border">
            <x-side-menu/>
        </div>

        <div class="col-10 h-100">
            <div class="row w-fit border">
                @livewire('navigation-menu') 
            </div>
            <div class="row w-fit border mt-0">
                <main>
                    <!-- <h1>Hi</h1> -->
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>
</html>
