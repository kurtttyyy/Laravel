<header class="bg-white border-b border-gray-200 sticky top-0 z-40 px-4 md:px-8 py-4 md:py-6 flex items-center justify-between backdrop-blur-sm">
    @php
        $activeAttendanceTab = $activeAttendanceTab ?? 'all';
    @endphp
    <div>
        <h2 class="text-3xl font-bold text-gray-900">Daily Attendance</h2>
        <p id="attendance-current-date" class="text-gray-600 mt-1">{{ now()->format('l, F j, Y') }}</p>
        @if ($activeAttendanceTab !== 'all')
            <a
                href="{{ route('admin.adminAttendance') }}"
                class="mt-3 inline-flex items-center gap-2 rounded-lg border border-gray-300 px-3 py-1.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
            >
                <i class=""></i>
                Back
            </a>
        @endif
    </div>
</header>

<script>
  (function () {
    const dateEl = document.getElementById('attendance-current-date');
    if (!dateEl) {
      return;
    }

    const updateDate = () => {
      const now = new Date();
      const formatted = now.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
      });
      dateEl.textContent = formatted;
    };

    updateDate();
    setInterval(updateDate, 60000);
  })();
</script>
