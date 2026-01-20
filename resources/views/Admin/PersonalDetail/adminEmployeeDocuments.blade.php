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
  <div class="space-y-3">
    <h3 class="font-semibold text-gray-800">All Documents</h3>

    <!-- Document Item -->
    <div class="bg-white rounded-xl p-4 flex items-center justify-between shadow-sm">
      <div class="flex items-center space-x-4">
        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-100 text-red-600">
          📄
        </div>
        <div>
          <p class="font-medium text-gray-800">Employment Contract</p>
          <p class="text-xs text-gray-500">
            contract.pdf • 2.4 MB • Jan 15, 2022
          </p>
        </div>
      </div>
      <div class="flex items-center space-x-3">
        <button class="text-gray-500 hover:text-indigo-600">👁️</button>
        <button class="text-gray-500 hover:text-indigo-600">⬇️</button>
      </div>
    </div>

    <!-- Document Item -->
    <div class="bg-white rounded-xl p-4 flex items-center justify-between shadow-sm">
      <div class="flex items-center space-x-4">
        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600">
          📘
        </div>
        <div>
          <p class="font-medium text-gray-800">Resume - John Doe</p>
          <p class="text-xs text-gray-500">
            resume.pdf • 1.2 MB • Jan 10, 2022
          </p>
        </div>
      </div>
      <div class="flex items-center space-x-3">
        <button class="text-gray-500 hover:text-indigo-600">👁️</button>
        <button class="text-gray-500 hover:text-indigo-600">⬇️</button>
      </div>
    </div>

    <!-- Document Item -->
    <div class="bg-white rounded-xl p-4 flex items-center justify-between shadow-sm">
      <div class="flex items-center space-x-4">
        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-purple-100 text-purple-600">
          🪪
        </div>
        <div>
          <p class="font-medium text-gray-800">Government ID</p>
          <p class="text-xs text-gray-500">
            id_document.jpg • 850 KB • Jan 12, 2022
          </p>
        </div>
      </div>
      <div class="flex items-center space-x-3">
        <button class="text-gray-500 hover:text-indigo-600">👁️</button>
        <button class="text-gray-500 hover:text-indigo-600">⬇️</button>
      </div>
    </div>

    <!-- Document Item -->
    <div class="bg-white rounded-xl p-4 flex items-center justify-between shadow-sm">
      <div class="flex items-center space-x-4">
        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-green-100 text-green-600">
          📊
        </div>
        <div>
          <p class="font-medium text-gray-800">W-4 Tax Form</p>
          <p class="text-xs text-gray-500">
            w4_form.pdf • 600 KB • Jan 15, 2022
          </p>
        </div>
      </div>
      <div class="flex items-center space-x-3">
        <button class="text-gray-500 hover:text-indigo-600">👁️</button>
        <button class="text-gray-500 hover:text-indigo-600">⬇️</button>
      </div>
    </div>

    <!-- Document Item -->
    <div class="bg-white rounded-xl p-4 flex items-center justify-between shadow-sm">
      <div class="flex items-center space-x-4">
        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-yellow-100 text-yellow-600">
          ⭐
        </div>
        <div>
          <p class="font-medium text-gray-800">Professional Certifications</p>
          <p class="text-xs text-gray-500">
            certifications.pdf • 1.8 MB • Mar 20, 2023
          </p>
        </div>
      </div>
      <div class="flex items-center space-x-3">
        <button class="text-gray-500 hover:text-indigo-600">👁️</button>
        <button class="text-gray-500 hover:text-indigo-600">⬇️</button>
      </div>
    </div>

  </div>
</div>