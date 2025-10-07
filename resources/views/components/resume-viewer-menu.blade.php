<nav class="ps-5 h-16 w-100 row align-items-center">
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
    <p class="text-2xl font-medium fs-4 fw-bold col-1">Task</p>
    <div class="col-auto p-0">
        <a href="{{ route('resume-viewer.unread') }}" class="p-1 text-decoration-none d-flex align-items-center btn 
            {{ request()->routeIs('resume-viewer.unread') ? 'bg-primary text-white' : 'btn-outline-primary' }} px-2 py-1">
            <img src="{{ asset('images/unread_icon.png') }}" alt="Unread Icon" style="width: 20px; height: 20px;" class="me-2">
            <p class="text-2xl font-medium fs-6 fw-bold mb-0">Unread</p>
        </a>
    </div>
    <div class="col-auto p-0 ms-2">
        <a href="{{ route('resume-viewer.marked') }}" class="p-1 text-decoration-none d-flex align-items-center btn 
            {{ request()->routeIs('resume-viewer.marked') ? 'bg-primary text-white' : 'btn-outline-primary' }} px-2 py-1"> 
            <img src="{{ asset('images/marked_yellow_icon.png') }}" alt="Marked Icon" style="width: 18px; height: 22px;" class="me-2">
            <p class="text-2xl font-medium fs-6 fw-bold mb-0">Marked</p>
        </a>
    </div>
    <div class="col-auto p-0 ms-2">
        <a href="{{ route('resume-viewer.replied') }}" class="p-1 text-decoration-none d-flex align-items-center btn 
            {{ request()->routeIs('resume-viewer.replied') ? 'bg-primary text-white' : 'btn-outline-primary' }} px-2 py-1"> 
            <img src="{{ asset('images/correct_thick_icon.png') }}" alt="Replied Icon" style="width: 20px; height: 20px;" class="me-2">
            <p class="text-2xl font-medium fs-6 fw-bold mb-0">Replied</p>
        </a>
    </div>
</nav>