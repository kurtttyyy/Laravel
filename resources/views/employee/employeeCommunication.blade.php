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
    <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
    <!-- CARD 1 -->
    <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
        <div class="mx-auto w-24 h-24 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700
                    flex items-center justify-center text-white text-3xl font-semibold mb-4">
            DV
        </div>

        <h3 class="font-semibold text-lg">Dr. Viloria</h3>
        <p class="text-sm text-gray-500">HR Director</p>
        <p class="text-sm text-gray-400 mb-4">Human Resources</p>

        <span class="px-4 py-1 text-sm bg-green-100 text-green-600 rounded-full">
            Available
        </span>
    </div>

    <!-- CARD 2 -->
    <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
        <div class="mx-auto w-24 h-24 rounded-2xl bg-gradient-to-br from-purple-400 to-purple-600
                    flex items-center justify-center text-white text-3xl font-semibold mb-4">
            AN
        </div>

        <h3 class="font-semibold text-lg">Antoinette</h3>
        <p class="text-sm text-gray-500">HR Assistant</p>
        <p class="text-sm text-gray-400 mb-4">Human Resources</p>

        <span class="px-4 py-1 text-sm bg-green-100 text-green-600 rounded-full">
            Available
        </span>
    </div>

    <!-- CARD 3 -->
    <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
        <div class="mx-auto w-24 h-24 rounded-2xl bg-gradient-to-br from-green-400 to-green-600
                    flex items-center justify-center text-white text-3xl font-semibold mb-4">
            ML
        </div>

        <h3 class="font-semibold text-lg">Melody</h3>
        <p class="text-sm text-gray-500">HR Assistant</p>
        <p class="text-sm text-gray-400 mb-4">Human Resources</p>

        <span class="px-4 py-1 text-sm bg-green-100 text-green-600 rounded-full">
            Available
        </span>
    </div>
    </div>

    </main>

</div>
</body>
</html>


