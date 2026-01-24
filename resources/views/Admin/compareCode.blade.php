<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PeopleHub – HR Dashboard</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <style>
    body { font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, sans-serif; }
  </style>
</head>
<body class="bg-slate-100">

<div class="flex min-h-screen">

  <!-- Sidebar -->
    @include('components.adminSideBar')


  <!-- Main Content -->
  <main class="flex-1">

    <!-- Header -->
     @include('components.adminHeader.attendanceHeader')

    <!-- Dashboard Content -->
    <div class="p-8 space-y-6">

<div class="max-w-5xl mx-auto bg-white px-10 py-8 border border-gray-400 text-[13px] text-black">

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
  <div class="border border-gray-500 w-1/2 mt-4" style="width: 463px;">
    <div class="row">Basic Salary:</div>
    <div class="row">Rate per Hour:</div>
    <div class="row">COLA:</div>
  </div>
  <br>
<div class="border-t border-dashed border-gray-500 my-3"></div>

  <br>
    <div class="row font-semibold bg-gray-100">Employee Details</div>
    <div class="row">Basic Salary:</div>
    <div class="row">Rate per Hour:</div>
    <div class="row">COLA:</div>
    <div class="row">Basic Salary:</div>
    <div class="row">Rate per Hour:</div>
    <div class="row">COLA:</div>
    <div class="row">Basic Salary:</div>

  <!-- FOOTER -->
  <div class="mt-6 text-xs text-gray-600">
    NC HR Form No. 16a – Employees Profile Rev. 01
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
  </main>
</div>

</body>
</html>
