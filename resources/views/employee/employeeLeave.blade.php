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


            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fa fa-calendar fa-2x"></i>
            </div>
            <h3 class="text-4xl font-bold text-gray-900 mb-1 mt-7">18</h3>
            <p class="text-gray-600 text-sm mb-4">Annual Leave</p>
            <p class="text-gray-500 text-xs mt-4">of 25 days</p>
        </div>


    <!-- Attendance Card -->
        <div class="relative bg-white rounded-2xl p-6 border border-gray-200">

            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fa fa-bed fa-2x"></i>
            </div>
            <h3 class="text-4xl font-bold text-gray-900 mb-1 mt-7">10</h3>
            <p class="text-gray-600 text-sm mb-1">Sick Leave</p>
            <p class="text-gray-500 text-xs mt-4">of 10 days</p>
        </div>


        <!-- Events Card -->
        <div class="relative bg-white rounded-2xl p-6 border border-gray-200">

            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fa fa-calendar-o fa-2x"></i>
            </div>
            <h3 class="text-4xl font-bold text-gray-900 mb-1 mt-7">3</h3>
            <p class="text-gray-600 text-sm mb-1">Personal Days</p>
            <p class="text-gray-500 text-xs mt-4">of 5 days</p>
        </div>

        <!-- Salary Card -->
        <div class="relative bg-white rounded-2xl p-6 border border-gray-200">

            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <i class="fa fa-hourglass-half fa-2x"></i>
            </div>
            <h3 class="text-4xl font-bold text-gray-900 mb-1 mt-7">7</h3>
            <p class="text-gray-600 text-sm mb-1">Days Used</p>
            <p class="text-gray-500 text-xs mt-4">this years</p>
        </div>

</div>

<div class="p-8 space-y-6 bg-white rounded-2xl border border-gray-200 flex flex-col md:flex-row gap-6">

    <!-- Left Filter Sidebar -->
<div class="w-full md:w-1/4 bg-gray-50 border border-gray-200 rounded-lg p-4 space-y-2">
    <h4 class="font-semibold text-gray-700 mb-4">Select Form</h4>
    <ul class="space-y-2 text-sm">
        <li>
            <button 
                onclick="showForm('leaveForm')"
                class="w-full text-left px-2 py-1 rounded hover:bg-blue-100">
                LEAVE APPLICATION FORM
            </button>
        </li>
        <li>
            <button 
                onclick="showForm('officialForm')"
                class="w-full text-left px-2 py-1 rounded hover:bg-blue-100">
                APPLICATION FOR OFFICIAL BUSINESS / OFFICIAL TIME
            </button>
        </li>
    </ul>
</div>



<div class="p-8 space-y-6 bg-white rounded-2xl border border-gray-200"> 
    <!-- Leave Application Form -->
    <div>
        <h3 class="text-xl font-bold text-gray-900 mb-4">Apply for Leave</h3>
        @include('requestForm.applicationOBF')

    </div>
</div>


</div>








    </div>
</div>

    </main>
</div>

</body>
</html>
