<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard - Northeastern College</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bg-gray-50">

<div class="flex min-h-screen">
    <!-- Sidebar -->
    @include('components.employeeSideBar')

    <!-- Main Content -->
    <main class="flex-1 ml-56">
        <!-- Top Header -->
    @include('components.employeeHeader', ['name' => 'Kurt', 'notifications' => 5])


<div class="p-8 space-y-8">
    <!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="relative bg-white rounded-2xl p-6 border border-gray-200">
            <span class="absolute top-9 right-4 bg-blue-500/20 text-black text-sm font-semibold px-2 py-1 rounded-lg backdrop-blur-sm">
                -22%
            </span>

            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fa fa-calendar fa-2x"></i>
            </div>
            <h3 class="text-4xl font-bold text-gray-900 mb-1 mt-7">18 Days</h3>
            <p class="text-gray-600 text-sm mb-4">Leave Balance</p>

            <div class="flex items-center gap-2 mt-4">
                <div class="flex-1 bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-500 h-2.5 rounded-full" style="width: 22%;"></div>
                </div>
                <span class="text-sm font-semibold text-gray-700">22%</span>
            </div>
        </div>


    <!-- Attendance Card -->
        <div class="relative bg-white rounded-2xl p-6 border border-gray-200">
            <span class="absolute top-9 right-4 bg-green-500/20 text-green-900 text-sm font-semibold px-2 py-1 rounded-lg backdrop-blur-sm">
                On Time
            </span>

            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fa fa-clock-o fa-2x"></i>
            </div>
            <h3 class="text-4xl font-bold text-gray-900 mb-1 mt-7">98.5%</h3>
            <p class="text-gray-600 text-sm mb-1">Attendance Rate</p>
            <p class="text-gray-500 text-xs mt-4">Last 30 days 29/30 days</p>
        </div>


        <!-- Events Card -->
        <div class="relative bg-white rounded-2xl p-6 border border-gray-200">
            <span class="absolute top-9 right-4 bg-purple-500/20 text-purple-900 text-sm font-semibold px-2 py-1 rounded-lg backdrop-blur-sm">
                3 Events
            </span>

            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fa fa-calendar-o fa-2x"></i>
            </div>
            <h3 class="text-4xl font-bold text-gray-900 mb-1 mt-7">Today</h3>
            <p class="text-gray-600 text-sm mb-1">Upcoming Events</p>
            <p class="text-gray-500 text-xs mt-4">Team Meeting</p>
        </div>

        <!-- Salary Card -->
        <div class="relative bg-white rounded-2xl p-6 border border-gray-200">
            <span class="absolute top-9 right-4 bg-yellow-500/20 text-yellow-900 text-sm font-semibold px-2 py-1 rounded-lg backdrop-blur-sm">
                Paid
            </span>

            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <i class="fa fa-credit-card fa-2x"></i>
            </div>
            <h3 class="text-4xl font-bold text-gray-900 mb-1 mt-7">₱5,250</h3>
            <p class="text-gray-600 text-sm mb-1">Last Salary</p>
            <p class="text-gray-500 text-xs mt-4">Next Payment: Jan 31, 2025</p>
        </div>

</div>


<div class="p-8 space-y-6 bg-white rounded-2xl border border-gray-200">
    <!-- Quick Actions Container -->
    <div>
        <h3 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h3>

        <!-- Quick Actions Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 flex flex-col items-center justify-center gap-2 hover:shadow-md cursor-pointer">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center border-2 border-blue-500">
                    <i class="fa fa-calendar-check-o fa-2x"></i>
                </div>
                <p class="font-medium text-gray-700">Apply Leave</p>
            </div>

            <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 flex flex-col items-center justify-center gap-2 hover:shadow-md cursor-pointer">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center border-2 border-green-500">
                    <i class="fa fa-clock-o fa-2x"></i>
                </div>
                <p class="font-medium text-gray-700">Documents</p>
            </div>

            <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 flex flex-col items-center justify-center gap-2 hover:shadow-md cursor-pointer">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center border-2 border-purple-500">
                    <i class="fa fa-money fa-2x"></i>
                </div>
                <p class="font-medium text-gray-700">View Payslip</p>
            </div>

            <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 flex flex-col items-center justify-center gap-2 hover:shadow-md cursor-pointer">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center border-2 border-yellow-500">
                    <i class="fa fa-users fa-2x"></i>
                </div>
                <p class="font-medium text-gray-700">Team Directory</p>
            </div>
        </div>
    </div>
</div>








    </div>
</div>

    </main>
</div>

</body>
</html>
