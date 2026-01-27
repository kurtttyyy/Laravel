@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


@include('layouts.header')  {{-- UNIVERSAL HEADER --}}


<div class="header-divider"></div>

<main class="container my-5">

    {{-- step 1 --}}
    <div class="card shadow-sm mb-4 animated-card delay-5 hover-card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h2 class="mb-1">Apply for {{ $openPosition->title}}</h2>
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
<form id="formPersonal" action="{{ route('applicant.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" id="last_name" name="position" class="form-control" value="{{ $openPosition->title}}" hidden>
    <div id="personalForm" class="mt-4 form-step">
        <h4 class="fw-bold mb-3">Personal Information</h4>
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

            <div class="d-flex justify-content-end mt-auto">
                <div></div>
                <button type="button" id="btnToExperience" class="btn btn-primary">Proceed</button>
            </div>
    </div>


    <!-- Work Experience & Education Form -->
    <div id="experienceForm" class="mt-4 d-none form-step">
        <h4 class="fw-bold mb-3">Educational Background</h4>
            <div class="mb-3">
                <label for="education" class="form-label">Highest Educational Attainment*</label>
                <select class="form-select" id="education" name="education" required>
                    <option value="">Select one</option>
                    <option value="High School">High School</option>
                    <option value="Associate Degree">Associate Degree</option>
                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                    <option value="Master's Degree">Master's Degree</option>
                    <option value="Master's Degree">Master of Science (MSc)</option>
                    <option value="Master's Degree">Master of Arts (MA)</option>
                    <option value="Doctorate">Doctor of Philosophy (PhD)</option>
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
                <label for="field_study" class="form-label">University Name*</label>
                    <input class="form-select" id="field_study" name="university_name" required>
            </div>

            <div class="mb-3">
                <label for="field_study" class="form-label">Address*</label>
                    <input class="form-select" id="field_study" name="university_address" required>
                </select>
            </div>

            <div class="mb-3">
                <label for="field_study" class="form-label">Year Complete*</label>
                    <input class="form-select" id="field_study" name="year_complete" required>
                </select>
            </div>

        <br>
        <h4 class="fw-bold mb-3">Work Experience</h4>

            <div class="mb-3">
                <label for="field_study" class="form-label">Position*</label>
                    <input class="form-select" id="field_study" name="work_position" required>
                </select>
            </div>

            <div class="mb-3">
                <label for="field_study" class="form-label">Employer*</label>
                <input class="form-select" id="field_study" name="work_employer" required>
                </select>
            </div>
            <div class="mb-3">
                <label for="field_study" class="form-label">Location*</label>
                <input class="form-select" id="field_study" name="work_location" required>
                </select>
            </div>
            <div class="mb-3">
                <label for="field_study" class="form-label">Duration*</label>
                    <input class="form-select" id="field_study" name="work_duration" required>
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

            <div class="d-flex justify-content-between mt-auto ">
                <button type="button" id="btnBackToPersonal" class="btn btn-secondary">Previous</button>
                <button type="button" id="btnToDocuments" class="btn btn-primary">Proceed</button>
            </div>
    </div>

    <!--Documents Form-->
    <div id="documentsForm" class="mt-4 d-none form-step">
        <h4 class="fw-bold mb-3">Required Document</h4>
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
                        name="documents[0][file]"
                        accept=".pdf,.doc,.docx"
                        required
                    >
                    <input type="hidden" name="documents[0][type]" value="Resume/CV">
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
                        name="documents[1][file]"
                        accept=".pdf,.doc,.docx"
                        required
                    >
                    <input type="hidden" name="documents[1][type]" value="Cover Letter">
                </label>
            </div>

            <!-- Personal Data Sheet -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Personal Data Sheet*</label>

                <label for="cover_letter" class="upload-area">
                    <i class="bi bi-file-earmark-arrow-up upload-icon"></i>
                    <div class="upload-main-text">Click to upload your Personal Data Sheet</div>
                    <div class="upload-sub-text">PDF, DOC, DOCX (up to 5MB)</div>
                    <input
                        type="file"
                        id="personal_data_sheet"
                        name="documents[2][file]"
                        accept=".pdf,.doc,.docx"
                        required
                    >
                    <input type="hidden" name="documents[2][type]" value="Personal Data Sheet">
                </label>
            </div>

            <!-- Transcript Of Records -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Transcript Of Records*</label>

                <label for="cover_letter" class="upload-area">
                    <i class="bi bi-file-earmark-arrow-up upload-icon"></i>
                    <div class="upload-main-text">Click to upload your Transcript Of Records</div>
                    <div class="upload-sub-text">PDF, DOC, DOCX (up to 5MB)</div>
                    <input
                        type="file"
                        id="TOR"
                        name="documents[3][file]"
                        accept=".pdf,.doc,.docx"
                        required
                    >
                    <input type="hidden" name="documents[3][type]" value="Transcript Of Records">
                </label>
            </div>

            <!-- Diploma, Master's, Doctorate -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Diploma, Master's (if available), Doctorate (if available)</label>

                <label for="cover_letter" class="upload-area">
                    <i class="bi bi-file-earmark-arrow-up upload-icon"></i>
                    <div class="upload-main-text">Click to upload your Diploma, Master's, Doctorate</div>
                    <div class="upload-sub-text">PDF, DOC, DOCX (up to 5MB)</div>
                    <input
                        type="file"
                        id="diploma"
                        name="documents[4][file]"
                        accept=".pdf,.doc,.docx"
                        required
                    >
                    <input type="hidden" name="documents[4][type]" value="Diploma">
                </label>
            </div>

            <!-- PRC License/Board Rating -->
            <div class="mb-4">
                <label class="form-label fw-semibold">PRC License/Board Rating (if Applicable)</label>

                <label for="cover_letter" class="upload-area">
                    <i class="bi bi-file-earmark-arrow-up upload-icon"></i>
                    <div class="upload-main-text">Click to upload your PRC License/Board Rating</div>
                    <div class="upload-sub-text">PDF, DOC, DOCX (up to 5MB)</div>
                    <input
                        type="file"
                        id="board_rating"
                        name="documents[5][file]"
                        accept=".pdf,.doc,.docx"
                        required
                    >
                    <input type="hidden" name="documents[5][type]" value="PRC License/Board Rating">
                </label>
            </div>

            <!-- Certificate Of Eligibility / Cetificate of Passing  -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Certificate Of Eligibility / Cetificate of Passing(If Applicable)</label>

                <label for="cover_letter" class="upload-area">
                    <i class="bi bi-file-earmark-arrow-up upload-icon"></i>
                    <div class="upload-main-text">Click to upload your Certificate Of Eligibility / Cetificate of Passing </div>
                    <div class="upload-sub-text">PDF, DOC, DOCX (up to 5MB)</div>
                    <input
                        type="file"
                        id="certificate_eligibility"
                        name="documents[6][file]"
                        accept=".pdf,.doc,.docx"
                        required
                    >
                    <input type="hidden" name="documents[6][type]" value="certificatCertificate Of Eligibility / Cetificate of Passinge_eligibility">
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
                        name="documents[7][file]"
                        accept=".pdf,.doc,.docx"
                        required
                    >
                    <input type="hidden" name="documents[7][type]" value="Certifications & Supporting Document">
                </label>
            </div>

            <!-- Membership/affiliation -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Membership/affiliation(If Applicable)</label>

                <label for="Membership/affiliation" class="upload-area">
                    <i class="bi bi-file-earmark-arrow-up upload-icon"></i>
                    <div class="upload-main-text">Click to upload your documents</div>
                    <div class="upload-sub-text">PDF, DOC, DOCX (up to 5MB)</div>
                    <input
                        type="file"
                        id="Membership/affiliation"
                        name="documents[8][file]"
                        accept=".pdf,.doc,.docx"
                        required
                    >
                    <input type="hidden" name="documents[8][type]" value="Membership/Affiliation">
                </label>
            </div>


                <div class="d-flex justify-content-between">
                    <button type="button" id="btnBackToExperience" class="btn btn-secondary">Previous</button>
                    <button type="button" id="btnToReview" class="btn btn-primary">Proceed</button>
                </div>
            </div>

        <!-- Review & Submit Form (to be implemented) -->
    <!-- Review Your Application Form -->
    <div id="reviewForm" class="mt-4 d-none form-step">
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

        <!-- Education & Experience Summary -->
        <div class="mb-4 p-3 border rounded shadow-sm bg-light">
            <h5 class="fw-bold text-success">Education & Experience</h5>
            <p>Highest Educational Attainment:</strong> <span id="review-education"></span></p>
            <p>Field of Study:</strong> <span id="review-field-study"></span></p>
            <p>University:</strong> <span id=""></span></p>
            <p>Address:</strong> <span id=""></span></p>
            <p>Year Complete:</strong> <span id=""></span></p>
            <p>Position</strong> <span id=""></span></p>
            <p>Employer</strong> <span id=""></span></p>
            <p>Location</strong> <span id=""></span></p>
            <p>Duration</strong> <span id=""></span></p>
            <p>Years of Relevant Experience:</strong> <span id="review-experience-years"></span></p>
            <p>Key Skills & Expertise:</strong> <span id="review-key-skills"></span></p>
        </div>

        <!-- Documents Summary -->
        <div class="mb-4 p-3 border rounded shadow-sm bg-light">
            <h5 class="fw-bold text-success">Documents</h5>
            <p>Resume/CV:</strong> <span id="review-resume-file"></span></p>
            <p>Cover Letter:</strong> <span id="review-cover-file"></span></p>
            <p>Personal Data Sheet:</strong> <span id=""></span></p>
            <p>Transcript Of Records:</strong> <span id=""></span></p>
            <p>Diploma, master's, Doctorate</strong> <span id=""></span></p>
            <p>PRC License/Board Rating</strong> <span id=""></span></p>
            <p>Certificate Of Eligibility / Cetificate of Passing</strong> <span id=""></span></p>
            <p>Certifications:</strong> <span id="review-certs-file"></span></p>
            <p>Membership/affiliation</strong> <span id=""></span></p>
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
</form>


        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {

    /* =======================
       FORM SECTIONS
    ======================= */
    const personalForm   = document.getElementById('personalForm');
    const experienceForm = document.getElementById('experienceForm');
    const documentsForm  = document.getElementById('documentsForm');
    const reviewForm     = document.getElementById('reviewForm');

    /* =======================
       BUTTONS
    ======================= */
    const btnToExperience              = document.getElementById('btnToExperience');
    const btnBackToPersonal            = document.getElementById('btnBackToPersonal');
    const btnToDocuments               = document.getElementById('btnToDocuments');
    const btnBackToExperience          = document.getElementById('btnBackToExperience');
    const btnToReview                  = document.getElementById('btnToReview');
    const btnBackToDocumentsFromReview = document.getElementById('btnBackToDocumentsFromReview');

    /* =======================
       STEPPER ELEMENTS
    ======================= */
    const steps = document.querySelectorAll('.step1');
    const lines = document.querySelectorAll('.line1');

    function setStep(stepNumber) {
        steps.forEach((step, index) => {
            step.classList.remove('active', 'completed1');
            if (index + 1 < stepNumber) step.classList.add('completed1');
            else if (index + 1 === stepNumber) step.classList.add('active');
        });

        lines.forEach((line, index) => {
            line.classList.toggle('completed1', index < stepNumber - 1);
        });
    }

    setStep(1); // Initial step

    /* =======================
       CERTIFICATION CHECKBOX
    ======================= */
    const certifyCheckbox = document.getElementById('certifyCheckbox');
    const submitButton = reviewForm.querySelector('button[type="submit"]');
    submitButton.disabled = true;

    certifyCheckbox.addEventListener('change', () => {
        submitButton.disabled = !certifyCheckbox.checked;
    });

    /* =======================
       FORM TRANSITION FUNCTION
    ======================= */
    function transitionForms(hideForm, showForm, direction = 'forward') {
        const outClass = direction === 'forward' ? 'slide-out-left' : 'slide-out-right';
        const inClass  = direction === 'forward' ? 'slide-in-right' : 'slide-in-left';

        hideForm.classList.add(outClass);

        setTimeout(() => {
            hideForm.classList.add('d-none');
            hideForm.classList.remove(outClass);

            showForm.classList.remove('d-none');
            showForm.classList.add(inClass);

            setTimeout(() => {
                showForm.classList.remove(inClass);
            }, 450);
        }, 300);
    }

    /* =======================
       NAVIGATION LOGIC
    ======================= */

    // Step 1 → Step 2
    btnToExperience.addEventListener('click', () => {
        transitionForms(personalForm, experienceForm, 'forward');
        setStep(2);
    });

    // Step 2 → Step 1
    btnBackToPersonal.addEventListener('click', () => {
        transitionForms(experienceForm, personalForm, 'back');
        setStep(1);
    });

    // Step 2 → Step 3
    btnToDocuments.addEventListener('click', () => {
        transitionForms(experienceForm, documentsForm, 'forward');
        setStep(3);
    });

    // Step 3 → Step 2
    btnBackToExperience.addEventListener('click', () => {
        transitionForms(documentsForm, experienceForm, 'back');
        setStep(2);
    });

    // Step 3 → Step 4 (Review)
    btnToReview.addEventListener('click', () => {
        // Populate review fields
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
        const coverInput  = document.getElementById('cover_letter');
        const certsInput  = document.getElementById('certifications');

        document.getElementById('review-resume-file').textContent =
            resumeInput.files.length ? resumeInput.files[0].name : 'None';
        document.getElementById('review-cover-file').textContent =
            coverInput.files.length ? coverInput.files[0].name : 'None';
        document.getElementById('review-certs-file').textContent =
            certsInput.files.length ? certsInput.files[0].name : 'None';

        transitionForms(documentsForm, reviewForm, 'forward');
        certifyCheckbox.checked = false;
        submitButton.disabled = true;
        setStep(4);
    });

    // Step 4 → Step 3
    btnBackToDocumentsFromReview.addEventListener('click', () => {
        transitionForms(reviewForm, documentsForm, 'back');
        setStep(3);
    });

});

</script>








@endsection
