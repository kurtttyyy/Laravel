<!-- Documents -->
<div x-show="tab === 'documents'" x-transition class="p-6 space-y-6">

  <!-- Upload Box (Static) -->
  <div class="border-2 border-dashed border-indigo-200 bg-indigo-50 rounded-xl p-8 text-center">
    <div class="text-3xl mb-2">☁️</div>
    <h3 class="font-semibold text-gray-800">Upload New Document</h3>
    <p class="text-sm text-gray-500 mb-4">
      Drag and drop files here or click to browse
    </p>

    <button
      type="button"
      class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition"
    >
      Choose File
    </button>
  </div>

  <!-- All Documents -->
  <div x-show="selectedEmployee?.applicant?.documents?.length" class="space-y-3">
    <h3 class="font-semibold text-gray-800">All Documents</h3>

    <template x-for="doc in selectedEmployee.applicant.documents" :key="doc.id">
        <!-- Document Item -->
        <div class="bg-white rounded-xl p-4 flex items-center justify-between shadow-sm">
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-100 text-red-600">
                📄
                </div>
                <div>
                <p class="font-medium text-gray-800"x-text="doc.type"></p>
                <p class="text-xs text-gray-500"x-text="doc.filename + ' • ' + doc.size + ' • ' + doc.formatted_created_at">
                    contract.pdf • 2.4 MB • Jan 15, 2022
                </p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <!-- Eye icon -->
                <button class="text-gray-500 hover:text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                </button>
                <!-- Download icon -->
                <button class="text-gray-500 hover:text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 12v8m0 0l-4-4m4 4l4-4M12 4v8" />
                </svg>
                </button>
            </div>
        </div>
    </template>
    <!-- Repeat similarly for the other documents... -->

  </div>
</div>
