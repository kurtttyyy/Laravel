<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Position</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body class="bg-slate-100">

<div class="p-6 max-w-7xl mx-auto">

  <!-- Header -->
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Add New Position</h1>

    <button class="px-4 py-2 rounded-lg border text-slate-600 hover:bg-slate-200">
      Cancel
    </button>
  </div>

  <!-- Layout -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- LEFT SIDE -->
    <div class="lg:col-span-2 space-y-6">

      <!-- Job Overview -->
      <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-semibold text-lg mb-4">Job Overview</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input class="input" placeholder="Job Title" />
          <input class="input" placeholder="Department" />
          <select class="input">
            <option>Employment Type</option>
            <option>Full-Time</option>
            <option>Part-Time</option>
          </select>
          <select class="input">
            <option>Work Mode</option>
            <option>Remote</option>
            <option>Onsite</option>
          </select>
        </div>
      </div>

      <!-- Description -->
      <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-semibold text-lg mb-4">Job Description</h2>
        <textarea rows="4" class="input resize-none"
                  placeholder="Describe the position..."></textarea>
      </div>

      <!-- Responsibilities -->
      <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-semibold text-lg mb-4">Responsibilities</h2>
        <textarea rows="4" class="input resize-none"
                  placeholder="• Build UI components&#10;• Work with designers"></textarea>
      </div>

      <!-- Requirements -->
      <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-semibold text-lg mb-4">Requirements</h2>
        <textarea rows="4" class="input resize-none"
                  placeholder="• 5+ years experience&#10;• React expertise"></textarea>
      </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="space-y-6">

      <!-- Job Details -->
      <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-semibold text-lg mb-4">Job Details</h2>

        <div class="space-y-3">
          <input class="input" placeholder="Salary Min ($)" />
          <input class="input" placeholder="Salary Max ($)" />
          <select class="input">
            <option>Experience Level</option>
            <option>Junior</option>
            <option>Mid</option>
            <option>Senior</option>
          </select>
          <input class="input" placeholder="Location" />
          <input type="date" class="input" />
          <input type="date" class="input" />
        </div>
      </div>

      <!-- Skills -->
      <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-semibold text-lg mb-4">Required Skills</h2>
        <input class="input" placeholder="Type skill and press Enter" />

        <div class="flex flex-wrap gap-2 mt-3">
          <span class="tag">React</span>
          <span class="tag">TypeScript</span>
          <span class="tag">Tailwind</span>
          <span class="tag">Redux</span>
        </div>
      </div>

      <!-- Benefits -->
      <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-semibold text-lg mb-4">Benefits & Perks</h2>
        <textarea rows="4" class="input resize-none"
                  placeholder="• Health Insurance&#10;• Unlimited PTO"></textarea>
      </div>

      <!-- Button -->
      <button
        class="w-full py-3 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
        Create Position
      </button>

    </div>
  </div>
</div>

<!-- Reusable styles -->
<style>
.input {
  width: 100%;
  border: 1px solid #cbd5e1;
  border-radius: 0.75rem;
  padding: 0.5rem 1rem;
  outline: none;
}
.input:focus {
  border-color: #6366f1;
  box-shadow: 0 0 0 2px rgb(99 102 241 / 30%);
}
.tag {
  background: #e0e7ff;
  color: #4338ca;
  padding: 0.25rem 0.75rem;
  border-radius: 9999px;
  font-size: 0.75rem;
}
</style>

</body>
</html>
