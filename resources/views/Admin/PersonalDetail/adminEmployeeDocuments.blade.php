<!-- Documents -->
<div x-show="tab === 'documents'" x-transition class="w-full p-6 space-y-6">

<form action="{{ route('admin.addDocument') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="applicant_id" :value="selectedEmployee?.applicant?.id">

    <!-- File Name -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Document Name
        </label>
        <input
            type="text"
            name="document_name"
            placeholder="e.g. Resume, Offer Letter"
            required
            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
        >
    </div>

    <!-- Upload Box -->
    <div class="border-2 border-dashed border-indigo-200 bg-indigo-50 rounded-xl p-8 text-center">
        <div class="text-3xl mb-2">‚òÅÔ∏è</div>
        <h3 class="font-semibold text-gray-800">Upload New Document</h3>
        <p class="text-sm text-gray-500 mb-4">
            Drag and drop files here or click to browse
        </p>

        <input
            type="file"
            name="documents"
            accept=".pdf,.doc,.docx"
            required
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition"
        >
    </div>

    <div class="mt-4 flex justify-end">
        <button
            type="submit"
            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
        >
            Save
        </button>
    </div>
</form>

<!-- All Documents -->
<div class="bg-gray-50 rounded-2xl p-4 shadow-inner">
    <h3 class="font-semibold text-gray-800 mb-3">All Documents</h3>

    <!-- Scroll Container -->
    <div class="space-y-3 max-h-80 overflow-y-auto pr-2">
        <template x-for="doc in (selectedEmployee?.applicant?.documents ?? [])" :key="doc.id">
            <!-- Document Item -->
            <div class="bg-white rounded-xl p-4 flex items-center justify-between shadow-sm">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-100 text-red-600">
                        üìÑ
                    </div>
                    <div>
                        <p class="font-medium text-gray-800" x-text="doc.type"></p>
                        <p
                            class="text-xs text-gray-500"
                            x-text="doc.filename + ' ï ' + (doc.formatted_size ?? doc.size) + ' ï ' + (doc.formatted_created_at ?? '')"
                        ></p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <!-- Eye icon -->
                    <a
                        class="text-gray-500 hover:text-indigo-600"
                        :href="`/storage/${doc.filepath}`"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>

                    <!-- Download icon -->
                    <a
                        class="text-gray-500 hover:text-indigo-600"
                        :href="`/storage/${doc.filepath}`"
                        :download="doc.filename"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 12v8m0 0l-4-4m4 4l4-4M12 4v8" />
                        </svg>
                    </a>
                </div>
            </div>
        </template>
        <p
            x-show="!selectedEmployee?.applicant?.documents?.length"
            class="text-sm text-gray-500"
        >
            No documents uploaded.
        </p>
    </div>
</div>

</div>

