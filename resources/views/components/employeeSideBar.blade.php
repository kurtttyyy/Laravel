<!-- resources/views/components/sidebar.blade.php -->
<aside class="w-56 bg-white border-r border-gray-200 fixed left-0 top-0 h-screen overflow-y-auto">

    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center flex-shrink-0">
                <img src="{{ asset('images/logo.webp') }}" alt="Logo" height="70">
            </div>
            <div>
                <h1 class="text-sm font-bold text-gray-900">Northeastern College</h1>
                <p class="text-xs text-gray-600">Employee Portal</p>
            </div>
        </div>
    </div>

    <nav class="p-4 space-y-2">

        <!-- Dashboard -->
        <a href="{{ route('employee.employeeHome') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
           {{ request()->routeIs('employee.employeeHome')
                ? 'bg-green-600 text-white hover:bg-green-700'
                : 'text-gray-700 hover:bg-green-600/30' }}">
            <i class="fa fa-dashboard"></i>
            Dashboard
        </a>

        <!-- My Profile -->
        <a href="{{ route('employee.employeeProfile') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
           {{ request()->routeIs('employee.employeeProfile')
                ? 'bg-green-600 text-white hover:bg-green-700'
                : 'text-gray-700 hover:bg-green-600/30' }}">
            <i class="fa fa-user"></i>
            My Profile
        </a>

        <!-- Leave Requests -->
        <a href="{{ route('employee.employeeLeave') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
           {{ request()->routeIs('employee.employeeLeave')
                ? 'bg-green-600 text-white hover:bg-green-700'
                : 'text-gray-700 hover:bg-green-600/30' }}">
            <i class="fa fa-calendar"></i>
            Leave Requests
        </a>

        <!-- Payslips -->
        <a href="{{ route('employee.employeePayslip') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
           {{ request()->routeIs('employee.employeePayslip')
                ? 'bg-green-600 text-white hover:bg-green-700'
                : 'text-gray-700 hover:bg-green-600/30' }}">
            <i class="fa fa-file-text-o"></i>
            Payslips
        </a>

        <!-- Documents -->
        <a href="{{ route('employee.employeeDocument') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
           {{ request()->routeIs('employee.employeeDocument')
                ? 'bg-green-600 text-white hover:bg-green-700'
                : 'text-gray-700 hover:bg-green-600/30' }}">
            <i class="fa fa-folder"></i>
            Documents
        </a>

        <!-- Communication -->
        <a href="{{ route('employee.employeeCommunication') }}"
           class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition
           {{ request()->routeIs('employee.employeeCommunication')
                ? 'bg-green-600 text-white hover:bg-green-700'
                : 'text-gray-700 hover:bg-green-600/30' }}">
            <i class="fa fa-users"></i>
            Communication
        </a>

    </nav>

</aside>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
