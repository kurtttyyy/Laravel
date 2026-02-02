@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


@include('layouts.header')  {{-- UNIVERSAL HEADER --}}


<div class="header-divider"></div>
@foreach($jobOpen as $job)
<main class="container my-5">
    <h2 class="fw-bold mb-4 ">Job Vacancies</h2>

    {{-- Job Card 1 --}}
    <div class="card shadow-sm mb-4 animated-card delay-5 hover-card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="mb-1">{{ $job->title}}</h4>
                    <h5 class="text-secondary mb-1">{{ $job->department}}</h5>
                </div>
                <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                    {{ $job->employment }}
                </span>
            </div>

            <div class="mb-3">
                <p class="mb-0">{{ $job->location }}</p>

                <div class="ps-3" style="white-space: pre-line;">
                    {{
                        collect(preg_split("/\r\n|\n|\r/", $job->passionate))
                            ->map(fn($line) =>
                                preg_replace('/^[\s\p{Z}\x{2022}\x{2023}\x{25E6}\-*•–—]+/mu', '', $line)
                            )
                            ->filter()
                            ->take(3)
                            ->implode("\n")
                    }}
                </div>
            </div>



            <div class="d-flex justify-content-between align-items-center">
                <span class="badge bg-light text-dark">3d ago</span>
                    <a href="javascript:void(0)"
                    class="fw-semibold text-success text-decoration-none view-details"
                    data-job-title="{{ $job->title }}"
                    data-job-college="{{$job->department}}"
                    data-job-type="{{ $job->employment }}"
                    data-job-location="{{ $job->location}}"
                    data-job-skills='@json($job->skills)'
                    data-job-description='@json($job->job_description)'
                    data-job-responsibilities='@json($job->responsibilities)'
                    data-job-qualifications='@json($job->requirements)'
                    data-job-benefits='@json($job->benifits)'>
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
        <h6 class="section-title">Required Skills</h6>
        <div id="sidebarSkills" class="flex gap-2 mt-4 flex-wrap"></div>


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
        <a href="{{ route('guest.applicationNonTeachingSteps', $job->id ) }}" id="applyJobBtn" class="btn btn-success w-100">
            <i class="bi bi-box-arrow-up-right me-1"></i> Apply Now
        </a>
    </div>
    </div>
@endforeach
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('jobSidebar');
    const overlay = document.getElementById('overlay');
    const closeBtn = sidebar.querySelector('.close-btn');

    // ---------- Populate normal UL lists ----------
    function populateList(id, text) {
        const ul = document.getElementById(id);
        ul.innerHTML = "";

        if (!text) return;

        let items = [];

        // If text is already an array (from JSON)
        if (Array.isArray(text)) {
            items = text;
        } else {
            items = text
                .split('•')
                .map(item => item.trim())
                .filter(item => item.length);
        }

        items.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item;
            ul.appendChild(li);
        });
    }

    // ---------- Populate skills as transparent blue pills ----------
    function populateSkills(id, text) {
        const container = document.getElementById(id);
        container.innerHTML = "";

        if (!text) return;

        let skills = [];

        // Handle JSON array or comma-separated string
        if (Array.isArray(text)) {
            skills = text;
        } else {
            skills = text.split(',');
        }

        skills
            .map(skill => skill.trim())
            .filter(skill => skill.length)
            .forEach(skill => {
                const span = document.createElement('span');
                span.className = 'skill-badge'; // CSS class for blue pill style
                span.textContent = skill;
                container.appendChild(span);
            });
    }

    // ---------- Open sidebar & populate data ----------
    document.querySelectorAll('.view-details').forEach(btn => {
        btn.addEventListener('click', function () {

            // Title & College
            document.getElementById('sidebarTitle').textContent =
                this.dataset.jobTitle;
            document.getElementById('sidebarCollege').textContent =
                this.dataset.jobCollege;

            // Job Type & Contract
            document.getElementById('sidebarType').textContent =
                this.dataset.jobType;
            document.getElementById('sidebarContract').textContent =
                this.dataset.jobContract || '';

            // Location
            document.getElementById('sidebarLocationText').textContent =
                this.dataset.jobLocation;

            // Sidebar Sections
            populateSkills(
                'sidebarSkills',
                JSON.parse(this.dataset.jobSkills || '[]')
            );

            populateList(
                'sidebarDescription',
                JSON.parse(this.dataset.jobDescription || '[]')
            );

            populateList(
                'sidebarResponsibilities',
                JSON.parse(this.dataset.jobResponsibilities || '[]')
            );

            populateList(
                'sidebarQualifications',
                JSON.parse(this.dataset.jobQualifications || '[]')
            );

            populateList(
                'sidebarBenefits',
                JSON.parse(this.dataset.jobBenefits || '[]')
            );

            // Show sidebar
            overlay.style.display = 'block';
            sidebar.classList.add('show');
        });
    });

    // ---------- Close sidebar ----------
    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.style.display = 'none';
    }

    closeBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
});
</script>


@endsection
