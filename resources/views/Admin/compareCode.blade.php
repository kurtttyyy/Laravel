<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PeopleHub – HR Dashboard</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Alpine.js -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <style>
    body {
      font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }
  </style>
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

  <!-- Sidebar -->
  @include('components.adminSideBar')

  <!-- Main Content -->
  <main class="flex-1" x-data="{ openProfile: false, openEditProfile: false, tab: 'overview' }">

    <!-- Header -->
    @include('components.adminHeader')

    <!-- ================= DASHBOARD CONTENT ================= -->
    <div class="p-8 space-y-6">

      <!-- Search & Filter -->
      <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <input type="text"
               placeholder="Search by name, email, or department..."
               class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">

        <div class="flex items-center gap-2 text-sm">
          <span class="text-gray-500 font-medium">Filter:</span>
          <button class="px-4 py-1 rounded-full bg-gray-200">All Employees</button>
          <button class="px-4 py-1 rounded-full bg-blue-500 text-white">Active</button>
          <button class="px-4 py-1 rounded-full bg-gray-200">On Leave</button>
          <button class="px-4 py-1 rounded-full bg-gray-200">Remote</button>
        </div>
      </div>

      <!-- Status Summary -->
      <div class="flex gap-6 text-sm text-gray-600 font-medium">
        <span><span class="text-green-500 font-bold">1,180</span> Active</span>
        <span><span class="text-yellow-500 font-bold">68</span> On Leave</span>
        <span><span class="text-red-500 font-bold">324</span> Inactive</span>
      </div>

      <!-- ================= EMPLOYEE CARDS ================= -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        <!-- Employee Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
          <div class="h-24 bg-gradient-to-r from-purple-500 to-indigo-500 flex justify-center items-center">
            <div
              class="w-16 h-16 rounded-full bg-blue-500 text-white flex items-center justify-center text-lg font-bold shadow-md border-4 border-white mt-24">
              JD
            </div>
          </div>

          <div class="p-4 mt-7">
            <h3 class="font-bold text-gray-800 text-lg text-center">John Doe</h3>
            <p class="text-gray-500 text-sm text-center">Senior Software Engineer</p>
            <p class="text-gray-300 text-sm text-center">Engineering</p>

            <div class="mt-4 space-y-1 text-gray-500 text-sm">
              <div class="flex items-center gap-2">
                <i class="fa-regular fa-envelope"></i>
                john.doe@company.com
              </div>
              <div class="flex items-center gap-2">
                <i class="fa-solid fa-phone"></i>
                +1 (555) 123-4567
              </div>
            </div>

            <hr class="my-3">

            <div class="flex justify-between items-center">
              <span class="px-2 py-1 text-green-700 bg-green-100 rounded-full text-xs font-medium">
                Active
              </span>

              <button
                @click="openProfile = true"
                class="text-blue-500 text-sm font-medium hover:underline">
                View Profile
              </button>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- ================= PROFILE MODAL ================= -->
<div
  x-show="openProfile"
  x-transition
  @click.self="openProfile = false"
  class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
  style="display: none;"
>
  <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[80vh] flex flex-col overflow-y-auto overflow-hidden">

    <!-- Modal Header -->
    <div class="bg-gradient-to-r from-purple-500 to-indigo-500 p-6 text-white relative">
      <button
        @click="openProfile = false"
        class="absolute top-4 right-4 text-2xl">
        &times;
      </button>

      <div class="flex items-center gap-4">
        <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center text-xl font-bold">
          JD
        </div>

        <div>
          <h2 class="text-xl font-semibold">John Doe</h2>
          <p class="text-sm opacity-90">
            Senior Software Engineer<br>Engineering
          </p>
        </div>

        <span class="ml-auto bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
          Active
        </span>
      </div>
    </div>

    <!-- Tabs -->
    <div class="flex gap-6 px-6 pt-4 border-b text-sm">
      <button
        @click="tab = 'overview'"
        :class="tab === 'overview' ? 'text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2' : 'text-gray-500'"
      >
        Overview
      </button>

      <button
        @click="tab = 'personal'"
        :class="tab === 'personal' ? 'text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2' : 'text-gray-500'"
      >
        Personal Details
      </button>

      <button
        @click="tab = 'performance'"
        :class="tab === 'performance' ? 'text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2' : 'text-gray-500'"
      >
        Performance
      </button>

      <button
        @click="tab = 'documents'"
        :class="tab === 'documents' ? 'text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2' : 'text-gray-500'"
      >
        Documents
      </button>
    </div>

    <!-- Modal Content -->

    <!-- Overview -->
     @include('Admin.adminEmployeeOverview')


    <!-- Personal Details -->
     @include('Admin.adminEmployeePD')


    <!-- Performance -->
     @include('Admin.adminEmployeePerformance')

    <!-- Documents -->
     @include('Admin.adminEmployeeDocuments')


    <!-- Modal Footer -->
    <div class="flex gap-3 p-6 border-t">
        <button class="flex-1 bg-indigo-600 text-white py-2 rounded-lg">
          Send Message
        </button>
        <button class="flex-1 bg-slate-100 py-2 rounded-lg">
          Schedule Meeting
        </button>
      <button
        @click="openEditProfile = true"
        class="flex-1 bg-slate-100 py-2 rounded-lg hover:bg-slate-200"
      >
        Edit Profile
      </button>

    </div>

  </div>
</div>

<!-- Alpine.js CDN -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>



  </main>
</div>

</body>
</html>
