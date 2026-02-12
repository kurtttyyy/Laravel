<header class="bg-white border-b border-gray-200 sticky top-0 z-40 px-4 md:px-8 py-4 md:py-6 flex items-center justify-between backdrop-blur-sm">
    <div class="flex items-center gap-4">
        @if ($activeAttendanceTab !== 'all')
            <a href="{{ route('admin.adminAttendance') }}" class="text-gray-600 hover:text-gray-900 transition">
                <i class="fa-solid fa-arrow-left text-xl"></i>
            </a>
        @endif
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Daily Attendance</h2>
            <p class="text-gray-600 mt-1">Friday, January 10, 2025</p>
        </div>
    </div>


</header>
