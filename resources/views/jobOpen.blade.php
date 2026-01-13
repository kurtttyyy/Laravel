@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


<header class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
    <div class="container-fluid">
        <div class="navbar-brand d-flex align-items-center gap-3">
            <img src="{{ asset('images/logo.webp') }}" alt="Logo" height="70">
            <div class="d-flex flex-column">
                <span class="fw-bold fs-2 mb-0 text-white">Northeastern College</span>
                <small class="subtext">Join Our Team</small>
            </div>
        </div>
        <div class="ms-auto d-flex gap-3">
            <a href="#" class="btn btn-sm btn-outline-light">Job Applicant</a>
            <a href="#" class="btn btn-sm btn-outline-light">Application Status</a>
        </div>
    </div>
</header>

<div class="header-divider"></div>

<main class="container my-5">
    <h2 class="fw-bold mb-4">Job Vacancies</h2>

    {{-- Job Card 1 --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="mb-1">Assistant Professor - Computer Science</h4>
                    <h5 class="text-secondary mb-1">Northeastern College</h5>
                </div>
                <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                    Full-Time
                </span>
            </div>

            <div class="mb-3">
                <p class="mb-0">Contract/Temp</p>
                <p class="mb-0">Santiago City</p>

                <ul class="mb-3">
                    <li>Career growth</li>
                    <li>Be a part of a strong team delivering a clear mission</li>
                    <li>Build foundational knowledge of avant-garde practice and disciplines</li>
                </ul>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <span class="badge bg-light text-dark">3d ago</span>
                <a href="javascript:void(0)" 
                   class="fw-semibold text-success text-decoration-none view-details"
                   data-job-title="Assistant Professor - Computer Science"
                   data-job-college="Northeastern College"
                   data-job-type="Full-Time"
                   data-job-contract="Contract/Temp"
                   data-job-location="Santiago City"
                   data-job-points='["Careers growth","Be a part of a strong team delivering a clear mission","Build foundational knowledge of avant-garde practice and disciplines"]'>
                   View Details →
                </a>
            </div>
        </div>
    </div>

    {{-- Job Card 2 --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="mb-1">Senior Lecturer - Data Science</h4>
                    <h5 class="text-secondary mb-1">Northeastern College</h5>
                </div>
                <span class="badge rounded-pill bg-warning-subtle text-warning px-3 py-2">
                    Part-Time
                </span>
            </div>

            <div class="mb-3">
                <p class="mb-0">Contract/Temp</p>
                <p class="mb-0">New York City</p>

                <ul class="mb-3">
                    <li>Work with cutting-edge AI technologies</li>
                    <li>Collaborate on interdisciplinary research projects</li>
                    <li>Mentor undergraduate and graduate students</li>
                </ul>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <span class="badge bg-light text-dark">1d ago</span>
                <a href="javascript:void(0)" 
                   class="fw-semibold text-success text-decoration-none view-details"
                   data-job-title="Senior Lecturer - Data Science"
                   data-job-college="Northeastern College"
                   data-job-type="Part-Time"
                   data-job-contract="Contract/Temp"
                   data-job-location="New York City"
                   data-job-points='["Work with cutting-edge AI technologies","Collaborate on interdisciplinary research projects","Mentor undergraduate and graduate students"]'>
                   View Details →
                </a>
            </div>
        </div>
    </div>
</main>

{{-- Overlay --}}
<div id="overlay"></div>

{{-- Right-side sidebar --}}
<div id="jobSidebar">
    <span class="close-btn">&times;</span>
    <h4 id="sidebarTitle"></h4>
    <h5 class="text-secondary" id="sidebarCollege"></h5>
    <p id="sidebarType"></p>
    <p id="sidebarContract"></p>
    <p id="sidebarLocation"></p>
    <ul id="sidebarPoints"></ul>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('jobSidebar');
    const overlay = document.getElementById('overlay');
    const closeBtn = sidebar.querySelector('.close-btn');

    // Open sidebar
    document.querySelectorAll('.view-details').forEach(btn => {
        btn.addEventListener('click', function() {
            // Populate sidebar dynamically based on clicked job
            document.getElementById('sidebarTitle').textContent = this.dataset.jobTitle;
            document.getElementById('sidebarCollege').textContent = this.dataset.jobCollege;
            document.getElementById('sidebarType').textContent = "Type: " + this.dataset.jobType;
            document.getElementById('sidebarContract').textContent = "Contract: " + this.dataset.jobContract;
            document.getElementById('sidebarLocation').textContent = "Location: " + this.dataset.jobLocation;

            const points = JSON.parse(this.dataset.jobPoints);
            const ul = document.getElementById('sidebarPoints');
            ul.innerHTML = "";
            points.forEach(point => {
                const li = document.createElement('li');
                li.textContent = point;
                ul.appendChild(li);
            });

            // Show overlay and sidebar
            overlay.style.display = 'block';
            sidebar.classList.add('show');
        });
    });

    // Close sidebar
    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.style.display = 'none';
    }

    closeBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
});
</script>
@endsection
