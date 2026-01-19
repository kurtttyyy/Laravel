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
    <a href="{{ route('employee.employeeHome') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-green-600 text-white font-medium cursor-pointer hover:bg-green-700 transition">
        <i class="fa fa-dashboard"></i>
        Dashboard
    </a>
    <a href="{{ route('employee.employeeProfile') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-700 hover:bg-green-600/30 cursor-pointer transition">
        <i class="fa fa-user"></i>
        My Profile
    </a>
    <a href="{{ route('employee.employeeLeave') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-700 hover:bg-green-600/30 cursor-pointer transition">
        <i class="fa fa-calendar"></i>
        Leave Requests
    </a>
    <a href="/payslips" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-700 hover:bg-green-600/30 cursor-pointer transition">
        <i class="fa fa-file-text-o"></i>
        Payslips
    </a>
    <a href="/documents" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-700 hover:bg-green-600/30 cursor-pointer transition">
        <i class="fa fa-folder"></i>
        Documents
    </a>
    <a href="/communication" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-700 hover:bg-green-600/30 cursor-pointer transition">
        <i class="fa fa-users"></i>
        Communication
    </a>
</nav>

</aside>

<!-- Add this in your main layout head if not already -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
