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
                    data-job-description='["Teach undergraduate and graduate computer science courses","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development"]'
                    data-job-responsibilities='["Deliver lectures and labs","Advise students","Conduct research","Conduct research","Conduct research","Conduct research"]'
                    data-job-qualifications='["Master’s degree in Computer Science","Teaching experience preferred"]'
                    data-job-benefits='["Career growth","Health insurance","Professional development support"]'>
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
                <span class="badge bg-light text-dark">3d ago</span>
                    <a href="javascript:void(0)" 
                    class="fw-semibold text-success text-decoration-none view-details"
                    data-job-title="Assistant Professor - Computer Science"
                    data-job-college="Northeastern College"
                    data-job-type="Full-Time"
                    data-job-contract="Contract/Temp"
                    data-job-location="Santiago City"
                    data-job-description='["Teach undergraduate and graduate computer science courses","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development","Participate in curriculum development"]'
                    data-job-responsibilities='["Deliver lectures and labs","Advise students","Conduct research","Conduct research","Conduct research","Conduct research"]'
                    data-job-qualifications='["Master’s degree in Computer Science","Teaching experience preferred"]'
                    data-job-benefits='["Career growth","Health insurance","Professional development support"]'>
                    View Details →
                    </a>
            </div>
        </div>
    </div>
</main>

{{-- Overlay --}}
<div id="overlay"></div>

{{-- Right-side sidebar --}}
{{-- Right-side sidebar --}}
<div id="jobSidebar">
    <!-- Sticky Header -->
    <div class="sidebar-header" id="sidebarHeader">
        <span class="close-btn">&times;</span>

        <h1 id="sidebarTitle"></h1>

        <h6 class="text-secondary">
            <i class="bi bi-mortarboard-fill me-1"></i>
            <span id="sidebarCollege"></span>
        </h6>

        <div class="job-meta">
            <i class="bi bi-clock-fill me-1"></i>
            <span id="sidebarType"></span>
            <span class="divider">|</span>
            <span id="sidebarContract"></span>
        </div>

        <p id="sidebarLocation">
            <i class="bi bi-geo-alt-fill me-1"></i>
            <span id="sidebarLocationText"></span>
        </p>

    </div>

    <!-- Scrollable Content -->
    <div class="sidebar-body">
        <h6 class="section-title">Job Description</h6>
        <ul id="sidebarDescription"></ul>

        <h6 class="section-title">Responsibilities</h6>
        <ul id="sidebarResponsibilities"></ul>

        <h6 class="section-title">Qualifications</h6>
        <ul id="sidebarQualifications"></ul>

        <h6 class="section-title">Benefits</h6>
        <ul id="sidebarBenefits"></ul>

        <!-- Apply Now Button -->
    <div class="text-center mt-3">
        <a href="{{ route('guest.applicationSteps') }}" id="applyJobBtn" class="btn btn-success w-100">
            <i class="bi bi-box-arrow-up-right me-1"></i> Apply Now
        </a>
    </div>
    </div>

</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('jobSidebar');
    const overlay = document.getElementById('overlay');
    const closeBtn = sidebar.querySelector('.close-btn');

    function populateList(id, items) {
        const ul = document.getElementById(id);
        ul.innerHTML = "";
        items.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item;
            ul.appendChild(li);
        });
    }

    document.querySelectorAll('.view-details').forEach(btn => {
        btn.addEventListener('click', function() {

            // Title & college (school icon already in HTML)
            document.getElementById('sidebarTitle').textContent =
                this.dataset.jobTitle;
            document.getElementById('sidebarCollege').textContent =
                this.dataset.jobCollege;

            // Job type + contract (clock icon already in HTML)
            document.getElementById('sidebarType').textContent =
                this.dataset.jobType;
            document.getElementById('sidebarContract').textContent =
                this.dataset.jobContract;

            // Location (pin icon already in HTML)
            document.getElementById('sidebarLocationText').textContent =
                this.dataset.jobLocation;

            // Job sections
            populateList(
                'sidebarDescription',
                JSON.parse(this.dataset.jobDescription)
            );
            populateList(
                'sidebarResponsibilities',
                JSON.parse(this.dataset.jobResponsibilities)
            );
            populateList(
                'sidebarQualifications',
                JSON.parse(this.dataset.jobQualifications)
            );
            populateList(
                'sidebarBenefits',
                JSON.parse(this.dataset.jobBenefits)
            );

            // Show sidebar
            overlay.style.display = 'block';
            sidebar.classList.add('show');
        });
    });

    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.style.display = 'none';
    }

    closeBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
});

</script>


@endsection
