
<div x-show="tab === 'biometric'" x-transition class="w-full p-6 space-y-6">
    <div class="p-8 space-y-6">
      <div x-data="{ openForm: false }">

<div class="max-w-5xl mx-auto bg-white px-5 py-8 border border-gray-400 text-[13px] text-black">

<!-- EDIT & DOWNLOAD BUTTONS -->
<div class="flex justify-between items-center mb-4 space-x-2">

  <!-- Edit Icon -->
  <div class="relative group">
    <button @click="openForm = true" class="p-2 bg-green-600 text-white rounded hover:bg-green-700">
      <!-- Pencil/Edit Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M16.5 3.5l4 4-8 8H8v-4l8.5-8.5z" />
      </svg>
    </button>

    <!-- Bubble Chat Tooltip -->
    <div
      class="absolute bottom-full mb-3 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
      <div class="relative bg-green-600 text-white text-xs rounded-lg px-3 py-1 shadow-lg whitespace-nowrap">
        Edit Profile
        <!-- Tail using pseudo-circle -->
        <div class="absolute left-1/2 -bottom-1 w-2 h-2 bg-green-600 rotate-45 -translate-x-1/2"></div>
      </div>
    </div>
  </div>

  <!-- Download Icon -->
  <div class="relative group">
    <button @click="downloadProfile()" class="p-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      <!-- Download Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12v8m0 0l-4-4m4 4l4-4M12 4v8" />
      </svg>
    </button>

    <!-- Bubble Chat Tooltip -->
    <div
      class="absolute bottom-full mb-3 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
      <div class="relative bg-blue-600 text-white text-xs rounded-lg px-3 py-1 shadow-lg whitespace-nowrap">
        Download Profile
        <!-- Tail -->
        <div class="absolute left-1/2 -bottom-1 w-2 h-2 bg-blue-600 rotate-45 -translate-x-1/2"></div>
      </div>
    </div>
  </div>

</div>



  <!-- HEADER -->
  <div class="text-center mb-6 leading-tight">
    <p class="font-semibold uppercase">Northeastern College</p>
    <p >Santiago City, Philippines</p>
    <p >Telephone No.: (078) 305-3226</p>

    <p class="mt-4 font-semibold uppercase">Office of the Human Resource</p>
    <p class="font-semibold uppercase">Employees Profile Form</p>
  </div>

  <!-- TOP SECTION -->
  <div class="grid grid-cols-2 gap-4">

    <!-- LEFT BOX -->
    <div class="border border-gray-500">
      <div class="row" x-text="selectedEmployee?.last_name">Last Name:</div>
      <div class="row" x-text="selectedEmployee?.first_name">First Name:</div>
      <div class="row" x-text="selectedEmployee?.middle_name">Middle Name:</div>
      <div class="row" x-text="selectedEmployee?.employee.employee_id">ID Number:</div>
      <div class="row" x-text="selectedEmployee?.employee.account_number">Account No.:</div>
    </div>

    <!-- RIGHT BOX -->
    <div class="border border-gray-500">
      <div class="row" x-text="selectedEmployee?.employee.sex">Sex:</div>
      <div class="row" x-text="selectedEmployee?.employee.civil_status">Civil Status:</div>
      <div class="row" x-text="selectedEmployee?.employee.contact_number">Contact No.:</div>
      <div class="row" x-text="selectedEmployee?.employee.birthday">Date of Birth:</div>
      <div class="row" x-text="selectedEmployee?.employee.address">Address:</div>
    </div>
  </div>

  <!-- EMPLOYMENT SECTION -->
  <div class="grid grid-cols-2 gap-4 mt-4">

    <div class="border border-gray-500">
      <div class="row" x-text="selectedEmployee?.employee.employement_date">Employment Date:</div>
      <div class="row" x-text="selectedEmployee?.employee.position">Position:</div>
      <div class="row" x-text="selectedEmployee?.employee.department">Department:</div>
      <div class="row">
        Classification:
        <label class="ml-4">
            <input type="checkbox" disabled
                :checked="selectedEmployee?.employee.classification === 'Full-Time'">
            Full-time
        </label>

        <label class="ml-3">
            <input type="checkbox" disabled
                :checked="selectedEmployee?.employee.classification === 'Part-Time'">
            Part-time
        </label>

        <label class="ml-3">
            <input type="checkbox" disabled
                :checked="selectedEmployee?.employee.classification === 'NT'">
            NT
        </label>
    </div>
    </div>

    <div class="border border-gray-500">
      <div class="row" x-text="selectedEmployee?.government.SSS">SSS:</div>
      <div class="row" x-text="selectedEmployee?.government.TIN">TIN:</div>
      <div class="row" x-text="selectedEmployee?.government.PhilHealth">PhilHealth:</div>
      <div class="row" x-text="selectedEmployee?.government.MID">Pag-IBIG MID:</div>
      <div class="row" x-text="selectedEmployee?.government.RTN">Pag-IBIG RTN:</div>
    </div>
  </div>

  <!-- LICENSE + EDUCATION -->
  <div class="grid grid-cols-2 gap-4 mt-4">

    <div class="border border-gray-500">
      <div class="row" x-text="selectedEmployee?.license.license">License:</div>
      <div class="row" x-text="selectedEmployee?.license.registration_number">Registration No.:</div>
      <div class="row" x-text="selectedEmployee?.license.registration_date">Registration Date:</div>
      <div class="row" x-text="selectedEmployee?.license.valid_until">Valid Until:</div>
    </div>

    <div class="border border-gray-500">
      <div class="row" x-text="selectedEmployee?.education.bachelor">Bachelor’s Degree:</div>
      <div class="row" x-text="selectedEmployee?.education.master">Master’s Degree:</div>
      <div class="row" x-text="selectedEmployee?.education.doctorate">Doctorate Degree:</div>
    </div>
  </div>

  <!-- SALARY BOX -->
  <div class="border border-gray-500 w-1/2 mt-4" style="width: 502px;">
    <div class="row" x-text="selectedEmployee?.salary.salary">Basic Salary:</div>
    <div class="row" x-text="selectedEmployee?.salary.rate_per_hour">Rate per Hour:</div>
    <div class="row" x-text="selectedEmployee?.salary.cola">COLA:</div>
  </div>
  <br>
<div class="border-t border-dashed border-gray-500 my-3"></div>

  <br>
    <div class="row font-semibold bg-gray-100">Employee Details</div>
    <div class="row" x-text="selectedEmployee?.first_name + ' ' + selectedEmployee?.middle_name + ' ' + selectedEmployee?.last_name">Full Name:</div>
    <div class="row" x-text="selectedEmployee?.employee.employee_id">ID Number:</div>
    <div class="row" x-text="selectedEmployee?.employee.department">Department:</div>
    <div class="row" x-text="selectedEmployee?.applicant?.position.title ?? '-'">Person Contact in case of Emergency:</div>
    <div class="row" x-text="selectedEmployee?.applicant?.position.title ?? '-'">Address:</div>
    <div class="row" x-text="selectedEmployee?.applicant?.position.title ?? '-'">Cellphone Number:</div>



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
    <form action="{{ route('admin.updateBio')}}" method="POST">
        @csrf
        <input type="hidden" name="user_id" :value="selectedEmployee?.id">
    <!-- PERSONAL INFO -->
    <div class="grid grid-cols-2 gap-4">
      <input class="border px-2 py-1" name="last" placeholder="Last Name">
      <input class="border px-2 py-1" name="first" placeholder="First Name">
      <input class="border px-2 py-1" name="middle" placeholder="Middle Name">
      <input class="border px-2 py-1" name="employee_id" placeholder="ID Number">
      <input class="border px-2 py-1" name="account_number" placeholder="Account No.">
      <select name="gender" class="border px-2 py-1">
        <option value= "">Sex</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
      <input class="border px-2 py-1" name="civil_status" placeholder="Civil Status">
      <input class="border px-2 py-1" name="contact_number" placeholder="Contact No.">
      <div>
      <label class="block text-xs text-gray-600">Date of Birth</label>
        <input type="date" name="birthday" class="w-full border px-2 py-1">
      </div>
      <input class="border px-2 py-1" name="address" placeholder="Address">
    </div>

    <!-- EMPLOYMENT -->
    <h3 class="font-semibold mt-6">Employment Information</h3>
    <div class="grid grid-cols-2 gap-4">
      <div>
      <label class="block text-xs text-gray-600">Employment Date</label>
        <input type="date" name="employment_date" class="w-full border px-2 py-1">
      </div>
      <input class="border px-2 py-1" name = "position" placeholder="Position">
      <input class="border px-2 py-1" name = "department" placeholder="Department">

      <select name = "classification" class="border px-2 py-1">
        <option value ="">Classification</option>
        <option value ="Full-Time">Full-time</option>
        <option value ="Part-Time">Part-time</option>
        <option value ="NT">NT</option>
      </select>
    </div>

    <!-- GOVERNMENT IDS -->
    <h3 class="font-semibold mt-6">Government IDs</h3>
    <div class="grid grid-cols-2 gap-4">
      <input name = "SSS" class="border px-2 py-1" placeholder="SSS">
      <input name = "TIN" class="border px-2 py-1" placeholder="TIN">
      <input name = "PhilHealth" class="border px-2 py-1" placeholder="PhilHealth">
      <input name = "MID" class="border px-2 py-1" placeholder="Pag-IBIG MID">
      <input name = "RTN" class="border px-2 py-1" placeholder="Pag-IBIG RTN">
    </div>

    <!-- LICENSE -->
    <h3 class="font-semibold mt-6">License</h3>
    <div class="grid grid-cols-2 gap-4">
      <input name = "license" class="border px-2 py-1" placeholder="License">
      <input name = "registration_number" class="border px-2 py-1" placeholder="Registration No.">
      <div>
        <label class="block text-xs text-gray-600">Registration Date</label>
        <input name = "registration_date" type="date" class="w-full border px-2 py-1">
      </div>
      <div>
        <label class="block text-xs text-gray-600">Valid Until</label>
        <input name = "valid_until" type="date" class="w-full border px-2 py-1">
      </div>

    </div>

    <!-- EDUCATION -->
    <h3 class="font-semibold mt-6">Education</h3>
    <div class="grid grid-cols-2 gap-4">
      <input name = "bachelor" class="border px-2 py-1" placeholder="Bachelor’s Degree">
      <input name = "master" class="border px-2 py-1" placeholder="Master’s Degree">
      <input name = "doctorate" class="border px-2 py-1" placeholder="Doctorate Degree">
    </div>

    <!-- SALARY -->
    <h3 class="font-semibold mt-6">Salary</h3>
    <div class="grid grid-cols-3 gap-4">
      <input name = "salary" class="border px-2 py-1" placeholder="Basic Salary">
      <input name = "rate_per_hour" class="border px-2 py-1" placeholder="Rate per Hour">
      <input name = "cola" class="border px-2 py-1" placeholder="COLA">
    </div>

    <!-- ACTIONS -->
    <div class="flex justify-end gap-2 mt-6">
      <button type="button"
        @click="openForm = false"
        class="px-4 py-1 border rounded">
        Cancel
      </button>

      <button type="submit"
        class="px-4 py-1 bg-green-600 text-white rounded">
        Save
      </button>
    </div>

    </form>

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
