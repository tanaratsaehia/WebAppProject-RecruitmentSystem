<nav class="sticky-top flex row">
    <div class="h-20 ms-3 mt-4 d-flex">
        <img src="{{ asset('images/side_bar_logo_white.png') }}" alt="" width="25%">
        <div class="d-flex align-items-center">
            <p class="ms-3 text-2xl fs-4 text-white">Resume Parsing</p>
        </div>
    </div>
    <!-- if same route name -->
    <div class="p-0 mt-5 w-100">
        <div class="{{ request()->routeIs('dashboard') ? 'bg-primary' : '' }} w-100 ps-2">
            <a href="{{ route('dashboard') }}" class="p-0 m-0 w-100">
                <div class="h-16 d-flex align-items-center">
                    <img src="{{ asset('images/home_icon_white.png') }}" alt="" width="10%" class="ms-3">
                    <p class="ms-3 text-2xl fs-5 text-white">Home</p>
                </div>
            </a>
        </div>

        @if (auth()->user()->role == "user")
            <div class="w-100 ps-2 mt-2">
                <a href="#" class="p-0 m-0 w-100">
                    <div class="h-16 d-flex align-items-center">
                        <img src="{{ asset('images/paper_icon_white.png') }}" alt="" width="9%" class="ms-3">
                        <p class="ms-3 text-2xl fs-5 text-white">Upload Resume</p>
                    </div>
                </a>
            </div>
        @endif

        @if (auth()->user()->role == "hr" || auth()->user()->role == "superHR")
            <div class="w-100 ps-2 mt-2">
                <a href="#" class="p-0 m-0 w-100">
                    <div class="h-16 d-flex align-items-center">
                        <img src="{{ asset('images/admin_icon_white.png') }}" alt="" width="9%" class="ms-3">
                        <p class="ms-3 text-2xl fs-5 text-white">Resume Viewer</p>
                    </div>
                </a>
            </div>
            <div class="w-100 ps-2 mt-2">
                <a href="#" class="p-0 m-0 w-100">
                    <div class="h-16 d-flex align-items-center">
                        <img src="{{ asset('images/paper_and_pencil_icon_white.png') }}" alt="" width="10%" class="ms-3">
                        <p class="ms-3 text-2xl fs-5 text-white">Edit Hiring Jobs</p>
                    </div>
                </a>
            </div>
        @endif

        @if (auth()->user()->role == "superHR")
            <div class="w-100 ps-2 mt-2">
                <a href="#" class="p-0 m-0 w-100">
                    <div class="h-16 d-flex align-items-center">
                        <img src="{{ asset('images/admin_icon_white.png') }}" alt="" width="10%" class="ms-3">
                        <p class="ms-3 text-2xl fs-5 text-white">Admin</p>
                    </div>
                </a>
            </div>
        @endif


        <div class="{{ request()->routeIs('testing') ? 'bg-primary' : '' }} w-100 ps-2 mt-2">
            <a href="{{ route('testing') }}" class="p-0 m-0 w-100">
                <div class="h-16 d-flex align-items-center">
                    <img src="{{ asset('images/dev_icon_white.png') }}" alt="" width="10%" class="ms-3">
                    <p class="ms-3 text-2xl fs-5 text-white">Testing Page</p>
                </div>
            </a>
        </div>
    </div>
</nav>