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
        
    <!-- ===================== STATS ===================== -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- Card -->
        <div class="bg-white rounded-xl p-5 shadow-sm flex justify-between items-center">
            <div>
                <p class="text-3xl font-bold text-gray-900">248</p>
                <p class="text-sm text-gray-500">Total Applicants</p>
            </div>
            <div class="text-right">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mb-2">
                    <i class="fa-solid fa-users"></i>
                </div>
                <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">+12%</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm flex justify-between items-center">
            <div>
                <p class="text-3xl font-bold text-gray-900">64</p>
                <p class="text-sm text-gray-500">Under Review</p>
            </div>
            <div class="text-right">
                <div class="w-10 h-10 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center mb-2">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <span class="text-xs bg-yellow-100 text-yellow-600 px-2 py-1 rounded-full">Pending</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm flex justify-between items-center">
            <div>
                <p class="text-3xl font-bold text-gray-900">18</p>
                <p class="text-sm text-gray-500">Interviews Scheduled</p>
            </div>
            <div class="text-right">
                <div class="w-10 h-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mb-2">
                    <i class="fa-regular fa-calendar"></i>
                </div>
                <span class="text-xs bg-indigo-100 text-indigo-600 px-2 py-1 rounded-full">This Week</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm flex justify-between items-center">
            <div>
                <p class="text-3xl font-bold text-gray-900">32</p>
                <p class="text-sm text-gray-500">Hired This Month</p>
            </div>
            <div class="text-right">
                <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mb-2">
                    <i class="fa-solid fa-check"></i>
                </div>
                <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">+8%</span>
            </div>
        </div>

    </div>

    <!-- ===================== TABLE ===================== -->
    <div class="bg-white rounded-xl shadow-sm p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-lg text-gray-800">Recent Applicants</h2>

            <div class="flex gap-2">
                <select class="border rounded-lg px-3 py-1 text-sm">
                    <option>All Positions</option>
                </select>
                <select class="border rounded-lg px-3 py-1 text-sm">
                    <option>All Status</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <table class="w-full text-sm">
            <thead class="text-left text-gray-400 border-b">
            <tr>
                <th class="py-3">APPLICANT</th>
                <th>POSITION</th>
                <th>APPLIED DATE</th>
                <th>STATUS</th>
                <th>RATING</th>
                <th>ACTIONS</th>
            </tr>
            </thead>

            <tbody class="divide-y">

            <!-- Row -->
            <tr class="hover:bg-slate-50">
                <td class="py-4 flex items-center gap-3">
                    <div class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center">SM</div>
                    <div>
                        <p class="font-medium">Sarah Mitchell</p>
                        <p class="text-xs text-gray-400">sarah.m@email.com</p>
                    </div>
                </td>
                <td>
                    <p class="font-medium">Senior Frontend Developer</p>
                    <p class="text-xs text-gray-400">Engineering</p>
                </td>
                <td>Jan 15, 2024</td>
                <td><span class="px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-600">Interview</span></td>
                <td class="text-yellow-400">
                    ★★★★★
                </td>
              <td class="text-gray-400 space-x-3">
                <!-- 👁 OPEN MODAL -->
                <i class="fa-regular fa-eye cursor-pointer hover:text-indigo-600"
                   onclick="openApplicantModal()"></i>
                <i class="fa-regular fa-calendar cursor-pointer hover:text-indigo-600"
                onclick="openScheduleModal()"></i>

                <i class="fa-solid fa-xmark cursor-pointer"></i>
              </td>
            </tr>

            <!-- Copy rows (static) -->
            <tr>
                <td class="py-4 flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-full flex items-center justify-center">JC</div>
                    <div>
                        <p class="font-medium">James Chen</p>
                        <p class="text-xs text-gray-400">james.chen@email.com</p>
                    </div>
                </td>
                <td>
                    <p class="font-medium">Backend Developer</p>
                    <p class="text-xs text-gray-400">Engineering</p>
                </td>
                <td>Jan 14, 2024</td>
                <td><span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-600">Screening</span></td>
                <td class="text-yellow-400">★★★★☆</td>
                <td class="text-gray-400 space-x-3">
                    <i class="fa-regular fa-eye"></i>
                    <i class="fa-regular fa-calendar"></i>
                    <i class="fa-solid fa-xmark"></i>
                </td>
            </tr>

            </tbody>
        </table>

        <!-- Footer -->
        <div class="flex justify-between items-center mt-4 text-sm text-gray-400">
            <p>Showing 1 to 5 of 248 results</p>

            <div class="flex items-center gap-2">
                <span>Previous</span>
                <span class="bg-indigo-600 text-white w-8 h-8 flex items-center justify-center rounded-lg">1</span>
                <span>2</span>
                <span>3</span>
                <span>...</span>
                <span>50</span>
                <span>Next</span>
            </div>
        </div>

    </div>


    </div>
  </main>
</div>
<!-- ================= EXACT APPLICANT PROFILE MODAL ================= -->
<div id="applicantModal"
     class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden z-50 flex items-center justify-center">

  <div class="bg-white w-full max-w-5xl rounded-xl shadow-2xl relative">

    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 border-b">
      <h2 class="font-semibold text-lg">Applicant Profile</h2>
      <button onclick="closeApplicantModal()" class="text-gray-400 hover:text-gray-600 text-xl">
        &times;
      </button>
    </div>

    <!-- Body -->
    <div class="max-h-[82vh] overflow-y-auto p-6 grid grid-cols-3 gap-6">

      <!-- ================= LEFT COLUMN ================= -->
      <div class="col-span-2 space-y-6">

        <!-- Profile Header -->
        <div class="flex items-start gap-4">

          <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-sky-400 to-blue-600
                      text-white flex items-center justify-center text-xl font-bold">
            SM
          </div>

          <div class="flex-1">
            <h3 class="text-xl font-semibold">Sarah Mitchell</h3>
            <p class="text-sm text-gray-400">sarah.m@email.com</p>

            <div class="flex flex-wrap gap-2 mt-2">
              <span class="px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-600">
                Senior Frontend Developer
              </span>
              <span class="px-3 py-1 text-xs rounded-full bg-indigo-50 text-indigo-500">
                Interview
              </span>
            </div>

            <div class="flex gap-4 mt-2 text-sm text-gray-400">
              <span>
                <i class="fa-regular fa-calendar mr-1"></i>
                Applied: Jan 15, 2024
              </span>
              <span>
                <i class="fa-solid fa-location-dot mr-1"></i>
                San Francisco, CA
              </span>
            </div>
          </div>

          <div class="flex gap-2">
            <button onclick="openScheduleModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
            Schedule Interview
            </button>


          </div>

        </div>

        <!-- Professional Summary -->
        <div class="bg-slate-50 rounded-xl p-5">
          <h4 class="font-semibold mb-2 flex items-center gap-2">
            <i class="fa-regular fa-user text-indigo-500"></i>
            Professional Summary
          </h4>
          <p class="text-sm text-gray-600 leading-relaxed">
            Experienced frontend developer with 7+ years building scalable web applications.
            Specialized in React, TypeScript, and modern web technologies.
            Led teams of 5+ developers and delivered 20+ successful projects for Fortune 500 companies.
          </p>
        </div>

        <!-- Work Experience -->
        <div class="bg-white border rounded-xl p-5 space-y-4">
          <h4 class="font-semibold flex items-center gap-2">
            <i class="fa-solid fa-briefcase text-indigo-500"></i>
            Work Experience
          </h4>

          <div class="flex gap-4">
            <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center">
              <i class="fa-solid fa-code text-indigo-600"></i>
            </div>
            <div>
              <p class="font-medium">Senior Frontend Developer</p>
              <p class="text-sm text-gray-400">TechStart Inc • 2020 – Present</p>
              <p class="text-sm text-gray-600 mt-1">
                Led development of customer portal serving 100K+ users.
                Reduced development time by 40%.
              </p>
            </div>
          </div>

          <div class="flex gap-4">
            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
              <i class="fa-solid fa-laptop-code text-green-600"></i>
            </div>
            <div>
              <p class="font-medium">Frontend Developer</p>
              <p class="text-sm text-gray-400">Digital Solutions • 2017 – 2020</p>
              <p class="text-sm text-gray-600 mt-1">
                Built responsive applications using React and modern JavaScript frameworks.
              </p>
            </div>
          </div>
        </div>

        <!-- Education -->
        <div class="bg-white border rounded-xl p-5">
          <h4 class="font-semibold flex items-center gap-2 mb-2">
            <i class="fa-solid fa-graduation-cap text-indigo-500"></i>
            Education
          </h4>
          <p class="font-medium">BS in Computer Science</p>
          <p class="text-sm text-gray-400">Stanford University • 2013 – 2017</p>
          <p class="text-sm text-gray-500">GPA: 3.8 / 4.0</p>
        </div>

      </div>

      <!-- ================= RIGHT COLUMN ================= -->
      <div class="space-y-6">

        <!-- Skills -->
        <div class="bg-white border rounded-xl p-5">
          <h4 class="font-semibold mb-3">Skills</h4>
          <div class="flex flex-wrap gap-2">
            <span class="px-3 py-1 text-xs rounded-full bg-indigo-50 text-indigo-600">React</span>
            <span class="px-3 py-1 text-xs rounded-full bg-indigo-50 text-indigo-600">TypeScript</span>
            <span class="px-3 py-1 text-xs rounded-full bg-indigo-50 text-indigo-600">JavaScript</span>
            <span class="px-3 py-1 text-xs rounded-full bg-indigo-50 text-indigo-600">Next.js</span>
            <span class="px-3 py-1 text-xs rounded-full bg-indigo-50 text-indigo-600">Tailwind CSS</span>
            <span class="px-3 py-1 text-xs rounded-full bg-indigo-50 text-indigo-600">Git</span>
            <span class="px-3 py-1 text-xs rounded-full bg-indigo-50 text-indigo-600">REST APIs</span>
            <span class="px-3 py-1 text-xs rounded-full bg-indigo-50 text-indigo-600">GraphQL</span>
          </div>
        </div>

        <!-- Contact -->
        <div class="bg-white border rounded-xl p-5 space-y-2">
          <h4 class="font-semibold mb-2">Contact Information</h4>
          <p class="text-sm text-gray-600">
            <i class="fa-regular fa-envelope mr-2"></i> sarah.m@email.com
          </p>
          <p class="text-sm text-gray-600">
            <i class="fa-solid fa-phone mr-2"></i> +1 (555) 123-4567
          </p>
          <p class="text-sm text-indigo-600">
            <i class="fa-brands fa-linkedin mr-2"></i> linkedin.com/in/sarahmitchell
          </p>
          <p class="text-sm text-gray-600">
            <i class="fa-brands fa-github mr-2"></i> github.com/sarahmitchell
          </p>
        </div>

        <!-- Documents -->
        <div class="bg-white border rounded-xl p-5">
          <h4 class="font-semibold mb-3">Documents</h4>

          <div class="flex justify-between items-center mb-3">
            <div class="flex items-center gap-3">
              <div class="w-9 h-9 rounded-lg bg-red-100 flex items-center justify-center">
                <i class="fa-regular fa-file-pdf text-red-600"></i>
              </div>
              <div>
                <p class="text-sm font-medium">Resume.pdf</p>
                <p class="text-xs text-gray-400">245 KB</p>
              </div>
            </div>
            <i class="fa-solid fa-download text-gray-400 cursor-pointer"></i>
          </div>

          <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
              <div class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center">
                <i class="fa-regular fa-file text-blue-600"></i>
              </div>
              <div>
                <p class="text-sm font-medium">Cover_Letter.pdf</p>
                <p class="text-xs text-gray-400">128 KB</p>
              </div>
            </div>
            <i class="fa-solid fa-download text-gray-400 cursor-pointer"></i>
          </div>

        </div>

        <!-- Rating Container -->
        <div class="bg-white border rounded-xl p-4 flex items-center justify-between shadow-sm mt-4">
        <div>
            <p class="text-sm font-medium text-gray-700">Applicant Rating</p>
            <div class="text-yellow-400 flex gap-1 text-lg mt-1">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star-half-stroke"></i>
            <i class="fa-regular fa-star"></i>
            </div>
        </div>
        <div class="text-sm text-gray-500 font-medium">
            3.5 / 5
        </div>
        </div>


      </div>
    </div>
  </div>
</div>

<!-- Add this at the end of your body, after the applicant profile modal -->

<!-- ===================== SCHEDULE INTERVIEW MODAL ===================== -->
<div id="scheduleInterviewModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden z-50 flex items-center justify-center">

  <div class="bg-white w-full max-w-lg rounded-xl shadow-2xl overflow-hidden">

    <!-- Header -->
    <div class="bg-purple-600 px-6 py-4 flex justify-between items-center">
      <h2 class="text-white font-semibold text-lg">Schedule Interview</h2>
      <button onclick="closeScheduleModal()" class="text-white text-xl hover:text-gray-200">&times;</button>
    </div>

    <!-- Body -->
    <div class="p-6 space-y-4">

      <!-- Applicant Info -->
      <div class="flex items-center gap-4 bg-purple-50 p-4 rounded-lg">
        <div class="w-12 h-12 bg-blue-400 text-white rounded-full flex items-center justify-center font-bold">SM</div>
        <div>
          <p class="font-medium text-gray-800">Sarah Mitchell</p>
          <p class="text-sm text-gray-500">Senior Frontend Developer</p>
        </div>
      </div>

      <!-- Form -->
      <form class="space-y-4">

        <!-- Interview Type -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Interview Type</label>
          <select class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-purple-500">
            <option>Phone Screening</option>
            <option>Technical Interview</option>
            <option>HR Interview</option>
            <option>Final Interview</option>
          </select>
        </div>

        <!-- Date & Time -->
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
            <input type="date" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-purple-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
            <input type="time" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-purple-500">
          </div>
        </div>

        <!-- Duration -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
          <select class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-purple-500">
            <option>30 minutes</option>
            <option>45 minutes</option>
            <option>60 minutes</option>
            <option>90 minutes</option>
          </select>
        </div>

        <!-- Interviewers -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Interviewer(s)</label>
          <input type="text" placeholder="Enter interviewer name(s)" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-purple-500">
        </div>

        <!-- Meeting Link -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Meeting Link (Optional)</label>
          <input type="url" placeholder="https://meet.google.com/..." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-purple-500">
        </div>

        <!-- Notes -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
          <textarea placeholder="Add any additional notes or instructions..." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-purple-500 h-24 resize-none"></textarea>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-2">
          <button type="button" onclick="closeScheduleModal()" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">Cancel</button>
          <button type="submit" class="px-4 py-2 rounded-lg bg-purple-600 text-white hover:bg-purple-700">Schedule Interview</button>
        </div>

      </form>

    </div>

  </div>
</div>







</body>
<script>
  // Open/Close Schedule Interview Modal
  function openScheduleModal() {
    document.getElementById('scheduleInterviewModal').classList.remove('hidden');
  }
  function closeScheduleModal() {
    document.getElementById('scheduleInterviewModal').classList.add('hidden');
  }

  // Open/Close Applicant Modal (existing)
  function openApplicantModal() {
    document.getElementById('applicantModal').classList.remove('hidden');
  }
  function closeApplicantModal() {
    document.getElementById('applicantModal').classList.add('hidden');
  }
</script>


<script>
  function openApplicantModal() {
    document.getElementById('applicantModal').classList.remove('hidden');
  }

  function closeApplicantModal() {
    document.getElementById('applicantModal').classList.add('hidden');
  }
</script>

</html>
