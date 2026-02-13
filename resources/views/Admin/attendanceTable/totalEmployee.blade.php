<div class="bg-white rounded-xl border border-gray-200 p-4">
  <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h3 class="text-sm font-semibold text-gray-700">All Employees Attendance</h3>
    <div class="flex items-center gap-2">
      <button
        type="button"
        id="export_total_employee_excel"
        class="inline-flex items-center rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700"
      >
        <i class="fa-solid fa-file-excel mr-2"></i>Export Excel
      </button>
      <button
        type="button"
        id="export_total_employee_pdf"
        class="inline-flex items-center rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-red-700"
      >
        <i class="fa-solid fa-file-pdf mr-2"></i>Export PDF
      </button>
    </div>
  </div>
  <div class="overflow-x-auto">
    <table id="total_employee_table" class="min-w-full text-sm">
      <thead class="bg-slate-100 text-slate-700">
        <tr>
          <th class="px-3 py-2 text-left">Employee ID</th>
          <th class="px-3 py-2 text-left">Name</th>
          <th class="px-3 py-2 text-left">Gate</th>
          <th class="px-3 py-2 text-left">Date</th>
          <th class="px-3 py-2 text-left">AM In</th>
          <th class="px-3 py-2 text-left">AM Out</th>
          <th class="px-3 py-2 text-left">PM In</th>
          <th class="px-3 py-2 text-left">PM Out</th>
          <th class="px-3 py-2 text-left">Late Duration</th>
          <th class="px-3 py-2 text-left">Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($rows as $row)
          @php
            $lateMinutes = (int) ($row->late_minutes ?? 0);
            $lateHours = intdiv($lateMinutes, 60);
            $remainingMinutes = $lateMinutes % 60;
            $hourText = $lateHours === 1 ? 'hour' : 'hours';
            $minuteText = $remainingMinutes === 1 ? 'minute' : 'minutes';

            $statusText = 'Present';
            $statusClass = 'bg-green-100 text-green-700';
            if (!empty($row->is_absent)) {
              $statusText = 'Absent';
              $statusClass = 'bg-red-100 text-red-700';
            } elseif ($lateMinutes > 0) {
              $statusText = 'Tardy';
              $statusClass = 'bg-amber-100 text-amber-700';
            }
          @endphp
          <tr class="border-b border-slate-100">
            <td class="px-3 py-2">{{ $row->employee_id }}</td>
            <td class="px-3 py-2">{{ $row->employee_name ?? '-' }}</td>
            <td class="px-3 py-2">{{ $row->main_gate ?? '-' }}</td>
            <td class="px-3 py-2">{{ optional($row->attendance_date)->format('Y-m-d') ?? '-' }}</td>
            <td class="px-3 py-2">{{ $row->morning_in ? \Carbon\Carbon::parse($row->morning_in)->format('h:i A') : '-' }}</td>
            <td class="px-3 py-2">{{ $row->morning_out ? \Carbon\Carbon::parse($row->morning_out)->format('h:i A') : '-' }}</td>
            <td class="px-3 py-2">{{ $row->afternoon_in ? \Carbon\Carbon::parse($row->afternoon_in)->format('h:i A') : '-' }}</td>
            <td class="px-3 py-2">{{ $row->afternoon_out ? \Carbon\Carbon::parse($row->afternoon_out)->format('h:i A') : '-' }}</td>
            <td class="px-3 py-2">
              @if ($lateMinutes <= 0)
                -
              @elseif ($lateHours > 0 && $remainingMinutes > 0)
                {{ $lateHours }} {{ $hourText }} {{ $remainingMinutes }} {{ $minuteText }} late
              @elseif ($lateHours > 0)
                {{ $lateHours }} {{ $hourText }} late
              @else
                {{ $remainingMinutes }} {{ $minuteText }} late
              @endif
            </td>
            <td class="px-3 py-2">
              <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusClass }}">
                {{ $statusText }}
              </span>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="10" class="px-3 py-4 text-center text-gray-500">No attendance records found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<script>
  (function () {
    const table = document.getElementById('total_employee_table');
    const excelBtn = document.getElementById('export_total_employee_excel');
    const pdfBtn = document.getElementById('export_total_employee_pdf');

    if (!table) {
      return;
    }

    if (excelBtn) {
      excelBtn.addEventListener('click', function () {
        const rows = Array.from(table.querySelectorAll('tr'));
        const csv = rows
          .map((row) => {
            const cells = Array.from(row.querySelectorAll('th, td'));
            return cells
              .map((cell) => {
                const text = (cell.innerText || '').replace(/\r?\n|\r/g, ' ').trim();
                const escaped = text.replace(/"/g, '""');
                return `"${escaped}"`;
              })
              .join(',');
          })
          .join('\n');

        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'total_employee_attendance.csv';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
      });
    }

    if (pdfBtn) {
      pdfBtn.addEventListener('click', function () {
        const printWindow = window.open('', '_blank');
        if (!printWindow) {
          return;
        }

        const tableHtml = table.outerHTML;
        printWindow.document.write(`
          <html>
            <head>
              <title>Total Employee Attendance</title>
              <style>
                body { font-family: Arial, sans-serif; margin: 24px; color: #111827; }
                h1 { font-size: 18px; margin-bottom: 12px; }
                table { width: 100%; border-collapse: collapse; font-size: 12px; }
                th, td { border: 1px solid #d1d5db; padding: 8px; text-align: left; }
                th { background: #f1f5f9; }
              </style>
            </head>
            <body>
              <h1>Total Employee Attendance</h1>
              ${tableHtml}
            </body>
          </html>
        `);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
      });
    }
  })();
</script>
