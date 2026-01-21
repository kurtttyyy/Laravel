<header class="bg-white border-b border-gray-200 sticky top-0 z-40 px-8 py-5">
    <div class="flex items-center justify-between gap-6">

        <!-- LEFT : Title -->
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Employees</h2>
            <p class="text-gray-600 text-sm mt-1">
                Manage all employees and their status
            </p>
        </div>

        <!-- RIGHT : Search + Filters -->
        <div class="flex items-center gap-4">

            <!-- Search Bar -->
            <div class="relative">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                    <i class="fa fa-search"></i>
                </span>
                <input
                    type="text"
                    placeholder="Search employee..."
                    class="pl-10 pr-4 py-2 w-64 border border-gray-300 rounded-lg
                           focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                >
            </div>

            <!-- Status Filters -->
            <div class="flex items-center bg-gray-100 rounded-lg p-1">

                <!-- Active -->
                <button
                    class="px-4 py-2 text-sm rounded-md font-medium
                           bg-white text-green-600 shadow">
                    Active
                </button>

                <!-- On Leave -->
                <button
                    class="px-4 py-2 text-sm rounded-md font-medium
                           text-yellow-600 hover:bg-white hover:shadow">
                    On Leave
                </button>

                <!-- Inactive -->
                <button
                    class="px-4 py-2 text-sm rounded-md font-medium
                           text-red-600 hover:bg-white hover:shadow">
                    Inactive
                </button>

            </div>

        </div>
    </div>
</header>
