  <aside class="w-64 bg-slate-900 text-slate-200 flex flex-col">
    <div class="px-6 py-5 flex items-center gap-3 border-b border-slate-800">
      <div class="w-12 h-12 rounded overflow-hidden flex items-center justify-center">
        <img src="/images/logo.webp" alt="HR Logo" class="w-full h-full object-cover">
      </div>
      <span class="text-lg font-semibold">HR PORTAL</span>
    </div>


    <nav class="flex-1 px-4 py-6 space-y-2">
              <!-- Dashboard -->
        <a href="{{ route('admin.adminHome') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
           {{ request()->routeIs('admin.adminHome')
                ? 'bg-green-600 text-white hover:bg-green-700'
                : 'text-white hover:bg-green-600/30' }}">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>
        <a href="{{ route('admin.adminEmployee') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
           {{ request()->routeIs('admin.adminEmployee')
                ? 'bg-green-600 text-white hover:bg-green-700'
                : 'text-white hover:bg-green-600/30' }}">
            <i class="fa-solid fa-users"></i>
            Employees
        </a>
        <a href="{{ route('admin.adminAttendance') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
           {{ request()->routeIs('admin.adminAttendance')
                ? 'bg-green-600 text-white hover:bg-green-700'
                : 'text-white hover:bg-green-600/30' }}">
            <i class="fa-solid fa-calendar-check"></i>
            Attendance
        </a>
        <a href="{{ route('admin.adminLeaveManagement') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
           {{ request()->routeIs('admin.adminLeaveManagement')
                ? 'bg-green-600 text-white hover:bg-green-700'
                : 'text-white hover:bg-green-600/30' }}">
            <i class="fa-solid fa-clipboard"></i>
            Leave Management
        </a>
        <a href="{{ route('admin.adminReports') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
           {{ request()->routeIs('admin.adminReports')
                ? 'bg-green-600 text-white hover:bg-green-700'
                : 'text-white hover:bg-green-600/30' }}">
            <i class="fa-solid fa-chart-line"></i>
            Reports
        </a>
    </nav>

    <div class="px-6 py-4 border-t border-slate-800 flex items-center gap-3">
      <div class="w-9 h-9 rounded-full bg-emerald-500 flex items-center justify-center text-white font-semibold">AS</div>
      <div class="text-sm">
        <p class="font-medium">Admin Sarah</p>
        <p class="text-slate-400">HR Manager</p>
      </div>
    </div>
  </aside>

  <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
