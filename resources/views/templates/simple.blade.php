
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $portfolio->full_name ?? $portfolio->name }} | Simple Portfolio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>

/* =========================================
   COLOR PALETTE (same as the other templates)
========================================= */

:root {
  --background: #FFF8D4;
  --sand: #FFFEFA;
  --foreground: #132EB9;
  --dark: #132EB9;

  --card: #FFFEFA;
  --border: #799CF0;

  --primary: #132EB9;
  --muted-foreground: #132EB9;
}

/* =========================================
   BASE
========================================= */

* {
  box-sizing: border-box;
}

html {
  scroll-behavior: smooth;
  scroll-padding-top: 90px;
}

body {
  margin: 0;
  background: var(--background);
  color: var(--foreground);
  font-family: "Manrope", ui-sans-serif, system-ui, sans-serif;
  font-size: 16px;
  line-height: 1.65;
}

h1, h2, h3, h4 {
  margin: 0;
  font-family: "Sora", ui-sans-serif, system-ui, sans-serif;
}

p {
  margin: 0;
}

img {
  max-width: 100%;
}

a {
  color: inherit;
  text-decoration: none;
}

button {
  font: inherit;
}

section[id] {
  scroll-margin-top: 90px;
}

.container {
  width: 100%;
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 24px;
}

/* TOP NAVIGATION */
.portfolio-navbar {
    width: 100%;
    background: #132EB9;
    padding: 12px 24px;
    box-sizing: border-box;
}

.portfolio-navbar-inner {
    max-width: 1120px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.navbar-brand {
    color: #FFF8D4;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
}

.navbar-actions {
    display: flex;
    align-items: center;
    gap: 8px;
}

.navbar-button {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    padding: 10px 14px;
    border: 1px solid rgb(255 248 212 / 35%);
    border-radius: 999px;
    color: #FFF8D4;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
    transition: background 0.2s ease;
}

.navbar-button:hover {
    background: rgb(255 248 212 / 12%);
}

@media (max-width: 650px) {
    .portfolio-navbar-inner {
        flex-direction: column;
        align-items: flex-start;
    }

    .navbar-actions {
        flex-wrap: wrap;
    }
}

/* =========================================
   NAVIGATION (UNCHANGED)
========================================= */

.site-header {
  position: sticky;
  top: 0;
  z-index: 1000;
  width: 100%;
  background: rgb(255 248 212 / 95%);
  border-bottom: 1px solid var(--border);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  transition:
    background 0.3s ease,
    box-shadow 0.3s ease;
}

.site-header.scrolled {
  background: rgb(255 248 212 / 98%);
  box-shadow: 0 8px 24px rgb(19 46 185 / 8%);
}

.nav-container {
  width: min(1200px, 92%);
  min-height: 76px;
  margin-inline: auto;

  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 24px;
}

/* Logo */

.nav-brand {
  display: inline-flex;
  align-items: center;
  gap: 12px;

  color: var(--foreground);
  font-size: 1.05rem;
  font-weight: 800;
  white-space: nowrap;
}

.nav-brand img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
}

.nav-brand-icon {
  width: 44px;
  height: 44px;

  display: grid;
  place-items: center;

  border-radius: 50%;
  background: var(--primary);
  color: #FFF8D4;

  font-size: 0.9rem;
  font-weight: 800;
}

/* Desktop navigation links */

.nav-menu {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 26px;
}

.nav-link {
  position: relative;
  display: inline-block;
  padding: 10px 0;

  color: var(--foreground);
  font-size: 0.9rem;
  font-weight: 700;

  transition: color 0.25s ease;
}

.nav-link:hover,
.nav-link.is-active {
  color: var(--primary);
}

/* Animated underline */

.nav-link::after {
  content: "";

  position: absolute;
  left: 0;
  right: 0;
  bottom: 3px;

  height: 2px;
  border-radius: 2px;

  background: var(--primary);

  transform: scaleX(0);
  transform-origin: left;

  transition: transform 0.3s ease;
}

.nav-link:hover::after,
.nav-link.is-active::after {
  transform: scaleX(1);
}

/* Mobile navigation button */

.nav-toggle {
  width: 44px;
  height: 44px;

  display: none;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  gap: 6px;

  border: 1px solid var(--border);
  border-radius: 12px;

  background: transparent;
  cursor: pointer;
}

.nav-toggle span {
  display: block;
  width: 21px;
  height: 2px;

  border-radius: 3px;
  background: var(--foreground);

  transition:
    transform 0.3s ease,
    opacity 0.3s ease;
}

.nav-toggle[aria-expanded="true"] span:first-child {
  transform: translateY(8px) rotate(45deg);
}

.nav-toggle[aria-expanded="true"] span:nth-child(2) {
  opacity: 0;
}

.nav-toggle[aria-expanded="true"] span:last-child {
  transform: translateY(-8px) rotate(-45deg);
}

@media (max-width: 1000px) {
  .nav-container {
    min-height: 70px;
  }

  .nav-toggle {
    display: flex;
  }

  .nav-menu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;

    display: flex;
    align-items: stretch;
    flex-direction: column;
    gap: 0;

    max-height: calc(100vh - 70px);
    overflow-y: auto;

    padding: 12px 4% 20px;

    border-bottom: 1px solid var(--border);

    background: var(--background);
    box-shadow: 0 15px 24px rgb(19 46 185 / 8%);

    opacity: 0;
    visibility: hidden;
    pointer-events: none;

    transform: translateY(-10px);

    transition:
      opacity 0.25s ease,
      visibility 0.25s ease,
      transform 0.25s ease;
  }

  .nav-menu.open {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;

    transform: translateY(0);
  }

  .nav-link {
    display: block;
    padding: 14px 4px;

    border-bottom: 1px solid rgb(121 156 240 / 55%);
  }

  .nav-link::after {
    bottom: 5px;
    right: auto;
    width: 45px;
  }
}

@media (max-width: 600px) {
  .nav-container {
    width: 90%;
  }

  .nav-brand {
    font-size: 0.95rem;
  }

  .nav-brand img,
  .nav-brand-icon {
    width: 40px;
    height: 40px;
  }
}


/* =========================================
   SHARED PIECES
========================================= */

/* label + value (used in About, Details, Experience and Education) */
.label {
  display: block;
  margin-bottom: 4px;
  color: var(--muted-foreground);
  font-size: 11px;
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: 0.14em;
  text-transform: uppercase;
}

.value {
  display: block;
  font-size: 16px;
  font-weight: 600;
  line-height: 1.45;
  overflow-wrap: anywhere;
}

/* the most important field in a row */
.field--main .value {
  font-family: "Sora", ui-sans-serif, system-ui, sans-serif;
  font-size: 18px;
  font-weight: 700;
}

.fields {
  display: grid;
  grid-template-columns: minmax(0, 1.5fr) minmax(0, 1fr) minmax(0, 1fr);
  gap: 16px 32px;
}

.fields--two {
  grid-template-columns: repeat(2, minmax(0, 1fr));
}

.fields--edu {
  grid-template-columns: minmax(0, 1.4fr) minmax(0, 1.4fr) minmax(0, 0.7fr);
}

/* text link with a small arrow */
.link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: var(--primary);
  font-size: 14px;
  font-weight: 700;
  transition: gap 0.2s ease;
}

.link:hover {
  gap: 12px;
}

.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 12px 24px;
  border: 1.5px solid var(--foreground);
  border-radius: 8px;
  font-size: 14px;
  font-weight: 700;
  line-height: 1.2;
  transition: background 0.2s ease, color 0.2s ease, border-color 0.2s ease;
}

.btn--solid {
  background: var(--foreground);
  color: var(--background);
}

.btn--solid:hover {
  background: var(--primary);
  border-color: var(--primary);
}

.btn--line {
  background: transparent;
  color: var(--foreground);
}

.btn--line:hover {
  background: var(--foreground);
  color: var(--background);
}

/* =========================================
   HERO (centered, single column)
========================================= */

.hero {
    padding: 88px 0 80px;
    text-align: center;
}

.hero-photo {
    width: 220px;
    height: 220px;
    margin: 0 auto 28px;
    overflow: hidden;
    border: 4px solid var(--background);
    border-radius: 50%;
    box-shadow: 0 0 0 2px var(--primary);
}

.hero-photo img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
}

.hero-placeholder {
  display: grid;
  place-items: center;
  width: 100%;
  height: 100%;
  background: var(--sand);
  color: var(--foreground);
  font-size: 44px;
}

.hero-hello {
  margin-bottom: 6px;
  color: var(--muted-foreground);
  font-size: 15px;
  font-weight: 600;
}

.hero h1 {
  margin-bottom: 10px;
  font-size: clamp(34px, 5vw, 52px);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
  overflow-wrap: anywhere;
}

.hero-role {
  margin-bottom: 18px;
  color: var(--primary);
  font-size: 18px;
  font-weight: 700;
}

.hero-desc {
  max-width: 600px;
  margin: 0 auto 32px;
  color: var(--muted-foreground);
  font-size: 17px;
  line-height: 1.8;
}

.hero-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 12px;
}

.hero-meta {
  margin-top: 28px;
  color: var(--muted-foreground);
  font-size: 14px;
}

/* =========================================
   SECTIONS (title on the left, content on the right)
========================================= */

.section {
  padding: 72px 0;
}

.hero + .section {
  border-top: 1px solid var(--border);
}

.section--sand {
  background: var(--sand);
}

.section-grid {
  display: grid;
  grid-template-columns: 240px minmax(0, 1fr);
  gap: 48px;
  align-items: start;
}

.eyebrow {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 8px;
  color: var(--primary);
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 0.18em;
  text-transform: uppercase;
}

/* the only decorative shape: one small dot */
.eyebrow::before {
  content: "";
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--primary);
}

.section-title {
  font-size: 28px;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -0.01em;
}

/* =========================================
   ABOUT
========================================= */

.about-text {
  font-size: 20px;
  line-height: 1.75;
  text-align: justify;
}

.about-facts {
  margin-top: 32px;
  padding-top: 24px;
  border-top: 1px solid var(--border);
}

.about-link {
  display: flex;
  width: fit-content;
  margin-top: 24px;
}

/* =========================================
   PERSONAL DETAILS
========================================= */

.details {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 0 40px;
  border-bottom: 1px solid var(--border);
}

.details .field {
  padding: 18px 0;
  border-top: 1px solid var(--border);
}

/* =========================================
   SKILLS
========================================= */

.skills {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

.skill {
  padding: 8px 18px;
  border: 1px solid var(--border);
  border-radius: 999px;
  background: var(--card);
  font-size: 14px;
  font-weight: 600;
  line-height: 1.4;
  transition: border-color 0.2s ease, color 0.2s ease;
}

.skill:hover {
  border-color: var(--primary);
  color: var(--primary);
}

/* =========================================
   PROJECTS (simple list)
========================================= */

.projects {
  border-bottom: 1px solid var(--border);
}

.project {
  display: grid;
  grid-template-columns: 56px minmax(0, 1fr) auto;
  gap: 12px 24px;
  align-items: start;
  padding: 26px 0;
  border-top: 1px solid var(--border);
}

.project-no {
  padding-top: 3px;
  color: var(--primary);
  font-family: "Sora", ui-sans-serif, system-ui, sans-serif;
  font-size: 15px;
  font-weight: 700;
}

.project h3 {
  margin-bottom: 6px;
  font-size: 19px;
  font-weight: 700;
  line-height: 1.3;
}

.project p {
  max-width: 560px;
  color: var(--muted-foreground);
  font-size: 15px;
  line-height: 1.7;
  text-align: justify;
}

.project .link {
  padding-top: 4px;
  white-space: nowrap;
}

/* =========================================
   EXPERIENCE + EDUCATION (same entry layout)
========================================= */

.entries {
  border-bottom: 1px solid var(--border);
}

.entry {
  padding: 26px 0;
  border-top: 1px solid var(--border);
}

.entry-note {
  margin-top: 18px;
}

.entry-note p {
  max-width: 640px;
  color: var(--muted-foreground);
  font-size: 15px;
  line-height: 1.75;
}

/* =========================================
   CONTACT
========================================= */

.contact-text h3 {
  max-width: 560px;
  margin-bottom: 12px;
  font-size: 30px;
  font-weight: 800;
  line-height: 1.25;
  letter-spacing: -0.01em;
}

.contact-text p {
  max-width: 520px;
  margin-bottom: 28px;
  color: var(--muted-foreground);
  font-size: 17px;
}

.contact-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
}

.socials {
  display: flex;
  flex-wrap: wrap;
  gap: 8px 24px;
  margin-top: 28px;
  padding-top: 22px;
  border-top: 1px solid var(--border);
}

.social {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  font-weight: 700;
  transition: color 0.2s ease;
}

.social:hover {
  color: var(--primary);
}

/* =========================================
   FOOTER
========================================= */

footer {
  padding: 24px;
  border-top: 1px solid var(--border);
  color: var(--muted-foreground);
  text-align: center;
  font-size: 14px;
}

footer a {
  color: var(--primary);
  font-weight: 700;
}

/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 800px) {
  .hero {
    padding: 56px 0;
  }

  .section {
    padding: 56px 0;
  }

  .section-grid {
    grid-template-columns: 1fr;
    gap: 28px;
  }

  .about-text {
    font-size: 18px;
  }

  .details {
    grid-template-columns: 1fr;
  }

  .fields,
  .fields--two,
  .fields--edu {
    grid-template-columns: 1fr;
    gap: 14px;
  }

  .project {
    grid-template-columns: 40px minmax(0, 1fr);
  }

  .project .link {
    grid-column: 2;
    padding-top: 0;
  }

  .contact-text h3 {
    font-size: 26px;
  }
}

@media (max-width: 480px) {
  .hero-actions,
  .contact-actions {
    flex-direction: column;
    align-items: stretch;
  }
}

@media (prefers-reduced-motion: reduce) {
  html {
    scroll-behavior: auto;
  }

  *,
  *::before,
  *::after {
    scroll-behavior: auto !important;
    transition-duration: 0.01ms !important;
  }
}
</style>
</head>

<body>
<!-- TOP NAVIGATION -->
 @unless($isPublic ?? false)
<nav class="portfolio-navbar">
    <div class="portfolio-navbar-inner">

        <a href="{{ route('portfolios.index') }}" class="navbar-brand">
            Portfolio Preview · PortfolioGen
        </a>

        <div class="navbar-actions">
            <a href="{{ route('portfolios.index') }}" class="navbar-button">
                My Portfolios
            </a>

            <a href="{{ route('portfolios.edit', $portfolio->id) }}" class="navbar-button">
                Edit Portfolio
            </a>

            <a href="{{ route('portfolios.templates', $portfolio->id) }}" class="navbar-button">
                Change Template
            </a>
        </div>

    </div>
</nav>
@endunless

<header class="site-header" id="siteHeader">
    <nav class="nav-container">

        <a href="#home" class="nav-brand">

            @if(!empty($portfolio->photo))
                <img
                    src="{{ $portfolio->photo }}"
                    alt="{{ $portfolio->full_name ?? 'Profile picture' }}"
                >
            @else
                <span class="nav-brand-icon">
                    {{ strtoupper(substr($portfolio->full_name ?? 'P', 0, 1)) }}
                </span>
            @endif

            <span>
                {{ $portfolio->full_name ?? 'My Portfolio' }}
            </span>

        </a>

        <button
            type="button"
            class="nav-toggle"
            id="navToggle"
            aria-label="Toggle navigation"
            aria-expanded="false"
            aria-controls="navMenu"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="nav-menu" id="navMenu">

            <a href="#home" class="nav-link is-active">
                Home
            </a>

            <a href="#about" class="nav-link">
                About
            </a>

            <a href="#personal-details" class="nav-link">
                Personal Details
            </a>

            <a href="#skills" class="nav-link">
                Skills
            </a>

            <a href="#projects" class="nav-link">
                Projects
            </a>

            <a href="#experience" class="nav-link">
                Experience
            </a>

            <a href="#education" class="nav-link">
                Education
            </a>

            <a href="#contact" class="nav-link">
                Contact
            </a>

        </div>

    </nav>
</header>

@php
    $fullName  = $portfolio->full_name ?? $portfolio->name ?? 'My Portfolio';
    $aboutText = $portfolio->about ?? $portfolio->bio ?? '';
    $jobTitle  = $portfolio->title ?? $portfolio->job_title ?? $portfolio->headline ?? $portfolio->profession ?? '';
    $website   = $portfolio->website ?? $portfolio->website_url ?? '';
    $profilePhoto = $portfolio->photo ?? $portfolio->profile_picture ?? null;

    if (
        $profilePhoto &&
        !str_starts_with($profilePhoto, 'data:') &&
        !filter_var($profilePhoto, FILTER_VALIDATE_URL)
    ) {
        $profilePhoto = asset('storage/' . $profilePhoto);
    }

    $heroMeta = implode(' · ', array_filter([$portfolio->address ?? '', $portfolio->email ?? '']));

    $details = array_filter([
        ['label' => 'Full Name', 'value' => $fullName],
        ['label' => 'Title',     'value' => $jobTitle],
        ['label' => 'Email',     'value' => $portfolio->email ?? ''],
        ['label' => 'Phone',     'value' => $portfolio->phone ?? ''],
        ['label' => 'Location',  'value' => $portfolio->address ?? ''],
        ['label' => 'Website',   'value' => $website],
    ], fn ($item) => !empty($item['value']));

    // Skills: accepts a comma-separated string, a JSON array, an array,
    // or a collection of skill models (names containing commas are split too).
    $rawSkills = $portfolio->skills ?? [];

    if (is_string($rawSkills)) {
        $decoded = json_decode($rawSkills, true);
        $rawSkills = is_array($decoded) ? $decoded : [$rawSkills];
    }

    $skillList = collect($rawSkills)
        ->map(fn ($skill) => is_object($skill)
            ? ($skill->name ?? '')
            : (is_array($skill) ? ($skill['name'] ?? '') : $skill))
        ->flatMap(fn ($name) => preg_split('/[,;|\r\n]+/', (string) $name))
        ->map(fn ($name) => trim($name))
        ->filter()
        ->unique()
        ->values();

    // Social links: pick a brand icon from the platform name.
    $socialIcon = function ($platform) {
        $p = strtolower((string) $platform);

        return match (true) {
            str_contains($p, 'github')    => 'fa-brands fa-github',
            str_contains($p, 'linkedin')  => 'fa-brands fa-linkedin-in',
            str_contains($p, 'facebook')  => 'fa-brands fa-facebook-f',
            str_contains($p, 'instagram') => 'fa-brands fa-instagram',
            str_contains($p, 'twitter'),
            str_contains($p, 'x.com')     => 'fa-brands fa-x-twitter',
            str_contains($p, 'youtube')   => 'fa-brands fa-youtube',
            str_contains($p, 'tiktok')    => 'fa-brands fa-tiktok',
            str_contains($p, 'behance')   => 'fa-brands fa-behance',
            str_contains($p, 'dribbble')  => 'fa-brands fa-dribbble',
            default                       => 'fa-solid fa-link',
        };
    };
@endphp

<!-- HERO -->
<section class="hero" id="home">
    <div class="container">

        <div class="hero-photo">
            @if($profilePhoto)
                <img src="{{ $profilePhoto }}" alt="{{ $fullName }}">
            @else
                <div class="hero-placeholder">
                    <i class="fa-solid fa-user"></i>
                </div>
            @endif
        </div>

        <p class="hero-hello">Hello, I'm</p>

        <h1>{{ $fullName }}</h1>

        @if($jobTitle)
            <p class="hero-role">{{ $jobTitle }}</p>
        @endif

        <p class="hero-desc">
          "Welcome to my portfolio! Here, you can explore my background, educational achievements, skills, projects, and experiences that reflect my personal and professional journey."
        </p>

        <div class="hero-actions">
            <a href="#projects" class="btn btn--solid">
                Explore My Work
                <i class="fa-solid fa-arrow-right"></i>
            </a>

            <a href="#contact" class="btn btn--line">
                Let's Connect
            </a>
        </div>

        @if($heroMeta)
            <p class="hero-meta">{{ $heroMeta }}</p>
        @endif

    </div>
</section>


<!-- ABOUT -->
<section class="section" id="about">
    <div class="container section-grid">

        <div>
            <span class="eyebrow">Who I am</span>
            <h2 class="section-title">About Me</h2>
        </div>

        <div>

            <p class="about-text">
                {{ $aboutText ?: 'I am someone who enjoys learning, exploring new ideas, and developing skills through meaningful experiences and projects.' }}
            </p>

            @if($jobTitle || !empty($portfolio->address))
                <div class="fields fields--two about-facts">

                    @if($jobTitle)
                        <div class="field">
                            <span class="label">Currently</span>
                            <span class="value">{{ $jobTitle }}</span>
                        </div>
                    @endif

                    @if(!empty($portfolio->address))
                        <div class="field">
                            <span class="label">Location</span>
                            <span class="value">{{ $portfolio->address }}</span>
                        </div>
                    @endif

                </div>
            @endif

            <a href="#personal-details" class="link about-link">
                View personal details
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

    </div>
</section>


<!-- PERSONAL DETAILS -->
<section class="section section--sand" id="personal-details">
    <div class="container section-grid">

        <div>
            <span class="eyebrow">The basics</span>
            <h2 class="section-title">Personal Details</h2>
        </div>

        <div class="details">

            @foreach($details as $detail)
                <div class="field">
                    <span class="label">{{ $detail['label'] }}</span>
                    <span class="value">{{ $detail['value'] }}</span>
                </div>
            @endforeach

        </div>

    </div>
</section>


<!-- SKILLS -->
@if($skillList->isNotEmpty())

<section class="section" id="skills">
    <div class="container section-grid">

        <div>
            <span class="eyebrow">What I do</span>
            <h2 class="section-title">Skills &amp; Expertise</h2>
        </div>

        <div class="skills">

            @foreach($skillList as $skillName)
                <span class="skill">{{ $skillName }}</span>
            @endforeach

        </div>

    </div>
</section>

@endif


<!-- PROJECTS -->
@if($portfolio->projects && $portfolio->projects->count() > 0)

<section class="section section--sand" id="projects">
    <div class="container section-grid">

        <div>
            <span class="eyebrow">What I've built</span>
            <h2 class="section-title">Projects</h2>
        </div>

        <div class="projects">

            @foreach($portfolio->projects as $project)

                <article class="project">

                    <span class="project-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

                    <div>
                        <h3>{{ $project->name }}</h3>

                        <p>
                            {{ !empty($project->description) ? $project->description : 'A project showcasing my skills, ideas, and learning experience.' }}
                        </p>
                    </div>

                    @if(!empty($project->link))
                        <a href="{{ $project->link }}"
                           class="link"
                           target="_blank"
                           rel="noopener noreferrer">
                            View project
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    @endif

                </article>

            @endforeach

        </div>

    </div>
</section>

@endif


<!-- EXPERIENCE -->
@if($portfolio->experiences && $portfolio->experiences->count() > 0)

<section class="section" id="experience">
    <div class="container section-grid">

        <div>
            <span class="eyebrow">Where I worked</span>
            <h2 class="section-title">Work Experience</h2>
        </div>

        <div class="entries">

            @foreach($portfolio->experiences as $experience)

                <article class="entry">

                    <div class="fields">

                        <div class="field field--main">
                            <span class="label">Role</span>
                            <span class="value">{{ $experience->position }}</span>
                        </div>

                        @if(!empty($experience->company))
                            <div class="field">
                                <span class="label">Company</span>
                                <span class="value">{{ $experience->company }}</span>
                            </div>
                        @endif

                        <div class="field">
                            <span class="label">Duration</span>
                            <span class="value">{{ $experience->duration ?: 'Professional Experience' }}</span>
                        </div>

                    </div>

                    @if(!empty($experience->description))
                        <div class="entry-note">
                            <span class="label">What I did</span>
                            <p>{{ $experience->description }}</p>
                        </div>
                    @endif

                </article>

            @endforeach

        </div>

    </div>
</section>

@endif


<!-- EDUCATION -->
@if($portfolio->educations && $portfolio->educations->count() > 0)

<section class="section section--sand" id="education">
    <div class="container section-grid">

        <div>
            <span class="eyebrow">Studies</span>
            <h2 class="section-title">Education</h2>
        </div>

        <div class="entries">

            @foreach($portfolio->educations as $education)

                @php
                    $schoolName  = $education->school_name ?? $education->institution ?? '';
                    $programName = $education->program ?? $education->degree ?? $education->education_level ?? $education->level ?? 'Education';
                @endphp

                <article class="entry">

                    <div class="fields fields--edu">

                        @if(!empty($schoolName))
                            <div class="field field--main">
                                <span class="label">School</span>
                                <span class="value">{{ $schoolName }}</span>
                            </div>
                        @endif

                        <div class="field">
                            <span class="label">Program</span>
                            <span class="value">{{ $programName }}</span>
                        </div>

                        @if(!empty($education->year))
                            <div class="field">
                                <span class="label">Year</span>
                                <span class="value">{{ $education->year }}</span>
                            </div>
                        @endif

                    </div>

                </article>

            @endforeach

        </div>

    </div>
</section>

@endif


<!-- CONTACT -->
<section class="section" id="contact">
    <div class="container section-grid">

        <div>
            <span class="eyebrow">Say hello</span>
            <h2 class="section-title">Get in Touch</h2>
        </div>

        <div class="contact-text">

            <h3>Let's Connect and Create Something Amazing.</h3>

            <p>I'm open to job opportunities and collaborations. Feel free to reach out.</p>

            <div class="contact-actions">

                @if(!empty($portfolio->email))
                    <a href="mailto:{{ $portfolio->email }}" class="btn btn--solid">
                        <i class="fa-regular fa-envelope"></i>
                        Email Me
                    </a>
                @endif

                @if(!empty($portfolio->phone))
                    <a href="tel:{{ $portfolio->phone }}" class="btn btn--line">
                        <i class="fa-solid fa-phone"></i>
                        {{ $portfolio->phone }}
                    </a>
                @endif

            </div>

            @if($portfolio->links && $portfolio->links->count() > 0)

                <div class="socials">

                    @foreach($portfolio->links as $link)

                        <a href="{{ $link->url }}"
                           class="social"
                           target="_blank"
                           rel="noopener noreferrer">
                            <i class="{{ $socialIcon($link->platform ?? '') }}"></i>
                            {{ ucfirst($link->platform ?? 'Website') }}
                        </a>

                    @endforeach

                </div>

            @endif

        </div>

    </div>
</section>


<!-- FOOTER -->
<footer>
    <p>
        &copy; {{ date('Y') }} {{ $fullName }}. All rights reserved.
        &nbsp;·&nbsp;
        <a href="#home">Back to top</a>
    </p>
</footer>


<!-- NAVIGATION SCRIPT (UNCHANGED) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const header = document.getElementById('siteHeader');
    const toggle = document.getElementById('navToggle');
    const menu = document.getElementById('navMenu');
    const links = document.querySelectorAll('.nav-link');

    if (!header || !toggle || !menu) {
        return;
    }

    // Open and close the mobile navigation.
    toggle.addEventListener('click', function () {
        const isOpen = menu.classList.toggle('open');

        toggle.setAttribute('aria-expanded', String(isOpen));
    });

    // Close the mobile menu when a navigation link is clicked.
    links.forEach(function (link) {
        link.addEventListener('click', function () {
            menu.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
        });
    });

    // Add a shadow to the navigation when scrolling.
    function updateHeader() {
        header.classList.toggle('scrolled', window.scrollY > 20);
    }

    window.addEventListener('scroll', updateHeader, {
        passive: true
    });

    updateHeader();

    // Highlight the navigation link for the current section.
    const sections = document.querySelectorAll('section[id]');

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) {
                    return;
                }

                const currentId = entry.target.id;

                links.forEach(function (link) {
                    const isActive =
                        link.getAttribute('href') === '#' + currentId;

                    link.classList.toggle('is-active', isActive);
                });
            });
        }, {
            rootMargin: '-20% 0px -65% 0px'
        });

        sections.forEach(function (section) {
            observer.observe(section);
        });
    }

    // Close the mobile menu when returning to desktop width.
    window.addEventListener('resize', function () {
        if (window.innerWidth > 900) {
            menu.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
        }
    });
});
</script>

</body>
</html>
