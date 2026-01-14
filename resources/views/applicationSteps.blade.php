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

    {{-- step 1 --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h2 class="mb-1">Apply for HR Assistant</h2>
                    <h6 class="text-secondary mb-1">Please fill out all fields to  complete your application</h6>
                </div>

            </div>


        </div>
    </div>
</main>




@endsection
