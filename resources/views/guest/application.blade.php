@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

@include('layouts.header')  {{-- UNIVERSAL HEADER --}}

<div class="header-divider"></div>

{{-- Email Verification Modal --}}
<div class="modal fade" id="emailCheckModal" tabindex="-1" aria-labelledby="emailCheckLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0 justify-content-center">
                <div class="text-center w-100">
                    <i class="bi bi-envelope-check text-primary display-4 mb-2"></i>
                    <h5 class="modal-title fw-bold" id="emailCheckLabel">Verify Your Email</h5>
                    <p class="text-muted small">Enter your email to continue to your applications</p>
                </div>
            </div>
            <div class="modal-body px-4">
                <input type="email" id="verifyEmail" class="form-control py-2 rounded-pill shadow-sm" placeholder="you@example.com">
                <div id="emailError" class="text-danger mt-2 text-center small" style="display:none;">Please enter a valid email.</div>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-primary px-4 py-2 rounded-pill fw-bold" onclick="checkEmail()">
                    Continue
                </button>
            </div>
        </div>
    </div>
</div>

<main id="applicationsContent" class="container my-5 animated-card1 delay-5" style="display:none;">
    <div class="container my-5 shadow-sm p-4 bg-white rounded-4">
        <h2 class="fw-bold mb-1">Your Applications</h2>
        <p class="text-muted mb-4">Track the status of your job applications</p>

        {{-- Application Card 1 --}}
        <div class="card shadow-sm mb-4 rounded-4 border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="mb-1 fw-semibold">Assistant Professor - Computer Science</h5>
                        <small class="text-muted">Submitted: Jan 20, 2025</small>
                    </div>
                    <span class="badge rounded-pill bg-primary text-white px-3 py-2">Under Review</span>
                </div>

                {{-- Progress --}}
                <div class="stepper mb-3">
                    <div class="step completed"><div class="circle">✓</div><div class="line"></div></div>
                    <div class="step completed"><div class="circle">✓</div><div class="line"></div></div>
                    <div class="step"><div class="circle">3</div><div class="line"></div></div>
                    <div class="step"><div class="circle">4</div></div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-success fw-semibold">Next: Final Interview</span>
                </div>
            </div>
        </div>

        {{-- Application Card 2 --}}
        <div class="card shadow-sm mb-4 rounded-4 border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="mb-1 fw-semibold">IT Support Specialist</h5>
                        <small class="text-muted">Submitted: Jan 15, 2025</small>
                    </div>
                    <span class="badge rounded-pill bg-success text-white px-3 py-2">Interview Scheduled</span>
                </div>

                {{-- Progress --}}
                <div class="stepper mb-3">
                    <div class="step completed"><div class="circle">✓</div><div class="line"></div></div>
                    <div class="step completed"><div class="circle">✓</div><div class="line"></div></div>
                    <div class="step"><div class="circle">3</div><div class="line"></div></div>
                    <div class="step"><div class="circle">4</div></div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-success fw-semibold">Next: Final Interview</span>
                </div>
            </div>
        </div>

    </div>

    {{-- Application Tips --}}
    <div class="container my-5 shadow-sm p-4 rounded-4 bg-light">
        <div class="d-flex align-items-start">
            <div class="me-3">
                <i class="bi bi-lightbulb-fill tips-icon text-warning display-6"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-2">Application Tips</h6>
                <ul class="list-unstyled mb-0 small">
                    <li>• Check your email regularly for updates from our HR team</li>
                    <li>• You will be notified at each stage of the application process</li>
                    <li>• Interview invitations will be sent via email at least 3 days notice</li>
                </ul>
            </div>
        </div>
    </div>

</main>

{{-- JavaScript --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Show modal on page load
        const emailModal = new bootstrap.Modal(document.getElementById('emailCheckModal'));
        emailModal.show();
    });

    function checkEmail() {
        const emailInput = document.getElementById('verifyEmail');
        const emailError = document.getElementById('emailError');
        const content = document.getElementById('applicationsContent');
        const email = emailInput.value.trim();

        // Simple validation
        if (!email || !email.includes('@')) {
            emailError.style.display = 'block';
            return;
        }

        emailError.style.display = 'none';

        // Close modal
        const emailModal = bootstrap.Modal.getInstance(document.getElementById('emailCheckModal'));
        emailModal.hide();

        // Show application content
        content.style.display = 'block';
    }
</script>

@endsection
