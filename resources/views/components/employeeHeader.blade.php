<!-- resources/views/components/employeeHeader.blade.php -->
<header class="bg-white border-b border-gray-200 sticky top-0 z-40 px-8 py-6">
    <div class="flex items-center justify-between">
        <!-- Left: Welcome -->
        <div class="flex items-center gap-3">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">
                    Welcome back, {{ $name ?? 'Employee' }}! <span class="text-3xl">👋</span></h2>
                </h2>
                <p class="text-gray-600 mt-1">Here's what's happening with your work today</p>
            </div>
        </div>

        <!-- Right: Notifications -->
            <div class="flex items-center gap-2">
                <!-- Notifications -->
                <button class="relative p-3.5 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <span class="absolute top-1 right-1 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full w-5 h-5">
                        {{ $notifications ?? 0 }}
                    </span>
                    <i class="fa fa-bell fa-2x"></i> <!-- 2x bigger -->
                </button>

                <!-- User Profile / Dropdown -->
                <button class="p-2.5 text-gray-600 hover:bg-gray-100 rounded-full">
                    <i class="fa fa-user fa-2x"></i> <!-- 2x bigger -->
                </button>
            </div>

    </div>
</header>
