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


<div class="p-8 space-y-6 bg-white rounded-2xl border border-gray-200"> 
    <!-- Leave Application Form -->
    <div>
        <h3 class="text-xl font-bold text-gray-900 mb-4">Apply for Leave</h3>

        <form method="POST" action="{{ url('/leave/apply') }}" class="space-y-6">
            @csrf

            <!-- LEAVE APPLICATION FORM -->
            <div class="border border-gray-300 p-6 rounded-lg space-y-4">

                <h4 class="text-center font-semibold text-gray-800 mb-6 tracking-wide uppercase">
                    LEAVE APPLICATION FORM
                </h4>

                <!-- Top Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium">Office / Department</label>
                        <input type="text" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Name (Last, First, Middle)</label>
                        <input type="text" class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-medium">Date of Filing</label>
                        <input type="date" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Position</label>
                        <input type="text" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Salary</label>
                        <input type="text" class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <!-- DETAILS OF APPLICATION -->
                <div class="border-t pt-4">
                    <h5 class="font-semibold mb-8 text-center tracking-wide uppercase">DETAILS OF APPLICATION</h5>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Left Column -->
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm font-medium">Type of Leave</label>
                                <div class="space-y-1 text-sm">
                                    <label><input type="checkbox" class="mr-2">Vacation</label><br>
                                    <label><input type="checkbox" class="mr-2">Sick</label><br>
                                    <label><input type="checkbox" class="mr-2">Maternity</label><br>
                                    <label><input type="checkbox" class="mr-2">Paternity</label><br>
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox">
                                        Others
                                        <input type="text" class="border rounded px-2 py-1 w-full">
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium">
                                    Number of working days applied for
                                </label>
                                <input type="number" class="w-full border rounded px-3 py-2">
                            </div>

                            <div>
                                <label class="text-sm font-medium">Inclusive Dates</label>
                                <input type="text" class="w-full border rounded px-3 py-2">
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm font-medium">
                                    Where leave will be spent
                                </label>
                                <div class="space-y-1 text-sm">
                                    <label><input type="checkbox" class="mr-2">Within the Philippines</label><br>
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox">
                                        Abroad
                                        <input type="text" class="border rounded px-2 py-1 w-full">
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium">In case of sick leave</label>
                                <div class="space-y-1 text-sm">
                                    <label><input type="checkbox" class="mr-2">In hospital</label><br>
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox">
                                        Outpatient
                                        <input type="text" class="border rounded px-2 py-1 w-full">
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium">Commutation</label>
                                <div class="space-y-1 text-sm">
                                    <label><input type="radio" name="commutation" class="mr-2">Requested</label><br>
                                    <label><input type="radio" name="commutation" class="mr-2">Not Requested</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Signature -->
                <div class="flex justify-end pt-4">
                    <div class="w-full md:w-1/2">
                        <label class="text-sm font-medium">Signature of Applicant</label>
                        <input type="text" class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <!-- DETAILS ON ACTION OF APPLICATION -->
                <div class="border-t pt-6 space-y-4">
                    <h5 class="font-semibold">DETAILS ON ACTION OF APPLICATION</h5>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Leave Credits -->
                        <div>
                            <label class="text-sm font-medium">
                                Certification of Leave Credits (As of)
                            </label>
                            <input type="date" class="w-full border rounded px-3 py-2 mt-1">

                            <table class="w-full border text-sm mt-3">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-2 py-1"></th>
                                        <th class="border px-2 py-1">Vacation</th>
                                        <th class="border px-2 py-1">Sick</th>
                                        <th class="border px-2 py-1">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border px-2 py-1">Beginning Balance</td>
                                        <td class="border px-2 py-1"></td>
                                        <td class="border px-2 py-1"></td>
                                        <td class="border px-2 py-1"></td>
                                    </tr>
                                    <tr>
                                        <td class="border px-2 py-1">Add: Earned Leave/s</td>
                                        <td class="border px-2 py-1"></td>
                                        <td class="border px-2 py-1"></td>
                                        <td class="border px-2 py-1"></td>
                                    </tr>
                                    <tr>
                                        <td class="border px-2 py-1">Less: Applied Leave/s</td>
                                        <td class="border px-2 py-1"></td>
                                        <td class="border px-2 py-1"></td>
                                        <td class="border px-2 py-1"></td>
                                    </tr>
                                    <tr>
                                        <td class="border px-2 py-1 font-semibold">Ending Balance</td>
                                        <td class="border px-2 py-1"></td>
                                        <td class="border px-2 py-1"></td>
                                        <td class="border px-2 py-1"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Recommendation -->
                        <div class="space-y-3">
                            <label class="text-sm font-medium">Recommendation</label>

                            <label class="block text-sm">
                                <input type="radio" name="recommendation" class="mr-2">
                                Approved
                            </label>

                            <label class="block text-sm">
                                <input type="radio" name="recommendation" class="mr-2">
                                Disapproved due to:
                            </label>

                            <textarea
                                class="w-full border rounded px-3 py-2"
                                rows="3"
                            ></textarea>

                            <div>
                                <label class="text-sm font-medium">
                                    Signature of Immediate Supervisor
                                </label>
                                <input type="text" class="w-full border rounded px-3 py-2">
                            </div>
                        </div>
                    </div>

                    <!-- Final Approval -->
                    <div class="border-t pt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-medium">Approved for:</label>
                            <input type="text" placeholder="Day(s) with pay" class="w-full border rounded px-3 py-2">
                            <input type="text" placeholder="Day(s) without pay" class="w-full border rounded px-3 py-2">
                            <input type="text" placeholder="Others (please specify)" class="w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="text-sm font-medium">Disapproved due to:</label>
                            <textarea class="w-full border rounded px-3 py-2" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <!-- HR & PRESIDENT APPROVAL -->
<div class="border-t pt-6 space-y-6">

    <!-- Signatories -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-sm pt-6">

        <!-- Director of HR -->
        <div class="text-center space-y-2">
            <div class="border-b border-gray-400"></div>
            <p class="font-semibold">Director of Human Resources</p>
        </div>

        <!-- President -->
        <div class="text-center space-y-2">
            <div class="border-b border-gray-400"></div>
            <p class="font-semibold">President</p>
        </div>

    </div>

    <!-- Single Date -->
    <div class="flex justify-center pt-4">
        <div class="w-full md:w-1/3 text-center">
            <label class="block text-sm font-medium">Date</label>
            <input
                type="date"
                class="w-full border rounded px-3 py-2 mt-1 text-sm"
            >
        </div>
    </div>

</div>


            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                >
                    Submit Application
                </button>
            </div>
            
        </form>
    </div>
</div>


</div>








    </div>
</div>

    </main>
</div>

</body>
</html>
