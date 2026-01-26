@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

@include('layouts.header')  {{-- UNIVERSAL HEADER --}}


<div class="header-divider"></div>
@foreach($applicants as $applicant)
<main class="container my-5 animated-card1 delay-5">
    <div class="container my-5 shadow-sm p-4 bg-white rounded">
    <h2 class="fw-bold mb-1">Your Applications</h2>
    <p class="text-muted mb-4">Track the status of your job applications</p>

    {{-- Application Card 1 --}}
    <div class="card shadow-sm mb-4 animated-card delay-5">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-1">{{ $applicant->applied_position }}</h5>
                    <small class="text-muted">Submitted: {{ $applicant->created_at->format('m/d/y') }}</small>
                </div>
                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                    {{ $applicant->application_status }}
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
@endforeach
@endsection
