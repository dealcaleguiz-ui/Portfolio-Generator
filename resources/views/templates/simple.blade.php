<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $portfolio->full_name ?? $portfolio->name }} | Simple Portfolio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- One font family for the whole page --}}
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>

/* =========================================
   DESIGN TOKENS
   Same palette as the other templates.
   Hierarchy comes from size, weight and
   color tone, never from extra fonts.
========================================= */

:root {
  /* Color */
  --background: #FFF8D4;
  --sand: #FFFEFA;
  --card: #FFFEFA;
  --border: #799CF0;

  --primary: #132EB9;      /* headings, links, accents */
  --foreground: #1B2455;   /* body text: deep navy, easy on the eyes */
  --muted: #4A5596;        /* secondary text (6.5:1 on background) */

  /* Type scale (one family: Manrope) */
  --font: "Manrope", ui-sans-serif, system-ui, -apple-system, "Segoe UI", sans-serif;

  --fs-display: clamp(2.25rem, 5vw, 3.25rem);  /* name */
  --fs-h2: 1.75rem;                            /* section titles */
  --fs-h3: 1.25rem;                            /* item titles */
  --fs-lead: 1.125rem;                         /* intro paragraphs */
  --fs-body: 1rem;                             /* normal text */
  --fs-small: 0.875rem;                        /* links, buttons, meta */
  --fs-label: 0.8125rem;                       /* field labels */

  /* Spacing scale (8px base) */
  --space-1: 8px;
  --space-2: 16px;
  --space-3: 24px;
  --space-4: 32px;
  --space-5: 48px;
  --space-6: 80px;

  --radius: 10px;
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
  font-family: var(--font);
  font-size: var(--fs-body);
  font-weight: 500;
  line-height: 1.7;
  -webkit-font-smoothing: antialiased;
}

h1, h2, h3, h4 {
  margin: 0;
  color: var(--primary);
  font-family: var(--font);
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

:focus-visible {
  outline: 3px solid var(--primary);
  outline-offset: 3px;
  border-radius: 4px;
}

/* Centered page width */
.container {
  width: 100%;
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 var(--space-3);
}

/* =========================================
   PREVIEW BAR (hidden on public pages)
========================================= */

/* Blue preview bar at the very top */
.portfolio-navbar {
  width: 100%;
  background: var(--primary);
  padding: 12px var(--space-3);
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
  font-size: var(--fs-small);
  font-weight: 700;
}

.navbar-actions {
  display: flex;
  align-items: center;
  gap: var(--space-1);
}

/* Rounded buttons in the preview bar */
.navbar-button {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  padding: 10px 14px;
  border: 1px solid rgb(255 248 212 / 40%);
  border-radius: 999px;
  color: #FFF8D4;
  font-size: var(--fs-label);
  font-weight: 600;
  white-space: nowrap;
  transition: background 0.2s ease;
}

.navbar-button:hover {
  background: rgb(255 248 212 / 14%);
}

/* Preview bar stacks on small screens */
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
   SITE NAVIGATION
========================================= */

/* Sticky navigation bar */
.site-header {
  position: sticky;
  top: 0;
  z-index: 1000;
  width: 100%;
  background: rgb(255 248 212 / 95%);
  border-bottom: 1px solid var(--border);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  transition: background 0.3s ease, box-shadow 0.3s ease;
}

.site-header.scrolled {
  background: rgb(255 248 212 / 98%);
  box-shadow: 0 8px 24px rgb(19 46 185 / 8%);
}

/* Keeps the logo and menu aligned */
.nav-container {
  width: min(1100px, calc(100% - 48px));
  min-height: 76px;
  margin-inline: auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-3);
}

/* Photo and name on the left */
.nav-brand {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  color: var(--primary);
  font-size: var(--fs-body);
  font-weight: 800;
  white-space: nowrap;
}

.nav-brand img {
  width: 44px;
  height: 44px;
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
  font-size: var(--fs-small);
  font-weight: 800;
}

/* Menu links on the right */
.nav-menu {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 24px;
}

/* One menu link */
.nav-link {
  position: relative;
  display: inline-block;
  padding: 10px 0;
  color: var(--foreground);
  font-size: var(--fs-small);
  font-weight: 600;
  transition: color 0.25s ease;
}

.nav-link:hover,
.nav-link.is-active {
  color: var(--primary);
}

.nav-link.is-active {
  font-weight: 800;
}

/* Underline that grows on hover */
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

/* Menu button (only shown on small screens) */
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
  background: var(--primary);
  transition: transform 0.3s ease, opacity 0.3s ease;
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

/* Mobile menu */
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
    padding: 12px 24px 20px;
    border-bottom: 1px solid var(--border);
    background: var(--background);
    box-shadow: 0 15px 24px rgb(19 46 185 / 8%);
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: translateY(-10px);
    transition: opacity 0.25s ease, visibility 0.25s ease, transform 0.25s ease;
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

/* =========================================
   SHARED PIECES
========================================= */

/* Label above a value: small, muted, sentence case (easy to read) */
.label {
  display: block;
  margin-bottom: 2px;
  color: var(--muted);
  font-size: var(--fs-label);
  font-weight: 600;
  line-height: 1.4;
}

.value {
  display: block;
  color: var(--foreground);
  font-size: var(--fs-body);
  font-weight: 600;
  line-height: 1.5;
  overflow-wrap: anywhere;
}

/* The most important field in a row stands out by size and color */
.field--main .value {
  color: var(--primary);
  font-size: var(--fs-h3);
  font-weight: 800;
  line-height: 1.35;
}

/* Row of label and value pairs */
.fields {
  display: grid;
  grid-template-columns: minmax(0, 1.5fr) minmax(0, 1fr) minmax(0, 1fr);
  gap: var(--space-2) var(--space-4);
  align-items: start;
}

.fields--two {
  grid-template-columns: repeat(2, minmax(0, 1fr));
}

.fields--edu {
  grid-template-columns: minmax(0, 1.5fr) minmax(0, 1.2fr) minmax(0, 0.6fr);
}

/* Text link with an arrow */
.link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: var(--primary);
  font-size: var(--fs-small);
  font-weight: 700;
  transition: gap 0.2s ease;
}

.link:hover {
  gap: 12px;
}

/* Shape shared by all buttons */
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  min-height: 48px;
  padding: 12px 24px;
  border: 2px solid var(--primary);
  border-radius: var(--radius);
  font-size: var(--fs-small);
  font-weight: 700;
  line-height: 1.2;
  transition: background 0.2s ease, color 0.2s ease;
}

/* Filled button */
.btn--solid {
  background: var(--primary);
  color: var(--background);
}

.btn--solid:hover {
  background: #0E2290;
  border-color: #0E2290;
}

/* Outlined button */
.btn--line {
  background: transparent;
  color: var(--primary);
}

.btn--line:hover {
  background: var(--primary);
  color: var(--background);
}

/* =========================================
   HERO (centered, single column)
========================================= */

.hero {
  padding: var(--space-6) 0;
  text-align: center;
}

/* Round profile picture with a ring */
.hero-photo {
  width: 200px;
  height: 200px;
  margin: 0 auto var(--space-3);
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
  color: var(--primary);
  font-size: 44px;
}

.hero-hello {
  margin-bottom: 4px;
  color: var(--muted);
  font-size: var(--fs-lead);
  font-weight: 600;
}

.hero h1 {
  margin-bottom: 12px;
  font-size: var(--fs-display);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
  overflow-wrap: anywhere;
}

.hero-role {
  margin-bottom: var(--space-2);
  color: var(--foreground);
  font-size: var(--fs-h3);
  font-weight: 700;
}

/* Welcome text under the name */
.hero-desc {
  max-width: 600px;
  margin: 0 auto var(--space-4);
  color: var(--muted);
  font-size: var(--fs-lead);
  line-height: 1.75;
}

.hero-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 12px;
}

.hero-meta {
  margin-top: var(--space-3);
  color: var(--muted);
  font-size: var(--fs-small);
}

/* =========================================
   SECTIONS
   Title column (left) + content column (right).
   Same padding and gap in every section.
========================================= */

.section {
  padding: var(--space-6) 0;
}

.hero + .section {
  border-top: 1px solid var(--border);
}

.section--sand {
  background: var(--sand);
}

/* Title on the left, content on the right */
.section-grid {
  display: grid;
  grid-template-columns: 240px minmax(0, 1fr);
  gap: var(--space-5);
  align-items: start;
}

/* Title stays in view while long content scrolls */
.section-head {
  position: sticky;
  top: 110px;
}

/* Small label above each section title */
.eyebrow {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 8px;
  color: var(--muted);
  font-size: var(--fs-label);
  font-weight: 700;
}

.eyebrow::before {
  content: "";
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--primary);
}

.section-title {
  font-size: var(--fs-h2);
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -0.01em;
}

/* =========================================
   ABOUT
========================================= */

.about-text {
  max-width: 68ch;
  font-size: var(--fs-lead);
  line-height: 1.8;
  text-align: left;
}

.about-facts {
  margin-top: var(--space-4);
  padding-top: var(--space-3);
  border-top: 1px solid var(--border);
}

.about-link {
  display: flex;
  width: fit-content;
  margin-top: var(--space-3);
}

/* =========================================
   PERSONAL DETAILS
========================================= */

/* Two-column list of details */
.details {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 0 var(--space-5);
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
  gap: 12px;
}

/* One skill tag */
.skill {
  padding: 8px 18px;
  border: 1px solid var(--border);
  border-radius: 999px;
  background: var(--card);
  color: var(--foreground);
  font-size: var(--fs-small);
  font-weight: 600;
  line-height: 1.4;
  transition: border-color 0.2s ease, color 0.2s ease;
}

.skill:hover {
  border-color: var(--primary);
  color: var(--primary);
}

/* =========================================
   PROJECTS
========================================= */

.projects {
  border-bottom: 1px solid var(--border);
}

/* One project row */
.project {
  display: grid;
  grid-template-columns: minmax(0, 1fr) auto;
  gap: 8px var(--space-3);
  align-items: start;
  padding: var(--space-3) 0;
  border-top: 1px solid var(--border);
}

.project h3 {
  margin-bottom: 4px;
  font-size: var(--fs-h3);
  font-weight: 800;
  line-height: 1.35;
}

.project p {
  max-width: 62ch;
  color: var(--muted);
  font-size: var(--fs-body);
  line-height: 1.7;
  text-align: left;
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

/* One experience or education entry */
.entry {
  padding: var(--space-3) 0;
  border-top: 1px solid var(--border);
}

.entry-note {
  margin-top: var(--space-2);
}

.entry-note p {
  max-width: 68ch;
  color: var(--muted);
  font-size: var(--fs-body);
  line-height: 1.75;
}

/* =========================================
   CONTACT
========================================= */

.contact-text h3 {
  max-width: 560px;
  margin-bottom: 12px;
  font-size: var(--fs-h2);
  font-weight: 800;
  line-height: 1.3;
  letter-spacing: -0.01em;
}

.contact-text p {
  max-width: 520px;
  margin-bottom: var(--space-4);
  color: var(--muted);
  font-size: var(--fs-lead);
}

.contact-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
}

/* Row of social media links */
.socials {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-1) var(--space-3);
  margin-top: var(--space-4);
  padding-top: var(--space-3);
  border-top: 1px solid var(--border);
}

.social {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: var(--foreground);
  font-size: var(--fs-small);
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
  padding: var(--space-3);
  border-top: 1px solid var(--border);
  color: var(--muted);
  text-align: center;
  font-size: var(--fs-small);
}

footer a {
  color: var(--primary);
  font-weight: 700;
}

/* =========================================
   RESPONSIVE
========================================= */

/* Tablets and phones: one column */
@media (max-width: 800px) {
  .hero {
    padding: var(--space-5) 0;
  }

  .section {
    padding: var(--space-5) 0;
  }

  .section-grid {
    grid-template-columns: 1fr;
    gap: var(--space-3);
  }

  .section-head {
    position: static;
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
    grid-template-columns: 1fr;
  }

  .project .link {
    padding-top: 0;
  }
}

/* Small phones: buttons stack */
@media (max-width: 480px) {
  .hero-actions,
  .contact-actions {
    flex-direction: column;
    align-items: stretch;
  }
}

/* Turn off animations for people who prefer less motion */
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
{{-- Preview bar: hidden when the portfolio is opened from the public link --}}
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

      <a href="{{ route('portfolios.edit', ['portfolio' => $portfolio->id, 'template' => 'simple']) }}" class="navbar-button">
          Edit Portfolio
      </a>

      <a href="{{ route('portfolios.templates', $portfolio->id) }}" class="navbar-button">
        Change Template
      </a>
        
    </div>

  </div>
</nav>
@endunless

{{-- Site navigation bar --}}
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

    {{-- Menu button (shown on small screens) --}}
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

    {{-- Links to each section --}}
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

{{-- Prepare the values used by the sections below --}}
@php
  // Basic profile values (falls back to other column names)
  $fullName  = $portfolio->full_name ?? $portfolio->name ?? 'My Portfolio';
  $aboutText = $portfolio->about ?? $portfolio->bio ?? '';
  $jobTitle  = $portfolio->title ?? $portfolio->job_title ?? $portfolio->headline ?? $portfolio->profession ?? '';
  $website   = $portfolio->website ?? $portfolio->website_url ?? '';
  // Photo: keep data URLs and full URLs, add the storage path to saved files
  $profilePhoto = $portfolio->photo ?? $portfolio->profile_picture ?? null;

  if (
    $profilePhoto &&
    !str_starts_with($profilePhoto, 'data:') &&
    !filter_var($profilePhoto, FILTER_VALIDATE_URL)
  ) {
    $profilePhoto = asset('storage/' . $profilePhoto);
  }

  // Line under the buttons: address and email
  $heroMeta = implode(' · ', array_filter([$portfolio->address ?? '', $portfolio->email ?? '']));

  // Items for Personal Details (empty values are removed)
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

    {{-- Profile picture (icon if there is no photo) --}}
    <div class="hero-photo">
      @if($profilePhoto)
        <img src="{{ $profilePhoto }}" alt="{{ $fullName }}">
      @else
        <div class="hero-placeholder">
          <i class="fa-solid fa-user"></i>
        </div>
      @endif
    </div>

    {{-- Name and job title --}}
    <p class="hero-hello">Hello, I'm</p>

    <h1>{{ $fullName }}</h1>

    @if($jobTitle)
      <p class="hero-role">{{ $jobTitle }}</p>
    @endif

    {{-- Short welcome text --}}
    <p class="hero-desc">
      Welcome to my portfolio! Here, you can explore my background, educational achievements, skills, projects, and experiences that reflect my personal and professional journey.
    </p>

    {{-- Buttons that scroll to Projects and Contact --}}
    <div class="hero-actions">
      <a href="#projects" class="btn btn--solid">
        Explore My Work
        <i class="fa-solid fa-arrow-right"></i>
      </a>

      <a href="#contact" class="btn btn--line">
        Let's Connect
      </a>
    </div>

    {{-- Address and email line --}}
    @if($heroMeta)
      <p class="hero-meta">{{ $heroMeta }}</p>
    @endif

  </div>
</section>


<!-- ABOUT -->
<section class="section" id="about">
  <div class="container section-grid">

    <div class="section-head">
      <span class="eyebrow">Who I am</span>
      <h2 class="section-title">About Me</h2>
    </div>

    <div>

      {{-- About text (default text if empty) --}}
      <p class="about-text">
        {{ $aboutText ?: 'I am someone who enjoys learning, exploring new ideas, and developing skills through meaningful experiences and projects.' }}
      </p>

      {{-- Job title and location --}}
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

    <div class="section-head">
      <span class="eyebrow">The basics</span>
      <h2 class="section-title">Personal Details</h2>
    </div>

    <div class="details">

      {{-- One row for each filled-in detail --}}
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

    <div class="section-head">
      <span class="eyebrow">What I do</span>
      <h2 class="section-title">Skills &amp; Expertise</h2>
    </div>

    <div class="skills">

      {{-- One tag for each skill --}}
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

    <div class="section-head">
      <span class="eyebrow">What I've built</span>
      <h2 class="section-title">Projects</h2>
    </div>

    <div class="projects">

      {{-- One entry for each project --}}
      @foreach($portfolio->projects as $project)

        <article class="project">

          <div>
            <h3>{{ $project->name }}</h3>

            <p>
              {{ !empty($project->description) ? $project->description : 'A project showcasing my skills, ideas, and learning experience.' }}
            </p>
          </div>

          {{-- Link is only shown when the project has one --}}
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

    <div class="section-head">
      <span class="eyebrow">Where I worked</span>
      <h2 class="section-title">Work Experience</h2>
    </div>

    <div class="entries">

      {{-- One entry for each job --}}
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

          {{-- Description is only shown when filled in --}}
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

    <div class="section-head">
      <span class="eyebrow">Studies</span>
      <h2 class="section-title">Education</h2>
    </div>

    <div class="entries">

      {{-- One entry for each school --}}
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

    <div class="section-head">
      <span class="eyebrow">Say hello</span>
      <h2 class="section-title">Get in Touch</h2>
    </div>

    <div class="contact-text">

      <h3>Let's Connect and Create Something Amazing.</h3>

      <p>I'm open to job opportunities and collaborations. Feel free to reach out.</p>

      {{-- Email and phone buttons (only shown when filled in) --}}
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

      {{-- Social media and website links --}}
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


<!-- NAVIGATION SCRIPT -->
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

  // Close the mobile menu when returning to desktop width
  // (1000px matches the CSS breakpoint).
  window.addEventListener('resize', function () {
    if (window.innerWidth > 1000) {
      menu.classList.remove('open');
      toggle.setAttribute('aria-expanded', 'false');
    }
  });
});
</script>

<script>
    function toggleDownloadMenu() {
        document.getElementById('downloadMenu').classList.toggle('show');
    }

    document.addEventListener('click', function (event) {
        const dropdown = document.querySelector('.download-dropdown');
        const menu = document.getElementById('downloadMenu');

        if (dropdown && menu && !dropdown.contains(event.target)) {
            menu.classList.remove('show');
        }
    });
</script>

</body>
</html>