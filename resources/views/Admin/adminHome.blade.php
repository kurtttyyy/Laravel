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
     @include('components.adminHeader.dashboardHeader')

    <!-- Dashboard Content -->
    <div class="p-8 space-y-6">

      <!-- Stats -->
      <div class="grid grid-cols-4 gap-6">
        <div class="bg-white rounded-xl p-5 flex justify-between items-center">
          <div>
            <p class="text-sm text-slate-500">Total Employees</p>
            <h2 class="text-2xl font-semibold">1,248</h2>
            <p class="text-sm text-emerald-500">↑ +12% this month</p>
          </div>
          <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center">
            <i class="fa-solid fa-users"></i>
          </div>
        </div>

        <div class="bg-white rounded-xl p-5 flex justify-between items-center">
          <div>
            <p class="text-sm text-slate-500">Present Today</p>
            <h2 class="text-2xl font-semibold">1,180</h2>
            <p class="text-sm text-slate-500">94.5% attendance rate</p>
          </div>
          <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
            <i class="fa-solid fa-check"></i>
          </div>
        </div>

        <div class="bg-white rounded-xl p-5 flex justify-between items-center">
          <div>
            <p class="text-sm text-slate-500">On Leave</p>
            <h2 class="text-2xl font-semibold">68</h2>
            <p class="text-sm text-orange-500">12 pending requests</p>
          </div>
          <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center">
            <i class="fa-solid fa-calendar"></i>
          </div>
        </div>

        <div class="bg-white rounded-xl p-5 flex justify-between items-center">
          <div>
            <p class="text-sm text-slate-500">Open Positions</p>
            <h2 class="text-2xl font-semibold">24</h2>
            <p class="text-sm text-purple-500">156 applications</p>
          </div>
          <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center">
            <i class="fa-solid fa-briefcase"></i>
          </div>
        </div>
      </div>

      <!-- Middle Section -->
      <div class="grid grid-cols-3 gap-6">

        <!-- Recent Employees -->
        <div class="col-span-2 bg-white rounded-xl p-6">
          <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold">Recent Employees</h3>
            <button class="text-sm text-emerald-600 bg-emerald-50 px-3 py-1 rounded">View All</button>
          </div>

          <table class="w-full text-sm mb-6">
            <thead class="text-slate-500 border-b">
              <tr>
                <th class="py-2 text-left">Employee</th>
                <th class="text-left">Department</th>
                <th class="text-left">Status</th>
                <th class="text-left">Join Date</th>
              </tr>
            </thead>
            <tbody class="divide-y">
              <tr>
                <td class="py-3 flex items-center gap-3">
                  <div class="w-9 h-9 bg-blue-500 rounded-full text-white flex items-center justify-center">JD</div>
                  <div>
                    <p class="font-medium">John Doe</p>
                    <p class="text-xs text-slate-500">john.doe@company.com</p>
                  </div>
                </td>
                <td>Engineering</td>
                <td><span class="text-xs bg-emerald-100 text-emerald-600 px-2 py-1 rounded">Active</span></td>
                <td>Jan 15, 2024</td>
              </tr>

              <tr>
                <td class="py-3 flex items-center gap-3">
                  <div class="w-9 h-9 bg-pink-500 rounded-full text-white flex items-center justify-center">SW</div>
                  <div>
                    <p class="font-medium">Sarah Wilson</p>
                    <p class="text-xs text-slate-500">sarah.w@company.com</p>
                  </div>
                </td>
                <td>Marketing</td>
                <td><span class="text-xs bg-emerald-100 text-emerald-600 px-2 py-1 rounded">Active</span></td>
                <td>Jan 12, 2024</td>
              </tr>

              <tr>
                <td class="py-3 flex items-center gap-3">
                  <div class="w-9 h-9 bg-orange-500 rounded-full text-white flex items-center justify-center">MC</div>
                  <div>
                    <p class="font-medium">Mike Chen</p>
                    <p class="text-xs text-slate-500">mike.chen@company.com</p>
                  </div>
                </td>
                <td>Finance</td>
                <td><span class="text-xs bg-orange-100 text-orange-600 px-2 py-1 rounded">On Leave</span></td>
                <td>Jan 10, 2024</td>
              </tr>

            </tbody>
          </table>

          <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold">New Account Employees</h3>
            <button class="text-sm text-emerald-600 bg-emerald-50 px-3 py-1 rounded">View All</button>
          </div>

<table class="w-full text-sm">
  <thead class="text-slate-500 border-b">
    <tr>
      <th class="py-2 text-left">Employee</th>
      <th class="text-left"></th>
      <th class="text-left">Action</th>
      <th class="text-left">Join Date</th>
    </tr>
  </thead>
  <tbody class="divide-y">
    <tr>
      <td class="py-3 flex items-center gap-3">
        <div class="w-9 h-9 bg-blue-500 rounded-full text-white flex items-center justify-center">JD</div>
        <div>
          <p class="font-medium">John Doe</p>
          <p class="text-xs text-slate-500">john.doe@company.com</p>
        </div>
      </td>
      <td></td>
      <td class="flex gap-2">
        <button class="text-xs bg-emerald-100 text-emerald-600 px-2 py-1 rounded hover:bg-emerald-200">Accept</button>
        <button class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded hover:bg-red-200">Declined</button>
      </td>
      <td>Jan 15, 2024</td>
    </tr>

    <tr>
      <td class="py-3 flex items-center gap-3">
        <div class="w-9 h-9 bg-pink-500 rounded-full text-white flex items-center justify-center">SW</div>
        <div>
          <p class="font-medium">Sarah Wilson</p>
          <p class="text-xs text-slate-500">sarah.w@company.com</p>
        </div>
      </td>
      <td></td>
      <td class="flex gap-2">
        <button class="text-xs bg-emerald-100 text-emerald-600 px-2 py-1 rounded hover:bg-emerald-200">Accept</button>
        <button class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded hover:bg-red-200">Declined</button>
      </td>
      <td>Jan 12, 2024</td>
    </tr>

    <tr>
      <td class="py-3 flex items-center gap-3">
        <div class="w-9 h-9 bg-orange-500 rounded-full text-white flex items-center justify-center">MC</div>
        <div>
          <p class="font-medium">Mike Chen</p>
          <p class="text-xs text-slate-500">mike.chen@company.com</p>
        </div>
      </td>
      <td></td>
      <td class="flex gap-2">
        <button class="text-xs bg-emerald-100 text-emerald-600 px-2 py-1 rounded hover:bg-emerald-200">Accept</button>
        <button class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded hover:bg-red-200">Declined</button>
      </td>
      <td>Jan 10, 2024</td>
    </tr>
  </tbody>
</table>

        </div>


        

        <!-- Right Column -->
        <div class="space-y-6">

          <!-- Leave Requests -->
          <div class="bg-white rounded-xl p-6">
            <div class="flex justify-between items-center mb-4">
              <h3 class="font-semibold">Leave Requests</h3>
              <span class="w-6 h-6 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
            </div>

            <div class="space-y-4">
              <div class="border rounded-lg p-4">
                <div class="flex justify-between items-center">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-blue-500 rounded-full text-white flex items-center justify-center">RL</div>
                    <div>
                      <p class="font-medium">Robert Lee</p>
                      <p class="text-xs text-slate-500">Sick Leave · Jan 20–22</p>
                    </div>
                  </div>
                  <span class="text-xs bg-orange-100 text-orange-600 px-2 py-1 rounded">Pending</span>
                </div>
                <div class="flex gap-2 mt-3">
                  <button class="flex-1 bg-emerald-500 text-white py-1.5 rounded">Approve</button>
                  <button class="flex-1 bg-slate-100 py-1.5 rounded">Decline</button>
                </div>
              </div>

              <div class="border rounded-lg p-4">
                <div class="flex justify-between items-center">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-pink-500 rounded-full text-white flex items-center justify-center">AP</div>
                    <div>
                      <p class="font-medium">Anna Park</p>
                      <p class="text-xs text-slate-500">Vacation · Jan 25–30</p>
                    </div>
                  </div>
                  <span class="text-xs bg-orange-100 text-orange-600 px-2 py-1 rounded">Pending</span>
                </div>
                <div class="flex gap-2 mt-3">
                  <button class="flex-1 bg-emerald-500 text-white py-1.5 rounded">Approve</button>
                  <button class="flex-1 bg-slate-100 py-1.5 rounded">Decline</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Department Overview -->
          <div class="bg-white rounded-xl p-6">
            <h3 class="font-semibold mb-4">Department Overview</h3>

            <div class="space-y-3 text-sm">
              <div>
                <div class="flex justify-between"><span>Engineering</span><span>342</span></div>
                <div class="h-2 bg-slate-100 rounded mt-1"><div class="h-2 bg-emerald-500 rounded w-[70%]"></div></div>
              </div>
              <div>
                <div class="flex justify-between"><span>Marketing</span><span>186</span></div>
                <div class="h-2 bg-slate-100 rounded mt-1"><div class="h-2 bg-blue-500 rounded w-[45%]"></div></div>
              </div>
              <div>
                <div class="flex justify-between"><span>Sales</span><span>284</span></div>
                <div class="h-2 bg-slate-100 rounded mt-1"><div class="h-2 bg-orange-500 rounded w-[60%]"></div></div>
              </div>
              <div>
                <div class="flex justify-between"><span>Human Resources</span><span>98</span></div>
                <div class="h-2 bg-slate-100 rounded mt-1"><div class="h-2 bg-purple-500 rounded w-[30%]"></div></div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </main>
</div>

</body>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

</html>
