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
    @include('components.adminHeader.attendanceHeader')

    <!-- Dashboard Content -->
    <div class="p-8 space-y-6">

  <!-- Back -->
  <a href="/job-details"
     class="text-sm text-slate-500 flex items-center gap-2 mb-6">
    ← Back to Job Details
  </a>

  <!-- Card -->
  <div class="bg-white rounded-xl shadow-sm p-8 max-w-6xl mx-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-2xl font-bold text-slate-800">
        Edit Job Posting
      </h1>

      <div class="flex gap-3">
        <button
          class="px-5 py-2 rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50">
          Cancel
        </button>

        <button
          class="px-5 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
          Save Changes
        </button>
      </div>
    </div>

    <!-- Section -->
    <h2 class="text-lg font-semibold text-slate-800 mb-6">
      Basic Information
    </h2>

    <!-- Form -->
    <form class="space-y-6">

      <!-- Job Title -->
      <div>
        <label class="block text-sm font-medium text-slate-600 mb-1">
          Job Title
        </label>
        <input type="text"
               value="Senior Frontend Developer"
               class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
      </div>

      <!-- Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- College Name -->
        <div>
          <label class="block text-sm font-medium text-slate-600 mb-1">
            College Name
          </label>
          <input type="text"
                 value="NORTHEASTERN COLLEGE"
                 class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Employment Type -->
        <div>
          <label class="block text-sm font-medium text-slate-600 mb-1">
            Employment Type
          </label>
          <select
            class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500">
            <option selected>Full-Time</option>
            <option>Part-Time</option>
            <option>Contract</option>
          </select>
        </div>

        <!-- Location -->
        <div>
          <label class="block text-sm font-medium text-slate-600 mb-1">
            Location
          </label>
          <input type="text"
                 value="Santiago City"
                 class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Experience Level -->
        <div>
          <label class="block text-sm font-medium text-slate-600 mb-1">
            Experience Level
          </label>
          <select
            class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500">
            <option selected>Senior Level</option>
            <option>Mid Level</option>
            <option>Junior Level</option>
          </select>
        </div>
      </div>

      <!-- Job Description -->
      <div>
        <label class="block text-sm font-medium text-slate-600 mb-1">
          Job Description
        </label>
        <textarea rows="5"
          class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-indigo-500">
We're looking for a Senior Frontend Developer to join our growing engineering team.
        </textarea>
      </div>
          <div class="mb-8">
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Summary
        </label>
        <div class="w-full rounded-lg border border-gray-300 bg-white p-4 text-gray-800">
            We're looking for an experienced frontend developer to join our team and build amazing user experiences.
        </div>
    </div>

    <!-- Key Responsibilities -->
    <div class="mb-8">
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Key Responsibilities
        </label>
        <div class="w-full rounded-lg border border-gray-300 bg-white p-4">
            <ul class="list-disc list-inside space-y-2 text-gray-800">
                <li>Build and maintain complex React applications with TypeScript</li>
                <li>Collaborate with designers to implement pixel-perfect UI designs</li>
                <li>Write clean, maintainable, and well-documented code</li>
                <li>Optimize applications for maximum performance and scalability</li>
                <li>Participate in code reviews and mentor junior developers</li>
            </ul>
        </div>
    </div>

    <!-- Requirements -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Requirements
        </label>
        <div class="w-full rounded-lg border border-gray-300 bg-white p-4">
            <ul class="list-disc list-inside space-y-2 text-gray-800">
                <li>5+ years of experience in frontend development</li>
                <li>Expert knowledge of React, TypeScript, and modern JavaScript</li>
                <li>Strong understanding of responsive design and CSS frameworks</li>
                <li>Experience with state management (Redux, MobX, or similar)</li>
                <li>Excellent communication and teamwork skills</li>
            </ul>
        </div>
    </div>

        <!-- Required Skills -->
    <div class="mb-10">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">
            Required Skills
        </h2>

        <label class="block text-sm font-medium text-gray-600 mb-2">
            Skills (comma separated)
        </label>

        <input
            type="text"
            value="React, TypeScript, Tailwind CSS, Redux, Git, REST APIs, Jest, Figma"
            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-800
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
        />
    </div>

    <!-- Posting Dates -->
    <div>
        <h2 class="text-lg font-semibold text-gray-900 mb-6">
            Posting Dates
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Closing Date -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Closing Date
                </label>

                <div class="relative">
                    <input
                        type="date"
                        value="2024-02-10"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 pr-10 text-gray-800
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    />
                    <!-- Calendar Icon -->
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Status
                </label>

                <select
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-800
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
                    <option selected>Active</option>
                    <option>Inactive</option>
                    <option>Draft</option>
                </select>
            </div>
        </div>
    </div>

    </form>
  </div>

    </div>
  </main>
</div>

</body>
</html>
