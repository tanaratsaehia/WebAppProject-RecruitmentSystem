<nav class="sticky-top flex row">
    <div class="h-20 mt-2 d-flex align-items-center ">
        <img src="{{ asset('images/side_bar_logo_white.png') }}" alt="" width="85%">
    </div>
    <!-- if same route name -->
    <div class="p-0 mt-5 w-100">
        <div class="{{ request()->routeIs('dashboard') ? 'bg-primary' : '' }} w-100 ps-2">
            <a href="{{ route('dashboard') }}" class="p-0 m-0 w-100">
                <div class="h-16 d-flex align-items-center">
                    <img src="{{ asset('images/home_icon_white.png') }}" alt="" width="12%" class="ms-3">
                    <p class="ms-3 text-2xl fs-4 text-white">Home</p>
                </div>
            </a>
        </div>



        <div class="{{ request()->routeIs('testing') ? 'bg-primary' : '' }} w-100 ps-2 mt-2">
            <a href="{{ route('testing') }}" class="p-0 m-0 w-100">
                <div class="h-16 d-flex align-items-center">
                    <img src="{{ asset('images/dev_icon_white.png') }}" alt="" width="12%" class="ms-3">
                    <p class="ms-3 text-2xl fs-4 text-white">Testing Page</p>
                </div>
            </a>
        </div>
    </div>
</nav>