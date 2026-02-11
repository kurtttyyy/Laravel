    <!-- ================= EDIT PROFILE MODAL (EXACT DESIGN) ================= -->
    <div
      x-show="openEditProfile && modalTarget === 'general'"
      x-transition
      @click.self="openEditProfile=false; modalTarget = ''"
      class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
      style="display:none"
    >
      <div class="bg-white w-full max-w-3xl rounded-xl shadow-xl max-h-[90vh] flex flex-col">

        <!-- Header -->
        <div class="flex justify-between px-6 py-4 border-b">
          <h2 class="font-semibold text-gray-800">Edit Employee Profile</h2>
          <button @click="openEditProfile=false; modalTarget = ''" class="text-xl text-gray-400">&times;</button>
        </div>

        <!-- Content -->
        <div class="overflow-y-auto px-6 py-5 space-y-6 text-sm">

          <!-- Personal Information -->
          <section>
            <h3 class="text-indigo-600 font-semibold mb-4 flex items-center gap-2">👤 Personal Information</h3>
            <div class="grid grid-cols-2 gap-4">
              <input class="border rounded-md px-3 py-2" value="John">
              <input class="border rounded-md px-3 py-2" value="Doe">
              <input class="border rounded-md px-3 py-2" value="03/15/1990">
              <select class="border rounded-md px-3 py-2"><option>Male</option></select>
            </div>
          </section>

          <!-- Contact -->
          <section>
            <h3 class="text-indigo-600 font-semibold mb-4 flex items-center gap-2">📧 Contact Information</h3>
            <div class="grid grid-cols-2 gap-4">
              <input class="border rounded-md px-3 py-2" value="john.doe@company.com">
              <input class="border rounded-md px-3 py-2" value="+1 (555) 123-4567">
            </div>
          </section>

          <!-- Employment -->
          <section>
            <h3 class="text-indigo-600 font-semibold mb-4 flex items-center gap-2">💼 Employment Details</h3>
            <div class="grid grid-cols-2 gap-4">
              <input class="border rounded-md px-3 py-2" value="Senior Software Engineer">
              <input class="border rounded-md px-3 py-2" value="Engineering">
              <input class="border rounded-md px-3 py-2" value="EMP-2024-1234">
            </div>
          </section>

          <!-- Address -->
          <section>
            <h3 class="text-indigo-600 font-semibold mb-4 flex items-center gap-2">📍 Address</h3>
            <input class="border rounded-md px-3 py-2 w-full mb-4" value="123 Market Street, Apt 4B">
            <div class="grid grid-cols-2 gap-4">
              <input class="border rounded-md px-3 py-2" value="San Francisco">
              <input class="border rounded-md px-3 py-2" value="California">
              <input class="border rounded-md px-3 py-2" value="United States">
            </div>
          </section>

          <!-- Emergency -->
          <section>
            <h3 class="text-red-500 font-semibold mb-4 flex items-center gap-2">🚨 Emergency Contact</h3>
            <div class="grid grid-cols-2 gap-4">
              <input class="border rounded-md px-3 py-2" value="Jane Doe">
              <input class="border rounded-md px-3 py-2" value="Spouse">
              <input class="border rounded-md px-3 py-2" value="+1 (555) 987-6543">
            </div>
          </section>

          <!-- Bank -->
          <section>
            <h3 class="text-indigo-600 font-semibold mb-4 flex items-center gap-2">🏦 Bank Details</h3>
            <div class="grid grid-cols-2 gap-4">
              <input class="border rounded-md px-3 py-2" value="PNB">
              <input class="border rounded-md px-3 py-2" value="PNB ACCOUNT NUMBER">
              <input class="border rounded-md px-3 py-2" value="PAG IBIG MID">
              <input class="border rounded-md px-3 py-2" value="PAG IBIG RTN">
              <input class="border rounded-md px-3 py-2" value="SSS">
              <input class="border rounded-md px-3 py-2" value="PHILHEALTH">
              <input class="border rounded-md px-3 py-2" value="TIN">


            </div>
          </section>

        </div>

        <!-- Footer -->
        <div class="border-t px-6 py-4 flex justify-end gap-3">
          <button @click="openEditProfile=false; modalTarget = ''" class="px-4 py-2 bg-gray-100 rounded-md">Cancel</button>
          <button class="px-6 py-2 bg-blue-500 text-white rounded-md">Save Changes</button>
        </div>

      </div>
    </div>