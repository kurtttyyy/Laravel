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
    <div class="container my-5 shadow-sm p-4 bg-white rounded">
    <h2 class="fw-bold mb-1">Your Applications</h2>
    <p class="text-muted mb-4">Track the status of your job applications</p>

    {{-- Application Card 1 --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-1">Assistant Professor - Computer Science</h5>
                    <small class="text-muted">Submitted: Jan 20, 2025</small>
                </div>
                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                    Under Review
                </span>
            </div>

            {{-- Progress --}}
            <div class="stepper">
                <div class="step completed">
                    <div class="circle">✓</div>
                    <div class="line"></div>
                </div>

                <div class="step completed">
                    <div class="circle">✓</div>
                    <div class="line"></div>
                </div>

                <div class="step">
                    <div class="circle">3</div>
                    <div class="line"></div>
                </div>

                <div class="step">
                    <div class="circle">4</div>
                </div>
            </div>


            <div class="d-flex justify-content-between align-items-center">
                <span class="text-success">Next: Final Interview</span>
                <!--<a href="#" class="fw-semibold text-success text-decoration-none">
                    View Details →
                </a>
                -->
            </div>

        </div>
    </div>

    {{-- Application Card 2 --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-1">IT Support Specialist</h5>
                    <small class="text-muted">Submitted: Jan 15, 2025</small>
                </div>
                <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                    Interview Scheduled
                </span>
            </div>

            {{-- Progress --}}
            <div class="stepper">
                <div class="step completed">
                    <div class="circle">✓</div>
                    <div class="line"></div>
                </div>

                <div class="step completed">
                    <div class="circle">✓</div>
                    <div class="line"></div>
                </div>

                <div class="step">
                    <div class="circle">3</div>
                    <div class="line"></div>
                </div>

                <div class="step">
                    <div class="circle">4</div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <span class="text-success">Next: Final Interview</span>
             <!--   <a href="#" class="fw-semibold text-success text-decoration-none">
                    View Details →
                </a>
            -->
            </div>
        </div>
    </div>
    </div>

        <div class="container my-5 shadow-sm p-4 rounded application-tips">
            <div class="d-flex align-items-start">
                <!-- Icon -->
                <div class="me-3">
                    <i class="bi bi-lightbulb-fill tips-icon"></i>
                </div>

                <!-- Content -->
                <div>
                    <h6 class="fw-bold mb-2">Application Tips</h6>
                    <ul class="list-unstyled mb-0">
                        <li>• Check your email regularly for updates from our HR team</li>
                        <li>• You will be notified at each stage of the application process</li>
                        <li>• Interview invitations will be sent via email at least 3 days notice</li>
                    </ul>
                </div>
            </div>
        </div>

</main>
@endsection
