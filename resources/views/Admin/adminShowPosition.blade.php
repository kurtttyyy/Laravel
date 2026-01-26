<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PeopleHub – Job Details</title>

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

    <!-- Dashboard Content -->
    <div class="p-8 space-y-6">

      <!-- Back -->
      <a  href="{{ route('admin.adminPosition') }}" class="text-sm text-slate-500 flex items-center gap-2">
        <i class="fa fa-arrow-left"></i> Back to Jobs
      </a>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT COLUMN -->
        <div class="lg:col-span-2 space-y-6">

          <!-- Job Header -->
          <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex justify-between items-start">

              <div class="flex gap-4">
                <div class="w-12 h-12 bg-indigo-600 text-white rounded-xl flex items-center justify-center text-xl">
                  <i class="fa fa-code"></i>
                </div>

                <div class="items-start">
                  <h1 class="text-2xl font-bold text-slate-800">Senior Frontend Developer</h1>
                  <p class="text-sm text-slate-500">
                    Engineering • Full-Time • Remote
                  </p>

                  <div class="flex gap-3 mt-4">
                    <a href="{{ route('admin.adminEditPosition') }}"
                      class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm inline-flex items-center">
                        <i class="fa fa-pen mr-1"></i> Edit Job
                    </a>

                    <button class="border border-red-300 text-red-500 px-4 py-2 rounded-lg text-sm">
                      Close Position
                    </button>
                  </div>
                </div>
              </div>

              <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full">
                Active
              </span>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 text-center mt-8 border-t pt-6">
              <div>
                <p class="text-2xl font-bold">24</p>
                <p class="text-xs text-slate-500">Total Applicants</p>
              </div>
              <div>
                <p class="text-2xl font-bold">8</p>
                <p class="text-xs text-slate-500">In Review</p>
              </div>
              <div>
                <p class="text-2xl font-bold">5 days</p>
                <p class="text-xs text-slate-500">Posted</p>
              </div>
            </div>
          </div>

          <!-- Job Description -->
          <div class="bg-white rounded-xl p-6 shadow-sm space-y-6">

            <div>
              <h2 class="font-semibold mb-2">Job Description</h2>
              <p class="text-sm text-slate-600">
                We're looking for an experienced frontend developer to join our team and build amazing user experiences.
                You'll work closely with our design and product teams.
              </p>
            </div>

            <div>
              <h2 class="font-semibold mb-2">Responsibilities</h2>
              <ul class="space-y-2 text-sm text-slate-600">
                <li><i class="fa fa-check-circle text-indigo-500 mr-2"></i>Build React applications with TypeScript</li>
                <li><i class="fa fa-check-circle text-indigo-500 mr-2"></i>Collaborate with designers</li>
                <li><i class="fa fa-check-circle text-indigo-500 mr-2"></i>Write clean and maintainable code</li>
                <li><i class="fa fa-check-circle text-indigo-500 mr-2"></i>Optimize for performance</li>
                <li><i class="fa fa-check-circle text-indigo-500 mr-2"></i>Mentor junior developers</li>
              </ul>
            </div>

            <div>
              <h2 class="font-semibold mb-2">Requirements</h2>
              <ul class="space-y-2 text-sm text-slate-600">
                <li><i class="fa fa-check-circle text-indigo-500 mr-2"></i>5+ years frontend experience</li>
                <li><i class="fa fa-check-circle text-indigo-500 mr-2"></i>Expert in React & TypeScript</li>
                <li><i class="fa fa-check-circle text-indigo-500 mr-2"></i>Strong CSS knowledge</li>
                <li><i class="fa fa-check-circle text-indigo-500 mr-2"></i>Redux or similar tools</li>
                <li><i class="fa fa-check-circle text-indigo-500 mr-2"></i>Excellent communication</li>
              </ul>
            </div>

          </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="space-y-6">

          <!-- Job Details -->
          <div class="bg-white rounded-xl p-6 shadow-sm text-sm space-y-4">
            <h3 class="font-semibold">Job Details</h3>

            <div>
              <p class="text-slate-400">Salary Range</p>
              <p class="font-medium">$120,000 - $160,000</p>
            </div>

            <div>
              <p class="text-slate-400">Experience Level</p>
              <p class="font-medium">Senior Level (5+ years)</p>
            </div>

            <div>
              <p class="text-slate-400">Location</p>
              <p class="font-medium">Remote (US Only)</p>
            </div>

            <div>
              <p class="text-slate-400">Posted Date</p>
              <p class="font-medium">January 10, 2024</p>
            </div>

            <div>
              <p class="text-slate-400">Closing Date</p>
              <p class="font-medium">February 10, 2024</p>
            </div>
          </div>

          <!-- Skills -->
          <div class="bg-white rounded-xl p-6 shadow-sm">
            <h3 class="font-semibold mb-3">Required Skills</h3>
            <div class="flex gap-2 flex-wrap">
              <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-600 rounded-full">React</span>
              <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-600 rounded-full">TypeScript</span>
              <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-600 rounded-full">Tailwind CSS</span>
              <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-600 rounded-full">Redux</span>
              <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-600 rounded-full">Git</span>
              <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-600 rounded-full">REST APIs</span>
              <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-600 rounded-full">Jest</span>
              <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-600 rounded-full">Figma</span>
            </div>
          </div>

          <!-- Benefits -->
          <div class="bg-white rounded-xl p-6 shadow-sm text-sm">
            <h3 class="font-semibold mb-3">Benefits & Perks</h3>
            <ul class="space-y-2 text-slate-600">
              <li><i class="fa fa-check text-green-500 mr-2"></i>Health, Dental & Vision</li>
              <li><i class="fa fa-check text-green-500 mr-2"></i>401(k) with Match</li>
              <li><i class="fa fa-check text-green-500 mr-2"></i>Unlimited PTO</li>
              <li><i class="fa fa-check text-green-500 mr-2"></i>Remote Equipment</li>
              <li><i class="fa fa-check text-green-500 mr-2"></i>Learning Budget</li>
              <li><i class="fa fa-check text-green-500 mr-2"></i>Stock Options</li>
            </ul>
          </div>

          <!-- Hiring Team -->
          <div class="bg-white rounded-xl p-6 shadow-sm">
            <h3 class="font-semibold mb-4">Hiring Team</h3>

            <div class="flex items-center gap-3 mb-3">
              <div class="w-10 h-10 bg-indigo-500 text-white rounded-full flex items-center justify-center">JD</div>
              <div>
                <p class="text-sm font-medium">John Doe</p>
                <p class="text-xs text-slate-500">Hiring Manager</p>
              </div>
            </div>

            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center">JS</div>
              <div>
                <p class="text-sm font-medium">Jane Smith</p>
                <p class="text-xs text-slate-500">Technical Lead</p>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </main>
</div>

</body>
</html>
