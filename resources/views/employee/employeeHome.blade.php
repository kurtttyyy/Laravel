<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard - Northeastern College</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            transition: margin-left 0.3s ease;
        }
        
        main {
            transition: margin-left 0.3s ease;
        }
        
        aside:not(:hover) ~ main {
            margin-left: 4rem; /* w-16 when collapsed */
        }
        
        aside:hover ~ main {
            margin-left: 14rem; /* w-56 when expanded */
        }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex min-h-screen">
    <!-- Sidebar -->
    @include('components.employeeSideBar')

    <!-- Main Content -->
    <main class="flex-1 ml-16 transition-all duration-300">
        <!-- Top Header -->
    @include('components.employeeHeader.dashboardHeader', ['name' => 'Kurt', 'notifications' => 5])


<div class="p-4 md:p-8 space-y-8 pt-20">
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


<div class="p-4 md:p-8 space-y-6 bg-white rounded-2xl border border-gray-200 mx-4 md:mx-0">
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


    <!-- Attendance + Upcoming Events Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 px-4 md:px-0">
        <!-- This Week's Attendance -->
        <div class="bg-white rounded-2xl border border-gray-200 p-4 md:p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">This Week's Attendance</h3>
                <span class="text-sm text-gray-500 font-medium">Jan 20 – Jan 26</span>
            </div>

            <div class="space-y-6">
                <div>
                    <div class="grid grid-cols-12 items-start gap-4">
                        <div class="col-span-2 mt-5 ml-8 relative w-12 h-12 text-green-600">
                            <i class="fa fa-calendar-o fa-4x w-full h-full mt-[-10px]"></i>
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-xs font-bold mt-2 ml-2">
                                <span>Mon</span>
                                <span>20</span>
                            </div>
                        </div>

                        <div class="col-span-10 bg-gray-50 border border-gray-200 rounded-xl p-4 mr-2">
                            <div class="grid grid-cols-12 items-center gap-4">

                                <div class="col-span-6 space-y-2">
                                    <div class="flex items-center gap-3">
                                        <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
                                        <p class="text-sm text-gray-700">09:00 AM - 12:00 PM</p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
                                        <p class="text-sm text-gray-700">01:00 PM - 06:00 PM</p>
                                    </div>
                                </div>

                                <div class="col-span-2 space-y-2 text-center">
                                    <p class="text-xs text-gray-500">3 hrs worked</p>
                                    <p class="text-xs text-gray-500">5 hrs worked</p>
                                </div>

                                <div class="col-span-4 text-right space-y-2">
                                    <div class="bg-green-100/30 px-2 py-1 rounded-lg">
                                        <p class="text-xs text-green-600 font-medium">Present</p>
                                    </div>
                                    <div class="bg-green-100/30 px-2 py-1 rounded-lg">
                                        <p class="text-xs text-green-600 font-medium">Present</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>



<!-- Upcoming Events -->
<div class="bg-white border border-gray-200 rounded-2xl p-4 md:p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-bold text-gray-900">Upcoming Events</h3>
        <span class="text-sm text-gray-500 font-medium">Jan 20 – Jan 26</span>
    </div>

    <ul class="space-y-4">
        <li class="bg-white rounded-xl border-2 border-gray-200 p-4 hover:shadow-sm transition-shadow flex items-center gap-4">
            <span class="w-8 h-8 bg-orange-100 text-orange-500 flex items-center justify-center rounded border-2 border-orange-500">
                <i class="fa fa-calendar"></i>
            </span>

            <div class="flex flex-col">
                <p class="font-semibold text-gray-900">Team Meeting</p>
                <p class="text-sm text-gray-600">Today – 2:00 PM, Conference Room A</p>
            </div>
        </li>

        <li class="bg-white rounded-xl border-2 border-gray-200 p-4 hover:shadow-sm transition-shadow flex items-center gap-4">
            <span class="w-8 h-8 bg-green-100 text-green-500 flex items-center justify-center rounded border-2 border-green-500">
                <i class="fa fa-calendar"></i>
            </span>

            <div class="flex flex-col">
                <p class="font-semibold text-gray-900">Project Review</p>
                <p class="text-sm text-gray-600">Tomorrow – 10:00 AM, Conference Room B</p>
            </div>
        </li>


        <li class="bg-white rounded-xl border-2 border-gray-200 p-4 hover:shadow-sm transition-shadow flex items-center gap-4">
            <span class="w-8 h-8 bg-purple-100 text-purple-500 flex items-center justify-center rounded border-2 border-purple-500">
                <i class="fa fa-calendar"></i>
            </span>

            <div class="flex flex-col">
                <p class="font-semibold text-gray-900">Training Session</p>
                <p class="text-sm text-gray-600">Jan 25 – 3:00 PM, Online</p>
            </div>
        </li>

    </ul>
</div>


    </div>
</div>

    </main>
</div>

<script>
    // Handle sidebar state changes and adjust layout
    const sidebar = document.querySelector('aside');
    const main = document.querySelector('main');
    
    if (sidebar && main) {
        sidebar.addEventListener('mouseenter', function() {
            main.classList.remove('ml-16');
            main.classList.add('ml-56');
        });
        
        sidebar.addEventListener('mouseleave', function() {
            main.classList.remove('ml-56');
            main.classList.add('ml-16');
        });
    }
</script>

</body>
</html>
