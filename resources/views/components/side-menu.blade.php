<div class="fixed top-0 left-0 h-screen w-16 md:w-64 bg-gray-800 text-white shadow-xl transition-all duration-300">
    <!-- Sidebar Content -->
    <div class="p-4">
        <h1 class="text-xl md:text-2xl font-bold mb-6 truncate">
            <!-- Hide Full Text on Small Screens -->
            <span class="hidden md:inline">Dashboard Menu</span>
            <!-- Show Icon/Shorthand on Small Screens -->
            <span class="md:hidden">DM</span>
        </h1>

        <nav class="space-y-2">
            <!-- Menu Item 1 -->
            <a href="#" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-gray-700 transition duration-150 group">
                <!-- Icon placeholder (using inline SVG for simplicity) -->
                <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l-7 7m7-7v10a1 1 0 01-1 1h-3"></path></svg>
                <!-- Hide text on small screens, show on medium and larger -->
                <span class="text-sm hidden md:inline">Home</span>
            </a>
            
            <!-- Menu Item 2 -->
            <a href="#" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-gray-700 transition duration-150 group bg-gray-700">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20h5v-2a3 3 0 00-5.356-1.857"></path></svg>
                <span class="text-sm hidden md:inline">Users (Active)</span>
            </a>
            
            <!-- Menu Item 3 -->
            <a href="#" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-gray-700 transition duration-150 group">
                <svg class="w-6 h-6 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6a2 2 0 00-2-2H5a2 2 0 00-2 2v13m7 0v-2a3 3 0 013-3h3a3 3 0 013 3v2m-7 0H9"></path></svg>
                <span class="text-sm hidden md:inline">Reports</span>
            </a>
        </nav>
    </div>
</div>