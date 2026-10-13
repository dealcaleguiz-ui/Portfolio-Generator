<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Portfolio</title>

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
            --text: #24364b;
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

        /* VALIDATION ERRORS */
        .error-box {
            margin-bottom: 25px;
            padding: 18px 20px;

            border: 1px solid #F0B8C0;
            border-radius: 15px;

            background: #FFF0F2;
            color: #A52E40;
            font-size: 14px;
        }

        .error-box ul {
            margin-bottom: 0;
            padding-left: 22px;
        }

        /* SAVE PORTFOLIO BUTTON */
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

    <a href="{{ route('portfolios.index') }}" class="back-link">
        &larr; Back to My Portfolios
    </a>

    <header class="header">
        <div class="header-icon">✦</div>

        <h1>Create Your Portfolio</h1>

        <p class="subtitle">
            Tell your story, showcase your skills, and build your professional identity.
        </p>

        <span class="progress-note">✧ &nbsp; YOUR PERSONAL PORTFOLIO</span>
    </header>

    @if ($errors->any())
        <div class="error-box">
            <strong>Please correct the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('portfolios.store', [], false) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <!-- PERSONAL INFORMATION -->
        <section class="form-section">
            <div class="section-heading">
                <div class="section-number">01</div>
                <div>
                    <h2>Personal Information</h2>
                    <p class="section-description">Introduce yourself to the world.</p>
                </div>
            </div>

            <div class="field">
                <label for="full_name">Full Name <span class="required">*</span></label>
                <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    value="{{ old('full_name') }}"
                    placeholder="Enter your full name"
                    required
                >
            </div>

            <div class="field">
                <label for="photo">Profile Picture</label>
                <input type="file" id="photo" name="photo" accept="image/*">
                <p class="hint">Upload a professional photo of yourself. This is optional.</p>
            </div>

            <div class="field">
                <label for="email">Email Address <span class="required">*</span></label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
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
                    value="{{ old('phone') }}"
                    placeholder="Enter your contact number"
                >
            </div>

            <div class="field">
                <label for="address">Address</label>
                <input
                    type="text"
                    id="address"
                    name="address"
                    value="{{ old('address') }}"
                    placeholder="City, Province, Country"
                >
            </div>

            <div class="field">
                <label for="about">About Me</label>
                <textarea
                    id="about"
                    name="about"
                    placeholder="Write a short introduction about yourself"
                >{{ old('about') }}</textarea>
                <p class="hint">Share your interests, goals, experience, and what makes you unique.</p>
            </div>
        </section>

        <!-- EDUCATION -->
        <section class="form-section">
            <div class="section-heading">
                <div class="section-number">02</div>
                <div>
                    <h2>Educational Background</h2>
                    <p class="section-description">Showcase your academic journey.</p>
                </div>
            </div>

            <div class="field">
                <label for="school_name">School Name</label>
                <input
                    type="text"
                    id="school_name"
                    name="educations[0][school_name]"
                    value="{{ old('educations.0.school_name') }}"
                    placeholder="Enter your school name"
                >
            </div>

            <div class="field">
                <label for="education_level">Education Level</label>
                <input
                    type="text"
                    id="education_level"
                    name="educations[0][education_level]"
                    value="{{ old('educations.0.education_level') }}"
                    placeholder="College, Senior High School, etc."
                >
            </div>

            <div class="field">
                <label for="program">Program</label>
                <input
                    type="text"
                    id="program"
                    name="educations[0][program]"
                    value="{{ old('educations.0.program') }}"
                    placeholder="BS Information Technology, STEM, HUMSS, etc."
                >
            </div>

            <div class="field">
                <label for="year">Year</label>
                <input
                    type="text"
                    id="year"
                    name="educations[0][year]"
                    value="{{ old('educations.0.year') }}"
                    placeholder="Example: 2025–Present"
                >
            </div>
        </section>

        <!-- SKILLS -->
        <section class="form-section">
            <div class="section-heading">
                <div class="section-number">03</div>
                <div>
                    <h2>Skills</h2>
                    <p class="section-description">Highlight what you do best.</p>
                </div>
            </div>

            <div class="field">
                <label for="skills">Your Skills</label>
                <textarea
                    id="skills"
                    name="skills[0][name]"
                    placeholder="Example: Communication, teamwork, HTML, CSS, Java, PHP"
                >{{ old('skills.0.name') }}</textarea>
                <p class="hint">Enter your technical skills, personal strengths, and areas of expertise.</p>
            </div>
        </section>

        <!-- PROJECTS -->
        <section class="form-section">
            <div class="section-heading">
                <div class="section-number">04</div>
                <div>
                    <h2>Projects</h2>
                    <p class="section-description">Present the work you are proud of.</p>
                </div>
            </div>

            <div class="field">
                <label for="project_name">Project Name</label>
                <input
                    type="text"
                    id="project_name"
                    name="projects[0][name]"
                    value="{{ old('projects.0.name') }}"
                    placeholder="Enter your project name"
                >
            </div>

            <div class="field">
                <label for="project_description">Project Description</label>
                <textarea
                    id="project_description"
                    name="projects[0][description]"
                    placeholder="Describe the purpose, features, and technologies used"
                >{{ old('projects.0.description') }}</textarea>
            </div>
        </section>

        <!-- WORK EXPERIENCE -->
        <section class="form-section">
            <div class="section-heading">
                <div class="section-number">05</div>
                <div>
                    <h2>Work Experience</h2>
                    <p class="section-description">Share your professional experience.</p>
                </div>
            </div>

            <div class="field">
                <label for="position">Job Title / Position</label>
                <input
                    type="text"
                    id="position"
                    name="experiences[0][position]"
                    value="{{ old('experiences.0.position') }}"
                    placeholder="Enter your job title or position"
                >
            </div>

            <div class="field">
                <label for="company">Company Name</label>
                <input
                    type="text"
                    id="company"
                    name="experiences[0][company]"
                    value="{{ old('experiences.0.company') }}"
                    placeholder="Enter your company name"
                >
            </div>

            <div class="field">
                <label for="experience_duration">Employment Period</label>
                <input
                    type="text"
                    id="experience_duration"
                    name="experiences[0][duration]"
                    value="{{ old('experiences.0.duration') }}"
                    placeholder="Example: 2024–2025 or January 2025–Present"
                >
            </div>

            <div class="field">
                <label for="experience_description">Job Description</label>
                <textarea
                    id="experience_description"
                    name="experiences[0][description]"
                    placeholder="Describe your responsibilities and achievements"
                >{{ old('experiences.0.description') }}</textarea>
            </div>
        </section>

        <!-- SOCIAL LINKS -->
        <section class="form-section">
            <div class="section-heading">
                <div class="section-number">06</div>
                <div>
                    <h2>Social Media & Website Links</h2>
                    <p class="section-description">Help people discover your online presence.</p>
                </div>
            </div>

            <div class="field">
                <label for="platform">Platform Name</label>
                <input
                    type="text"
                    id="platform"
                    name="links[0][platform]"
                    value="{{ old('links.0.platform') }}"
                    placeholder="Facebook, LinkedIn, GitHub, Personal Website"
                >
            </div>

            <div class="field">
                <label for="url">Profile or Website URL</label>
                <input
                    type="url"
                    id="url"
                    name="links[0][url]"
                    value="{{ old('links.0.url') }}"
                    placeholder="https://example.com"
                >
            </div>
        </section>

        <button type="submit" class="submit-button">
            Save Portfolio &nbsp; &rarr;
        </button>

        <p class="footer-note">
            Your information will be saved so you can select a design template for your portfolio.
        </p>

    </form>
</div>
</body>
</html>