<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payslips | Employee Portal</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex min-h-screen">

 @include('components.employeeSidebar')

    <!-- MAIN CONTENT -->
    <main class="flex-1 ml-56">
    @include('components.employeeHeader', ['name' => 'Kurt', 'notifications' => 5])
<div class="p-8 space-y-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Payslips</h2>
                <p class="text-gray-500">View and download your salary information</p>
            </div>

        </div>

        <div class="bg-gradient-to-b from-green-900 to-green-500 rounded-2xl p-8 text-white shadow-lg">

            <div class="grid grid-cols-4 gap-6 text-center">

                <div>
                    <p class="text-sm opacity-80">Gross Salary</p>
                    <h3 class="text-3xl font-bold mt-2">₱6,500</h3>
                </div>

                <div>
                    <p class="text-sm opacity-80">Deductions</p>
                    <h3 class="text-3xl font-bold mt-2">₱1,250</h3>
                </div>

                <div>
                    <p class="text-sm opacity-80">Net Salary</p>
                    <h3 class="text-3xl font-bold mt-2">₱5,250</h3>
                </div>

                <div>
                    <p class="text-sm opacity-80">others</p>
                    <h3 class="text-3xl font-bold mt-2">₱3,000</h3>
                </div>

            </div>
        </div>

        <!-- RECENT PAYSLIPS -->
        <div class="mt-10 bg-white rounded-2xl shadow-sm border border-gray-200">
            <div class="p-6 border-b">
                <h3 class="text-xl font-semibold text-gray-800">Recent Payslips</h3>
            </div>

            <div class="p-6">
                <div class="flex justify-between items-center border border-gray-200 rounded-xl p-5">
                    <div>
                        <p class="font-semibold text-gray-800">January 2025</p>
                        <p class="text-sm text-gray-500">Paid on Jan 31, 2025</p>
                    </div>

                    <div class="text-right">
                        <p class="font-bold text-gray-800">₱5,250</p>
                        <a href="#" class="text-purple-600 text-sm font-medium hover:underline">
                            View
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </main>

</div>
</body>
</html>
