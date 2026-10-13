<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $portfolio->full_name ?? $portfolio->name }} | Creative Portfolio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>

/* =========================================
   COLOR PALETTE
========================================= */

:root {
  --radius: 1rem;

  --background: #F7F4FF;
  --sand: #EEE9FB;
  --foreground: #1E1B4B;
  --dark: #0F0A2E;

  --card: #FFFFFF;
  --border: #DDD6F3;

  --primary: #7C3AED;
  --primary-light: #A855F7;
  --muted-foreground: #5B5780;

  --gradient-card: linear-gradient(135deg, #5B21B6 0%, #312E81 55%, #0F0A2E 100%);
  --gradient-button: linear-gradient(135deg, #7C3AED, #A855F7);

  --shadow-soft:
    0 1px 2px rgb(30 27 75 / 8%),
    0 14px 34px -10px rgb(30 27 75 / 18%);
}

/* =========================================
   BASE STYLES
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
}

h1, h2, h3, h4, h5, h6 {
  font-family: "Sora", ui-sans-serif, system-ui, sans-serif;
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

/* TOP NAVIGATION */
.portfolio-navbar {
    width: 100%;
    background: #1E1B4B;
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
    color: #ffffff;
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
    border: 1px solid rgb(255 255 255 / 35%);
    border-radius: 999px;
    color: #ffffff;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
    transition: background 0.2s ease;
}

.navbar-button:hover {
    background: rgb(255 255 255 / 12%);
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
  background: rgb(247 244 255 / 95%);
  border-bottom: 1px solid var(--border);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  transition:
    background 0.3s ease,
    box-shadow 0.3s ease;
}

.site-header.scrolled {
  background: rgb(247 244 255 / 98%);
  box-shadow: 0 8px 24px rgb(30 27 75 / 8%);
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
  color: #FFFFFF;

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
    box-shadow: 0 15px 24px rgb(30 27 75 / 8%);

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

    border-bottom: 1px solid rgb(221 214 243 / 55%);
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
   HERO
========================================= */

.hero {
  position: relative;
  width: 100%;
  min-height: 80vh;
  padding: 70px 0;
  background: var(--background);
  overflow: hidden;
}

.hero .container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;          /* centers the hero so both sides get equal space */
  padding: 0 30px;
}

.hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
  align-items: center;
  gap: 60px;
}

.hero-copy {
  position: relative;
  z-index: 2;
  min-width: 0;
}

.hero-label {
  display: inline-block;
  margin-bottom: 20px;
  color: var(--primary);
  font-size: 14px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
}

.hero-copy h1 {
  margin: 0 0 24px;
  color: var(--foreground);
  font-size: clamp(38px, 5vw, 64px);
  font-weight: 800;
  line-height: 1.15;
  overflow-wrap: anywhere;
}

.hero-copy h1 span {
  color: var(--primary);
}

.hero-description {
  max-width: 520px;
  margin: 0 0 30px;
  color: var(--foreground);
  font-size: 17px;
  line-height: 1.8;
}

.hero-buttons {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 15px;
}

.hero-buttons .button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  padding: 14px 22px;
  border: 2px solid var(--foreground);
  border-radius: 8px;
  font-size: 15px;
  font-weight: 700;
  transition: background 0.3s ease, color 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
}

.hero-buttons .button-dark {
  background: var(--foreground);
  color: var(--background);
}

.hero-buttons .button-dark:hover {
  background: var(--primary);
  border-color: var(--primary);
  transform: translateY(-3px);
}

.hero-buttons .button-outline {
  background: transparent;
  color: var(--foreground);
}

.hero-buttons .button-outline:hover {
  background: var(--border);
  transform: translateY(-3px);
}

.hero-image-wrap {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  max-width: 480px;
  min-width: 0;
  margin: 0 0 0 auto;      /* picture sits at the right edge, mirroring the text on the left */
  padding: 20px;
}

.hero-image-frame {
  position: absolute;
  top: 25px;
  right: 5px;
  width: 85%;
  height: 88%;
  border: 3px solid var(--primary);
  border-radius: 180px 180px 20px 20px;
  transform: rotate(5deg);
  pointer-events: none;
}

.hero-image-wrap img.hero-image {
  position: relative;
  z-index: 1;
  display: block;
  width: 100%;
  max-width: 360px;
  height: 440px;
  object-fit: cover;
  object-position: center top;
  border-radius: 180px 180px 20px 20px;
  box-shadow: 0 15px 35px rgb(30 27 75 / 12%);
}

.hero-image-wrap .hero-placeholder {
  position: relative;
  z-index: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  max-width: 360px;
  height: 440px;
  background: var(--border);
  color: var(--foreground);
  font-size: 70px;
  border-radius: 180px 180px 20px 20px;
}

.image-note {
  position: absolute;
  z-index: 2;
  right: 0;
  bottom: 35px;
  padding: 13px 18px;
  border: 1px solid var(--border);
  border-radius: 10px;
  background: var(--background);
  color: var(--foreground);
  font-size: 13px;
  font-weight: 700;
  box-shadow: 0 8px 25px rgb(30 27 75 / 10%);
}

@media (max-width: 900px) {
  .hero-grid { gap: 35px; }
  .hero-copy h1 { font-size: clamp(36px, 5vw, 50px); }
  .hero-image-wrap img.hero-image,
  .hero-image-wrap .hero-placeholder { height: 390px; }
}

@media (max-width: 768px) {
  .hero { min-height: auto; padding: 50px 0; }
  .hero .container { padding: 0 24px; }
  .hero-grid { grid-template-columns: minmax(0, 1fr); gap: 45px; }
  .hero-copy { text-align: center; }
  .hero-copy h1 { font-size: clamp(36px, 9vw, 48px); }
  .hero-description { margin-right: auto; margin-left: auto; }
  .hero-buttons { justify-content: center; }
  .hero-image-wrap { max-width: 400px; margin: 0 auto; }
  .hero-image-wrap img.hero-image,
  .hero-image-wrap .hero-placeholder { max-width: 330px; height: 380px; }
  .image-note { right: 5px; bottom: 20px; }
}

@media (max-width: 480px) {
  .hero .container { padding: 0 18px; }
  .hero-copy h1 { font-size: 34px; }
  .hero-description { font-size: 15px; }
  .hero-buttons { flex-direction: column; align-items: stretch; }
  .hero-buttons .button { width: 100%; }
  .hero-image-wrap img.hero-image,
  .hero-image-wrap .hero-placeholder { max-width: 290px; height: 330px; }
  .image-note { right: 0; bottom: 15px; padding: 10px 12px; font-size: 11px; }
}

/* =========================================
   SHARED SECTION STYLES
========================================= */

.section {
  padding: 80px 0;
}

.section--sand  { background: var(--sand); }
.section--cream { background: var(--background); }

.section .container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 24px;
}

.section-head {
  margin-bottom: 40px;
}

.section-label {
  display: block;
  margin-bottom: 6px;
  color: var(--primary);
  font-size: 12px;
  font-weight: 600;
  line-height: 1.3;
  letter-spacing: 0.22em;
  text-transform: uppercase;
}

.section-head h2 {
  margin: 0;
  color: var(--foreground);
  font-size: 40px;
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
}

/* orange underline */
.section-head h2::after {
  content: "";
  display: block;
  width: 56px;
  height: 4px;
  margin-top: 12px;
  border-radius: 4px;
  background: var(--primary);
}

/* =========================================
   ABOUT
========================================= */

.about-grid {
  display: grid;
  grid-template-columns: minmax(0, 2fr) minmax(0, 1fr);
  align-items: start;
  gap: 32px;
}

.about-card {
  padding: 32px;
  border: 1px solid var(--border);
  border-radius: 28px;
  background: var(--card);
  box-shadow: 0 10px 24px rgb(30 27 75 / 10%);
}

.about-quote {
  display: block;
  width: fit-content;
  margin-bottom: 14px;
  font-family: Georgia, serif;
  font-size: 56px;
  font-weight: 800;
  line-height: 1;
  background: linear-gradient(90deg, #6D28D9 50%, #C026D3 50%);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  color: transparent;
}

.about-card p {
  margin: 0;
  color: var(--foreground);
  font-size: 18px;
  font-weight: 500;
  line-height: 1.6;
}

.about-side {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.about-current {
  padding: 32px;
  border-radius: 28px;
  background: var(--gradient-card);
  color: #F7F4FF;
  box-shadow: 0 12px 25px rgb(30 27 75 / 15%);
}

.about-current-label {
  display: block;
  margin-bottom: 8px;
  color: rgb(255 255 255 / 70%);
  font-size: 12px;
  font-weight: 700;
  line-height: 1.3;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}

.about-current h3 {
  margin: 0 0 12px;
  color: #F7F4FF;
  font-size: 22px;
  font-weight: 800;
  line-height: 1.3;
}

.about-current p {
  margin: 0;
  color: rgb(255 255 255 / 70%);
  font-size: 14px;
  line-height: 1.6;
  text-align: justify;
}

.about-details-button {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  align-self: flex-start;
  width: fit-content;
  padding: 13px 24px;
  border: 1px solid #C4B5FD;
  border-radius: 999px;
  background: #EDE9FE;
  color: var(--primary);
  font-size: 14px;
  font-weight: 600;
  line-height: 1.2;
  transition: background 0.3s ease, color 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
}

.about-details-button:hover {
  background: var(--primary);
  border-color: var(--primary);
  color: #FFFFFF;
  transform: translateY(-2px);
}

/* =========================================
   PERSONAL DETAILS
========================================= */

.details-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 16px 18px;
}

.detail-card {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 20px;
  border: 1px solid var(--border);
  border-radius: 28px;
  background: var(--card);
  box-shadow: var(--shadow-soft);
}

.detail-icon {
  flex: none;
  width: 40px;
  height: 40px;
  display: grid;
  place-items: center;
  border-radius: 50%;
  background: var(--gradient-button);
  color: #FFFFFF;
  font-size: 15px;
}

.detail-label {
  display: block;
  color: #4B4780;
  font-size: 11px;
  font-weight: 600;
  line-height: 1.4;
  letter-spacing: 0.12em;
  text-transform: uppercase;
}

.detail-value {
  display: block;
  margin-top: 2px;
  color: var(--foreground);
  font-size: 17px;
  font-weight: 500;
  line-height: 1.4;
  overflow-wrap: anywhere;
}

/* =========================================
   SKILLS
========================================= */

.skills-container {
  width: 100%;
  padding: 30px;
  border: 1px solid var(--border);
  border-radius: 24px;
}

.skills-list {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 16px;
  width: 100%;
}

/* one oval per skill */
.skill-pill {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  padding: 12px 24px;
  border: 1px solid var(--border);
  border-radius: 999px;
  background: var(--card);
  color: var(--foreground);
  font-size: 15px;
  font-weight: 600;
  line-height: 1.4;
}

@media (max-width: 768px) {
  .skills-container { padding: 20px; }
}

/* =========================================
   PROJECTS
========================================= */

.project-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 24px;
}

.project-card {
  position: relative;
  overflow: hidden;
  padding: 24px;
  border-radius: 28px;
  background: var(--gradient-card);
  color: #FFFFFF;
  box-shadow: 0 14px 30px -10px rgb(30 27 75 / 35%);
}

/* big faded number in the top-right corner */
.project-number {
  position: absolute;
  top: -16px;
  right: -4px;
  color: rgb(255 255 255 / 8%);
  font-family: "Sora", sans-serif;
  font-size: 88px;
  font-weight: 800;
  line-height: 1;
  pointer-events: none;
}

.project-card h3 {
  position: relative;
  margin: 0 0 10px;
  color: #FFFFFF;
  font-size: 18px;
  font-weight: 700;
  line-height: 1.3;
}

.project-card p {
  position: relative;
  margin: 0;
  color: rgb(255 255 255 / 70%);
  font-size: 14px;
  text-align: justify;
  line-height: 1.6;
}

.project-link {
  position: relative;
  display: block;
  width: 40px;
  padding: 8px 0;
  margin-top: 14px;
}

.project-link::before {
  content: "";
  display: block;
  height: 3px;
  border-radius: 3px;
  background: rgb(255 255 255 / 40%);
  transition: background 0.25s ease, width 0.25s ease;
}

a.project-link:hover::before {
  background: var(--primary);
}

/* =========================================
   EXPERIENCE (TIMELINE)
========================================= */

.timeline {
  max-width: 100%;
}

.timeline-item {
  position: relative;
  padding: 0 0 32px 40px;
}

.timeline-item:last-child {
  padding-bottom: 0;
}

/* orange dot with a cream ring */
.timeline-item::before {
  content: "";
  position: absolute;
  top: -3px;
  left: -3px;
  z-index: 1;
  width: 20px;
  height: 20px;
  border: 3px solid var(--sand);
  border-radius: 50%;
  background: var(--primary);
  box-shadow: 0 0 0 1px #DDD6FE;
}

/* vertical line */
.timeline-item::after {
  content: "";
  position: absolute;
  top: 22px;
  bottom: 0;
  left: 6px;
  width: 2px;
  background: #DDD6FE;
}

/* two equal halves with a vertical line in the center */
.timeline-body {
  display: grid;
  grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
  align-items: stretch;
}

/* left half: Duration / Role / Company side by side */
.timeline-fields {
  display: flex;
  flex-wrap: wrap;
  align-content: flex-start;
  gap: 16px 28px;
  padding-right: 32px;
}

.timeline-field {
  min-width: 0;
}

/* right half: "What I did" (the border is the center line) */
.timeline-field--full {
  padding-left: 32px;
  border-left: 2px solid #DDD6FE;
}

/* small label above each value */
.timeline-label {
  display: block;
  margin-bottom: 4px;
  color: var(--muted-foreground);
  font-size: 11px;
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: 0.14em;
  text-transform: uppercase;
}

.timeline-date {
  display: block;
  color: #4B4780;
  font-size: 14px;
  font-weight: 700;
  line-height: 1.5;
  letter-spacing: 0.06em;
  text-transform: uppercase;
}

.timeline-role {
  margin: 0;
  color: var(--foreground);
  font-size: 19px;
  font-weight: 700;
  line-height: 1.3;
}

.timeline-company {
  color: var(--primary);
  font-size: 16px;
  line-height: 1.5;
}

.timeline-item p {
  margin: 0;
  color: #4B4780;
  font-size: 16px;
  line-height: 1.7;
}

/* =========================================
   EDUCATION
========================================= */

.education-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 24px;
}

.education-card {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  padding: 24px;
  border: 1px solid var(--border);
  border-radius: 24px;
  background: var(--card);
  box-shadow: var(--shadow-soft);
}

.education-icon {
  flex: none;
  width: 48px;
  height: 48px;
  display: grid;
  place-items: center;
  border-radius: 14px;
  background: var(--gradient-button);
  color: #FFFFFF;
  font-size: 18px;
}

.education-year {
  display: block;
  color: #4B4780;
  font-size: 12px;
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: 0.1em;
}

.education-card h3 {
  margin: 4px 0 4px;
  color: var(--foreground);
  font-size: 19px;
  font-weight: 700;
  line-height: 1.3;
}

.education-card p {
  margin: 0;
  color: var(--primary);
  font-size: 13.5px;
  line-height: 1.5;
}

/* =========================================
   CREATIVE ENHANCEMENTS
   (icons, color, borders, shadows, motion)
========================================= */

/* ---------- Section backdrops: soft glow + dotted grid ---------- */
.section {
  position: relative;
  overflow: hidden;
  isolation: isolate;
}

.section .container {
  position: relative;
  z-index: 1;
}

.section::before,
.section::after {
  content: "";
  position: absolute;
  z-index: 0;
  pointer-events: none;
}

.section::before {
  top: -140px;
  right: -120px;
  width: 380px;
  height: 380px;
  border-radius: 50%;
  background: radial-gradient(circle, rgb(124 58 237 / 12%), transparent 68%);
}

.section::after {
  bottom: 32px;
  left: 24px;
  width: 140px;
  height: 110px;
  background-image: radial-gradient(rgb(30 27 75 / 22%) 1.6px, transparent 1.8px);
  background-size: 20px 20px;
  opacity: 0.55;
}

.section--cream::before {
  right: auto;
  left: -140px;
  top: -120px;
  background: radial-gradient(circle, rgb(30 27 75 / 9%), transparent 68%);
}

.section--cream::after {
  left: auto;
  right: 24px;
}

/* ---------- Section labels become icon pills ---------- */
.section-label {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 12px;
  padding: 6px 14px;
  border: 1px solid rgb(124 58 237 / 28%);
  border-radius: 999px;
  background: rgb(124 58 237 / 9%);
  letter-spacing: 0.18em;
}

.section-label i {
  font-size: 12px;
}

.section-head h2::after {
  width: 64px;
  height: 5px;
  background: linear-gradient(90deg, var(--primary), #C4B5FD);
}

/* ---------- Hero ---------- */
.hero .container {
  position: relative;
  z-index: 1;
}

.hero::before,
.hero::after {
  content: "";
  position: absolute;
  border-radius: 50%;
  pointer-events: none;
}

.hero::before {
  top: -120px;
  left: -100px;
  width: 420px;
  height: 420px;
  background: radial-gradient(circle, rgb(30 27 75 / 9%), transparent 68%);
}

.hero::after {
  right: -80px;
  bottom: -120px;
  width: 380px;
  height: 380px;
  background: radial-gradient(circle, rgb(124 58 237 / 14%), transparent 68%);
}

.hero-label {
  padding: 7px 14px;
  border: 1px solid rgb(124 58 237 / 28%);
  border-radius: 999px;
  background: rgb(124 58 237 / 9%);
}

.hero-label i {
  margin-right: 6px;
}

.image-note i {
  color: var(--primary);
}

/* ---------- About ---------- */
.about-card {
  position: relative;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.about-card::before {
  content: "";
  position: absolute;
  inset: 0 0 auto 0;
  height: 5px;
  background: linear-gradient(90deg, var(--foreground), var(--primary));
}

.about-card::after {
  content: "";
  position: absolute;
  right: -50px;
  bottom: -50px;
  width: 170px;
  height: 170px;
  border-radius: 50%;
  background: radial-gradient(circle, rgb(124 58 237 / 14%), transparent 70%);
  pointer-events: none;
}

.about-card p {
  position: relative;
  z-index: 1;
}

.about-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 18px 34px rgb(30 27 75 / 16%);
}

.about-current {
  position: relative;
  overflow: hidden;
}

.about-current::before {
  content: "";
  position: absolute;
  top: -40px;
  right: -40px;
  width: 140px;
  height: 140px;
  border: 1px solid rgb(255 255 255 / 14%);
  border-radius: 50%;
}

.about-current::after {
  content: "";
  position: absolute;
  top: -20px;
  right: -20px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: radial-gradient(circle, rgb(124 58 237 / 35%), transparent 70%);
}

.about-current > * {
  position: relative;
  z-index: 1;
}

.about-current-label {
  display: flex;
  align-items: center;
  gap: 8px;
  width: fit-content;
}

/* pulsing "available" dot */
.about-current-label::before {
  content: "";
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #4ADE80;
  animation: pulse-dot 2s infinite;
}

.about-current p i {
  margin-right: 8px;
  color: #C4B5FD;
}

.about-details-button {
  box-shadow: 0 8px 18px -8px rgb(124 58 237 / 45%);
}

.about-details-button i {
  transition: transform 0.25s ease;
}

.about-details-button:hover i {
  transform: translateX(4px);
}

/* ---------- Personal details ---------- */
.detail-card {
  background: linear-gradient(135deg, #FFFFFF, #FAF5FF);
  transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
}

.detail-card:hover {
  transform: translateY(-4px);
  border-color: #C4B5FD;
  box-shadow: 0 16px 30px -10px rgb(124 58 237 / 25%);
}

.detail-icon,
.education-icon {
  box-shadow: 0 0 0 5px rgb(124 58 237 / 12%), 0 8px 16px -4px rgb(124 58 237 / 45%);
}

/* ---------- Skills ---------- */
.skills-container {
  background: rgb(255 254 250 / 60%);
  box-shadow: var(--shadow-soft);
}

.skill-pill {
  gap: 10px;
  box-shadow: 0 10px 18px -10px rgb(30 27 75 / 30%);
  transition: transform 0.25s ease, background 0.25s ease, color 0.25s ease, border-color 0.25s ease;
}

.skill-pill i {
  color: var(--primary);
  font-size: 13px;
  transition: color 0.25s ease;
}

.skill-pill:nth-child(3n+2) {
  border-color: #BFDBFE;
  background: #E0E7FF;
}

.skill-pill:nth-child(3n) {
  border-color: #D8B4FE;
  background: #F3E8FF;
}

.skill-pill:hover {
  transform: translateY(-3px);
  border-color: transparent;
  background: var(--gradient-button);
  color: #FFFFFF;
}

.skill-pill:hover i {
  color: #FFFFFF;
}

/* ---------- Projects ---------- */
.project-card {
  border: 1px solid rgb(255 255 255 / 10%);
  background:
    radial-gradient(circle at 0 0, rgb(124 58 237 / 22%), transparent 45%),
    var(--gradient-card);
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
}

.project-card::after {
  content: "";
  position: absolute;
  right: -40px;
  bottom: -60px;
  width: 170px;
  height: 170px;
  border: 1px solid rgb(255 255 255 / 10%);
  border-radius: 50%;
  pointer-events: none;
}

.project-card:hover {
  transform: translateY(-6px);
  border-color: rgb(124 58 237 / 55%);
  box-shadow: 0 22px 40px -12px rgb(30 27 75 / 50%);
}

.project-icon {
  position: relative;
  display: grid;
  place-items: center;
  width: 42px;
  height: 42px;
  margin-bottom: 16px;
  border-radius: 14px;
  background: var(--gradient-button);
  color: #FFFFFF;
  font-size: 17px;
  box-shadow: 0 8px 16px -6px rgb(124 58 237 / 60%);
}

.project-link--cta {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  width: auto;
  padding: 0;
  margin-top: 16px;
  color: #C4B5FD;
  font-size: 13px;
  font-weight: 700;
  transition: color 0.2s ease, gap 0.2s ease;
}

.project-link--cta::before {
  display: none;
}

.project-link--cta:hover {
  gap: 12px;
  color: #FFFFFF;
}

/* ---------- Experience: card + glowing dot + label icons ---------- */
.timeline-body {
  padding: 22px 26px;
  border: 1px solid var(--border);
  border-radius: 22px;
  background: var(--card);
  box-shadow: var(--shadow-soft);
  transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
}

.timeline-item:hover .timeline-body {
  transform: translateY(-3px);
  border-color: #C4B5FD;
  box-shadow: 0 16px 32px -12px rgb(124 58 237 / 25%);
}

.timeline-item::before {
  top: 19px;
  box-shadow: 0 0 0 1px #DDD6FE, 0 0 0 7px rgb(124 58 237 / 15%);
}

.timeline-item::after {
  top: 44px;
  bottom: -19px;
}

.timeline-item:last-child::after {
  bottom: 0;
}

.timeline-label {
  display: flex;
  align-items: center;
  gap: 6px;
}

.timeline-label i {
  color: var(--primary);
  font-size: 12px;
}

/* ---------- Education ---------- */

/* full-width cards so the three ovals fit in one row */
.education-grid {
  grid-template-columns: 1fr;
}

.education-card {
  position: relative;
  overflow: hidden;
  align-items: center;
  transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
}

.education-card::before {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 5px;
  background: var(--gradient-button);
}

.education-card:hover {
  transform: translateY(-4px);
  border-color: #C4B5FD;
  box-shadow: 0 16px 30px -10px rgb(124 58 237 / 25%);
}

/* the three ovals share the row in equal-width columns */
.education-details {
  display: grid;
  grid-auto-flow: column;
  grid-auto-columns: minmax(0, 1fr);
  align-items: stretch;
  gap: 12px;
  flex: 1;
  min-width: 0;
}

.education-pill {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  gap: 2px 10px;
  width: 100%;
  min-height: 48px;
  padding: 9px 18px;
  text-align: center;
  border: 1px solid var(--border);
  border-radius: 26px;
  background: var(--card);
  box-shadow: 0 10px 18px -12px rgb(30 27 75 / 30%);
}

.education-pill--year {
  border-color: #D8B4FE;
  background: #F3E8FF;
}

.education-pill--program {
  border-color: #BFDBFE;
  background: #E0E7FF;
}

.education-label {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  color: var(--muted-foreground);
  font-size: 11px;
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  white-space: nowrap;
}

.education-label i {
  color: var(--primary);
  font-size: 12px;
}

/* same font, size and weight for Year, School and Program */
.education-value {
  color: var(--foreground);
  font-family: "Manrope", ui-sans-serif, system-ui, sans-serif;
  font-size: 14px;
  font-weight: 600;
  line-height: 1.4;
}

/* phones: ovals stack, one per row */
@media (max-width: 768px) {
  .education-card {
    align-items: flex-start;
  }

  .education-details {
    grid-auto-flow: row;
    grid-auto-columns: auto;
    grid-template-columns: 1fr;
    gap: 10px;
  }
}

/* ---------- Contact ---------- */

.contact-box {
  position: relative;
  overflow: hidden;
  padding: 56px;
  border: 1px solid rgb(255 255 255 / 10%);
  border-radius: 32px;
  background:
    radial-gradient(circle at 100% 0, rgb(217 70 239 / 35%), transparent 40%),
    var(--gradient-card);
  color: #FFFFFF;
  box-shadow: 0 20px 40px -14px rgb(30 27 75 / 40%);
}

/* decorative rings */
.contact-box::before,
.contact-box::after {
  content: "";
  position: absolute;
  border-radius: 50%;
  pointer-events: none;
}

.contact-box::before {
  left: -70px;
  bottom: -90px;
  width: 260px;
  height: 260px;
  border: 1px solid rgb(255 255 255 / 10%);
}

.contact-box::after {
  left: -30px;
  bottom: -50px;
  width: 180px;
  height: 180px;
  border: 1px solid rgb(255 255 255 / 8%);
}

.contact-box > *:not(.contact-deco) {
  position: relative;
  z-index: 1;
}

.contact-deco {
  position: absolute;
  right: 48px;
  bottom: 36px;
  color: rgb(255 255 255 / 7%);
  font-size: 150px;
  transform: rotate(-12deg);
  pointer-events: none;
}

.contact-box h3 {
  max-width: 680px;
  margin: 0 0 14px;
  color: #FFFFFF;
  font-size: 38px;
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.02em;
}

.contact-box h3 span {
  background: linear-gradient(90deg, #A855F7, #F5D0FE);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  color: transparent;
}

.contact-box p {
  margin: 0 0 28px;
  color: rgb(255 255 255 / 78%);
  font-size: 17px;
  line-height: 1.6;
}

/* email, phone and social links: one row, equal columns */
.contact-actions {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 14px;
}

.contact-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  min-width: 0;
  min-height: 54px;
  padding: 14px 24px;
  border: 1px solid rgb(255 255 255 / 30%);
  border-radius: 999px;
  background: rgb(255 255 255 / 6%);
  color: #FFFFFF;
  font-size: 15px;
  font-weight: 700;
  line-height: 1.2;
  text-align: center;
  overflow-wrap: anywhere;
  transition: background 0.25s ease, color 0.25s ease, border-color 0.25s ease, transform 0.25s ease;
}

.contact-btn i {
  flex-shrink: 0;
  font-size: 15px;
}

.contact-btn:hover {
  transform: translateY(-2px);
  border-color: var(--primary);
  background: var(--primary);
}

/* email stays the highlighted one */
.contact-btn--light {
  border-color: #F7F4FF;
  background: #F7F4FF;
  color: var(--foreground);
  box-shadow: 0 10px 20px -8px rgb(0 0 0 / 35%);
}

.contact-btn--light:hover {
  border-color: #FFFFFF;
  background: #FFFFFF;
  color: var(--foreground);
}

/* tablets and phones */
@media (max-width: 768px) {
  .contact-box {
    padding: 32px 24px;
    border-radius: 28px;
  }

  .contact-box h3 {
    font-size: 28px;
  }

  .contact-box p {
    font-size: 15px;
  }

  .contact-deco {
    right: 20px;
    bottom: 20px;
    font-size: 90px;
  }
}

/* ---------- Scroll reveal (only active when JS runs) ---------- */
.js-reveal .reveal {
  opacity: 0;
}

.js-reveal .reveal.in-view {
  animation: reveal-up 0.7s cubic-bezier(.2, .7, .2, 1) both;
  animation-delay: var(--reveal-delay, 0s);
}

@keyframes reveal-up {
  from { opacity: 0; translate: 0 26px; }
  to   { opacity: 1; translate: 0 0; }
}

@keyframes pulse-dot {
  0%   { box-shadow: 0 0 0 0 rgb(74 222 128 / 55%); }
  70%  { box-shadow: 0 0 0 8px rgb(74 222 128 / 0%); }
  100% { box-shadow: 0 0 0 0 rgb(74 222 128 / 0%); }
}

@media (max-width: 768px) {
  .section::before { width: 260px; height: 260px; }
  .section::after { display: none; }
  .timeline-body { padding: 18px; }
}

@media (prefers-reduced-motion: reduce) {
  .js-reveal .reveal { opacity: 1 !important; animation: none !important; }
  .about-current-label::before { animation: none; }
}

/* =========================================
   FOOTER
========================================= */

footer {
  padding: 25px 20px;
  background: var(--dark);
  color: #F7F4FF;
  text-align: center;
}

footer p {
  margin: 0;
  font-size: 14px;
}

footer a {
  color: #C4B5FD;
}

/* =========================================
   SECTION RESPONSIVE
========================================= */

@media (max-width: 768px) {
  .timeline-body {
    grid-template-columns: 1fr;
    gap: 16px;
  }

  .timeline-fields {
    padding-right: 0;
  }

  .timeline-field--full {
    padding-left: 0;
    border-left: 0;
  }

  .section { padding: 60px 0; }
  .section .container { padding: 0 20px; }
  .section-head h2 { font-size: 32px; }

  .about-grid,
  .details-grid,
  .project-grid,
  .education-grid {
    grid-template-columns: 1fr;
  }

  .about-grid { gap: 24px; }
  .about-card { padding: 26px; }
  .about-card p { font-size: 16px; }
  .about-current { padding: 26px; }

}

@media (prefers-reduced-motion: reduce) {
  html { scroll-behavior: auto; }

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

    $details = array_filter([
        ['icon' => 'fa-regular fa-user',      'label' => 'Full Name', 'value' => $fullName],
        ['icon' => 'fa-solid fa-briefcase',   'label' => 'Title',     'value' => $jobTitle],
        ['icon' => 'fa-regular fa-envelope',  'label' => 'Email',     'value' => $portfolio->email ?? ''],
        ['icon' => 'fa-solid fa-phone',       'label' => 'Phone',     'value' => $portfolio->phone ?? ''],
        ['icon' => 'fa-solid fa-location-dot','label' => 'Location',  'value' => $portfolio->address ?? ''],
        ['icon' => 'fa-solid fa-globe',       'label' => 'Website',   'value' => $website],
    ], fn ($item) => !empty($item['value']));

    // Skills: works whether $portfolio->skills is a comma-separated string,
    // a JSON array, an array, or a collection of skill models whose "name"
    // itself contains commas (e.g. "html, css, js").
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
@endphp

<!-- HERO -->
<section class="hero" id="home">
    <div class="container hero-grid">

        <div class="hero-copy">

            <span class="hero-label"><i class="fa-solid fa-star"></i> Personal Portfolio</span>

            <h1>
                Hello, I'm<br>
                <span>{{ $fullName }}</span>
            </h1>

            <p class="hero-description">
             "Welcome to my portfolio! Here, you can explore my background, educational achievements, skills, projects, and experiences that reflect my personal and professional journey."
            </p>

            <div class="hero-buttons">

                <a href="#projects" class="button button-dark">
                    Explore My Work
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

                <a href="#contact" class="button button-outline">
                    Let's Connect
                </a>

            </div>

        </div>

        <div class="hero-image-wrap">

            <div class="hero-image-frame"></div>

            @if($profilePhoto)

                <img src="{{ $profilePhoto }}"
                     alt="{{ $fullName }}"
                     class="hero-image">

            @else

                <div class="hero-image hero-placeholder">
                    <i class="fa-solid fa-user"></i>
                </div>

            @endif

            <div class="image-note">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
                &nbsp; Creating my own path
            </div>

        </div>

    </div>
</section>


<!-- ABOUT -->
<section class="section section--sand" id="about">
    <div class="container">

        <div class="section-head">
            <span class="section-label"><i class="fa-solid fa-user"></i> Who I am</span>
            <h2>About Me</h2>
        </div>

        <div class="about-grid">

            <div class="about-card">
                <span class="about-quote">&ldquo;</span>
                <p>
                    {{ $aboutText ?: 'I am someone who enjoys learning, exploring new ideas, and developing skills through meaningful experiences and creative projects.' }}
                </p>
            </div>

            <div class="about-side">

                @if($jobTitle || !empty($portfolio->address))
                    <div class="about-current">
                        <span class="about-current-label">Currently</span>

                        @if($jobTitle)
                            <h3>{{ $jobTitle }}</h3>
                        @endif

                        @if(!empty($portfolio->address))
                            <p><i class="fa-solid fa-location-dot"></i> {{ $portfolio->address }}</p>
                        @endif
                    </div>
                @endif

                <a href="#personal-details" class="about-details-button">
                    View Personal Details
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </div>

    </div>
</section>


<!-- PERSONAL DETAILS -->
<section class="section section--cream" id="personal-details">
    <div class="container">

        <div class="section-head">
            <span class="section-label"><i class="fa-solid fa-id-card"></i> The basics</span>
            <h2>Personal Details</h2>
        </div>

        <div class="details-grid">

            @foreach($details as $detail)

                <div class="detail-card">

                    <span class="detail-icon">
                        <i class="{{ $detail['icon'] }}"></i>
                    </span>

                    <div>
                        <span class="detail-label">{{ $detail['label'] }}</span>
                        <span class="detail-value">{{ $detail['value'] }}</span>
                    </div>

                </div>

            @endforeach

        </div>

    </div>
</section>


<!-- SKILLS -->
@if($skillList->isNotEmpty())

<section class="section section--sand" id="skills">
    <div class="container">

        <div class="section-head">
            <span class="section-label"><i class="fa-solid fa-bolt"></i> What I do</span>
            <h2>Skills &amp; Expertise</h2>
        </div>

        <div class="skills-container">
            <div class="skills-list">

                @foreach($skillList as $skillName)
                    <div class="skill-pill"><i class="fa-solid fa-bolt"></i>{{ $skillName }}</div>
                @endforeach

            </div>
        </div>

    </div>
</section>

@endif

<!-- PROJECTS -->
@if($portfolio->projects && $portfolio->projects->count() > 0)

<section class="section section--cream" id="projects">
    <div class="container">

        <div class="section-head">
            <span class="section-label"><i class="fa-solid fa-layer-group"></i> What I've built</span>
            <h2>Projects</h2>
        </div>

        <div class="project-grid">

            @foreach($portfolio->projects as $project)

                <article class="project-card">

                    <span class="project-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

                    <span class="project-icon"><i class="fa-solid fa-laptop-code"></i></span>

                    <h3>{{ $project->name }}</h3>

                    <p>
                        {{ !empty($project->description) ? $project->description : 'A project showcasing my skills, ideas, and learning experience.' }}
                    </p>

                    @if(!empty($project->link))
                        <a href="{{ $project->link }}"
                           class="project-link project-link--cta"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="View {{ $project->name }}">View Project <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                    @else
                        <span class="project-link"></span>
                    @endif

                </article>

            @endforeach

        </div>

    </div>
</section>

@endif


<!-- EXPERIENCE -->
@if($portfolio->experiences && $portfolio->experiences->count() > 0)

<section class="section section--sand" id="experience">
    <div class="container">

        <div class="section-head">
            <span class="section-label"><i class="fa-solid fa-briefcase"></i> Where I worked</span>
            <h2>Work Experience</h2>
        </div>

        <div class="timeline">

            @foreach($portfolio->experiences as $experience)

                <article class="timeline-item">

                    <div class="timeline-body">

                    <div class="timeline-fields">

                        <div class="timeline-field">
                            <span class="timeline-label"><i class="fa-regular fa-calendar"></i> Duration</span>
                            <span class="timeline-date">
                                {{ $experience->duration ?: 'Professional Experience' }}
                            </span>
                        </div>

                        <div class="timeline-field">
                            <span class="timeline-label"><i class="fa-solid fa-user-tie"></i> Role</span>
                            <h3 class="timeline-role">{{ $experience->position }}</h3>
                        </div>

                        @if(!empty($experience->company))
                            <div class="timeline-field">
                                <span class="timeline-label"><i class="fa-regular fa-building"></i> Company</span>
                                <div class="timeline-company">{{ $experience->company }}</div>
                            </div>
                        @endif

                    </div>

                    @if(!empty($experience->description))
                        <div class="timeline-field timeline-field--full">
                            <span class="timeline-label"><i class="fa-solid fa-list-check"></i> What I did</span>
                            <p>{{ $experience->description }}</p>
                        </div>
                    @endif

                    </div>

                </article>

            @endforeach

        </div>

    </div>
</section>

@endif


<!-- EDUCATION -->
@if($portfolio->educations && $portfolio->educations->count() > 0)

<section class="section section--cream" id="education">
    <div class="container">

        <div class="section-head">
            <span class="section-label"><i class="fa-solid fa-graduation-cap"></i> Studies</span>
            <h2>Education</h2>
        </div>

        <div class="education-grid">

            @foreach($portfolio->educations as $education)

                <article class="education-card">

                    <div class="education-icon">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>

                    <div class="education-details">

                        @if(!empty($education->year))
                            <div class="education-pill education-pill--year">
                                <span class="education-label"><i class="fa-regular fa-calendar"></i> Year</span>
                                <span class="education-value">{{ $education->year }}</span>
                            </div>
                        @endif

                        @php
                            $schoolName = $education->school_name ?? $education->institution ?? '';
                        @endphp

                        @if(!empty($schoolName))
                            <div class="education-pill education-pill--school">
                                <span class="education-label"><i class="fa-solid fa-building-columns"></i> School</span>
                                <span class="education-value">{{ $schoolName }}</span>
                            </div>
                        @endif

                        <div class="education-pill education-pill--program">
                            <span class="education-label"><i class="fa-solid fa-award"></i> Program</span>
                            <span class="education-value">
                                {{ $education->program ?? $education->degree ?? $education->education_level ?? $education->level ?? 'Education' }}
                            </span>
                        </div>

                    </div>

                </article>

            @endforeach

        </div>

    </div>
</section>

@endif


<!-- CONTACT -->
<section class="section section--sand" id="contact">
    <div class="container">

        <div class="section-head">
            <span class="section-label"><i class="fa-solid fa-paper-plane"></i> Say hello</span>
            <h2>Get in Touch</h2>
        </div>

@php
    // Brand icon for each platform name
    $socialIcon = function ($platform) {
        $p = strtolower((string) $platform);

        return match (true) {
            str_contains($p, 'github')    => 'fa-brands fa-github',
            str_contains($p, 'linkedin')  => 'fa-brands fa-linkedin-in',
            str_contains($p, 'facebook')  => 'fa-brands fa-facebook-f',
            str_contains($p, 'messenger') => 'fa-brands fa-facebook-messenger',
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

    // Clean up the saved links: add https:// when missing and keep only http/https links
    $socialLinks = collect($portfolio->links ?? [])
        ->map(function ($link) {
            $url = trim((string) ($link->url ?? ''));

            if ($url !== '' && !preg_match('/^[a-z][a-z0-9+.-]*:/i', $url)) {
                $url = 'https://' . $url;
            }

            $platform = trim((string) ($link->platform ?? ''));
            $host = preg_replace('/^www\./i', '', (string) parse_url($url, PHP_URL_HOST));

            return [
                'url'      => $url,
                'platform' => $platform,
                'name'     => $platform !== '' ? ucfirst($platform) : ($host ?: 'Website'),
            ];
        })
        ->filter(fn ($item) => $item['url'] !== ''
            && in_array(strtolower(parse_url($item['url'], PHP_URL_SCHEME) ?? ''), ['http', 'https']))
        ->values();
@endphp

        <div class="contact-box">

            <i class="fa-solid fa-paper-plane contact-deco" aria-hidden="true"></i>

            <h3>Let's Connect and Create Something <span>Amazing.</span></h3>

            <p>I'm open to job opportunities and collaborations. Feel free to reach out.</p>

            {{-- Email, phone and social links share ONE evenly spaced row --}}
            <div class="contact-actions">

                @if(!empty($portfolio->email))
                    <a href="mailto:{{ $portfolio->email }}" class="contact-btn contact-btn--light">
                        <i class="fa-regular fa-envelope"></i>
                        Email Me
                    </a>
                @endif

                @if(!empty($portfolio->phone))
                    <a href="tel:{{ $portfolio->phone }}" class="contact-btn">
                        <i class="fa-solid fa-phone"></i>
                        {{ $portfolio->phone }}
                    </a>
                @endif

                @foreach($socialLinks as $social)
                    <a href="{{ $social['url'] }}"
                       class="contact-btn"
                       target="_blank"
                       rel="noopener noreferrer">
                        <i class="{{ $socialIcon($social['platform']) }}"></i>
                        {{ $social['name'] }}
                    </a>
                @endforeach

            </div>

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

<!-- SCROLL REVEAL -->
<script>
(function () {
    var targets = document.querySelectorAll(
        '.section-head, .about-card, .about-side, .detail-card, .skills-container, ' +
        '.project-card, .timeline-item, .education-card, .contact-box'
    );

    if (!('IntersectionObserver' in window) || !targets.length) {
        return;
    }

    document.documentElement.classList.add('js-reveal');

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -6% 0px' });

    targets.forEach(function (el) {
        var index = Array.prototype.indexOf.call(el.parentElement.children, el);

        el.classList.add('reveal');
        el.style.setProperty('--reveal-delay', (Math.min(index, 5) * 0.08) + 's');
        observer.observe(el);
    });
})();
</script>

</body>
</html>
