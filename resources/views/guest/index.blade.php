@extends('layouts.app')

@section('content')
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
            <a href="{{ route('guest.jobOpen') }}" class="btn btn-sm btn-outline-light">Job Applicant</a>
            <a href="{{ route('guest.application') }}" class="btn btn-sm btn-outline-light">Application Status</a>
        </div>
    </div>
</header>
<div class="header-divider" aria-hidden="true"></div>

<main>
    <section class="hero text-white py-5">
        <div class="container text-center py-5">
            <h1 class="display-5 fw-bold">Build Your Future With Us</h1>
            <p class="lead mb-4">Explore career opportunities and take the first step towards your dream job</p>

            <form class="d-flex justify-content-center mb-4" role="search">
                <div class="input-group search-input" style="max-width:720px;">
                    <input type="search" class="form-control" placeholder="Search job titles, keywords..." aria-label="Search">
                    <button class="btn btn-hero" type="submit">Search</button>
                </div>
            </form>
        </div>


    </section>
            <div class="container">
            <div class="filter-card bg-white rounded shadow-sm p-4 mx-auto" style="max-width:1100px; margin-top:-40px;">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label small mb-1">Department</label>
                        <select class="form-select">
                            <option>All Departments</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small mb-1">Employment Type</label>
                        <select class="form-select">
                            <option>All Types</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small mb-1">Location</label>
                        <select class="form-select">
                            <option>All Locations</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="container stats-section mt-4">
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <div class="stat-card bg-white rounded p-3">
                        <div class="stat-number fw-bold display-6">24</div>
                        <div class="stat-label small text-muted">Open Positions</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card bg-white rounded p-3">
                        <div class="stat-number fw-bold display-6">8</div>
                        <div class="stat-label small text-muted">Departments</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card bg-white rounded p-3">
                        <div class="stat-number fw-bold display-6">500+</div>
                        <div class="stat-label small text-muted">Employees</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card bg-white rounded p-3">
                        <div class="stat-number fw-bold display-6">
                            4.8<span class="star">★</span>
                        </div>
                        <div class="stat-label small text-muted">Company Rating</div>
                    </div>
                </div>
            </div>
        </div>

<div class="container mt-5">
    <h2 class="fw-bold text-start">Job Vacancies</h2>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card p-3 rounded shadow-sm mb-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold mb-1">Assistant Professor - Computer Science</h5>
                    <span class="badge bg-success">New</span>
                </div>
                <small class="text-muted">Academic Department</small>
                <p class="mt-2 mb-3 text-truncate" style="max-width: 100%;">We are seeking a passionate educator to join our Computer Science department...</p>
                <div class="mb-3">
                    <span class="badge bg-success bg-opacity-25 text-success me-1 bordered-badge">Full-time</span>
                    <span class="badge custom-badge me-1">Part-time</span>
                    <span class="badge bg-purple-light-opacity me-1">On-site</span>
                </div>
                <button onclick="window.location.href='/job/available'" class="btn btn-primary w-100 green-btn">View Details & Apply</button>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card p-3 rounded shadow-sm mb-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold mb-1">Assistant Professor - Computer Science</h5>
                    <span class="badge bg-success">New</span>
                </div>
                <small class="text-muted">Academic Department</small>
                <p class="mt-2 mb-3 text-truncate" style="max-width: 100%;">We are seeking a passionate educator to join our Computer Science department...</p>
                <div class="mb-3">
                    <span class="badge bg-success bg-opacity-25 text-success me-1 bordered-badge">Full-time</span>
                    <span class="badge custom-badge me-1">Part-time</span>
                    <span class="badge bg-purple-light-opacity me-1">On-site</span>
                </div>
                <button class="btn btn-primary w-100 green-btn">View Details & Apply</button>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card p-3 rounded shadow-sm mb-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold mb-1">Assistant Professor - Computer Science</h5>
                    <span class="badge bg-success">New</span>
                </div>
                <small class="text-muted">Academic Department</small>
                <p class="mt-2 mb-3 text-truncate" style="max-width: 100%;">We are seeking a passionate educator to join our Computer Science department...</p>
                <div class="mb-3">
                    <span class="badge bg-success bg-opacity-25 text-success me-1 bordered-badge">Full-time</span>
                    <span class="badge custom-badge me-1">Part-time</span>
                    <span class="badge bg-purple-light-opacity me-1">On-site</span>
                </div>
                <button class="btn btn-primary w-100 green-btn">View Details & Apply</button>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card p-3 rounded shadow-sm mb-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold mb-1">Assistant Professor - Computer Science</h5>
                    <span class="badge bg-success">New</span>
                </div>
                <small class="text-muted">Academic Department</small>
                <p class="mt-2 mb-3 text-truncate" style="max-width: 100%;">We are seeking a passionate educator to join our Computer Science department...</p>
                <div class="mb-3">
                    <span class="badge bg-success bg-opacity-25 text-success me-1 bordered-badge">Full-time</span>
                    <span class="badge custom-badge me-1">Part-time</span>
                    <span class="badge bg-purple-light-opacity me-1">On-site</span>
                </div>
                <button class="btn btn-primary w-100 green-btn">View Details & Apply</button>
            </div>
        </div>


    </div>
</div>



</main>
@endsection