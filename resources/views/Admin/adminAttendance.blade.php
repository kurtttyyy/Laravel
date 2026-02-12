<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PeopleHub - HR Dashboard</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <style>
    body { font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, sans-serif; transition: margin-left 0.3s ease; }
    main { transition: margin-left 0.3s ease; }
    aside ~ main { margin-left: 16rem; }
  </style>
</head>
<body class="bg-slate-100">

<div class="flex min-h-screen">
  @include('components.adminSideBar')

  <main class="flex-1 ml-16 transition-all duration-300">
    @include('components.adminHeader.attendanceHeader')

    <div class="p-4 md:p-8 space-y-6 pt-20">
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
        @if (session('success'))
          <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
          </div>
        @endif

        @if ($errors->has('excel_file'))
          <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ $errors->first('excel_file') }}
          </div>
        @endif

        <form action="{{ route('admin.uploadAttendanceExcel') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
          @csrf

          <label for="excel_file" class="cursor-pointer border-2 border-dashed border-blue-300 rounded-lg p-6 flex flex-col items-center justify-center text-center hover:bg-blue-50 transition">
            <i class="fa-solid fa-cloud-arrow-up text-3xl text-blue-500 mb-2"></i>
            <p class="text-sm text-blue-600 font-medium">Browse Excel file to upload</p>
            <p class="text-xs text-gray-400 mt-1">(.xls, .xlsx)</p>
            <p id="selected_excel_name" class="text-xs text-slate-500 mt-2">No file selected</p>
          </label>

          <input id="excel_file" name="excel_file" type="file" accept=".xls,.xlsx" class="hidden" required />

          <div class="flex justify-end">
            <button id="upload_excel_btn" type="submit" disabled class="bg-blue-600 hover:bg-blue-700 disabled:bg-blue-300 disabled:cursor-not-allowed text-white px-4 py-2 rounded-lg text-sm font-medium transition">
              <i class="fa-solid fa-upload mr-2"></i>
              Upload Excel
            </button>
          </div>
        </form>

        <div class="bg-white border-2 border-gray-200 rounded-xl p-6 mt-6 relative">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-sm font-semibold text-gray-700">Files Status</h3>

            <form method="GET" action="{{ route('admin.adminAttendance') }}" class="flex items-center gap-2" style="margin-top: -7px;">
              <label class="text-sm text-gray-600">From Date:</label>
              <input
                name="from_date"
                value="{{ $fromDate }}"
                type="date"
                class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
              />
              <button type="submit" class="bg-slate-700 hover:bg-slate-800 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">
                Filter
              </button>
            </form>
          </div>

          <div class="space-y-3">
            @forelse ($attendanceFiles as $file)
              <div class="flex items-center gap-3 bg-blue-50 p-3 rounded-lg">
                <i class="fa-solid fa-file-excel text-green-600 text-xl"></i>

                <div class="flex-1">
                  <p class="text-sm font-medium">
                    {{ $file->original_name }}
                    <span class="text-gray-500">- {{ $file->status }}</span>
                  </p>
                  <p class="text-xs text-gray-500">
                    {{ number_format((float) $file->file_size / 1024, 2) }} KB
                    @if (!is_null($file->processed_rows))
                      | {{ $file->processed_rows }} rows processed
                    @endif
                  </p>
                </div>

                <div class="text-right text-xs text-gray-500 min-w-[120px]">
                  {{ optional($file->uploaded_at)->format('M d, Y') ?? '-' }}<br>
                  {{ optional($file->uploaded_at)->format('h:i A') ?? '-' }}
                </div>
              </div>
            @empty
              <div class="rounded-lg border border-dashed border-gray-300 p-5 text-center text-sm text-gray-500">
                No uploaded files yet.
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

</body>

<script>
  const sidebar = document.querySelector('aside');
  const main = document.querySelector('main');
  const excelInput = document.getElementById('excel_file');
  const excelName = document.getElementById('selected_excel_name');
  const uploadBtn = document.getElementById('upload_excel_btn');

  if (excelInput && excelName && uploadBtn) {
    excelInput.addEventListener('change', function () {
      const hasFile = this.files && this.files.length > 0;
      uploadBtn.disabled = !hasFile;
      excelName.textContent = hasFile ? this.files[0].name : 'No file selected';
    });
  }

  if (sidebar && main) {
    sidebar.addEventListener('mouseenter', function() {
      main.classList.remove('ml-16');
      main.classList.add('ml-64');
    });
    sidebar.addEventListener('mouseleave', function() {
      main.classList.remove('ml-64');
      main.classList.add('ml-16');
    });
  }
</script>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
</html>
