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

<!-- Page Title -->
<div class="flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Job Postings</h1>
        <p class="text-slate-500 text-sm">Manage and create job openings</p>
    </div>

    <div class="flex items-center gap-4">
        <div class="relative">
            <i class="fa fa-search absolute left-3 top-3 text-slate-400 text-sm"></i>
            <input
                type="text"
                placeholder="Search applicants..."
                class="pl-9 pr-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none"
            />
        </div>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
            + Add Applicant
        </button>
    </div>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <div class="flex justify-between items-center">
            <span class="text-sm text-slate-500">Open Positions</span>
            <span class="text-xs bg-indigo-100 text-indigo-600 px-2 py-1 rounded-full">Active</span>
        </div>
        <p class="text-3xl font-bold mt-4">12</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm">
        <div class="flex justify-between items-center">
            <span class="text-sm text-slate-500">Total Views</span>
            <span class="text-xs bg-purple-100 text-purple-600 px-2 py-1 rounded-full">+24%</span>
        </div>
        <p class="text-3xl font-bold mt-4">1,248</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm">
        <div class="flex justify-between items-center">
            <span class="text-sm text-slate-500">New Applications</span>
            <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">This Week</span>
        </div>
        <p class="text-3xl font-bold mt-4">87</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm">
        <div class="flex justify-between items-center">
            <span class="text-sm text-slate-500">Days to Fill</span>
            <span class="text-xs bg-orange-100 text-orange-600 px-2 py-1 rounded-full">Avg</span>
        </div>
        <p class="text-3xl font-bold mt-4">14</p>
    </div>
</div>

<!-- Job Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Frontend Job -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-lg font-semibold">Senior Frontend Developer</h3>
                <p class="text-sm text-slate-500">Engineering • Full-Time • Remote</p>
            </div>
            <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full">Active</span>
        </div>

        <p class="text-slate-600 text-sm mt-4">
            We're looking for an experienced frontend developer to build amazing user experiences.
        </p>

        <div class="flex gap-2 mt-4 flex-wrap">
            <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-600 rounded-full">React</span>
            <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-600 rounded-full">TypeScript</span>
            <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-600 rounded-full">Tailwind</span>
        </div>

        <div class="flex justify-between items-center mt-6">
            <span class="text-xs text-slate-500">
                <i class="fa fa-users mr-1"></i> 24 Applicants • Posted 5 days ago
            </span>

            <div class="flex gap-2">
                <button onclick="window.location.href='/system/show/position'" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm">View Details</button>
                <button onclick="window.location.href='/system/edit/position'" class="border px-4 py-2 rounded-lg text-sm">Edit</button>
            </div>
        </div>
    </div>

    <!-- Backend Job -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-lg font-semibold">Backend Engineer</h3>
                <p class="text-sm text-slate-500">Engineering • Full-Time • Hybrid</p>
            </div>
            <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full">Active</span>
        </div>

        <p class="text-slate-600 text-sm mt-4">
            Join our backend team to design and build scalable APIs and microservices.
        </p>

        <div class="flex gap-2 mt-4 flex-wrap">
            <span class="px-3 py-1 text-xs bg-green-100 text-green-600 rounded-full">Node.js</span>
            <span class="px-3 py-1 text-xs bg-green-100 text-green-600 rounded-full">AWS</span>
            <span class="px-3 py-1 text-xs bg-green-100 text-green-600 rounded-full">Docker</span>
        </div>

        <div class="flex justify-between items-center mt-6">
            <span class="text-xs text-slate-500">
                <i class="fa fa-users mr-1"></i> 18 Applicants • Posted 3 days ago
            </span>

        <div class="flex gap-2">
            <a href="#"
            class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm inline-flex items-center justify-center">
                View Details
            </a>

            <a href="#"
            class="border px-4 py-2 rounded-lg text-sm inline-flex items-center justify-center">
                Edit
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
