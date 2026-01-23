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

    <!-- Employees -->
    <a href="{{ route('admin.adminEmployee') }}"
       class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
       {{ request()->routeIs('admin.adminEmployee')
            ? 'bg-green-600 text-white hover:bg-green-700'
            : 'text-white hover:bg-green-600/30' }}">
        <i class="fa-solid fa-users"></i>
        Employees
    </a>

    <!-- Attendance -->
    <a href="{{ route('admin.adminAttendance') }}"
       class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
       {{ request()->routeIs('admin.adminAttendance')
            ? 'bg-green-600 text-white hover:bg-green-700'
            : 'text-white hover:bg-green-600/30' }}">
        <i class="fa-solid fa-calendar-check"></i>
        Attendance
    </a>

    <!-- Leave -->
    <a href="{{ route('admin.adminLeaveManagement') }}"
       class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
       {{ request()->routeIs('admin.adminLeaveManagement')
            ? 'bg-green-600 text-white hover:bg-green-700'
            : 'text-white hover:bg-green-600/30' }}">
        <i class="fa-solid fa-clipboard"></i>
        Leave Management
    </a>

    <!-- Hiring (Dropdown) -->
    <div x-data="{ open: false }" class="space-y-1">
      <button
        @click="open = !open"
        class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg font-medium transition
        text-white hover:bg-green-600/30"
      >
        <span class="flex items-center gap-3">
          <i class="fa-solid fa-briefcase"></i>
          Hiring
        </span>

        <i class="fa-solid fa-chevron-down transition-transform"
          :class="{ 'rotate-180': open }"></i>
      </button>

      <!-- Submenu -->
      <div x-show="open" x-collapse class="ml-8 space-y-1">

        <a href="{{ route('admin.adminApplicant') }}"
          class="flex items-center gap-2 px-4 py-2 rounded-md text-sm text-white hover:bg-green-600/30">
          <i class="fa-solid fa-user-check"></i>
          Applicant
        </a>

        <a href="{{ route('admin.adminPosition') }}"
          class="flex items-center gap-2 px-4 py-2 rounded-md text-sm text-white hover:bg-green-600/30">
          <i class="fa-solid fa-briefcase"></i>
          Job Position
        </a>

        <a href="{{ route('admin.admininterview') }}"
          class="flex items-center gap-2 px-4 py-2 rounded-md text-sm text-white hover:bg-green-600/30">
          <i class="fa-solid fa-comments"></i>
          Interview
        </a>

      </div>
    </div>


    <!-- Reports -->
    <a href="{{ route('admin.adminReports') }}"
       class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
       {{ request()->routeIs('admin.adminReports')
            ? 'bg-green-600 text-white hover:bg-green-700'
            : 'text-white hover:bg-green-600/30' }}">
        <i class="fa-solid fa-chart-line"></i>
        Reports
    </a>

  </nav>

  <!-- Profile -->
  <div class="px-6 py-4 border-t border-slate-800 flex items-center gap-3">
    <div class="w-9 h-9 rounded-full bg-emerald-500 flex items-center justify-center text-white font-semibold">AS</div>
    <div class="text-sm">
      <p class="font-medium">Admin Sarah</p>
      <p class="text-slate-400">HR Manager</p>
    </div>
  </div>
</aside>
