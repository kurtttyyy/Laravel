<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PeopleHub – HR Dashboard</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <style>
        body { font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, sans-serif; transition: margin-left 0.3s ease; }
        main { transition: margin-left 0.3s ease; }
        aside ~ main { margin-left: 16rem; }
  </style>
</head>
<body class="bg-slate-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
        @include('components.adminSideBar')


    <!-- Main Content -->
  <main class="flex-1 ml-16 transition-all duration-300">
    <!-- Header -->
     @include('components.adminHeader.leaveHeader')

    <!-- Dashboard Content -->
    <div class="p-8 space-y-6">



<div class="bg-gray-50 min-h-screen p-6">


    <!-- Leave Balance Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        <!-- Annual -->
        <div class="bg-white rounded-xl shadow p-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center text-green-600">
                    🌿
                </div>
                <span class="text-sm text-gray-500" style="margin-left: 245px;">Annual</span>
            </div>

            <p class="text-2xl font-bold">15</p>
            <p class="text-sm text-gray-500 mb-3">employees on leave</p>

        </div>

        <!-- Sick -->
        <div class="bg-white rounded-xl shadow p-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                    💙
                </div>
                <span class="text-sm text-gray-500" style="margin-left: 245px;">Sick</span>
            </div>

            <p class="text-2xl font-bold">8</p>
            <p class="text-sm text-gray-500 mb-3">employees on leave</p>

        </div>

        <!-- Personal -->
        <div class="bg-white rounded-xl shadow p-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center text-yellow-600">
                    🟡
                </div>
                <span class="text-sm text-gray-500" style="margin-left: 235px;">Personal</span>
            </div>

            <p class="text-2xl font-bold">3</p>
            <p class="text-sm text-gray-500 mb-3">employees on leave</p>

        </div>

        <!-- Study -->
        <div class="bg-white rounded-xl shadow p-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600">
                    🎓
                </div>
                <span class="text-sm text-gray-500" style="margin-left: 245px;">Study</span>
            </div>

            <p class="text-2xl font-bold">5</p>
            <p class="text-sm text-gray-500 mb-3">employees on leave</p>

        </div>

    </div>

    <!-- Request Leave -->
<div class="bg-white rounded-xl shadow p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

    <!-- Employee Info -->
    <div class="flex items-center gap-4">
        <!-- Avatar -->
        <div class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-semibold">
            JD
        </div>

        <div>
            <p class="font-medium text-gray-800">John Doe</p>
            <p class="text-sm text-gray-500">
                Annual Leave • Feb 10 – Feb 16, 2024
            </p>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-3">
        <button
            class="px-4 py-2 text-sm font-medium rounded-lg bg-green-500 text-white hover:bg-green-600 transition">
            Approve
        </button>

        <button
            class="px-4 py-2 text-sm font-medium rounded-lg bg-red-500 text-white hover:bg-red-600 transition">
            Decline
        </button>
    </div>

</div>


<!-- Leave History -->
<div class="bg-white rounded-xl shadow">
    <div class="p-4 border-b">
        <h3 class="font-semibold">Leave History</h3>
    </div>

    <div class="divide-y">

        <!-- Item - Approved -->
        <div class="p-4 flex justify-between items-center">
            <div class="flex gap-3">
                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                    🌴
                </div>
                <div>
                    <!-- EMPLOYEE NAME -->


                    <p class="font-medium">
                        Annual Leave
                        <span class="ml-2 text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">
                            Employee
                        </span>
                    </p>
                    <p class="text-sm font-semibold text-gray-700">Kurt Robin</p>
                    <p class="text-sm text-gray-500">
                        Feb 10, 2024 - Feb 16, 2024 • 5 days
                    </p>
                    <p class="text-sm text-gray-400">Vacation in Hawaii</p>
                </div>
            </div>

            <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full">
                Approved
            </span>
        </div>

        <!-- Item - Approved -->
        <div class="p-4 flex justify-between items-center">
            <div class="flex gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                    🩺
                </div>
                <div>

                    <p class="font-medium">
                        Sick Leave
                        <span class="ml-2 text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">
                            Employee
                        </span>
                    </p>
                    <p class="text-sm font-semibold text-gray-700">Maria Santos</p>
                    <p class="text-sm text-gray-500">
                        Jan 25, 2024 • 1 day
                    </p>
                    <p class="text-sm text-gray-400">Doctor appointment and flu</p>
                </div>
            </div>

            <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full">
                Approved
            </span>
        </div>

    </div>
</div>


</div>



    </div>
  </main>
</div>

</body>

<script>
  const sidebar = document.querySelector('aside');
  const main = document.querySelector('main');
  if (sidebar && main) {
    sidebar.addEventListener('mouseenter', function() {
      main.classList.remove('ml-16');
      main.classList.add('ml-64');
    });
    sidebar.addEventListener('mouseleave', function() {
      main.classList.remove('ml-64');
      main.classList.add('ml-16');
    });
  }
</script>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
</html>
