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
    body { font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, sans-serif; }
  </style>
</head>
<body class="bg-slate-100">

<div class="flex min-h-screen">

  <!-- Sidebar -->
    @include('components.adminSideBar')


  <!-- Main Content -->
  <main class="flex-1">

    <!-- Header -->
     @include('components.adminHeader.attendanceHeader')

    <!-- Dashboard Content -->
    <div class="p-8 space-y-6">

        <!-- STATS -->
<!-- STATS -->
<div class="grid grid-cols-4 gap-6 mb-8">

    <!-- Today -->
    <div class="relative bg-white p-6 rounded-xl border">
        <div class="absolute top-4 right-4 w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600">
            📅
        </div>
        <p class="text-sm text-slate-400">Today</p>
        <p class="text-3xl font-bold mt-2">5</p>
        <p class="text-sm text-slate-400">Today's Interviews</p>
    </div>

    <!-- Completed -->
    <div class="relative bg-white p-6 rounded-xl border">
        <div class="absolute top-4 right-4 w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center text-green-600">
            ✔️
        </div>
        <p class="text-sm text-green-500">+15%</p>
        <p class="text-3xl font-bold mt-2">42</p>
        <p class="text-sm text-slate-400">Completed This Month</p>
    </div>

    <!-- Upcoming -->
    <div class="relative bg-white p-6 rounded-xl border">
        <div class="absolute top-4 right-4 w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600">
            ⏰
        </div>
        <p class="text-sm text-orange-500">Upcoming</p>
        <p class="text-3xl font-bold mt-2">18</p>
        <p class="text-sm text-slate-400">Scheduled</p>
    </div>

    <!-- Rating -->
    <div class="relative bg-white p-6 rounded-xl border">
        <div class="absolute top-4 right-4 w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600">
            ⭐
        </div>
        <p class="text-sm text-purple-500">Avg</p>
        <p class="text-3xl font-bold mt-2">4.2</p>
        <p class="text-sm text-slate-400">Average Rating</p>
    </div>

</div>

        <!-- INTERVIEW LIST -->
        <div class="bg-white rounded-xl border p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-semibold text-lg">Interview Schedule</h2>

                <div class="flex gap-3">
                    <select class="border rounded-lg px-3 py-2">
                        <option>This Week</option>
                    </select>

                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
                        + Schedule New
                    </button>
                </div>
            </div>

            <p class="text-sm text-slate-400 mb-4">TODAY – JANUARY 15, 2024</p>

            <!-- CARD 1 -->
            <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-5 mb-4 flex justify-between">
                <div class="flex gap-6">
                    <div class="text-indigo-600 font-bold text-xl">
                        10:00
                        <p class="text-xs font-normal">AM</p>
                    </div>

                    <div>
                        <p class="font-semibold">Technical Interview – Sarah Mitchell</p>
                        <p class="text-sm text-slate-500">Senior Frontend Developer</p>
                        <p class="text-sm text-slate-400 mt-1">
                            ⏱ 60 minutes · 👥 John Doe, Jane Smith
                        </p>

                        <div class="mt-3 flex gap-3">
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm">
                                Join Meeting
                            </button>
                            <button class="border px-4 py-2 rounded-lg text-sm">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>

                <span class="bg-indigo-100 text-indigo-600 px-4 py-1 rounded-full text-sm h-fit">
                    In Progress
                </span>
            </div>

            <!-- CARD 2 -->
            <div class="bg-white border rounded-xl p-5 flex justify-between">
                <div class="flex gap-6">
                    <div class="font-bold text-xl">
                        14:00
                        <p class="text-xs font-normal">PM</p>
                    </div>

                    <div>
                        <p class="font-semibold">Phone Screening – James Chen</p>
                        <p class="text-sm text-slate-500">Backend Developer</p>
                        <p class="text-sm text-slate-400 mt-1">
                            ⏱ 30 minutes · 👤 John Doe
                        </p>

                        <div class="mt-3 flex gap-3">
                            <button class="bg-slate-100 px-4 py-2 rounded-lg text-sm">
                                Reschedule
                            </button>
                            <button class="border px-4 py-2 rounded-lg text-sm">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>

                <span class="bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-sm h-fit">
                    Scheduled
                </span>
            </div>

        </div>

    </div>
  </main>
</div>

</body>
</html>
