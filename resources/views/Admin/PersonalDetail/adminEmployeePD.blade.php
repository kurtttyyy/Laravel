<!-- Personal Details -->
<div x-show="tab === 'personal'" x-transition class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

  <!-- Personal Information -->
  <div class="bg-slate-50 p-6 rounded-xl shadow-sm space-y-4">
    <div class="flex items-center gap-2 text-indigo-600 font-semibold text-lg mb-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9.003 9.003 0 1118.879 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
      </svg>
      Personal Information
    </div>
    <div class="space-y-2 text-sm text-gray-700">
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Full Name</span>John Doe</p>
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Date of Birth</span>March 15, 1990</p>
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Gender</span>Male</p>
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Nationality</span>Filipino</p>
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Marital Status</span>Single</p>
    </div>
  </div>

  <!-- Address -->
  <div class="bg-slate-50 p-6 rounded-xl shadow-sm space-y-4">
    <div class="flex items-center gap-2 text-indigo-600 font-semibold text-lg mb-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c-1.657 0-3 1.343-3 3v7h6v-7c0-1.657-1.343-3-3-3z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2a7 7 0 017 7c0 4.418-7 13-7 13S5 13.418 5 9a7 7 0 017-7z" />
      </svg>
      Address
    </div>
    <div class="space-y-2 text-sm text-gray-700">
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Street Address</span>123 Market Street, Apt 4B</p>
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Province</span>Isabela</p>
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Municipality</span>Echague</p>
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Postal Code</span>94102</p>
    </div>
  </div>

  <!-- Emergency Contact -->
  <div class="bg-slate-50 p-6 rounded-xl shadow-sm space-y-4">
    <div class="flex items-center gap-2 text-red-600 font-semibold text-lg mb-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636a9 9 0 11-12.728 0m5.657 5.657l-2.122-2.121m4.242 4.243l-2.122-2.121" />
      </svg>
      Emergency Contact
    </div>
    <div class="space-y-2 text-sm text-gray-700">
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Contact Name</span>Jane Doe</p>
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Relationship</span>Spouse</p>
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Phone Number</span>+1 (555) 987-6543</p>
    </div>
  </div>

  <!-- Bank Details -->
  <div class="bg-slate-50 p-6 rounded-xl shadow-sm space-y-4">
    <div class="flex items-center gap-2 text-indigo-600 font-semibold text-lg mb-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M12 2v20M7 18h10" />
      </svg>
      Bank Details
    </div>
    <div class="space-y-2 text-sm text-gray-700">
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Bank Name</span>Chase Bank</p>
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Account Number</span>••••••1234</p>
      <p style="margin-bottom: 20px;"><span class="block font-semibold text-xs uppercase text-gray-400">Routing Number</span>021000021</p>
    </div>
  </div>

</div>