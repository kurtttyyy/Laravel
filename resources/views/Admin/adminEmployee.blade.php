<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PeopleHub – HR Dashboard</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Alpine.js -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <style>
    body {
      font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, sans-serif; transition: margin-left 0.3s ease;
    }
    main { transition: margin-left 0.3s ease; }
    aside ~ main { margin-left: 16rem; }
  </style>
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

  <!-- Sidebar -->
  @include('components.adminSideBar')

  <!-- Main Content -->
<main class="flex-1 ml-16 transition-all duration-300"
      x-data="{
        openProfile:false,
        openEditProfile:false,
        modalTarget: '',
        tab:'overview',
        department:'All',
        selectedEmployee: null,
      }">

    <!-- Header -->
    @include('components.adminHeader.employeeHeader')

    <!-- ================= DASHBOARD CONTENT ================= -->
<div class="p-4 md:p-8 space-y-6 pt-20">

    <!-- TOP BAR -->
<div class="flex items-center justify-between" style="margin-top: -20px;">

    <!-- Status Legend -->
    <div class="flex items-center gap-6 text-sm text-gray-600">

        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-green-500"></span>
            Active
        </div>

        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
            On Leave
        </div>

        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-red-500"></span>
            Inactive
        </div>

          <div class="flex items-center gap-2 text-sm text-gray-600">
          <i class="fa-solid fa-filter text-gray-400"></i>
          Filter by Department
        </div>

        <select
          x-model="department"
          class="border border-gray-300 rounded-lg px-3 py-2 text-sm
                focus:ring-2 focus:ring-indigo-500 focus:outline-none"
        >
          <option value="All">All Departments</option>
          <option value="Engineering">Engineering</option>
          <option value="Human Resource">Human Resource</option>
          <option value="Finance">Finance</option>
          <option value="IT Support">IT Support</option>
          <option value="Marketing">Marketing</option>
        </select>

    </div>
    <!-- FILTER BAR -->






    <!-- Add Employee Button -->
    <button
        class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white
               rounded-lg shadow hover:bg-indigo-700 transition"
    >
        <i class="fa fa-user-plus"></i>
        Add Employee
    </button>

</div>




    <!-- Employee Cards Grid -->
    <div class="flex flex-wrap gap-6">

        @foreach ($employee as $emp)
        <!-- Employee Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden w-72">
            <div class="h-24 bg-gradient-to-r from-purple-500 to-indigo-500 flex justify-center items-center">
                <div class="w-16 h-16 rounded-full bg-blue-500 text-white flex items-center justify-center text-lg font-bold border-4 border-white mt-24">
                    {{$emp->initials}}
                </div>
            </div>

            <div class="p-4 mt-7">
                <h3 class="font-bold text-gray-800 text-lg text-center">{{$emp->first_name ?? ''}} {{$emp->last_name ?? ''}}</h3>
                <p class="text-gray-500 text-sm text-center">{{$emp->applicant->position->title ?? ''}}</p>

                <div class="mt-4 space-y-1 text-gray-500 text-sm">
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-id-badge"></i>
                        {{ $emp->employee->employee_id ?? '' }}
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-sitemap"></i>
                        {{$emp->applicant->position->department }}
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar"></i>
                        Hired {{$emp->applicant?->formatted_date_hired }}
                    </div>
                </div>

                <hr class="my-3">

                <div class="flex justify-between items-center">
                    <div class="flex items-center -space-x-">
                        <span class="px-2 py-1 text-green-700 bg-green-100 rounded-full text-xs font-medium z-10">
                            Active
                        </span>

                        <!--<span class="px-2 py-1 text-indigo-700 bg-indigo-100 rounded-full text-xs font-medium">
                            Rehire
                        </span>-->
                    </div>
                    <button
                        @click="openProfile = true; selectedEmployee = @js($emp);"
                        class="text-blue-500 text-sm font-medium hover:underline">
                        View Profile
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>


</div>


    <!-- ================= PROFILE MODAL ================= -->
    <div
      x-show="openProfile"
      x-transition
      @click.self="openProfile=false"
      class="fixed inset-0 bg-black/50 flex items-center justify-center z-40"
      style="display:none"
    >
      <div class="bg-white rounded-2xl w-full max-w-4xl max-h-[90vh] flex flex-col overflow-y-auto overflow-hidden">

        <div class="bg-gradient-to-r from-purple-500 to-indigo-500 p-6 text-white relative">
          <button @click="openProfile=false" class="absolute top-4 right-4 text-2xl">&times;</button>

          <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center font-bold"
            x-text="selectedEmployee?.initials"
            >
            </div>
            <div>
              <h2 class="text-xl font-semibold"
              x-text="selectedEmployee?.applicant?.first_name + ' ' + selectedEmployee?.applicant?.last_name"
              ></h2>
              <p class="text-sm">
                <span x-text="selectedEmployee?.applicant?.position?.title"></span><br>
                <span x-text="selectedEmployee?.applicant?.position?.department"></span>
              </p>
            </div>
            <span class="ml-auto bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
              Active
            </span>
          </div>
        </div>

        <!-- Tabs -->
        <div class="flex gap-6 px-6 pt-4 border-b text-sm">
          <button @click="tab='overview'" :class="tab==='overview' ? 'text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2' : 'text-gray-500'">Overview</button>
          <button @click="tab='personal'" :class="tab==='personal' ? 'text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2' : 'text-gray-500'">Personal Details</button>
          <button @click="tab='performance'" :class="tab==='performance' ? 'text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2' : 'text-gray-500'">Performance</button>
          <button @click="tab='documents'" :class="tab==='documents' ? 'text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2' : 'text-gray-500'">Documents</button>
          <button @click="tab='record'" :class="tab==='record' ? 'text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2' : 'text-gray-500'">Service Record</button>
          <button @click="tab='biometric'" :class="tab==='biometric' ? 'text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2' : 'text-gray-500'">Biometric</button>
        </div>

        @include('Admin.PersonalDetail.adminEmployeeOverview')
        @include('Admin.PersonalDetail.adminEmployeePD')
        @include('Admin.PersonalDetail.adminEmployeePerformance')
        @include('Admin.PersonalDetail.adminEmployeeDocuments')
        @include('Admin.PersonalDetail.adminServiceRecord')
        @include('Admin.PersonalDetail.adminbioMetric')



        <!-- Footer -->
        <div class="flex gap-3 p-6 border-t">
          <button class="flex-1 bg-indigo-600 text-white py-2 rounded-lg">Send Message</button>
          <button class="flex-1 bg-slate-100 py-2 rounded-lg">Schedule Meeting</button>
          <button
            @click="openEditProfile = true; modalTarget = 'general'"
            class="flex-1 bg-slate-100 py-2 rounded-lg hover:bg-slate-200">
            Edit Profile
          </button>
        </div>

      </div>
    </div>



    <!-- ================= PROFILE EDIT ================= -->
    @include('Admin.PersonalDetail.editProfile')

  </main>
</div>

</body>

<script>
  const sidebar = document.querySelector('aside');
  const main = document.querySelector('main');
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
</html>
