@extends('layouts.app')

@section('page-loader')
<div id="page-loader" class="page-loader" role="status">
    <div class="loader-content">
        <div class="loader-icon">
            <div class="dot dot-1"></div>
            <div class="dot dot-2"></div>
            <div class="dot dot-3"></div>
        </div>
        <div class="loader-text">
            loading opportunities<span class="dots">...</span>
        </div>
    </div>
</div>
@endsection
@push('loader-script')
<script>
(function(){
    const loader = document.getElementById('page-loader');
    if(!loader) return;

    const minDelay = 1000;
    const start = Date.now();

    function hideLoader(){
        const elapsed = Date.now() - start;
        const remaining = Math.max(0, minDelay - elapsed);
        setTimeout(()=>{
            loader.classList.add('fade-out');
            setTimeout(()=> loader.remove(), 350);
        }, remaining);
    }

    if(document.readyState === 'complete'){
        hideLoader();
    } else {
        window.addEventListener('load', hideLoader);
    }
})();
</script>
@endpush


@section('content')
@include('layouts.header')  {{-- UNIVERSAL HEADER --}}
<div class="header-divider" aria-hidden="true"></div>

<main>
<section class="hero text-white py-5 position-relative overflow-hidden">

    <!-- Carousel Background -->
    <div id="heroCarousel" class="carousel slide carousel-fade position-absolute top-0 start-0 w-100 h-100"
         data-bs-ride="carousel" data-bs-interval="4000">

        <div class="carousel-inner h-100">
            <div class="carousel-item active h-100">
                <img src="{{ asset('images/banner2.png') }}"
                     class="d-block w-100 h-90 object-fit-cover"
                     alt="Careers">
            </div>
            <div class="carousel-item h-100">
                <img src="{{ asset('images/Banner1.png') }}"
                     class="d-block w-100 h-90 object-fit-cover"
                     alt="Team">
            </div>
            <div class="carousel-item h-100">
                <img src="{{ asset('images/banner3.png') }}"
                     class="d-block w-100 h-90 object-fit-cover"
                     alt="Growth">
            </div>
        </div>
    </div>

    <!-- Dark Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-75"></div>

    <!-- Hero Content -->
    <div class="container text-center py-5 position-relative z-3">
        <h1 class="display-5 fw-bold text-warning">
            Build Your Future With Us
        </h1>

        <p class="lead mb-4 text-warning">
            Explore career opportunities and take the first step towards your dream job
        </p>


        <form class="d-flex justify-content-center mb-4" role="search">
            <div class="input-group search-input" style="max-width:720px;">
                <input type="search" class="form-control"
                       placeholder="Search job titles, keywords..."
                       aria-label="Search">
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
                        <div class="stat-number fw-bold display-6">{{$openCount}}</div>
                        <div class="stat-label small text-muted">Open Positions</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card bg-white rounded p-3">
                        <div class="stat-number fw-bold display-6">{{$department}}</div>
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
        @foreach ($open_position as $position)
            <div class="col-12 col-md-6">
                <div class="card p-3 rounded shadow-sm mb-4 animated-card delay-5 hover-card border-1">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-bold mb-1">{{ $position->title }}</h5>
                        <span class="badge bg-success">New</span>
                    </div>

                    <small class="text-muted">{{ $position->department }}</small>

                    @php
                        $lines = preg_split("/\r\n|\n|\r/", $position->job_description);
                    @endphp

                    <ul class="list-unstyled mt-2 mb-3">
                        @foreach ($lines as $line)
                            <li>{{ substr(ltrim($line, "•- "), 0, 150) }}{{ strlen($line) > 150 ? '......' : '' }}</li>
                        @endforeach
                    </ul>



                    <div class="mb-3">
                        @if ($position->employment == "Full-Time")
                            <span class="badge bg-success bg-opacity-25 text-success me-1 bordered-badge">Full - Time</span>
                            <span class="badge bg-purple-light-opacity me-1">{{ $position->work_mode }}</span>
                        @else
                            <span class="badge bg-success bg-opacity-25 text-success me-1 bordered-badge">Part - Time</span>
                            <span class="badge bg-purple-light-opacity me-1">{{ $position->work_mode }}</span>
                        @endif
                    </div>

                    <button
                        onclick="window.location.href='{{ route('guest.jobOpen', $position->id) }}'";
                        class="btn btn-primary w-100 green-btn"
                    >
                        View Details & Apply
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>




</main>
@endsection
