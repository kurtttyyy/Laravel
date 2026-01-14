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

            <div class="stepper1">

                <div class="step1 completed1">
                    <div class="circle1">1</div>
                    <div class="label1">Personal Info</div>
                </div>

                <div class="line1 completed1"></div>

                <div class="step1 completed1">
                    <div class="circle1">2</div>
                    <div class="label1">Experience</div>
                </div>

                <div class="line1 completed1"></div>

                <div class="step1">
                    <div class="circle1">3</div>
                    <div class="label1">Documents</div>
                </div>

                <div class="line1"></div>

                <div class="step1">
                    <div class="circle1">4</div>
                    <div class="label1">Review</div>
                </div>

                <div class="line1"></div>

                <div class="step1">
                    <div class="circle1">5</div>
                    <div class="label1">Submit</div>
                </div>

            </div>

<!-- Personal Info Form -->
<div id="personalForm" class="mt-4">
    <h4 class="fw-bold mb-3">Personal Information</h4>
    <form id="formPersonal">

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="first_name" class="form-label">First Name*</label>
                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter your first name" required>
            </div>

            <div class="col-md-6">
                <label for="last_name" class="form-label">Last Name*</label>
                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter your last name" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Email Address*</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">Phone Number*</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your phone number" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address*</label>
            <input type="text" id="address" name="address" class="form-control" placeholder="Enter your address" required>
        </div>

        <div class="d-flex justify-content-between">
            <div></div>
            <button type="button" id="btnToExperience" class="btn btn-primary">Proceed</button>
        </div>

    </form>
</div>

<!-- Work Experience & Education Form -->
<div id="experienceForm" class="mt-4 d-none">
    <h4 class="fw-bold mb-3">Work Experience & Education</h4>
    <form id="formExperience">

        <div class="mb-3">
            <label for="education" class="form-label">Highest Educational Attainment*</label>
            <select class="form-select" id="education" name="education" required>
                <option value="">Select one</option>
                <option value="High School">High School</option>
                <option value="Associate Degree">Associate Degree</option>
                <option value="Bachelor's Degree">Bachelor's Degree</option>
                <option value="Master's Degree">Master's Degree</option>
                <option value="Doctorate">Doctorate</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="field_study" class="form-label">Field of Study*</label>
            <select class="form-select" id="field_study" name="field_study" required>
                <option value="">Select one</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Business">Business</option>
                <option value="Engineering">Engineering</option>
                <option value="Education">Education</option>
                <option value="Health Sciences">Health Sciences</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="experience_years" class="form-label">Years of Relevant Experience*</label>
            <select class="form-select" id="experience_years" name="experience_years" required>
                <option value="">Select one</option>
                <option value="0–1">0–1</option>
                <option value="2–3">2–3</option>
                <option value="4–5">4–5</option>
                <option value="6+">6+</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="key_skills" class="form-label">Key Skill & Expertise*</label>

            <!-- Autocomplete suggestion box -->
            <input list="skillsList" class="form-control" id="key_skills" name="key_skills" placeholder="Type or select a skill" required>

            <datalist id="skillsList">
                <option value="Team Leadership">
                <option value="Project Management">
                <option value="Communication">
                <option value="Software Development">
                <option value="Graphic Design">
                <option value="Data Analysis">
                <option value="Customer Service">
            </datalist>
        </div>

        <div class="d-flex justify-content-between">
            <button type="button" id="btnBackToPersonal" class="btn btn-secondary">Previous</button>
            <button type="button" id="btnToDocuments" class="btn btn-primary">Proceed</button>
        </div>

    </form>
</div>

<!--Documents Form-->
<div id="documentsForm" class="mt-4 d-none">
    <h4 class="fw-bold mb-3">Required Document</h4>
    <form id="formDocuments" enctype="multipart/form-data">
        <!-- Resume/CV -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Resume/CV*</label>

            <label for="resume" class="upload-area">
                <i class="bi bi-file-earmark-arrow-up upload-icon"></i>
                <div class="upload-main-text">Click to upload your resume</div>
                <div class="upload-sub-text">PDF, DOC, DOCX (up to 5MB)</div>
                <input 
                    type="file" 
                    id="resume" 
                    name="resume"
                    accept=".pdf,.doc,.docx"
                    required
                >
            </label>
        </div>

        <!-- Cover Letter -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Cover Letter*</label>

            <label for="cover_letter" class="upload-area">
                <i class="bi bi-file-earmark-arrow-up upload-icon"></i>
                <div class="upload-main-text">Click to upload your cover letter</div>
                <div class="upload-sub-text">PDF, DOC, DOCX (up to 5MB)</div>
                <input 
                    type="file" 
                    id="cover_letter" 
                    name="cover_letter"
                    accept=".pdf,.doc,.docx"
                    required
                >
            </label>
        </div>

        <!-- Certifications -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Certifications & Supporting Document*</label>

            <label for="certifications" class="upload-area">
                <i class="bi bi-file-earmark-arrow-up upload-icon"></i>
                <div class="upload-main-text">Click to upload your documents</div>
                <div class="upload-sub-text">PDF, DOC, DOCX (up to 5MB)</div>
                <input 
                    type="file" 
                    id="certifications" 
                    name="certifications"
                    accept=".pdf,.doc,.docx"
                    required
                >
            </label>
        </div>


                <div class="d-flex justify-content-between">
                    <button type="button" id="btnBackToExperience" class="btn btn-secondary">Previous</button>
                    <button type="button" id="btnToReview" class="btn btn-primary">Proceed</button>
                </div>

            </form>
        </div>

    <!-- Review & Submit Form (to be implemented) -->
<!-- Review Your Application Form -->
<div id="reviewForm" class="mt-4 d-none">
    <h3 class="fw-bold mb-3">Review Your Application</h3>

    <div class="review-notice d-flex align-items-start mb-4">
        <div class="review-icon">i</div>
        <div class="ms-3">
            <div class="fw-semibold" style="font-size: 1.1rem;">Before you submit</div>
            <div class="text-dark-green">
                Please review all information carefully. You can go back to any previous step to make sure changes.
            </div>
        </div>
    </div>

    <!-- Personal Information Summary -->
    <div class="mb-4 p-3 border rounded shadow-sm bg-light">
        <h5 class="fw-bold text-success">Personal Information</h5>
        <p>First Name:</strong> <span id="review-first-name"></span></p>
        <p>Last Name:</strong> <span id="review-last-name"></span></p>
        <p>Email Address:</strong> <span id="review-email"></span></p>
        <p>Phone Number:</strong> <span id="review-phone"></span></p>
        <p>Address:</strong> <span id="review-address"></span></p>
    </div>

    <!-- Experience & Education Summary -->
    <div class="mb-4 p-3 border rounded shadow-sm bg-light">
        <h5 class="fw-bold text-success">Experience & Education</h5>
        <p>Highest Educational Attainment:</strong> <span id="review-education"></span></p>
        <p>Field of Study:</strong> <span id="review-field-study"></span></p>
        <p>Years of Relevant Experience:</strong> <span id="review-experience-years"></span></p>
        <p>Key Skills & Expertise:</strong> <span id="review-key-skills"></span></p>
    </div>

    <!-- Documents Summary -->
    <div class="mb-4 p-3 border rounded shadow-sm bg-light">
        <h5 class="fw-bold text-success">Documents</h5>
        <p>Resume/CV:</strong> <span id="review-resume-file"></span></p>
        <p>Cover Letter:</strong> <span id="review-cover-file"></span></p>
        <p>Certifications:</strong> <span id="review-certs-file"></span></p>
    </div>



<!-- Certification Checkbox -->
    <div class="review-notice1 d-flex align-items-start mb-4">
        <div class="form-check mb-3">
            <input 
                class="form-check-input" 
                type="checkbox" 
                id="certifyCheckbox" 
                required
            >
            <label class="form-check-label text-secondary" for="certifyCheckbox">
                I certify that all information provided is true and accurate to the best of my knowledge. 
                I understand that any false information may result in disqualification.
            </label>
        </div>
    </div>




    <div class="d-flex justify-content-between">
        <button type="button" id="btnBackToDocumentsFromReview" class="btn btn-secondary">Previous</button>
        <button type="submit" class="btn btn-success">Submit Application</button>
    </div>

    
</div>


        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const personalForm = document.getElementById('personalForm');
    const experienceForm = document.getElementById('experienceForm');
    const documentsForm = document.getElementById('documentsForm');
    const reviewForm = document.getElementById('reviewForm');

    const btnToExperience = document.getElementById('btnToExperience');
    const btnBackToPersonal = document.getElementById('btnBackToPersonal');
    const btnToDocuments = document.getElementById('btnToDocuments');
    const btnBackToExperience = document.getElementById('btnBackToExperience');
    const btnToReview = document.getElementById('btnToReview');
    const btnBackToDocumentsFromReview = document.getElementById('btnBackToDocumentsFromReview');

    const certifyCheckbox = document.getElementById('certifyCheckbox');

    // Disable submit button initially
    const submitButton = reviewForm.querySelector('button[type="submit"]');
    submitButton.disabled = true;

    // Enable/disable submit based on checkbox
    certifyCheckbox.addEventListener('change', () => {
        submitButton.disabled = !certifyCheckbox.checked;
    });

    btnToExperience.addEventListener('click', () => {
        personalForm.classList.add('d-none');
        experienceForm.classList.remove('d-none');
    });

    btnBackToPersonal.addEventListener('click', () => {
        experienceForm.classList.add('d-none');
        personalForm.classList.remove('d-none');
    });

    btnToDocuments.addEventListener('click', () => {
        experienceForm.classList.add('d-none');
        documentsForm.classList.remove('d-none');
    });

    btnBackToExperience.addEventListener('click', () => {
        documentsForm.classList.add('d-none');
        experienceForm.classList.remove('d-none');
    });

    btnToReview.addEventListener('click', () => {
        // Populate summary fields
        document.getElementById('review-first-name').textContent = document.getElementById('first_name').value;
        document.getElementById('review-last-name').textContent = document.getElementById('last_name').value;
        document.getElementById('review-email').textContent = document.getElementById('email').value;
        document.getElementById('review-phone').textContent = document.getElementById('phone').value;
        document.getElementById('review-address').textContent = document.getElementById('address').value;

        document.getElementById('review-education').textContent = document.getElementById('education').value;
        document.getElementById('review-field-study').textContent = document.getElementById('field_study').value;
        document.getElementById('review-experience-years').textContent = document.getElementById('experience_years').value;
        document.getElementById('review-key-skills').textContent = document.getElementById('key_skills').value;

        const resumeInput = document.getElementById('resume');
        const coverInput = document.getElementById('cover_letter');
        const certsInput = document.getElementById('certifications');

        document.getElementById('review-resume-file').textContent = resumeInput.files.length ? resumeInput.files[0].name : 'None';
        document.getElementById('review-cover-file').textContent = coverInput.files.length ? coverInput.files[0].name : 'None';
        document.getElementById('review-certs-file').textContent = certsInput.files.length ? certsInput.files[0].name : 'None';

        documentsForm.classList.add('d-none');
        reviewForm.classList.remove('d-none');

        // reset checkbox and submit state
        certifyCheckbox.checked = false;
        submitButton.disabled = true;
    });

    btnBackToDocumentsFromReview.addEventListener('click', () => {
        reviewForm.classList.add('d-none');
        documentsForm.classList.remove('d-none');
    });

    // Prevent form submission if checkbox is not checked
    reviewForm.querySelector('form, button[type="submit"]').addEventListener('click', (e) => {
        if (!certifyCheckbox.checked) {
            e.preventDefault();
            alert('Please certify that the information provided is true before submitting.');
        }
    });
});
</script>







@endsection
