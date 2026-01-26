<header class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
    <div class="container-fluid">
        <div class="navbar-brand d-flex align-items-center gap-3">
            <img src="{{ asset('images/logo.webp') }}" alt="Logo" height="70">
            <div class="d-flex flex-column">
                <span class="fw-bold fs-2 mb-0 text-white">HUMAN RESOURCES DEPARTMENT</span>
                <small class="subtext">Join Our Team</small>
            </div>
        </div>

        <div class="ms-auto d-flex align-items-center gap-4">
            <!-- HOME -->
            <a href="{{ route('guest.index') }}" class="nav-home-link">Home</a>

            <!-- Buttons -->
            <a href="{{ route('guest.index') }}" class="btn btn-sm btn-outline-light">Job Applicant</a>

            <!-- Application Status button triggers modal -->
            <button id="applicationStatusBtn" class="btn btn-sm btn-outline-light">
                Application Status
            </button>
        </div>
    </div>
</header>

<div class="header-divider" aria-hidden="true"></div>

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
    {{-- Your application cards here (same as previous design) --}}
</main>

{{-- JavaScript --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Grab the Application Status button
        const appStatusBtn = document.getElementById('applicationStatusBtn');

        // Only show modal when button is clicked
        appStatusBtn.addEventListener('click', function() {
            const emailModal = new bootstrap.Modal(document.getElementById('emailCheckModal'));
            emailModal.show();
        });
    });

    function checkEmail() {
        const emailInput = document.getElementById('verifyEmail');
        const emailError = document.getElementById('emailError');
        const email = emailInput.value.trim();

        // Simple validation
        if (!email || !email.includes('@')) {
            emailError.style.display = 'block';
            return;
        }

        emailError.style.display = 'none';

        // Redirect to application status page
        // You can pass the email as a query parameter if needed: ?email=...
        window.location.href = "{{ route('guest.application') }}?email=" + encodeURIComponent(email);
    }
</script>

