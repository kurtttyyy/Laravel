@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

@include('layouts.header')

<div class="header-divider"></div>

<main class="container my-5 animated-card2 delay-5">
    <h2 class="fw-bold mb-4">Job Vacancies</h2>

    <div class="card shadow-sm mb-4 hover-card ">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-1">{{ $job->title }}</h4>
                        <h5 class="text-secondary mb-1">{{ $job->department }}</h5>
                    </div>
                    <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                        {{ $job->employment }}
                    </span>
                </div>
                <p class="mb-1">{{ $job->job_description }}</p>
                <p class="mb-1">{{ $job->location }}</p>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="badge bg-light text-dark">{{ $job->created_at->diffForHumans() }}</span>
                    <a href="javascript:void(0)"
                    class="fw-semibold text-success text-decoration-none view-details"
                    data-job='@json($job)'>
                        View Details →
                    </a>
                </div>
            </div>
        </div>
    @foreach($other as $others)
        <div class="card shadow-sm mb-4 hover-card ">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-1">{{ $others->title }}</h4>
                        <h5 class="text-secondary mb-1">{{ $others->department }}</h5>
                    </div>
                    <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                        {{ $others->employment }}
                    </span>
                </div>
                <p class="mb-1">{{ $others->job_description }}</p>
                <p class="mb-1">{{ $others->location }}</p>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="badge bg-light text-dark">{{ $others->created_at->diffForHumans() }}</span>
                    <a href="javascript:void(0)"
                    class="fw-semibold text-success text-decoration-none view-details"
                    data-job='@json($others)'>
                        View Details →
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</main>

{{-- Overlay --}}
<div id="overlay"></div>

{{-- Sidebar --}}
<div id="jobSidebar">
    <div class="sidebar-header">
        <span class="close-btn">&times;</span>

        <h3 id="sidebarTitle"></h3>
        <h6 class="text-secondary" id="sidebarCollege"></h6>

        <p class="mb-1">
            <i class="bi bi-clock-fill me-1"></i>
            <span id="sidebarType"></span>
        </p>

        <p>
            <i class="bi bi-geo-alt-fill me-1"></i>
            <span id="sidebarLocationText"></span>
        </p>
    </div>

    <div class="sidebar-body">
        <!-- SKILL REQUIREMENTS BOX -->
        <div class="card mb-4">
            <div class="card-body">

            <h6 class=" mb-2">Skill Requirements:</h6>

            <div
                id="sidebarSkills"
                class="d-flex flex-wrap gap-2 justify-content-center mt-2">
            </div>

            </div>
        </div>

        <h6 class="section-title">Job Description</h6>
        <ul id="sidebarDescription" class="list-unstyled ps-0"></ul>

        <h6 class="section-title">Responsibilities</h6>
        <ul id="sidebarResponsibilities" class="list-unstyled ps-0"></ul>

        <h6 class="section-title">Qualifications</h6>
        <ul id="sidebarQualifications" class="list-unstyled ps-0"></ul>

        <h6 class="section-title">Benefits</h6>
        <ul id="sidebarBenefits" class="list-unstyled ps-0"></ul>

        <div class="text-center mt-3 hover-card">
            <a href="#" id="applyJobBtn" class="btn btn-success w-100">
                Apply Now
            </a>
        </div>

        <hr>

        <h6 class="section-title">Related Jobs Open</h6>
        <div id="otherJobs"></div>
    </div>
</div>

<script>
    const allJobs = @json($jobOpen);

    const sidebar = document.getElementById('jobSidebar');
    const overlay = document.getElementById('overlay');

    function populateList(id, data) {
        const el = document.getElementById(id);
        el.innerHTML = '';
        if (!data) return;

        // If responsibilities come as a single string with bullets/newlines, split into lines
        let items = Array.isArray(data) ? data : [data];

        // special handling for longer text fields: split on bullet markers or newlines
        if (/(responsib|description|qualif|benefit)/.test(id.toLowerCase())) {
            if (!Array.isArray(data)) {
                let text = String(data || '');
                // convert <br> to newline for consistent splitting
                text = text.replace(/<br\s*\/?/gi, '\n');

                // If the text contains explicit bullet markers, split on newlines and strip markers
                if (/\u2022|\u2023|\u25E6|^\s*[-–—\*\+]/m.test(text)) {
                    const parts = text.split(/\n+/).map(p => p.replace(/^\s*[\u2022\u2023\u25E6\-–—\*\+]\s*/, '').trim());
                    items = parts.filter(Boolean);
                } else {
                    // fallback: split on newlines only
                    const parts = text.split(/\n+/).map(p => p.trim());
                    items = parts.filter(Boolean);
                }
            }
        }

        items.forEach(item => {
            const li = document.createElement('li');
            li.className = 'mb-2';
            // allow HTML strings if passed, otherwise use text
            if (typeof item === 'string' && /<[^>]+>/.test(item)) {
                li.innerHTML = item;
            } else {
                li.textContent = item;
            }
            el.appendChild(li);
        });
    }

    function populateSkills(data) {
        const el = document.getElementById('sidebarSkills');
        el.innerHTML = '';
        if (!data) return;

        (Array.isArray(data) ? data : data.split(',')).forEach(skill => {
            const span = document.createElement('span');
            span.className = 'badge skill-badge';
            span.textContent = skill.trim();
            el.appendChild(span);
        });
    }

    function populateOtherJobs(currentJob) {
        const container = document.getElementById('otherJobs');
        container.innerHTML = '';

        allJobs.filter(j => j.id !== currentJob.id && j.department === currentJob.department).forEach(job => {
            const div = document.createElement('div');
            div.className = 'border rounded p-2 mb-2 d-flex justify-content-between align-items-center cursor-pointer';

            div.innerHTML = `
                <div>
                    <strong>${job.title}</strong><br>
                    <small class="text-muted">${job.department}</small>
                </div>
                <a href="javascript:void(0)"
                class="text-success open-job"
                style="text-decoration: none;"
                data-job='${JSON.stringify(job)}'>
                View →
                </a>
            `;

            container.appendChild(div);
        });
    }


    function openSidebar(job) {
        document.getElementById('sidebarTitle').textContent = job.title;
        document.getElementById('sidebarCollege').textContent = job.department;
        document.getElementById('sidebarType').textContent = job.employment;
        document.getElementById('sidebarLocationText').textContent = job.location;

        populateSkills(job.skills);
        populateList('sidebarDescription', job.job_description);
        populateList('sidebarResponsibilities', job.responsibilities);
        populateList('sidebarQualifications', job.requirements);
        populateList('sidebarBenefits', job.benifits);

        document.getElementById('applyJobBtn').href =
            `/application/non_teaching/procedure/${job.id}`;

        populateOtherJobs(job);

        sidebar.classList.add('show');
        overlay.style.display = 'block';
    }

    document.querySelectorAll('.view-details').forEach(btn => {
        btn.addEventListener('click', () => {
            openSidebar(JSON.parse(btn.dataset.job));
        });
    });

    document.addEventListener('click', e => {
        if (e.target.classList.contains('open-job')) {
            openSidebar(JSON.parse(e.target.dataset.job));
        }
    });

    document.querySelector('.close-btn').onclick = () => {
        sidebar.classList.remove('show');
        overlay.style.display = 'none';
    };

    overlay.onclick = () => {
        sidebar.classList.remove('show');
        overlay.style.display = 'none';
    };
</script>

@endsection
