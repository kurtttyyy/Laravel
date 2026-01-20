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
     @include('components.adminHeader')

    <!-- Dashboard Content -->
    <div class="p-8 space-y-6">

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="relative bg-white rounded-2xl p-6 border border-gray-200 flex items-center justify-center">
        <div class="text-center">
            <div class="text-4xl font-bold text-gray-800">0</div>
            <div class="text-sm text-gray-500 mt-1">Present</div>
        </div>
    </div>

    <div class="relative bg-white rounded-2xl p-6 border border-gray-200 flex items-center justify-center">
        <div class="text-center">
            <div class="text-4xl font-bold text-gray-800">0</div>
            <div class="text-sm text-gray-500 mt-1">Absent</div>
        </div>
    </div>

    <div class="relative bg-white rounded-2xl p-6 border border-gray-200 flex items-center justify-center">
        <div class="text-center">
            <div class="text-4xl font-bold text-gray-800">0</div>
            <div class="text-sm text-gray-500 mt-1">Leave</div>
        </div>
    </div>

    <div class="relative bg-white rounded-2xl p-6 border border-gray-200 flex items-center justify-center">
        <div class="text-center">
            <div class="text-4xl font-bold text-gray-800">0</div>
            <div class="text-sm text-gray-500 mt-1">Total</div>
        </div>
    </div>
</div>



  <div class="bg-white rounded-xl border border-gray-200 p-6 max-full mx-auto">

    <!-- Upload Box -->
    <div class="border-2 border-dashed border-blue-300 rounded-lg p-6 flex flex-col items-center justify-center text-center hover:bg-blue-50 transition">
      <i class="fa-solid fa-cloud-arrow-up text-3xl text-blue-500 mb-2"></i>
      <p class="text-sm text-blue-600 font-medium">Browse Excel file to upload</p>
      <p class="text-xs text-gray-400 mt-1">(.xls, .xlsx)</p>
    </div>

    <!-- Upload Button -->
    <div class="flex justify-end mt-4">
      <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition cursor-not-allowed opacity-90"
      >
        <i class="fa-solid fa-download mr-2"></i>
        Upload Excel
      </button>
    </div>

    <!-- Scan Status Container -->
    <div class="bg-white border-2 border-gray-200 rounded-xl p-6 mt-6 relative">

      <!-- Top Right Button -->
      <button
        class="absolute top-4 right-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition cursor-not-allowed opacity-90"
      >
        <i class="fa-solid fa-magnifying-glass mr-2"></i>
        Scan Excel
      </button>

      <!-- Header -->
      <div class="flex items-center justify-between mb-6">
        <h3 class="text-sm font-semibold text-gray-700">Files Status</h3>

        <!-- Date Filter -->
        <div class="flex items-center gap-2 mr-32" style="margin-top: -7px;">
          <label class="text-sm text-gray-600">From Date:</label>
          <input
            type="date"
            class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
          />
        </div>
      </div>

      <!-- Content -->
      <div class="space-y-3">

        <!-- Scanning -->
        <div class="flex items-center gap-3 bg-blue-50 p-3 rounded-lg">
          <i class="fa-solid fa-file-excel text-green-600 text-xl"></i>

          <div class="flex-1">
            <p class="text-sm font-medium">
              attendance.xlsx
              <span class="text-gray-400">· Scanning</span>
            </p>
            <div class="w-full bg-blue-200 h-2 rounded mt-1">
              <div class="bg-blue-500 h-2 rounded w-2/3"></div>
            </div>
          </div>
          <span class="text-sm text-gray-500">67%</span>

          <!-- Date -->
          <div class="text-right text-xs text-gray-500 min-w-[120px]">
            Jan 26, 2026<br>
            3:45 PM
          </div>

        </div>

        <!-- Scanned -->
        <div class="flex items-center gap-3 bg-blue-50 p-3 rounded-lg">
          <i class="fa-solid fa-file-excel text-green-600 text-xl"></i>

          <div class="flex-1">
            <p class="text-sm font-medium">
              employees.xlsx
              <span class="text-gray-400">· Scanned</span>
            </p>
            <p class="text-xs text-gray-500">124 rows processed</p>
          </div>
          <i class="fa-solid fa-check text-green-600"></i>

          <!-- Date -->
          <div class="text-right text-xs text-gray-500 min-w-[120px]">
            Jan 25, 2026<br>
            2:10 PM
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
