<nav class="sticky-top flex row">
    <div class="h-20 ms-3 mt-4 d-flex">
        <img src="{{ asset('images/side_bar_logo_white.png') }}" alt="" style="width: 25%; height: auto;">
        <div class="d-flex align-items-center">
            <p class="ms-3 text-2xl fs-4 text-white">Recruitment System</p>
        </div>
    </div>
    <div class="p-0 mt-5 w-100">
        <div class="{{ request()->routeIs('home*') ? 'bg-primary' : '' }} w-100 ps-2">
            <a href="{{ route('home') }}" class="p-0 m-0 w-100">
                <div class="h-16 d-flex align-items-center">
                    <img src="{{ asset('images/home_icon_white.png') }}" alt="" width="10%" class="ms-3">
                    <p class="ms-3 text-2xl fs-5 text-white">Home</p>
                </div>
            </a>
        </div>
        @if (auth()->user()->role == "user")
            <div class="{{ request()->routeIs('applied-status') ? 'bg-primary' : '' }} w-100 ps-2 mt-2">
                <a href="{{ route('applied-status') }}" class="p-0 m-0 w-100">
                    <div class="h-16 d-flex align-items-center">
                        <img src="{{ asset('images/paper_icon_white.png') }}" alt="" width="9%" class="ms-3">
                        <p class="ms-3 text-2xl fs-5 text-white">Applied Status</p>
                    </div>
                </a>
            </div>
        @endif
        @if (auth()->user()->role == "hr")
            <div class="{{ request()->routeIs('resume-viewer') || request()->routeIs('resume-viewer.*') ? 'bg-primary' : '' }} w-100 ps-2 mt-2">
                <a href="{{ route('resume-viewer.unread') }}" class="p-0 m-0 w-100">
                    <div class="h-16 d-flex align-items-center">
                        <img src="{{ asset('images/paper_icon_white.png') }}" alt="" width="9%" class="ms-3">
                        <p class="ms-3 text-2xl fs-5 text-white">Resume Viewer</p>
                    </div>
                </a>
            </div>
            <div class="{{ request()->routeIs('edit-hiring-job') || request()->routeIs('edit-hiring-job.*') ? 'bg-primary' : '' }} w-100 ps-2 mt-2">
                <a href="{{ route('edit-hiring-job') }}" class="p-0 m-0 w-100">
                    <div class="h-16 d-flex align-items-center">
                        <img src="{{ asset('images/paper_and_pencil_icon_white.png') }}" alt="" width="10%" class="ms-3">
                        <p class="ms-3 text-2xl fs-5 text-white">Edit Hiring Jobs</p>
                    </div>
                </a>
            </div>
        @endif
    </div>
</nav>