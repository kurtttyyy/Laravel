    <!-- Overview -->
    <div x-show="tab === 'overview'" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
      <div class="bg-slate-50 p-4 rounded-xl text-sm">
        <h3 class="font-semibold mb-5">Contact Information</h3>
        <p class="mb-3"><span class="block font-semibold text-xs uppercase text-gray-400">Email:</span> john.doe@company.com</p>
        <p class="mb-3"><span class="block font-semibold text-xs uppercase text-gray-400">Phone:</span> +1 (555) 123-4567</p>
        <p class="mb-3"><span class="block font-semibold text-xs uppercase text-gray-400">Location:</span> San Francisco, CA</p>
      </div>

      <div class="bg-slate-50 p-4 rounded-xl text-sm">
        <h3 class="font-semibold mb-5">Employment Details</h3>
        <p class="mb-3"><span class="block font-semibold text-xs uppercase text-gray-400">Employee ID:</span> EMP-2024-1234</p>
        <p class="mb-3"><span class="block font-semibold text-xs uppercase text-gray-400">Join Date:</span> Jan 15, 2022</p>
        <p class="mb-3"><span class="block font-semibold text-xs uppercase text-gray-400">Manager:</span> Sarah Williams</p>
      </div>

      <div class="bg-slate-50 p-4 rounded-xl text-sm">
        <h3 class="font-semibold mb-5">Skills</h3>
        <div class="flex flex-wrap gap-2">
          <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-700 rounded-full">JavaScript</span>
          <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-700 rounded-full">React</span>
          <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-700 rounded-full">Node.js</span>
          <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-700 rounded-full">Python</span>
          <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-700 rounded-full">AWS</span>
        </div>
      </div>

      <div class="bg-slate-50 p-4 rounded-xl text-sm">
        <h3 class="font-semibold mb-5">Recent Activity</h3>
        <ul class="text-sm space-y-2">
          <li>✅ Completed project milestone (2 days ago)</li>
          <li>📅 Attended team meeting (5 days ago)</li>
          <li>✏️ Updated profile (1 week ago)</li>
        </ul>
      </div>
    </div>
    