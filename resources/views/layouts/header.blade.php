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
            <!-- HOME (text only, clickable) -->
            <a href="{{ route('guest.index') }}"
               class="nav-home-link">
                Home
            </a>

            <!-- Buttons -->
            <a href="{{ route('guest.index') }}" class="btn btn-sm btn-outline-light">
                Job Applicant
            </a>
            <a href="{{ route('guest.application') }}" class="btn btn-sm btn-outline-light">
                Application Status
            </a>
        </div>
    </div>
</header>

<div class="header-divider" aria-hidden="true"></div>
