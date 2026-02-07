
<div x-show="tab === 'biometric'" x-transition class="p-6 space-y-6">
    <div class="p-8 space-y-6">
      <div x-data="{ openForm: false }">

<div class="max-w-5xl mx-auto bg-white px-5 py-8 border border-gray-400 text-[13px] text-black">

  <!-- EDIT BUTTON -->
  <div class="flex justify-end mb-4">
    <button @click="openForm = true" class="px-4 py-2 text-sm bg-green-600 text-white rounded hover:bg-green-700">
      Edit
    </button>
  </div>

  <!-- HEADER -->
  <div class="text-center mb-6 leading-tight">
    <p class="font-semibold uppercase">Northeastern College</p>
    <p>Santiago City, Philippines</p>
    <p>Telephone No.: (078) 305-3226</p>

    <p class="mt-4 font-semibold uppercase">Office of the Human Resource</p>
    <p class="font-semibold uppercase">Employees Profile Form</p>
  </div>

  <!-- TOP SECTION -->
  <div class="grid grid-cols-2 gap-4">

    <!-- LEFT BOX -->
    <div class="border border-gray-500">
      <div class="row">Last Name:</div>
      <div class="row">First Name:</div>
      <div class="row">Middle Name:</div>
      <div class="row">ID Number:</div>
      <div class="row">Account No.:</div>
    </div>

    <!-- RIGHT BOX -->
    <div class="border border-gray-500">
      <div class="row">Sex:</div>
      <div class="row">Civil Status:</div>
      <div class="row">Contact No.:</div>
      <div class="row">Date of Birth:</div>
      <div class="row">Address:</div>
    </div>
  </div>

  <!-- EMPLOYMENT SECTION -->
  <div class="grid grid-cols-2 gap-4 mt-4">

    <div class="border border-gray-500">
      <div class="row">Employment Date:</div>
      <div class="row">Position:</div>
      <div class="row">Department:</div>
      <div class="row">
        Classification:
        <span class="ml-4">☐ Full-time</span>
        <span class="ml-3">☐ Part-time</span>
        <span class="ml-3">☐ NT</span>
      </div>
    </div>

    <div class="border border-gray-500">
      <div class="row">SSS:</div>
      <div class="row">TIN:</div>
      <div class="row">PhilHealth:</div>
      <div class="row">Pag-IBIG MID:</div>
      <div class="row">Pag-IBIG RTN:</div>
    </div>
  </div>

  <!-- LICENSE + EDUCATION -->
  <div class="grid grid-cols-2 gap-4 mt-4">

    <div class="border border-gray-500">
      <div class="row">License:</div>
      <div class="row">Registration No.:</div>
      <div class="row">Registration Date:</div>
      <div class="row">Valid Until:</div>
    </div>

    <div class="border border-gray-500">
      <div class="row">Bachelor’s Degree:</div>
      <div class="row">Master’s Degree:</div>
      <div class="row">Doctorate Degree:</div>
    </div>
  </div>

  <!-- SALARY BOX -->
  <div class="border border-gray-500 w-1/2 mt-4" style="width: 502px;">
    <div class="row">Basic Salary:</div>
    <div class="row">Rate per Hour:</div>
    <div class="row">COLA:</div>
  </div>
  <br>
<div class="border-t border-dashed border-gray-500 my-3"></div>

  <br>
    <div class="row font-semibold bg-gray-100">Employee Details</div>
    <div class="row">Full Name:</div>
    <div class="row">ID Number:</div>
    <div class="row">Department:</div>
    <div class="row">Person Contact in case of Emergency:</div>
    <div class="row">Address:</div>
    <div class="row">Cellphone Number:</div>
    


  <!-- FOOTER -->
  <div class="mt-6 text-xs text-gray-600">
    NC HR Form No. 16a – Employees Profile Rev. 01
  </div>
</div>

<!-- MODAL -->
<!-- FULL FORM MODAL -->
<div
  x-show="openForm"
  x-transition
  class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

  <div
    @click.outside="openForm = false"
    class="bg-white w-full max-w-5xl rounded shadow-lg p-6 text-sm overflow-y-auto max-h-[90vh]"
  >

    <h2 class="text-lg font-semibold mb-4">Edit Employee Profile</h2>

    <!-- PERSONAL INFO -->
    <div class="grid grid-cols-2 gap-4">
      <input class="border px-2 py-1" placeholder="Last Name">
      <input class="border px-2 py-1" placeholder="First Name">
      <input class="border px-2 py-1" placeholder="Middle Name">
      <input class="border px-2 py-1" placeholder="ID Number">
      <input class="border px-2 py-1" placeholder="Account No.">
      <select class="border px-2 py-1">
        <option>Sex</option>
        <option>Male</option>
        <option>Female</option>
      </select>
      <input class="border px-2 py-1" placeholder="Civil Status">
      <input class="border px-2 py-1" placeholder="Contact No.">
      <div>
      <label class="block text-xs text-gray-600">Date of Birth</label>
        <input type="date" class="w-full border px-2 py-1">
      </div>
      <input class="border px-2 py-1" placeholder="Address">
    </div>

    <!-- EMPLOYMENT -->
    <h3 class="font-semibold mt-6">Employment Information</h3>
    <div class="grid grid-cols-2 gap-4">
      <div>
      <label class="block text-xs text-gray-600">Employment Date</label>
        <input type="date" class="w-full border px-2 py-1">
      </div>
      <input class="border px-2 py-1" placeholder="Position">
      <input class="border px-2 py-1" placeholder="Department">

      <select class="border px-2 py-1">
        <option>Classification</option>
        <option>Full-time</option>
        <option>Part-time</option>
        <option>NT</option>
      </select>
    </div>

    <!-- GOVERNMENT IDS -->
    <h3 class="font-semibold mt-6">Government IDs</h3>
    <div class="grid grid-cols-2 gap-4">
      <input class="border px-2 py-1" placeholder="SSS">
      <input class="border px-2 py-1" placeholder="TIN">
      <input class="border px-2 py-1" placeholder="PhilHealth">
      <input class="border px-2 py-1" placeholder="Pag-IBIG MID">
      <input class="border px-2 py-1" placeholder="Pag-IBIG RTN">
    </div>

    <!-- LICENSE -->
    <h3 class="font-semibold mt-6">License</h3>
    <div class="grid grid-cols-2 gap-4">
      <input class="border px-2 py-1" placeholder="License">
      <input class="border px-2 py-1" placeholder="Registration No.">
      <div>
        <label class="block text-xs text-gray-600">Registration Date</label>
        <input type="date" class="w-full border px-2 py-1">
      </div>
      <div>
        <label class="block text-xs text-gray-600">Valid Until</label>
        <input type="date" class="w-full border px-2 py-1">
      </div>

    </div>

    <!-- EDUCATION -->
    <h3 class="font-semibold mt-6">Education</h3>
    <div class="grid grid-cols-2 gap-4">
      <input class="border px-2 py-1" placeholder="Bachelor’s Degree">
      <input class="border px-2 py-1" placeholder="Master’s Degree">
      <input class="border px-2 py-1" placeholder="Doctorate Degree">
    </div>

    <!-- SALARY -->
    <h3 class="font-semibold mt-6">Salary</h3>
    <div class="grid grid-cols-3 gap-4">
      <input class="border px-2 py-1" placeholder="Basic Salary">
      <input class="border px-2 py-1" placeholder="Rate per Hour">
      <input class="border px-2 py-1" placeholder="COLA">
    </div>

    <h3 class="font-semibold mt-6">Employee Details</h3>

<div class="space-y-3">

  <div>
    <label class="block text-xs text-gray-600">Full Name</label>
    <input
      type="text"
      class="w-full border px-2 py-1"
      placeholder="e.g. Juan Dela Cruz">
  </div>

  <div>
    <label class="block text-xs text-gray-600">ID Number</label>
    <input
      type="text"
      class="w-full border px-2 py-1"
      placeholder="Employee ID">
  </div>

  <div>
    <label class="block text-xs text-gray-600">Department</label>
    <input
      type="text"
      class="w-full border px-2 py-1"
      placeholder="e.g. Human Resource">
  </div>

  <div>
    <label class="block text-xs text-gray-600">
      Person to Contact in Case of Emergency
    </label>
    <input
      type="text"
      class="w-full border px-2 py-1"
      placeholder="Full name of emergency contact">
  </div>

  <div>
    <label class="block text-xs text-gray-600">Address</label>
    <input
      type="text"
      class="w-full border px-2 py-1"
      placeholder="Complete address">
  </div>

  <div>
    <label class="block text-xs text-gray-600">Cellphone Number</label>
    <input
      type="tel"
      class="w-full border px-2 py-1"
      placeholder="09XXXXXXXXX">
  </div>

</div>


    <!-- ACTIONS -->
    <div class="flex justify-end gap-2 mt-6">
      <button
        @click="openForm = false"
        class="px-4 py-1 border rounded">
        Cancel
      </button>

      <button
        class="px-4 py-1 bg-green-600 text-white rounded">
        Save
      </button>
    </div>

    

  </div>
</div>



<style>
  .row {
    border-bottom: 1px solid #6b7280;
    padding: 6px 8px;
    height: 30px;
  }
  .row:last-child {
    border-bottom: none;
  }
</style>


    </div>
    </div>
</div>
