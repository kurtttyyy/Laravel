<div class="bg-white rounded-xl border border-gray-200 p-4">
  <h3 class="text-sm font-semibold text-gray-700 mb-3">Absent / Incomplete Logs</h3>
  <div class="overflow-x-auto">
    <table class="min-w-full text-sm">
      <thead class="bg-slate-100 text-slate-700">
        <tr>
          <th class="px-3 py-2 text-left">Employee ID</th>
          <th class="px-3 py-2 text-left">Date</th>
          <th class="px-3 py-2 text-left">Missing Logs</th>
          <th class="px-3 py-2 text-left">Absences</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($rows as $row)
          @php
            $missing = is_array($row->missing_time_logs) ? $row->missing_time_logs : [];
          @endphp
          <tr class="border-b border-slate-100">
            <td class="px-3 py-2">{{ $row->employee_id }}</td>
            <td class="px-3 py-2">{{ optional($row->attendance_date)->format('Y-m-d') ?? '-' }}</td>
            <td class="px-3 py-2">{{ !empty($missing) ? implode(', ', $missing) : '-' }}</td>
            <td class="px-3 py-2">{{ !empty($missing) ? count($missing) : 0 }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-3 py-4 text-center text-gray-500">No absent records found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
