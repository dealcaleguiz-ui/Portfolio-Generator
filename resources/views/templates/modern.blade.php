@php

  // Education rows that have at least one filled field
  $educations = collect($portfolio->educations ?? [])
    ->filter(fn ($item) => $item->school_name || $item->education_level || $item->program || $item->year)
    ->values();

  // Skills that have a name
  $skills = collect($portfolio->skills ?? [])
    ->filter(fn ($item) => $item->name)
    ->values();

  // Projects that have a name or a description
  $projects = collect($portfolio->projects ?? [])
    ->filter(fn ($item) => $item->name || $item->description)
    ->values();

  // Work experiences that have at least one filled field
  $experiences = collect($portfolio->experiences ?? [])
    ->filter(fn ($item) => $item->position || $item->company || $item->duration || $item->description)
    ->values();

  // Social links: only keep rows with a platform and a safe http/https URL
  $links = collect($portfolio->links ?? [])
    ->filter(function ($item) {
      if (empty($item->platform) || empty($item->url)) {
        return false;
      }

      $scheme = strtolower(parse_url($item->url, PHP_URL_SCHEME) ?? '');

      return in_array($scheme, ['http', 'https']);
    })
    ->values();

  // Full name (with a fallback when empty)
  $fullName = $portfolio->full_name ?? 'Your Name';

  // Initials (first letter of the first two words), used when there is no photo
  $initials = collect(preg_split('/\s+/', trim($fullName)))
    ->filter()
    ->take(2)
    ->map(fn ($part) => mb_substr($part, 0, 1))
    ->implode('');

  // Profile photo: accepts base64 images, full URLs, or files saved in storage
  $photoPath = $portfolio->photo ?? null;

  $photoPath = $portfolio->photo ?? null;

  $photo = null;

  if (!empty($photoPath)) {
    if (
      preg_match('/^data:image\/[a-zA-Z0-9.+-]+;base64,/', $photoPath)
      || preg_match('/^https?:\/\//i', $photoPath)
    ) {
      $photo = $photoPath;
    } else {
      $photo = asset('storage/' . ltrim($photoPath, '/'));
    }
  }

  // Personal information (trimmed so empty values are easy to detect)
  $about = trim($portfolio->about ?? '');
  $email = trim($portfolio->email ?? '');
  $phone = trim($portfolio->phone ?? '');
  $address = trim($portfolio->address ?? '');

  // True when at least one contact detail exists
  $hasPersonalInfo = $email !== '' || $phone !== '' || $address !== '';

  // First link that mentions "messenger" (used for the hero "Message Me" button)
  $messengerLink = $links->first(
    fn ($link) => str_contains(strtolower($link->platform), 'messenger')
  );
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>{{ $fullName }} | Portfolio</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap"
        rel="stylesheet">

  <style>
    /* =========================================
       COLOR VARIABLES AND GLOBAL SETTINGS
    ========================================= */

    :root {
      --teal: #035A52;
      --teal-dark: #023F3A;
      --teal-light: #E6F1EC;
      --lime: #D8E267;
      --cream: #FAF9F0;
      --beige: #CFAE8E;
      --white: #FFFFFF;

      --text: #172D28;
      --muted: #354B43;
      --border: #D5DED5;
      --border-lime: #D7DF8D;
      --text-dark: #172D28;

      --shadow: 0 8px 25px rgba(3, 90, 82, 0.08);
      --shadow-hover: 0 14px 32px rgba(3, 90, 82, 0.14);
      --radius: 18px;
    }

    /* Reset default browser spacing */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Smooth scrolling for menu links */
    html {
      scroll-behavior: smooth;
      scroll-padding-top: 100px;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background:
        radial-gradient(circle at 5% 5%, rgba(207, 174, 142, .12), transparent 25%),
        var(--cream);
      color: var(--text);
      font-size: 15px;
      line-height: 1.8;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    img {
      display: block;
      max-width: 100%;
    }

    button,
    a {
      -webkit-tap-highlight-color: transparent;
    }

    /* Centered page container */
    .container {
      width: min(100% - 40px, 1080px);
      margin: 0 auto;
    }

    /* Spacing for every section */
    .section {
      padding: 42px 0;
    }

    /* Section titles */
    .section-heading {
      margin-bottom: 24px;
    }

    .section-label {
      display: inline-block;
      margin-bottom: 7px;
      color: var(--teal);
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 1.4px;
      text-transform: uppercase;
    }

    h1,
    h2,
    h3,
    h4 {
      font-family: 'Space Grotesk', sans-serif;
      line-height: 1.35;
    }

    h2 {
      color: var(--teal);
      font-size: clamp(25px, 3vw, 32px);
      font-weight: 700;
    }

    .section-description {
      margin-top: 8px;
      color: var(--text);
      font-size: 15px;
    }

    /* =========================================
       MANAGEMENT BAR
       (My Portfolios, Edit, Change Template)
    ========================================= */

    .management-bar {
      padding: 12px 0;
      background: var(--teal-dark);
      color: var(--white);
    }

    .management-inner {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 12px;
    }

    .management-label {
      font-size: 13px;
      font-weight: 700;
    }

    .management-links {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    .management-links a {
      padding: 6px 12px;
      border: 1px solid rgba(255,255,255,.4);
      border-radius: 30px;
      font-size: 12px;
      font-weight: 600;
      transition: .25s;
    }

    .management-links a:hover {
      background: var(--lime);
      border-color: var(--lime);
      color: var(--teal-dark);
    }

    /* =========================================
       NAVIGATION BAR
    ========================================= */

    .navbar {
      position: sticky;
      top: 0;
      z-index: 100;
      border-bottom: 2px solid var(--border);
      background: rgba(250,249,240,.97);
      backdrop-filter: blur(14px);
    }

    .nav-inner {
      min-height: 72px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 20px;
    }

    /* Logo and name on the left */
    .brand {
      display: flex;
      align-items: center;
      gap: 11px;
      color: var(--teal);
      font-family: 'Space Grotesk', sans-serif;
      font-size: 16px;
      font-weight: 700;
      overflow-wrap: anywhere;
    }

    .brand-icon {
      width: 39px;
      height: 39px;
      display: grid;
      place-items: center;
      flex-shrink: 0;
      border: 2px solid var(--teal);
      border-radius: 12px;
      background: var(--lime);
      color: var(--teal-dark);
      font-size: 16px;
    }

    /* Menu links on the right */
    .nav-links {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 17px;
    }

    .nav-links a {
      color: var(--text);
      font-size: 13px;
      font-weight: 700;
      transition: .2s;
    }

    .nav-links a:hover {
      color: var(--teal);
      text-decoration: underline;
      text-decoration-color: var(--lime);
      text-decoration-thickness: 3px;
      text-underline-offset: 6px;
    }

    /* =========================================
       HERO SECTION
    ========================================= */

    .hero {
      padding: 32px 0 25px;
    }

    /* Big green card */
    .hero-card {
      position: relative;
      display: grid;
      grid-template-columns: 1.4fr .6fr;
      align-items: center;
      gap: 38px;
      padding: clamp(28px, 5vw, 56px);
      overflow: hidden;
      border: 2px solid var(--teal-dark);
      border-radius: 24px;
      background: var(--teal);
      color: var(--white);
      box-shadow: 0 12px 0 rgba(216,226,103,.7);
    }

    /* Decorative circles */
    .hero-card::before {
      content: "";
      position: absolute;
      width: 300px;
      height: 300px;
      right: -100px;
      top: -190px;
      border: 35px solid rgba(216,226,103,.15);
      border-radius: 50%;
    }

    .hero-card::after {
      content: "";
      position: absolute;
      width: 200px;
      height: 200px;
      left: 30%;
      bottom: -170px;
      border: 25px solid rgba(255,255,255,.07);
      border-radius: 50%;
    }

    /* Keep content above the circles */
    .hero-content,
    .hero-photo {
      position: relative;
      z-index: 2;
    }

    .hero-label {
      display: inline-block;
      margin-bottom: 16px;
      padding: 7px 13px;
      border: 1px solid var(--lime);
      border-radius: 30px;
      color: var(--lime);
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .hero h1 {
      margin-bottom: 18px;
      color: var(--white);
      font-size: clamp(35px, 5vw, 57px);
      font-weight: 700;
      line-height: 1.18;
      letter-spacing: -1.5px;
      overflow-wrap: anywhere;
    }

    .hero h1 span {
      display: block;
      color: var(--lime);
    }

    .hero-description {
      max-width: 520px;
      color: var(--white);
      font-size: 18px;
      text-align: justify;
      line-height: 1.9;
      white-space: pre-line;
      overflow-wrap: anywhere;
    }

    .hero-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      margin-top: 25px;
    }

    /* Buttons */
    .button {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
      padding: 12px 18px;
      border: 2px solid transparent;
      border-radius: 10px;
      font-family: inherit;
      font-size: 13px;
      font-weight: 700;
      transition: .25s;
      cursor: pointer;
    }

    .button:hover {
      transform: translateY(-3px);
    }

    .button-lime {
      border-color: var(--lime);
      background: var(--lime);
      color: var(--teal-dark);
    }

    .button-lime:hover {
      background: var(--white);
      border-color: var(--white);
    }

    .button-outline {
      border-color: rgba(255,255,255,.75);
      color: var(--white);
    }

    .button-outline:hover {
      background: rgba(255,255,255,.12);
    }

    /* Profile photo */
    .hero-photo {
      display: flex;
      justify-content: center;
    }

    .photo-frame {
      width: min(280px, 100%);
      aspect-ratio: .85;
      padding: 8px;
      border: 2px solid var(--teal-dark);
      border-radius: 28px 28px 14px 14px;
      background: var(--lime);
      box-shadow: 8px 8px 0 rgba(2,63,58,.5);
      transform: rotate(3deg);
    }

    .photo-inner {
      width: 100%;
      height: 100%;
      display: grid;
      place-items: center;
      overflow: hidden;
      border: 2px solid var(--teal-dark);
      border-radius: 22px 22px 8px 8px;
      background: var(--cream);
      color: var(--teal);
      font-family: 'Space Grotesk', sans-serif;
      font-size: 46px;
      font-weight: 700;
    }

    .photo-inner img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* =========================================
       ABOUT AND PERSONAL INFORMATION
    ========================================= */

    .about-layout {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      align-items: stretch;
      gap: 24px;
    }

    .about-panel,
    .personal-panel {
      min-width: 0;
      height: 100%;
      padding: 30px;
      border: 2px solid var(--border);
      border-radius: var(--radius);
      background: var(--white);
      box-shadow: var(--shadow);
    }

    .about-panel {
      border-top: 6px solid var(--teal);
    }

    .personal-panel {
      border-top: 6px solid var(--lime);
    }

    .panel-title {
      margin-bottom: 20px;
      color: var(--teal);
      font-size: 25px;
      font-weight: 700;
    }

    .about-text {
      color: var(--text);
      font-size: 16px;
      text-align: justify;
      line-height: 2;
      white-space: pre-line;
      overflow-wrap: anywhere;
    }

    .personal-list {
      display: grid;
      gap: 20px;
    }

    .personal-item {
      display: flex;
      align-items: flex-start;
      gap: 13px;
      min-width: 0;
    }

    .info-icon {
      width: 42px;
      height: 42px;
      display: grid;
      place-items: center;
      flex-shrink: 0;
      border: 1px solid var(--teal);
      border-radius: 12px;
      background: var(--teal-light);
      color: var(--teal);
      font-size: 17px;
      font-weight: 700;
    }

    .info-label {
      display: block;
      margin-bottom: 4px;
      color: var(--teal);
      font-size: 12px;
      font-weight: 700;
      letter-spacing: .5px;
      text-transform: uppercase;
    }

    .info-value {
      color: var(--text);
      font-size: 15px;
      font-weight: 600;
      line-height: 1.7;
      overflow-wrap: anywhere;
    }

    .personal-item a:hover {
      color: var(--teal);
      text-decoration: underline;
    }

    /* =========================================
       EDUCATION AND SKILLS
    ========================================= */

    /* Layout: two containers side by side */
    .education-skills-layout {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      align-items: stretch;
      gap: 24px;
    }

    .education-container,
    .skills-container {
      width: 100%;
      min-width: 0;
      padding: 26px;
      border: 2px solid var(--border);
      border-radius: 20px;
      background: var(--white);
      box-shadow: var(--shadow);
    }

    .education-container {
      border-top: 6px solid var(--teal);
    }

    .skills-container {
      border-top: 6px solid var(--lime);
    }

    .education-container .section-heading,
    .skills-container .section-heading {
      margin-bottom: 22px;
    }

    .education-container h2,
    .skills-container h2 {
      color: var(--teal);
      font-size: 27px;
    }

    /* Education cards */
    .education-list {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      align-items: stretch;
      gap: 14px;
    }

    .education-card {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      min-width: 0;
      min-height: 115px;
      padding: 17px;
      border: 2px solid var(--border);
      border-radius: 14px;
      background: #F7FAF4;
      transition: 0.25s ease;
    }

    .education-card:nth-child(even) {
      border-color: var(--lime);
      background: #FBFBEF;
    }

    .education-card:hover {
      border-color: var(--teal);
      box-shadow: var(--shadow);
      transform: translateY(-3px);
    }

    .education-icon {
      width: 42px;
      height: 42px;
      display: grid;
      place-items: center;
      flex-shrink: 0;
      border-radius: 12px;
      background: var(--teal);
      color: var(--white);
      font-size: 20px;
    }

    .education-content {
      flex: 1;
      min-width: 0;
    }

    .education-label {
      display: block;
      margin-bottom: 7px;
      color: var(--teal);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.8px;
      line-height: 1.5;
      overflow-wrap: anywhere;
    }

    .education-card h3 {
      color: var(--teal-dark);
      font-size: 16px;
      font-weight: 700;
      line-height: 1.6;
      overflow-wrap: anywhere;
    }

    /* Skill cards */
    .skills-list {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      align-items: stretch;
      gap: 14px;
    }

    .skill-card {
      display: flex;
      align-items: center;
      gap: 14px;
      width: 100%;
      min-width: 0;
      min-height: 68px;
      padding: 14px;
      border: 2px solid #BBD8CD;
      border-radius: 13px;
      background: var(--teal-light);
      color: var(--teal-dark);
      font-size: 18px;
      font-weight: 700;
      line-height: 1.5;
      overflow-wrap: anywhere;
      transition: 0.25s ease;
    }

    /* Every third skill gets a lime accent */
    .skill-card:nth-child(3n) {
      border-color: var(--lime);
      background: #F8F9DF;
    }

    .skill-card:hover {
      border-color: var(--teal);
      box-shadow: var(--shadow);
      transform: translateY(-3px);
    }

    .skill-icon {
      display: grid;
      place-items: center;
      width: 35px;
      height: 35px;
      flex-shrink: 0;
      border-radius: 10px;
      background: var(--teal);
      color: var(--lime);
      font-size: 19px;
    }

    .skill-name {
      min-width: 0;
      overflow-wrap: anywhere;
    }

    /* =========================================
       PROJECTS (name + description)
    ========================================= */

    .projects-list {
      display: grid;
      gap: 18px;
    }

    .project-row {
      display: grid;
      grid-template-columns: .85fr 1.15fr;
      align-items: stretch;
      gap: 0;
      overflow: hidden;
      border: 2px solid #D5DED5;
      border-radius: 17px;
      background: #FFFFFF;
      box-shadow: 0 6px 20px rgba(3, 90, 82, .06);
      transition: .25s ease;
    }

    .project-row:hover {
      border-color: #035A52;
      box-shadow: 0 12px 25px rgba(3, 90, 82, .12);
      transform: translateY(-2px);
    }

    /* Left side: green card with the project name */
    .project-name-card {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: center;
      min-width: 0;
      padding: 25px;
      background: #035A52;
      color: #FFFFFF;
    }

    .project-icon {
      display: grid;
      place-items: center;
      width: 45px;
      height: 45px;
      margin-bottom: 18px;
      border: 1px solid #D8E267;
      border-radius: 13px;
      background: #D8E267;
      color: #023F3A;
      font-size: 22px;
    }

    .project-number {
      margin-bottom: 8px;
      color: #D8E267;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1.2px;
    }

    .project-name-card h3 {
      color: #FFFFFF;
      font-size: 20px;
      line-height: 1.5;
      overflow-wrap: anywhere;
    }

    .project-accent {
      width: 46px;
      height: 5px;
      margin-top: 17px;
      border-radius: 10px;
      background: #D8E267;
    }

    /* Right side: white card with the description */
    .project-description-card {
      min-width: 0;
      padding: 25px;
      background: #FFFFFF;
    }

    /* Shared heading style (projects and experience) */
    .project-description-heading,
    .experience-description-heading {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 14px;
      padding-bottom: 12px;
      border-bottom: 2px solid #D5DED5;
    }

    .description-icon {
      display: grid;
      place-items: center;
      width: 33px;
      height: 33px;
      flex-shrink: 0;
      border-radius: 10px;
      background: #F2F5C9;
      color: #035A52;
      font-size: 18px;
    }

    .project-description-heading h4,
    .experience-description-heading h4 {
      color: #035A52;
      font-size: 15px;
      font-weight: 700;
    }

    .project-description-card p,
    .experience-description p {
      color: #172D28;
      font-size: 14px;
      text-align: justify;
      line-height: 1.9;
      white-space: pre-line;
      overflow-wrap: anywhere;
    }

    /* =========================================
       WORK EXPERIENCE (two parts)
    ========================================= */

    .experience-list {
      display: grid;
      gap: 20px;
    }

    .experience-row {
      display: grid;
      grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
      align-items: stretch;
      width: 100%;
      overflow: hidden;
      border: 2px solid #D5DED5;
      border-radius: 18px;
      background: #FFFFFF;
      box-sizing: border-box;
    }

    .experience-row:hover {
      border-color: var(--teal);
      box-shadow: var(--shadow-hover);
    }

    /* Individual job information cards (title, company, duration) */
    .experience-card {
      display: flex;
      flex-direction: column;
      justify-content: center;
      min-width: 0;
      min-height: 115px;
      padding: 14px 10px;
      border: 2px solid #BBD8CD;
      border-top: 5px solid #035A52;
      border-radius: 12px;
      background: #E6F1EC;
      box-sizing: border-box;
      overflow-wrap: anywhere;
    }

    .experience-icon {
      width: 48px;
      height: 48px;
      display: grid;
      place-items: center;
      flex-shrink: 0;
      border: 1px solid var(--teal);
      border-radius: 13px;
      background: var(--teal);
      color: var(--lime);
      font-size: 22px;
    }

    /* Left column: the three cards */
    .experience-details {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      align-content: start;
      align-items: start;
      gap: 8px;
      min-width: 0;
      padding: 16px;
      background: #FFFFFF;
      border-right: 2px solid #D5DED5;
      box-sizing: border-box;
    }

    .experience-label {
      display: block;
      margin-bottom: 7px;
      color: var(--teal);
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 0.8px;
      line-height: 1.5;
      overflow-wrap: anywhere;
    }

    .experience-card h3 {
      margin: 10px 0 0;
      color: #023F3A;
      font-size: 16px;
      font-weight: 700;
      line-height: 1.5;
      overflow-wrap: anywhere;
    }

    .experience-value {
      color: var(--text);
      font-size: 16px;
      font-weight: 700;
      line-height: 1.7;
      overflow-wrap: anywhere;
    }

    .experience-duration {
      display: inline-block;
      padding: 7px 12px;
      border: 1px solid var(--lime);
      border-radius: 10px;
      background: #F8F9DF;
      color: var(--teal-dark);
      font-size: 14px;
      font-weight: 700;
      line-height: 1.6;
      overflow-wrap: anywhere;
    }

    /* Right column: job description */
    .experience-description {
      min-width: 0;
      padding: 28px;
      background: var(--white);
    }

    .experience-description-heading {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 2px solid var(--border);
    }

    .experience-description-heading h4 {
      color: var(--teal);
      font-size: 19px;
      font-weight: 700;
    }

    .experience-description p {
      color: var(--text);
      font-size: 16px;
      line-height: 1.9;
      white-space: pre-line;
      overflow-wrap: anywhere;
    }

    /* =========================================
       SOCIAL MEDIA
    ========================================= */

    .social-list {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 16px;
    }

    .social-card {
      display: flex;
      align-items: center;
      gap: 13px;
      min-width: 0;
      padding: 18px;
      border: 2px solid #D5DED5;
      border-radius: 15px;
      background: #FFFFFF;
      box-shadow: 0 5px 16px rgba(3, 90, 82, .05);
      transition: .25s ease;
    }

    .social-card:nth-child(3n + 2) {
      background: #F8F9DF;
      border-color: #D7DF8D;
    }

    .social-card:hover {
      border-color: #035A52;
      box-shadow: 0 10px 23px rgba(3, 90, 82, .12);
      transform: translateY(-3px);
    }

    .social-icon {
      width: 45px;
      height: 45px;
      display: grid;
      place-items: center;
      flex-shrink: 0;
      border: 1px solid #035A52;
      border-radius: 13px;
      background: #035A52;
      color: #D8E267;
      font-size: 19px;
      font-weight: 700;
    }

    .social-information {
      flex: 1;
      min-width: 0;
    }

    .social-information strong {
      display: block;
      color: #023F3A;
      font-size: 14px;
      font-weight: 700;
      overflow-wrap: anywhere;
    }

    .social-information span {
      display: block;
      margin-top: 3px;
      color: #263D34;
      font-size: 12px;
    }

    .social-arrow {
      flex-shrink: 0;
      color: #035A52;
      font-size: 20px;
      font-weight: 700;
    }

    /* =========================================
       RESPONSIVE LAYOUT
    ========================================= */

    /* Tablets */
    @media (max-width: 900px) {
      .education-skills-layout {
        grid-template-columns: 1fr;
      }

      .education-list {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }

      .social-list {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }

    /* Small tablets and large phones */
    @media (max-width: 650px) {
      .education-skills-layout {
        grid-template-columns: 1fr;
      }

      .education-list {
        grid-template-columns: 1fr;
      }

      .skills-list {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }

      .project-row,
      .experience-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: stretch;
        width: 100%;
        overflow: hidden;
        border: 2px solid #D5DED5;
        border-radius: 20px;
        background: #FFFFFF;
        box-shadow: 0 8px 25px rgba(3, 90, 82, 0.08);
        box-sizing: border-box;
      }

      .experience-information {
        border-right: none;
        border-bottom: 2px solid var(--border);
      }

      .education-container,
      .skills-container {
        padding: 20px;
      }

      .experience-information,
      .experience-description {
        padding: 22px;
      }
    }

    /* Phones */
    @media (max-width: 600px) {
      .education-list,
      .skills-list,
      .social-list {
        grid-template-columns: 1fr;
      }

      .education-container,
      .skills-container {
        padding: 20px;
      }

      .project-row,
      .experience-row {
        grid-template-columns: 1fr;
      }

      .project-name-card,
      .project-description-card,
      .experience-information,
      .experience-description {
        padding: 21px;
      }

      .project-name-card {
        min-height: 190px;
      }

      .social-card {
        padding: 15px;
      }
    }

    /* =========================================
       CONTACT SECTION (first version)
       Note: the second CONTACT block further
       below overrides some of these rules.
    ========================================= */

    /* Green container (same look as the hero card) */
    .contact-section {
      position: relative;
      display: flex;
      flex-wrap: wrap;
      align-items: stretch;
      gap: 14px;
      margin-bottom: 12px;
      padding: clamp(20px, 4vw, 32px);
      overflow: hidden;
      border: 2px solid var(--teal-dark);
      border-radius: 24px;
      background: var(--teal);
      color: var(--white);
      box-shadow: 0 12px 0 rgba(216, 226, 103, 0.7);
    }

    /* Decorative circles, same idea as the hero */
    .contact-section::before {
      content: "";
      position: absolute;
      top: -150px;
      right: -90px;
      width: 260px;
      height: 260px;
      border: 32px solid rgba(216, 226, 103, 0.15);
      border-radius: 50%;
      pointer-events: none;
    }

    .contact-section::after {
      content: "";
      position: absolute;
      bottom: -140px;
      left: 28%;
      width: 180px;
      height: 180px;
      border: 22px solid rgba(255, 255, 255, 0.07);
      border-radius: 50%;
      pointer-events: none;
    }

    /* The two wrappers disappear so email, phone and
       social links all sit in the same row */
    .contact-information,
    .contact-social-list {
      display: contents;
    }

    /* The three white cards */
    .contact-item,
    .contact-social-item {
      position: relative;
      z-index: 1;
      display: flex;
      align-items: center;
      gap: 14px;
      flex: 1 1 220px;
      min-width: 0;
      padding: 16px 18px;
      border: 2px solid transparent;
      border-radius: 14px;
      background: var(--white);
      color: var(--text);
      box-sizing: border-box;
      transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .contact-item:hover,
    .contact-social-item:hover {
      border-color: var(--lime);
      box-shadow: 0 8px 20px rgba(2, 63, 58, 0.25);
      transform: translateY(-3px);
    }

    /* Icons (same size and style on all three cards) */
    .contact-icon,
    .contact-social-icon {
      display: grid;
      place-items: center;
      flex-shrink: 0;
      width: 42px;
      height: 42px;
      border-radius: 12px;
      background: var(--teal-light);
      color: var(--teal);
      font-size: 18px;
      font-weight: 700;
    }

    /* Text inside the email and phone cards */
    .contact-item-content {
      display: flex;
      flex-direction: column;
      flex: 1;
      min-width: 0;
    }

    .contact-item-label {
      display: block;
      margin-bottom: 3px;
      color: var(--teal);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.7px;
      line-height: 1.4;
      text-transform: uppercase;
    }

    .contact-item-value {
      color: var(--text);
      font-size: 14px;
      font-weight: 700;
      line-height: 1.5;
      overflow-wrap: anywhere;
    }

    /* Text inside the social cards */
    .contact-social-name {
      flex: 1;
      min-width: 0;
      color: var(--text);
      font-size: 14px;
      font-weight: 700;
      overflow-wrap: anywhere;
    }

    .contact-social-arrow {
      flex-shrink: 0;
      margin-left: auto;
      color: var(--teal);
      font-size: 18px;
      font-weight: 700;
    }

    /* Phones: one card per row */
    @media (max-width: 650px) {
      .contact-section {
        padding: 18px;
        border-radius: 20px;
        box-shadow: 0 8px 0 rgba(216, 226, 103, 0.7);
      }

      .contact-item,
      .contact-social-item {
        flex: 1 1 100%;
      }
    }

    /* =========================================
       RESPONSIVE WORK EXPERIENCE
       Desktop, tablet, and mobile
    ========================================= */

    /* DESKTOP: two parts side by side */
    .experience-row {
      display: grid;
      grid-template-columns: minmax(0, 1.5fr) minmax(0, 1fr);
      align-items: stretch;
      width: 100%;
      min-width: 0;
      overflow: hidden;
      border: 2px solid #D5DED5;
      border-radius: 20px;
      background: #FFFFFF;
      box-sizing: border-box;
    }

    /* Left: three separate information cards */
    .experience-details {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      align-items: stretch;
      gap: 6px;
      min-width: 0;
      padding: 12px;
      border-right: 2px solid #D5DED5;
      box-sizing: border-box;
    }

    .experience-card {
      min-width: 0;
      padding: 14px 10px;
      border: 2px solid #BBD8CD;
      border-top: 5px solid #035A52;
      border-radius: 12px;
      background: #E6F1EC;
      box-sizing: border-box;
      overflow-wrap: anywhere;
    }

    .experience-card h3 {
      margin: 10px 0 0;
      color: #023F3A;
      font-size: 16px;
      line-height: 1.5;
      overflow-wrap: anywhere;
      word-break: normal;
    }

    /* Right: job description */
    .experience-description {
      min-width: 0;
      padding: 22px;
      box-sizing: border-box;
      overflow-wrap: anywhere;
    }

    .experience-description p {
      color: #172D28;
      font-size: 16px;
      line-height: 1.7;
      overflow-wrap: anywhere;
    }

    /* TABLETS AND SMALL LAPTOPS */
    @media (max-width: 900px) {
      .experience-row {
        grid-template-columns: minmax(0, 1fr);
      }

      .experience-details {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        border-right: none;
        border-bottom: 2px solid #D5DED5;
      }

      .experience-description {
        padding: 22px;
      }
    }

    /* PHONES */
    @media (max-width: 600px) {
      .experience-row {
        grid-template-columns: minmax(0, 1fr);
        border-radius: 14px;
      }

      .experience-details {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 7px;
        padding: 12px;
        border-right: none;
        border-bottom: 2px solid #D5DED5;
      }

      .experience-card {
        padding: 10px 6px;
        border-radius: 9px;
      }

      .experience-card .experience-label {
        font-size: 10px;
        letter-spacing: 0;
        line-height: 1.4;
      }

      .experience-card h3 {
        margin-top: 7px;
        font-size: 13px;
        line-height: 1.4;
        overflow-wrap: anywhere;
      }

      .experience-description {
        padding: 16px;
      }

      .experience-description-heading {
        gap: 9px;
      }

      .experience-description-heading h4 {
        font-size: 18px;
      }

      .experience-description p {
        font-size: 15px;
        line-height: 1.7;
      }
    }

    /* =========================================
       CONTACT SECTION (second version)
       These rules come later, so they win
       over the first contact block above.
    ========================================= */

    .contact-section {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 20px;
    }

    .contact-information {
      display: grid;
      gap: 14px;
    }

    .contact-item {
      display: flex;
      align-items: center;
      gap: 14px;
      min-width: 0;
      padding: 16px;
      border: 1px solid var(--border);
      border-radius: 14px;
      background: var(--white);
      transition: 0.2s ease;
    }

    .contact-item:hover {
      border-color: var(--teal);
      transform: translateY(-2px);
    }

    .contact-icon {
      display: grid;
      place-items: center;
      width: 42px;
      height: 42px;
      flex-shrink: 0;
      border-radius: 12px;
      background: var(--teal-light);
      color: var(--teal);
      font-size: 18px;
    }

    .contact-item-content {
      flex: 1;
      min-width: 0;
    }

    .contact-item-label {
      display: block;
      margin-bottom: 3px;
      color: var(--muted);
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.7px;
    }

    .contact-item-value {
      color: var(--text);
      font-size: 14px;
      font-weight: 600;
      overflow-wrap: anywhere;
    }

    .contact-social-list {
      display: grid;
      gap: 12px;
    }

    .contact-social-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px;
      border: 1px solid var(--border);
      border-radius: 12px;
      background: var(--white);
      transition: 0.2s ease;
    }

    .contact-social-item:hover {
      border-color: var(--teal);
      background: var(--teal-light);
    }

    .contact-social-icon {
      display: grid;
      place-items: center;
      width: 38px;
      height: 38px;
      flex-shrink: 0;
      border-radius: 10px;
      background: var(--teal);
      color: var(--white);
      font-size: 16px;
    }

    .contact-social-name {
      flex: 1;
      min-width: 0;
      color: var(--text);
      font-size: 14px;
      font-weight: 700;
      overflow-wrap: anywhere;
    }

    .contact-social-arrow {
      color: var(--teal);
      font-size: 17px;
    }

    @media (max-width: 650px) {
      .contact-section {
        grid-template-columns: 1fr;
      }
    }

    /* VERY SMALL PHONES */
    @media (max-width: 360px) {
      .experience-details {
        gap: 5px;
        padding: 8px;
      }

      .experience-card {
        padding: 8px 4px;
      }

      .experience-card .experience-label {
        font-size: 9px;
      }

      .experience-card h3 {
        font-size: 12px;
      }

      .experience-description {
        padding: 12px;
      }
    }

    /* =========================================
       FOOTER
    ========================================= */

    .footer {
      margin-top: 40px;
      padding: 28px 0;
      border-top: 4px solid var(--lime);
      background: var(--teal-dark);
      color: var(--white);
    }

    .footer-inner {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 16px;
    }

    .footer-name {
      color: var(--lime);
      font-family: 'Space Grotesk', sans-serif;
      font-size: 18px;
      font-weight: 700;
      line-height: 1.4;
      overflow-wrap: anywhere;
    }

    .footer p {
      margin-top: 2px;
      color: rgba(255, 255, 255, 0.8);
      font-size: 13px;
      line-height: 1.6;
    }

    .back-top {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 10px 16px;
      border: 2px solid var(--lime);
      border-radius: 10px;
      color: var(--lime);
      font-size: 13px;
      font-weight: 700;
      transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
    }

    .back-top:hover {
      background: var(--lime);
      color: var(--teal-dark);
      transform: translateY(-2px);
    }

    @media (max-width: 650px) {
      .footer-inner {
        flex-direction: column;
        align-items: flex-start;
      }
    }

    /* =========================================
   MOBILE RESPONSIVENESS FIX
========================================= */

@media (max-width: 650px) {

    /* Stack About Me and Personal Information */
    .about-layout {
        grid-template-columns: minmax(0, 1fr);
        gap: 18px;
    }

    /* Give both panels comfortable spacing */
    .about-panel,
    .personal-panel {
        width: 100%;
        min-width: 0;
        height: auto;
        padding: 22px;
    }

    /* Make headings fit smaller screens */
    .panel-title {
        font-size: clamp(21px, 6vw, 25px);
        overflow-wrap: anywhere;
    }

    /* Improve About Me text readability */
    .about-text {
        font-size: 15px;
        line-height: 1.8;
        text-align: left;
        white-space: pre-line;
        overflow-wrap: anywhere;
        word-break: normal;
    }

    /* Place the logo above the navigation links */
    .nav-inner {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
        padding-top: 12px;
        padding-bottom: 12px;
    }

    /* Allow menu links to scroll horizontally */
    .nav-links {
        width: 100%;
        max-width: 100%;
        flex-wrap: nowrap;
        gap: 18px;
        overflow-x: auto;
        overflow-y: hidden;
        padding-bottom: 8px;
        -webkit-overflow-scrolling: touch;
    }

    /* Prevent menu labels from breaking awkwardly */
    .nav-links a {
        flex-shrink: 0;
        white-space: nowrap;
    }
}
  </style>
</head>

<body id="top">

  {{-- =========================================
       MANAGEMENT BAR
       Hidden on public pages ($isPublic = true)
  ========================================== --}}
  @unless($isPublic ?? false)
    <div class="management-bar">
      <div class="container management-inner">
        <span class="management-label">
          Portfolio Preview · PortfolioGen
        </span>

        <div class="management-links">
          <a href="{{ route('portfolios.index') }}">My Portfolios</a>
          <a href="{{ route('portfolios.edit', ['portfolio' => $portfolio->id, 'template' => 'modern']) }}">
              Edit Portfolio
          </a>
          <a href="{{ route('portfolios.templates', $portfolio->id) }}">Change Template</a>
        </div>
      </div>
    </div>
  @endunless

  {{-- =========================================
       NAVIGATION
       Menu links only appear when the section has content
  ========================================== --}}
  <header class="navbar">
    <div class="container nav-inner">

      {{-- Logo: first letter of the name + full name --}}
      <a href="#top" class="brand">
        <span class="brand-icon">
          {{ mb_strtoupper(mb_substr($fullName, 0, 1)) }}
        </span>

        <span>{{ $fullName }}</span>
      </a>

      {{-- Menu links --}}
      <nav class="nav-links" aria-label="Main navigation">

        @if($about !== '')
          <a href="#about">About Me</a>
        @endif

        @if($hasPersonalInfo)
          <a href="#personal-info">Personal Info</a>
        @endif

        @if($educations->isNotEmpty())
          <a href="#education">Education</a>
        @endif

        @if($skills->isNotEmpty())
          <a href="#skills">Skills</a>
        @endif

        @if($projects->isNotEmpty())
          <a href="#projects">Projects</a>
        @endif

        @if($experiences->isNotEmpty())
          <a href="#experience">Experience</a>
        @endif

        @if($hasPersonalInfo || $links->isNotEmpty())
          <a href="#contact">Contact</a>
        @endif

      </nav>
    </div>
  </header>

  <main>

    {{-- =========================================
         HERO SECTION
         Welcome text, buttons and profile photo
    ========================================== --}}
    <section class="hero">
      <div class="container">

        <div class="hero-card">

          {{-- Left side: text and buttons --}}
          <div class="hero-content">

            <span class="hero-label">
              Welcome to my portfolio
            </span>

            <h1>
              Hi, I'm
              <span>{{ $fullName }}</span>
            </h1>

            <p class="hero-description">
              Here, you can explore my background, educational achievements, skills, projects, and experiences that reflect my personal and professional journey."
            </p>

            <div class="hero-actions">

              {{-- Show only when there are projects --}}
              @if($projects->isNotEmpty())
                <a href="#projects" class="button button-lime">
                  Explore My Projects ↗
                </a>
              @endif

              {{-- Second button: Messenger, then Email, then Contact section --}}
              @if($messengerLink)
                <a href="{{ $messengerLink->url }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="button button-outline">
                  Message Me ↗
                </a>
              @elseif($email !== '')
                <a href="mailto:{{ $email }}"
                   class="button button-outline">
                  Email Me ↗
                </a>
              @elseif($hasPersonalInfo)
                <a href="#personal-info" class="button button-outline">
                  Contact Me
                </a>
              @endif

            </div>
          </div>

          {{-- Right side: profile photo (or initials when missing) --}}
          <div class="hero-photo">
            <div class="photo-frame">
              <div class="photo-inner">

                @if($photo)
                  <img
                    src="{{ $photo }}"
                    alt="Profile photo of {{ $fullName }}"
                    style="display:block; width:100%; height:100%; object-fit:cover;"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';"
                  >
                  {{-- Fallback shown only if the image fails to load --}}
                  <span style="display:none; width:100%; height:100%; place-items:center;">
                    {{ $initials ?: 'YN' }}
                  </span>
                @else
                  <span>{{ $initials ?: 'YN' }}</span>
                @endif

              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    {{-- =========================================
         ABOUT ME AND PERSONAL INFORMATION
    ========================================== --}}
    @if($about !== '' || $hasPersonalInfo)
      <section class="section" id="about">
        <div class="container">

          <div class="about-layout">

            {{-- About Me panel --}}
            @if($about !== '')
              <article class="about-panel">

                <span class="section-label">Get to Know Me</span>
                <h2 class="panel-title">About Me</h2>

                <p class="about-text">{{ $about }}</p>

              </article>
            @endif

            {{-- Personal Information panel --}}
            @if($hasPersonalInfo)
              <article class="personal-panel" id="personal-info">

                <span class="section-label">Let's Connect</span>
                <h2 class="panel-title">Personal Information</h2>

                <div class="personal-list">

                  {{-- Email --}}
                  @if($email !== '')
                    <div class="personal-item">
                      <span class="info-icon">@</span>

                      <div>
                        <span class="info-label">Email Address</span>

                        <a href="mailto:{{ $email }}" class="info-value">
                          {{ $email }}
                        </a>
                      </div>
                    </div>
                  @endif

                  {{-- Phone --}}
                  @if($phone !== '')
                    <div class="personal-item">
                      <span class="info-icon">☎</span>

                      <div>
                        <span class="info-label">Phone Number</span>

                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                           class="info-value">
                          {{ $phone }}
                        </a>
                      </div>
                    </div>
                  @endif

                  {{-- Address --}}
                  @if($address !== '')
                    <div class="personal-item">
                      <span class="info-icon">⌖</span>

                      <div>
                        <span class="info-label">Address</span>
                        <p class="info-value">{{ $address }}</p>
                      </div>
                    </div>
                  @endif

                </div>
              </article>
            @endif

          </div>
        </div>
      </section>
    @endif

    {{-- =========================================
         EDUCATION AND SKILLS
         Two containers side by side
    ========================================== --}}
    @if($educations->isNotEmpty() || $skills->isNotEmpty())
      <section class="section" id="education-skills">
        <div class="container">

          <div class="education-skills-layout">

            {{-- EDUCATION CONTAINER --}}
            @if($educations->isNotEmpty())
              <div class="education-container" id="education">

                <div class="section-heading">
                  <span class="section-label">Academic Journey</span>
                  <h2>Education</h2>
                  <p class="section-description">
                    My educational background and achievements.
                  </p>
                </div>

                <div class="education-list">

                  @foreach($educations as $education)

                    {{-- School card --}}
                    @if($education->school_name)
                      <article class="education-card">
                        <span class="education-icon">🎓</span>

                        <div class="education-content">
                          <span class="education-label">SCHOOL</span>
                          <h3>{{ $education->school_name }}</h3>
                        </div>
                      </article>
                    @endif

                    {{-- Education level card --}}
                    @if($education->education_level)
                      <article class="education-card">
                        <span class="education-icon">📚</span>

                        <div class="education-content">
                          <span class="education-label">EDUCATION LEVEL</span>
                          <h3>{{ $education->education_level }}</h3>
                        </div>
                      </article>
                    @endif

                    {{-- Program card --}}
                    @if($education->program)
                      <article class="education-card">
                        <span class="education-icon">📖</span>

                        <div class="education-content">
                          <span class="education-label">PROGRAM</span>
                          <h3>{{ $education->program }}</h3>
                        </div>
                      </article>
                    @endif

                    {{-- Year card --}}
                    @if($education->year)
                      <article class="education-card">
                        <span class="education-icon">📅</span>

                        <div class="education-content">
                          <span class="education-label">YEAR</span>
                          <h3>{{ $education->year }}</h3>
                        </div>
                      </article>
                    @endif

                  @endforeach

                </div>
              </div>
            @endif

            {{-- SKILLS CONTAINER --}}
            @if($skills->isNotEmpty())
              <div class="skills-container" id="skills">

                <div class="section-heading">
                  <span class="section-label">What I Can Do</span>
                  <h2>My Skills</h2>
                  <p class="section-description">
                    Skills and abilities I have developed.
                  </p>
                </div>

                <div class="skills-list">
                  @foreach($skills as $skill)
                    {{-- A skill saved as "PHP, Laravel" becomes two separate cards --}}
                    @foreach(explode(',', $skill->name) as $name)
                      @if(trim($name))
                        <div class="skill-card">
                          <span class="skill-icon">✦</span>
                          <span>{{ trim($name) }}</span>
                        </div>
                      @endif
                    @endforeach
                  @endforeach
                </div>

              </div>
            @endif

          </div>

        </div>
      </section>
    @endif

    {{-- =========================================
         PROJECTS
         Each project: name card + description card
    ========================================== --}}
    @if($projects->isNotEmpty())
      <section class="section" id="projects">
        <div class="container">

          <div class="section-heading">
            <span class="section-label">My Work</span>
            <h2>Featured Projects</h2>
            <p class="section-description">
              A collection of projects I have worked on.
            </p>
          </div>

          <div class="projects-list">

            @foreach($projects as $project)
              <article class="project-row">

                {{-- Project name card --}}
                <div class="project-name-card">

                  <div class="project-icon">💻</div>

                  <span class="project-number">
                    PROJECT {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                  </span>

                  <h3>
                    {{ $project->name ?: 'Untitled Project' }}
                  </h3>

                  <span class="project-accent"></span>

                </div>

                {{-- Project description card --}}
                <div class="project-description-card">

                  <div class="project-description-heading">
                    <span class="description-icon">▤</span>
                    <h4>Project Description</h4>
                  </div>

                  <p>
                    {{ $project->description ?: 'No description provided.' }}
                  </p>

                </div>

              </article>
            @endforeach

          </div>

        </div>
      </section>
    @endif

    {{-- =========================================
         WORK EXPERIENCE
         Left: job title, company, duration
         Right: job description
    ========================================== --}}
    @if($experiences->isNotEmpty())
      <section class="section" id="experience">
        <div class="container">

          <div class="section-heading">
            <span class="section-label">Professional Journey</span>
            <h2>Work Experience</h2>
            <p class="section-description">
              My professional experience, responsibilities, and growth.
            </p>
          </div>

          <div class="experience-list">

            @foreach($experiences as $experience)

              <article class="experience-row">

                {{-- Left part: three information cards --}}
                <div class="experience-details">

                  @foreach([
                    'JOB TITLE' => $experience->position,
                    'COMPANY' => $experience->company,
                    'DURATION' => $experience->duration
                  ] as $label => $value)

                    <div class="experience-card">
                      <span class="experience-label">{{ $label }}</span>
                      <h3>{{ $value ?: 'Not specified' }}</h3>
                    </div>

                  @endforeach

                </div>

                {{-- Right part: job description --}}
                <div class="experience-description">

                  <div class="experience-description-heading">
                    <span class="description-icon">📝</span>
                    <h4>Job Description</h4>
                  </div>

                  <p>{{ $experience->description ?: 'No job description provided.' }}</p>

                </div>

              </article>

            @endforeach

          </div>

        </div>
      </section>
    @endif

    {{-- =========================================
         CONTACT SECTION
         Email, phone and social media links
    ========================================== --}}
    @if($hasPersonalInfo || $links->isNotEmpty())
      <section class="section" id="contact">
        <div class="container">

          <div class="section-heading">
            <span class="section-label">Get in Touch</span>
            <h2>Contact Me</h2>
            <p class="section-description">
              Feel free to contact me or connect through my social media accounts.
            </p>
          </div>

          <div class="contact-section">

            {{-- Email and phone --}}
            @if($hasPersonalInfo)
              <div class="contact-information">

                @if($email !== '')
                  <a href="mailto:{{ $email }}" class="contact-item">
                    <span class="contact-icon">✉</span>
                    <span class="contact-item-content">
                      <span class="contact-item-label">Email Address</span>
                      <span class="contact-item-value">{{ $email }}</span>
                    </span>
                  </a>
                @endif

                @if($phone !== '')
                  <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="contact-item">
                    <span class="contact-icon">☎</span>
                    <span class="contact-item-content">
                      <span class="contact-item-label">Phone Number</span>
                      <span class="contact-item-value">{{ $phone }}</span>
                    </span>
                  </a>
                @endif

              </div>
            @endif

            {{-- Social media links --}}
            @if($links->isNotEmpty())
              <div class="contact-social-list">

                @foreach($links as $link)
                  @php
                    // Pick a small icon based on the platform name
                    $platform = strtolower(trim($link->platform));

                    $contactIcon = match(true) {
                      str_contains($platform, 'facebook') => 'f',
                      str_contains($platform, 'instagram') => '◎',
                      str_contains($platform, 'linkedin') => 'in',
                      str_contains($platform, 'tiktok') => '♪',
                      str_contains($platform, 'youtube') => '▶',
                      str_contains($platform, 'github') => '⌘',
                      str_contains($platform, 'messenger') => 'M',
                      str_contains($platform, 'twitter'),
                      str_contains($platform, 'x.com') => '𝕏',
                      default => '↗',
                    };
                  @endphp

                  <a href="{{ $link->url }}"
                     target="_blank"
                     rel="noopener noreferrer"
                     class="contact-social-item">

                    <span class="contact-social-icon">{{ $contactIcon }}</span>

                    <span class="contact-social-name">
                      {{ $link->platform }}
                    </span>

                    <span class="contact-social-arrow">↗</span>
                  </a>
                @endforeach

              </div>
            @endif

          </div>
        </div>
      </section>
    @endif

  </main>

  {{-- =========================================
       FOOTER
  ========================================== --}}
  <footer class="footer">
    <div class="container footer-inner">

      <div>
        <div class="footer-name">{{ $fullName }}</div>

        <p>Created with care using PortfolioGen.</p>
      </div>

      <a href="#top" class="back-top">
        Back to Top ↑
      </a>

    </div>
  </footer>

@include('partials.share-download')

</body>
</html>

</body>
</html>