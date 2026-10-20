<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Your Portfolio</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --primary: #4D52B4;
            --primary-dark: #383D91;
            --sky-blue: #4E9CE8;
            --turquoise: #70D6C5;
            --pale-green: #CAE5BC;
            --soft-cream: #E1EDD4;
            --background: #CAE5BC;
            --panel: #F8FBF5;
            --text: #24364B;
            --muted: #718096;
            --border: #D8E8D0;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(
                145deg,
                #4E9CE8 0%,
                #70D6C5 38%,
                #CAE5BC 72%,
                #E1EDD4 100%
            );
            background-attachment: fixed;
            margin: 0;
            padding: 40px 18px;
            color: var(--text);
            min-height: 100vh;
        }

        /* MAIN CONTAINER */

        .container {
            max-width: 900px;
            margin: auto;
            padding: 38px;
            border: 1px solid rgba(255, 255, 255, 0.95);
            border-radius: 28px;
            background: rgba(250, 252, 247, 0.97);

            /* Matching container shadow from Create Portfolio */
            box-shadow:
                0 0 18px rgba(77, 82, 180, 0.10),
                0 0 35px rgba(78, 156, 232, 0.16),
                14px 14px 35px rgba(49, 91, 132, 0.14),
                -10px -10px 30px rgba(255, 255, 255, 0.55);
        }

        /* BACK LINK */

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
            color: var(--primary-dark);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
        }

        .back-link:hover {
            transform: translateX(-4px);
            color: var(--sky-blue);
        }

        /* HEADER */

        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .header-icon {
            width: 66px;
            height: 66px;
            margin: 0 auto 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 22px;
            background: linear-gradient(
                135deg,
                #E7F0FF,
                #E1EDD4
            );
            color: var(--primary);
            box-shadow:
                7px 7px 15px rgba(77, 82, 180, 0.10),
                -7px -7px 15px #FFFFFF;
            font-size: 30px;
        }

        h1 {
            margin: 0 0 12px;
            font-size: clamp(26px, 4vw, 36px);
            color: var(--primary);
            letter-spacing: -0.8px;
        }

        .subtitle {
            color: var(--muted);
            margin: 0;
            line-height: 1.7;
            font-size: 15px;
        }

        .progress-note {
            display: inline-block;
            margin-top: 18px;
            padding: 9px 16px;
            border-radius: 30px;
            border: 1px solid #DCEBE0;
            background: linear-gradient(
                135deg,
                #EAF3FF,
                #E7F6EF
            );
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.4px;
        }

        /* FORM SECTIONS */

        .form-section {
            margin-top: 28px;
            padding: 26px;
            border-radius: 22px;
            background: linear-gradient(
                145deg,
                #F8FBF5,
                #F0F7ED
            );
            border: 1px solid #E0EBDD;
            box-shadow:
                7px 7px 18px rgba(77, 82, 180, 0.07),
                -6px -6px 18px rgba(255, 255, 255, 0.85);
            transition:
                box-shadow 0.3s ease,
                border-color 0.3s ease;
        }

        .form-section:hover {
            border-color: #D0E8DF;
            box-shadow:
                8px 8px 20px rgba(77, 82, 180, 0.09),
                -6px -6px 18px rgba(255, 255, 255, 0.90);
        }

        /* SECTION HEADINGS */

        .section-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            margin: 0 0 23px;
            padding-bottom: 17px;
            border-bottom: 1px solid var(--border);
        }

        .section-number {
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 13px;
            background: linear-gradient(
                135deg,
                #4D52B4,
                #4E9CE8
            );
            color: white;
            font-size: 15px;
            font-weight: bold;
            box-shadow:
                0 4px 10px rgba(77, 82, 180, 0.22),
                0 0 12px rgba(78, 156, 232, 0.15);
        }

        .section-heading h2 {
            margin: 0;
            color: var(--primary);
            font-size: 19px;
            font-weight: 700;
        }

        .section-description {
            color: var(--muted);
            font-size: 13px;
            margin: 5px 0 0;
            line-height: 1.5;
        }

        /* FORM FIELDS */

        .field {
            margin-bottom: 20px;
        }

        .field:last-child {
            margin-bottom: 0;
        }

        label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 9px;
            color: #344D6B;
        }

        .required {
            color: #D64B63;
        }

        input,
        textarea {
            display: block;
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #E4EDE0;
            border-radius: 13px;
            background: #F5F9F1;
            color: var(--text);
            font-family: inherit;
            font-size: 14px;
            outline: none;

            /* Matching inset input shadow from Create Portfolio */
            box-shadow:
                inset 3px 3px 7px rgba(176, 193, 173, 0.20),
                inset -3px -3px 7px rgba(255, 255, 255, 0.90);

            transition:
                border-color 0.25s ease,
                box-shadow 0.25s ease,
                background 0.25s ease;
        }

        input:focus,
        textarea:focus {
            background: #FFFFFF;
            border-color: var(--turquoise);
            box-shadow:
                0 0 0 3px rgba(112, 214, 197, 0.18),
                0 0 12px rgba(78, 156, 232, 0.12);
        }

        input::placeholder,
        textarea::placeholder {
            color: #91A09A;
        }

        /* FILE UPLOAD */

        input[type="file"] {
            padding: 10px;
            cursor: pointer;
        }

        input[type="file"]::file-selector-button {
            border: none;
            border-radius: 8px;
            background: linear-gradient(
                135deg,
                #E4EEFF,
                #DDF4EC
            );
            color: var(--primary-dark);
            padding: 9px 12px;
            margin-right: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        input[type="file"]::file-selector-button:hover {
            background: #D5E9F9;
        }

        textarea {
            min-height: 115px;
            resize: vertical;
            line-height: 1.7;
        }

        .hint {
            color: var(--muted);
            font-size: 12px;
            margin: 8px 0 0;
            line-height: 1.6;
        }

        /* CURRENT PROFILE PHOTO */

        .current-photo-wrapper {
            margin-bottom: 18px;
        }

        .current-photo {
            display: block;
            width: 145px;
            height: 145px;
            object-fit: cover;
            margin-top: 10px;
            border-radius: 16px;
            border: 3px solid #FFFFFF;
            box-shadow:
                0 5px 15px rgba(77, 82, 180, 0.15),
                0 0 0 1px var(--border);
        }

        .photo-label {
            color: var(--muted);
            font-size: 13px;
            margin-top: 8px;
        }

        /* VALIDATION ERRORS */

        .error-box {
            margin-bottom: 25px;
            padding: 18px 20px;
            border: 1px solid #F0B8C0;
            border-radius: 15px;
            background: #FFF0F2;
            color: #A52E40;
            font-size: 14px;
            line-height: 1.7;
        }

        .error-box ul {
            margin-bottom: 0;
            padding-left: 22px;
        }

        /* SAVE BUTTON */

        .submit-button {
            display: block;
            width: 100%;
            margin-top: 32px;
            padding: 17px 20px;
            border: 1px solid rgba(255, 255, 255, 0.65);
            border-radius: 50px;
            background: linear-gradient(
                110deg,
                #4D52B4 0%,
                #4E9CE8 50%,
                #70D6C5 100%
            );
            color: #FFFFFF;
            font-family: inherit;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.5px;
            cursor: pointer;
            box-shadow:
                0 7px 18px rgba(77, 82, 180, 0.23),
                0 0 12px rgba(78, 156, 232, 0.18),
                0 0 20px rgba(112, 214, 197, 0.12);
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease,
                filter 0.3s ease;
        }

        .submit-button:hover {
            transform: translateY(-3px);
            box-shadow:
                0 10px 24px rgba(77, 82, 180, 0.28),
                0 0 18px rgba(78, 156, 232, 0.30),
                0 0 28px rgba(112, 214, 197, 0.25);
            filter: brightness(1.04);
        }

        .submit-button:active {
            transform: translateY(0);
            box-shadow:
                0 3px 10px rgba(77, 82, 180, 0.20);
        }

        .submit-button:focus-visible {
            outline: 3px solid var(--primary);
            outline-offset: 4px;
        }

        /* CANCEL BUTTON */

        .cancel-button {
            display: block;
            width: 100%;
            margin-top: 14px;
            padding: 15px 20px;
            border: 1px solid #D8E8D0;
            border-radius: 50px;
            background: #F5F9F1;
            color: var(--primary);
            font-family: inherit;
            font-size: 15px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            transition:
                background 0.2s ease,
                transform 0.2s ease;
        }

        .cancel-button:hover {
            background: #E8F2E1;
            transform: translateY(-1px);
        }

        /* FOOTER NOTE */

        .footer-note {
            text-align: center;
            margin-top: 20px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        /* MOBILE RESPONSIVENESS */

        @media (max-width: 600px) {
            body {
                padding: 20px 12px;
            }

            .container {
                padding: 22px 15px;
                border: 1px solid #D7E8D0;
                border-radius: 22px;
            }

            .form-section {
                padding: 19px 15px;
                border-radius: 17px;
            }

            .section-heading h2 {
                font-size: 17px;
            }

            input,
            textarea {
                padding: 13px;
                font-size: 16px;
            }

            .current-photo {
                width: 120px;
                height: 120px;
            }
        }

        /* ACCESSIBILITY */

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('portfolios.index', [], false) }}" class="back-link">
        &larr; Back to My Portfolios
    </a>

    <!-- HEADER -->

    <header class="header">

        <div class="header-icon" aria-hidden="true">✦</div>

        <h1>Edit Your Portfolio</h1>

        <p class="subtitle">
            Update your information, showcase your growth, and keep your professional identity current.
        </p>

        <span class="progress-note">
            ✧ &nbsp; UPDATE YOUR PERSONAL PORTFOLIO
        </span>

    </header>

    <!-- VALIDATION ERRORS -->

    @if ($errors->any())
        <div class="error-box" role="alert">

            <strong>Please correct the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    <form
        action="{{ route('portfolios.update', ['portfolio' => $portfolio->id], false) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')
        <input type="hidden" name="template" value="{{ $template ?? '' }}">
        <input type="hidden" name="return_to" value="{{ request()->query('template') ? 'preview' : 'templates' }}">
       
        <!-- PERSONAL INFORMATION -->

        <section class="form-section">

            <div class="section-heading">

                <div class="section-number">01</div>

                <div>
                    <h2>Personal Information</h2>
                    <p class="section-description">
                        Update your personal details and introduction.
                    </p>
                </div>

            </div>

            <div class="field">

                <label for="full_name">
                    Full Name <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    value="{{ old('full_name', $portfolio->full_name) }}"
                    placeholder="Enter your full name"
                    required
                >

            </div>

            <div class="field">

                <label for="photo">Profile Picture</label>

                @if ($portfolio->photo)
                    <div class="current-photo-wrapper">

                        <img
                            src="{{ $portfolio->photo }}"
                            alt="Current profile picture"
                            class="current-photo"
                        >

                        <p class="photo-label">
                            Your current profile picture
                        </p>

                    </div>
                @endif

                <input
                    type="file"
                    id="photo"
                    name="photo"
                    accept="image/*"
                >

                <p class="hint">
                    Upload a new picture only if you want to replace your current picture.
                </p>

            </div>

            <div class="field">

                <label for="email">
                    Email Address <span class="required">*</span>
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $portfolio->email) }}"
                    placeholder="you@example.com"
                    required
                >

            </div>

            <div class="field">

                <label for="phone">Contact Number</label>

                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $portfolio->phone) }}"
                    placeholder="Enter your contact number"
                >

            </div>

            <div class="field">

                <label for="address">Address</label>

                <input
                    type="text"
                    id="address"
                    name="address"
                    value="{{ old('address', $portfolio->address) }}"
                    placeholder="City, Province, Country"
                >

            </div>

            <div class="field">

                <label for="about">About Me</label>

                <textarea
                    id="about"
                    name="about"
                    placeholder="Write a short introduction about yourself"
                >{{ old('about', $portfolio->about) }}</textarea>

                <p class="hint">
                    Share your interests, goals, experience, and what makes you unique.
                </p>

            </div>

        </section>

        <!-- EDUCATIONAL BACKGROUND -->

        @php
            $educations = old('educations', $portfolio->educations->map(function ($education) {
                return [
                    'school_name' => $education->school_name,
                    'education_level' => $education->education_level,
                    'program' => $education->program,
                    'year' => $education->year,
                ];
            })->toArray());

            if (empty($educations)) {
                $educations = [[
                    'school_name' => '',
                    'education_level' => '',
                    'program' => '',
                    'year' => '',
                ]];
            }
        @endphp

        <section class="form-section">

            <div class="section-heading">

                <div class="section-number">02</div>

                <div>
                    <h2>Educational Background</h2>
                    <p class="section-description">
                        Update your academic journey.
                    </p>
                </div>

            </div>

            @foreach ($educations as $i => $education)

                <div class="field">

                    <label for="school_name_{{ $i }}">School Name</label>

                    <input
                        type="text"
                        id="school_name_{{ $i }}"
                        name="educations[{{ $i }}][school_name]"
                        value="{{ $education['school_name'] ?? '' }}"
                        placeholder="Enter your school name"
                    >

                </div>

                <div class="field">

                    <label for="education_level_{{ $i }}">Education Level</label>

                    <input
                        type="text"
                        id="education_level_{{ $i }}"
                        name="educations[{{ $i }}][education_level]"
                        value="{{ $education['education_level'] ?? '' }}"
                        placeholder="College, Senior High School, etc."
                    >

                </div>

                <div class="field">

                    <label for="program_{{ $i }}">Program</label>

                    <input
                        type="text"
                        id="program_{{ $i }}"
                        name="educations[{{ $i }}][program]"
                        value="{{ $education['program'] ?? '' }}"
                        placeholder="BS Information Technology, STEM, HUMSS, etc."
                    >

                </div>

                <div class="field">

                    <label for="year_{{ $i }}">Year</label>

                    <input
                        type="text"
                        id="year_{{ $i }}"
                        name="educations[{{ $i }}][year]"
                        value="{{ $education['year'] ?? '' }}"
                        placeholder="Example: 2025–Present"
                    >

                </div>

            @endforeach

        </section>

        <!-- SKILLS -->

        @php
            $skills = old('skills', $portfolio->skills->map(function ($skill) {
                return ['name' => $skill->name];
            })->toArray());

            if (empty($skills)) {
                $skills = [['name' => '']];
            }
        @endphp

        <section class="form-section">

            <div class="section-heading">

                <div class="section-number">03</div>

                <div>
                    <h2>Skills</h2>
                    <p class="section-description">
                        Highlight your strengths and areas of expertise.
                    </p>
                </div>

            </div>

            @foreach ($skills as $i => $skill)

                <div class="field">

                    <label for="skill_{{ $i }}">Skill {{ $i + 1 }}</label>

                    <textarea
                        id="skill_{{ $i }}"
                        name="skills[{{ $i }}][name]"
                        placeholder="Communication, teamwork, HTML, CSS, Java, PHP..."
                    >{{ $skill['name'] ?? '' }}</textarea>

                </div>

            @endforeach

            <p class="hint">
                Include your technical skills, personal strengths, and areas of expertise.
            </p>

        </section>

        <!-- PROJECTS -->

        @php
            $projects = old('projects', $portfolio->projects->map(function ($project) {
                return [
                    'name' => $project->name,
                    'description' => $project->description,
                ];
            })->toArray());

            if (empty($projects)) {
                $projects = [['name' => '', 'description' => '']];
            }
        @endphp

        <section class="form-section">

            <div class="section-heading">

                <div class="section-number">04</div>

                <div>
                    <h2>Projects</h2>
                    <p class="section-description">
                        Showcase the projects you are proud of.
                    </p>
                </div>

            </div>

            @foreach ($projects as $i => $project)

                <div class="field">

                    <label for="project_name_{{ $i }}">Project Name</label>

                    <input
                        type="text"
                        id="project_name_{{ $i }}"
                        name="projects[{{ $i }}][name]"
                        value="{{ $project['name'] ?? '' }}"
                        placeholder="Enter your project name"
                    >

                </div>

                <div class="field">

                    <label for="project_description_{{ $i }}">Project Description</label>

                    <textarea
                        id="project_description_{{ $i }}"
                        name="projects[{{ $i }}][description]"
                        placeholder="Describe the purpose, features, and technologies used"
                    >{{ $project['description'] ?? '' }}</textarea>

                </div>

            @endforeach

        </section>

        <!-- WORK EXPERIENCE -->

        @php
            $experiences = old('experiences', $portfolio->experiences->map(function ($experience) {
                return [
                    'position' => $experience->position,
                    'company' => $experience->company,
                    'duration' => $experience->duration,
                    'description' => $experience->description,
                ];
            })->toArray());

            if (empty($experiences)) {
                $experiences = [[
                    'position' => '',
                    'company' => '',
                    'duration' => '',
                    'description' => '',
                ]];
            }
        @endphp

        <section class="form-section">

            <div class="section-heading">

                <div class="section-number">05</div>

                <div>
                    <h2>Work Experience</h2>
                    <p class="section-description">
                        Update your professional experience.
                    </p>
                </div>

            </div>

            @foreach ($experiences as $i => $experience)

                <div class="field">

                    <label for="position_{{ $i }}">Job Title / Position</label>

                    <input
                        type="text"
                        id="position_{{ $i }}"
                        name="experiences[{{ $i }}][position]"
                        value="{{ $experience['position'] ?? '' }}"
                        placeholder="Enter your job title or position"
                    >

                </div>

                <div class="field">

                    <label for="company_{{ $i }}">Company Name</label>

                    <input
                        type="text"
                        id="company_{{ $i }}"
                        name="experiences[{{ $i }}][company]"
                        value="{{ $experience['company'] ?? '' }}"
                        placeholder="Enter your company name"
                    >

                </div>

                <div class="field">

                    <label for="duration_{{ $i }}">Employment Period</label>

                    <input
                        type="text"
                        id="duration_{{ $i }}"
                        name="experiences[{{ $i }}][duration]"
                        value="{{ $experience['duration'] ?? '' }}"
                        placeholder="Example: 2024–2025 or January 2025–Present"
                    >

                </div>

                <div class="field">

                    <label for="experience_description_{{ $i }}">Job Description</label>

                    <textarea
                        id="experience_description_{{ $i }}"
                        name="experiences[{{ $i }}][description]"
                        placeholder="Describe your responsibilities and achievements"
                    >{{ $experience['description'] ?? '' }}</textarea>

                </div>

            @endforeach

        </section>

        <!-- SOCIAL MEDIA AND WEBSITE LINKS -->

        @php
            $links = old('links', $portfolio->links->map(function ($link) {
                return [
                    'platform' => $link->platform,
                    'url' => $link->url,
                ];
            })->toArray());

            if (empty($links)) {
                $links = [['platform' => '', 'url' => '']];
            }
        @endphp

        <section class="form-section">

            <div class="section-heading">

                <div class="section-number">06</div>

                <div>
                    <h2>Social Media & Website Links</h2>
                    <p class="section-description">
                        Keep your online presence up to date.
                    </p>
                </div>

            </div>

            @foreach ($links as $i => $link)

                <div class="field">

                    <label for="platform_{{ $i }}">Platform Name</label>

                    <input
                        type="text"
                        id="platform_{{ $i }}"
                        name="links[{{ $i }}][platform]"
                        value="{{ $link['platform'] ?? '' }}"
                        placeholder="Facebook, LinkedIn, GitHub, Personal Website"
                    >

                </div>

                <div class="field">

                    <label for="url_{{ $i }}">Profile or Website URL</label>

                    <input
                        type="url"
                        id="url_{{ $i }}"
                        name="links[{{ $i }}][url]"
                        value="{{ $link['url'] ?? '' }}"
                        placeholder="https://example.com"
                    >

                </div>

            @endforeach

        </section>

        <!-- SAVE AND CANCEL -->

        <button type="submit" class="submit-button">
            Save Changes &nbsp; &rarr;
        </button>

        <a
            href="{{ route('portfolios.index', [], false) }}"
            class="cancel-button"
        >
            Cancel
        </a>

        <p class="footer-note">
            Your updated information will be saved to your portfolio.
        </p>

    </form>

</div>

</body>
</html>