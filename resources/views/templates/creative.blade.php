<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $portfolio->full_name ?? $portfolio->name }} | Creative Portfolio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- One font family for the whole page --}}
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>

/* =========================================
   TOKENS
   Light violet + black. Hierarchy comes from
   size, weight and light/dark contrast.
========================================= */
:root {
  --bg: #F7F4FF;
  --sand: #EEE9FB;
  --card: #FFFFFF;
  --border: #DDD6F3;

  --ink: #0B0B12;          /* black */
  --ink-2: #1A1826;        /* raised black surface */
  --text: #17142E;         /* body text on light */
  --muted: #55507A;        /* secondary text on light */
  --primary: #7C3AED;
  --primary-d: #6D28D9;    /* violet for small text on light */
  --primary-l: #A78BFA;    /* violet on black */
  --on-dark: #F5F3FF;
  --on-dark-muted: rgb(245 243 255 / 74%);

  --font: "Manrope", ui-sans-serif, system-ui, -apple-system, "Segoe UI", sans-serif;
  --fs-display: clamp(2.5rem, 6vw, 4rem);
  --fs-h2: 2.25rem;
  --fs-h3: 1.25rem;
  --fs-lead: 1.125rem;
  --fs-body: 1rem;
  --fs-small: 0.875rem;
  --fs-label: 0.8125rem;

  --radius: 24px;
  --grad-black: linear-gradient(135deg, #000 0%, #14102A 55%, #2A1466 100%);
  --grad-violet: linear-gradient(135deg, #7C3AED, #A855F7);
  --shadow: 0 1px 2px rgb(11 11 18 / 8%), 0 14px 34px -12px rgb(11 11 18 / 22%);
}

/* =========================================
   BASE
========================================= */
* { box-sizing: border-box; }
html { scroll-behavior: smooth; scroll-padding-top: 90px; }
body {
  margin: 0;
  background: var(--bg);
  color: var(--text);
  font-family: var(--font);
  font-size: var(--fs-body);
  font-weight: 500;
  line-height: 1.7;
  -webkit-font-smoothing: antialiased;
}
h1, h2, h3, p { margin: 0; }
h1, h2, h3 { font-family: var(--font); color: var(--ink); }
img { max-width: 100%; }
a { color: inherit; text-decoration: none; }
button { font: inherit; }
section[id] { scroll-margin-top: 90px; }
:focus-visible { outline: 3px solid var(--primary); outline-offset: 3px; border-radius: 4px; }

.container { width: 100%; max-width: 1160px; margin: 0 auto; padding: 0 24px; }

/* =========================================
   PREVIEW BAR + NAVIGATION
========================================= */
.portfolio-navbar { background: var(--ink); padding: 12px 24px; }
.portfolio-navbar-inner { max-width: 1120px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; gap: 20px; }
.navbar-brand { color: #fff; font-size: var(--fs-small); font-weight: 700; }
.navbar-actions { display: flex; align-items: center; gap: 8px; }
.navbar-button { padding: 10px 14px; border: 1px solid rgb(255 255 255 / 35%); border-radius: 999px; color: #fff; font-size: var(--fs-label); font-weight: 600; white-space: nowrap; transition: background .2s; }
.navbar-button:hover { background: rgb(255 255 255 / 14%); }
@media (max-width: 650px) {
  .portfolio-navbar-inner { flex-direction: column; align-items: flex-start; }
  .navbar-actions { flex-wrap: wrap; }
}

.site-header { position: sticky; top: 0; z-index: 1000; background: rgb(247 244 255 / 94%); border-bottom: 1px solid var(--border); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); transition: box-shadow .3s; }
.site-header.scrolled { box-shadow: 0 8px 24px rgb(11 11 18 / 10%); }
.nav-container { width: min(1160px, calc(100% - 48px)); min-height: 76px; margin-inline: auto; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
.nav-brand { display: inline-flex; align-items: center; gap: 12px; color: var(--ink); font-size: var(--fs-body); font-weight: 800; white-space: nowrap; }
.nav-brand img, .nav-brand-icon { width: 44px; height: 44px; border-radius: 50%; object-fit: cover; }
.nav-brand-icon { display: grid; place-items: center; background: var(--ink); color: var(--primary-l); font-size: var(--fs-small); font-weight: 800; }
.nav-menu { display: flex; align-items: center; justify-content: flex-end; gap: 24px; }
.nav-link { position: relative; padding: 10px 0; color: var(--text); font-size: var(--fs-small); font-weight: 600; transition: color .25s; }
.nav-link:hover, .nav-link.is-active { color: var(--primary-d); }
.nav-link.is-active { font-weight: 800; }
.nav-link::after { content: ""; position: absolute; left: 0; right: 0; bottom: 3px; height: 2px; border-radius: 2px; background: var(--ink); transform: scaleX(0); transform-origin: left; transition: transform .3s; }
.nav-link:hover::after, .nav-link.is-active::after { transform: scaleX(1); }
.nav-toggle { display: none; width: 44px; height: 44px; align-items: center; justify-content: center; flex-direction: column; gap: 6px; border: 1px solid var(--ink); border-radius: 12px; background: transparent; cursor: pointer; }
.nav-toggle span { width: 21px; height: 2px; border-radius: 3px; background: var(--ink); transition: transform .3s, opacity .3s; }
.nav-toggle[aria-expanded="true"] span:first-child { transform: translateY(8px) rotate(45deg); }
.nav-toggle[aria-expanded="true"] span:nth-child(2) { opacity: 0; }
.nav-toggle[aria-expanded="true"] span:last-child { transform: translateY(-8px) rotate(-45deg); }

@media (max-width: 1000px) {
  .nav-container { min-height: 70px; }
  .nav-toggle { display: flex; }
  .nav-menu { position: absolute; top: 100%; left: 0; right: 0; flex-direction: column; align-items: stretch; gap: 0; max-height: calc(100vh - 70px); overflow-y: auto; padding: 12px 24px 20px; border-bottom: 1px solid var(--border); background: var(--bg); box-shadow: 0 15px 24px rgb(11 11 18 / 10%); opacity: 0; visibility: hidden; pointer-events: none; transform: translateY(-10px); transition: opacity .25s, visibility .25s, transform .25s; }
  .nav-menu.open { opacity: 1; visibility: visible; pointer-events: auto; transform: none; }
  .nav-link { padding: 14px 4px; border-bottom: 1px solid var(--border); }
  .nav-link::after { display: none; }
}

/* =========================================
   SHARED
========================================= */
.section { position: relative; padding: 88px 0; }
.section--sand { background: var(--sand); }
.section--dark { background: radial-gradient(circle at 85% 0%, rgb(124 58 237 / 32%), transparent 45%), radial-gradient(rgb(255 255 255 / 7%) 1.4px, transparent 1.6px) 0 0 / 24px 24px, linear-gradient(160deg, #000 0%, #14102A 60%, #261257 100%); color: var(--on-dark); overflow: hidden; }

.section-head { margin-bottom: 40px; }
.section-label { display: inline-flex; align-items: center; gap: 8px; margin-bottom: 12px; padding: 6px 14px; border: 1px solid var(--ink); border-radius: 999px; color: var(--ink); font-size: var(--fs-label); font-weight: 700; }
.section-label i { color: var(--primary-d); font-size: 12px; }
.section-head h2 { font-size: var(--fs-h2); font-weight: 800; line-height: 1.15; letter-spacing: -0.02em; }
.section-head h2::after { content: ""; display: block; width: 72px; height: 5px; margin-top: 14px; border-radius: 4px; background: linear-gradient(90deg, var(--ink), var(--primary)); }
.section--dark .section-head h2::after { background: linear-gradient(90deg, var(--primary-l), #fff); }

.section--dark .section-label { border-color: rgb(255 255 255 / 40%); color: var(--on-dark); }
.section--dark .section-label i { color: var(--primary-l); }
.section--dark .section-head h2 { color: #fff; }

.btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; min-height: 50px; padding: 13px 24px; border: 2px solid var(--ink); border-radius: 12px; font-size: var(--fs-small); font-weight: 700; line-height: 1.2; transition: background .25s, color .25s, border-color .25s, transform .25s; }
.btn--dark { background: var(--grad-black); color: #fff; }
.btn--dark:hover { background: var(--primary); border-color: var(--primary); transform: translateY(-3px); }
.btn--line { background: transparent; color: var(--ink); }
.btn--line:hover { background: var(--ink); color: #fff; transform: translateY(-3px); }

/* =========================================
   HERO
========================================= */
.hero { position: relative; padding: 80px 0; overflow: hidden; background: linear-gradient(180deg, var(--bg) 0%, #E4DBFA 100%); }
.hero::after { content: ""; position: absolute; left: -120px; bottom: -160px; width: 440px; height: 440px; border-radius: 50%; background: radial-gradient(circle, rgb(11 11 18 / 16%), transparent 68%); pointer-events: none; }
.hero::before { content: ""; position: absolute; top: -140px; right: -100px; width: 440px; height: 440px; border-radius: 50%; background: radial-gradient(circle, rgb(124 58 237 / 16%), transparent 68%); pointer-events: none; }
.hero-grid { position: relative; display: grid; grid-template-columns: minmax(0, 1.1fr) minmax(0, .9fr); align-items: center; gap: 64px; }
.hero-label { display: inline-flex; align-items: center; gap: 8px; margin-bottom: 20px; padding: 7px 16px; border-radius: 999px; background: var(--ink); color: var(--on-dark); font-size: var(--fs-label); font-weight: 700; }
.hero-label i { color: var(--primary-l); }
.hero-hello { color: var(--muted); font-size: var(--fs-lead); font-weight: 600; }
.hero h1 { margin: 4px 0 12px; font-size: var(--fs-display); font-weight: 800; line-height: 1.1; letter-spacing: -0.03em; overflow-wrap: anywhere; }
.hero-role { margin-bottom: 20px; color: var(--primary-d); font-size: var(--fs-h3); font-weight: 800; }
.hero-description { max-width: 520px; margin-bottom: 32px; color: var(--muted); font-size: var(--fs-lead); line-height: 1.75; }
.hero-buttons { display: flex; flex-wrap: wrap; gap: 14px; }

.hero-image-wrap { position: relative; width: 100%; max-width: 400px; margin-left: auto; padding: 0 18px 18px 0; }
.hero-image-frame { position: absolute; inset: 18px 0 0 18px; border-radius: 200px 200px 24px 24px; background: var(--grad-black); box-shadow: 0 24px 40px -16px rgb(11 11 18 / 45%); }
.hero-image-wrap::before { content: ""; position: absolute; top: -34px; left: -44px; width: 190px; height: 190px; border: 2px dashed var(--primary); border-radius: 50%; opacity: .5; animation: spin 40s linear infinite; }
.hero-image, .hero-placeholder { position: relative; z-index: 1; display: block; width: 100%; height: 440px; border-radius: 200px 200px 24px 24px; object-fit: cover; object-position: center top; border: 3px solid var(--ink); background: var(--border); }
.hero-placeholder { display: grid; place-items: center; color: var(--ink); font-size: 70px; }
.image-note { position: absolute; z-index: 2; left: -24px; bottom: 56px; padding: 12px 18px; border-radius: 12px; background: var(--ink); color: #fff; font-size: var(--fs-label); font-weight: 700; box-shadow: var(--shadow); }
.image-note i { margin-right: 6px; color: var(--primary-l); }

@keyframes spin { to { transform: rotate(360deg); } }

/* =========================================
   ABOUT
========================================= */
.about-grid { display: grid; grid-template-columns: minmax(0, 2fr) minmax(0, 1fr); align-items: stretch; gap: 32px; }
.about-card { padding: 36px; border: 1px solid var(--border); border-top: 6px solid var(--ink); border-radius: var(--radius); background: var(--card); box-shadow: var(--shadow); }
.about-quote { display: block; margin-bottom: 8px; color: var(--primary); font-size: 4rem; font-weight: 800; line-height: .8; }
.about-card p { max-width: 62ch; font-size: var(--fs-lead); line-height: 1.8; }
.about-side { display: flex; flex-direction: column; gap: 20px; }
.about-current { flex: 1; padding: 32px; border-radius: var(--radius); background: radial-gradient(circle at 100% 0, rgb(124 58 237 / 40%), transparent 55%), var(--grad-black); color: var(--on-dark); box-shadow: var(--shadow); }
.about-current-label { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; color: var(--on-dark-muted); font-size: var(--fs-label); font-weight: 700; }
.about-current-label::before { content: ""; width: 8px; height: 8px; border-radius: 50%; background: #4ADE80; animation: pulse 2s infinite; }
.about-current h3 { margin-bottom: 12px; color: #fff; font-size: var(--fs-h3); font-weight: 800; line-height: 1.3; }
.about-current p { color: var(--on-dark-muted); font-size: var(--fs-small); }
.about-current p i { margin-right: 8px; color: var(--primary-l); }
.about-details-button { display: inline-flex; align-items: center; gap: 10px; align-self: flex-start; padding: 13px 24px; border: 2px solid var(--ink); border-radius: 999px; color: var(--ink); font-size: var(--fs-small); font-weight: 700; transition: background .25s, color .25s, transform .25s; }
.about-details-button:hover { background: var(--ink); color: #fff; transform: translateY(-2px); }

/* =========================================
   PERSONAL DETAILS
========================================= */
.details-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; }
.detail-card { display: flex; align-items: center; gap: 16px; padding: 22px; border: 1px solid var(--border); border-radius: var(--radius); background: var(--card); box-shadow: var(--shadow); transition: transform .3s, border-color .3s; }
.detail-card:hover { transform: translateY(-4px); border-color: var(--ink); }
.detail-icon { flex: none; width: 44px; height: 44px; display: grid; place-items: center; border-radius: 50%; background: var(--ink); color: var(--primary-l); font-size: 16px; }
.detail-label { display: block; color: var(--muted); font-size: var(--fs-label); font-weight: 600; line-height: 1.4; }
.detail-value { display: block; color: var(--ink); font-size: var(--fs-body); font-weight: 700; line-height: 1.4; overflow-wrap: anywhere; }

/* =========================================
   SKILLS (black section)
========================================= */
.skills-list { display: flex; flex-wrap: wrap; gap: 14px; }
.skill-pill { display: inline-flex; align-items: center; gap: 10px; padding: 12px 24px; border: 1px solid rgb(255 255 255 / 28%); border-radius: 999px; background: var(--ink-2); color: var(--on-dark); font-size: var(--fs-small); font-weight: 600; line-height: 1.4; transition: transform .25s, background .25s, border-color .25s; }
.skill-pill i { color: var(--primary-l); font-size: 13px; transition: color .25s; }
.skill-pill:hover { transform: translateY(-3px); border-color: transparent; background: var(--grad-violet); }
.skill-pill:hover i { color: #fff; }

/* =========================================
   PROJECTS (black cards)
========================================= */
.project-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 24px; }
.project-card { position: relative; overflow: hidden; display: flex; flex-direction: column; padding: 28px; border: 1px solid rgb(255 255 255 / 10%); border-radius: var(--radius); background: radial-gradient(circle at 0 0, rgb(124 58 237 / 28%), transparent 50%), var(--grad-black); color: var(--on-dark); box-shadow: var(--shadow); transition: transform .3s, border-color .3s; }
.project-card::after { content: ""; position: absolute; inset: 0; background: radial-gradient(260px circle at var(--mx, 50%) var(--my, 0%), rgb(167 139 250 / 24%), transparent 70%); opacity: 0; transition: opacity .3s; pointer-events: none; }
.project-card:hover::after { opacity: 1; }
.project-card:hover { transform: translateY(-6px); border-color: var(--primary); }
.project-icon { display: grid; place-items: center; width: 44px; height: 44px; margin-bottom: 16px; border-radius: 14px; background: var(--grad-violet); color: #fff; font-size: 17px; }
.project-card h3 { margin-bottom: 8px; color: #fff; font-size: var(--fs-h3); font-weight: 800; line-height: 1.3; }
.project-card p { color: var(--on-dark-muted); font-size: var(--fs-body); line-height: 1.7; }
.project-link { display: inline-flex; align-items: center; gap: 8px; margin-top: auto; padding-top: 18px; color: var(--primary-l); font-size: var(--fs-small); font-weight: 700; transition: gap .2s, color .2s; }
.project-link:hover { gap: 12px; color: #fff; }

/* =========================================
   EXPERIENCE
========================================= */
.timeline-item { position: relative; padding: 0 0 28px 44px; }
.timeline-item:last-child { padding-bottom: 0; }
.timeline-item::before { content: ""; position: absolute; top: 24px; left: 0; z-index: 1; width: 18px; height: 18px; border: 4px solid var(--sand); border-radius: 50%; background: var(--ink); box-shadow: 0 0 0 2px var(--ink); }
.timeline-item::after { content: ""; position: absolute; top: 46px; bottom: -24px; left: 8px; width: 2px; background: var(--ink); opacity: .25; }
.timeline-item:last-child::after { display: none; }
.timeline-body { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); padding: 24px 28px; border: 1px solid var(--border); border-radius: var(--radius); background: var(--card); box-shadow: var(--shadow); transition: transform .3s, border-color .3s; }
.timeline-item:hover .timeline-body { transform: translateY(-3px); border-color: var(--ink); }
.timeline-fields { display: flex; flex-direction: column; gap: 14px; padding-right: 32px; }
.timeline-field--full { padding-left: 32px; border-left: 2px solid var(--ink); }
.timeline-label { display: block; margin-bottom: 2px; color: var(--muted); font-size: var(--fs-label); font-weight: 600; line-height: 1.4; }
.timeline-role { color: var(--ink); font-size: var(--fs-h3); font-weight: 800; line-height: 1.3; }
.timeline-company { color: var(--primary-d); font-size: var(--fs-body); font-weight: 700; }
.timeline-date { display: block; color: var(--text); font-size: var(--fs-body); font-weight: 600; }
.timeline-field--full p { color: var(--muted); font-size: var(--fs-body); line-height: 1.75; }

/* =========================================
   EDUCATION
========================================= */
.education-grid { display: grid; gap: 20px; }
.education-card { position: relative; overflow: hidden; display: flex; align-items: center; gap: 20px; padding: 24px 28px 24px 32px; border: 1px solid var(--border); border-radius: var(--radius); background: var(--card); box-shadow: var(--shadow); transition: transform .3s, border-color .3s; }
.education-card::before { content: ""; position: absolute; inset: 0 auto 0 0; width: 8px; background: var(--ink); }
.education-card:hover { transform: translateY(-4px); border-color: var(--ink); }
.education-icon { flex: none; width: 48px; height: 48px; display: grid; place-items: center; border-radius: 14px; background: var(--ink); color: var(--primary-l); font-size: 18px; }
.education-details { flex: 1; min-width: 0; display: grid; grid-template-columns: minmax(0, 1.5fr) minmax(0, 1.2fr) minmax(0, .6fr); gap: 16px 28px; }
.education-label { display: block; color: var(--muted); font-size: var(--fs-label); font-weight: 600; line-height: 1.4; }
.education-value { display: block; color: var(--text); font-size: var(--fs-body); font-weight: 600; line-height: 1.5; overflow-wrap: anywhere; }
.education-field--main .education-value { color: var(--ink); font-size: var(--fs-h3); font-weight: 800; line-height: 1.35; }

/* =========================================
   CONTACT (black box)
========================================= */
.contact-box { position: relative; overflow: hidden; padding: 56px; border: 1px solid rgb(255 255 255 / 18%); border-radius: 32px; background: linear-gradient(135deg, rgb(255 255 255 / 10%), rgb(255 255 255 / 3%)); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); color: var(--on-dark); box-shadow: 0 24px 44px -16px rgb(0 0 0 / 60%); }
.contact-box::before { content: ""; position: absolute; left: -70px; bottom: -90px; width: 260px; height: 260px; border: 1px solid rgb(255 255 255 / 12%); border-radius: 50%; pointer-events: none; }
.contact-box > * { position: relative; }
.contact-deco { position: absolute !important; right: 48px; bottom: 36px; color: rgb(255 255 255 / 7%); font-size: 140px; transform: rotate(-12deg); pointer-events: none; }
.contact-box h3 { max-width: 640px; margin-bottom: 14px; color: #fff; font-size: var(--fs-h2); font-weight: 800; line-height: 1.2; letter-spacing: -0.02em; }
.contact-box p { max-width: 520px; margin-bottom: 32px; color: var(--on-dark-muted); font-size: var(--fs-lead); }
.contact-actions { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; }
.contact-btn { display: flex; align-items: center; justify-content: center; gap: 10px; min-height: 54px; padding: 14px 24px; border: 1px solid rgb(255 255 255 / 35%); border-radius: 999px; background: rgb(255 255 255 / 6%); color: #fff; font-size: var(--fs-small); font-weight: 700; text-align: center; overflow-wrap: anywhere; transition: background .25s, color .25s, border-color .25s, transform .25s; }
.contact-btn:hover { transform: translateY(-2px); border-color: var(--primary); background: var(--primary); }
.contact-btn--light { border-color: #fff; background: #fff; color: var(--ink); }
.contact-btn--light:hover { border-color: var(--primary-l); background: var(--primary-l); color: var(--ink); }

/* =========================================
   FOOTER
========================================= */
footer { padding: 24px 20px; border-top: 1px solid rgb(255 255 255 / 10%); background: #000; color: var(--on-dark); text-align: center; font-size: var(--fs-small); }
footer a { color: var(--primary-l); font-weight: 700; }

/* =========================================
   MOTION
========================================= */
.js-reveal .reveal { opacity: 0; }
.js-reveal .reveal.in-view { animation: reveal-up .7s cubic-bezier(.2, .7, .2, 1) both; animation-delay: var(--reveal-delay, 0s); }
@keyframes reveal-up { from { opacity: 0; translate: 0 26px; } to { opacity: 1; translate: 0 0; } }
@keyframes pulse { 0% { box-shadow: 0 0 0 0 rgb(74 222 128 / 55%); } 70% { box-shadow: 0 0 0 8px rgb(74 222 128 / 0%); } 100% { box-shadow: 0 0 0 0 rgb(74 222 128 / 0%); } }

/* =========================================
   RESPONSIVE
========================================= */
@media (max-width: 900px) {
  .details-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .hero-grid { gap: 40px; }
}

@media (max-width: 768px) {
  .section { padding: 60px 0; }
  .container { padding: 0 20px; }
  .section-head h2, .contact-box h3 { font-size: 1.75rem; }

  .hero { padding: 48px 0; }
  .hero-grid { grid-template-columns: 1fr; }
  .hero-copy { text-align: center; }
  .hero-description { margin-inline: auto; }
  .hero-buttons { justify-content: center; }
  .hero-image-wrap { max-width: 340px; margin: 0 auto; }
  .hero-image, .hero-placeholder { height: 380px; }
  .image-note { left: 0; }

  .about-grid, .project-grid, .details-grid { grid-template-columns: 1fr; }
  .about-card, .about-current { padding: 26px; }

  .timeline-body { grid-template-columns: 1fr; gap: 16px; padding: 20px; }
  .timeline-fields { padding-right: 0; }
  .timeline-field--full { padding: 16px 0 0; border-left: 0; border-top: 2px solid var(--ink); }

  .education-card { align-items: flex-start; }
  .education-details { grid-template-columns: 1fr; gap: 12px; }

  .contact-box { padding: 32px 24px; border-radius: 28px; }
  .contact-deco { right: 20px; bottom: 20px; font-size: 90px; }
}

@media (max-width: 480px) {
  .hero-buttons { flex-direction: column; align-items: stretch; }
}

@media (prefers-reduced-motion: reduce) {
  html { scroll-behavior: auto; }
  *, *::before, *::after { scroll-behavior: auto !important; transition-duration: .01ms !important; animation: none !important; }
  .js-reveal .reveal { opacity: 1 !important; }
}
</style>
</head>

<body>
<!-- TOP NAVIGATION -->
@unless($isPublic ?? false)
<nav class="portfolio-navbar">
    <div class="portfolio-navbar-inner">
        <a href="{{ route('portfolios.index') }}" class="navbar-brand">Portfolio Preview · PortfolioGen</a>
        <div class="navbar-actions">
            <a href="{{ route('portfolios.index') }}" class="navbar-button">My Portfolios</a>
            <a href="{{ route('portfolios.edit', $portfolio->id) }}" class="navbar-button">Edit Portfolio</a>
            <a href="{{ route('portfolios.templates', $portfolio->id) }}" class="navbar-button">Change Template</a>
        </div>
    </div>
</nav>
@endunless

<header class="site-header" id="siteHeader">
    <nav class="nav-container">

        <a href="#home" class="nav-brand">
            @if(!empty($portfolio->photo))
                <img src="{{ $portfolio->photo }}" alt="{{ $portfolio->full_name ?? 'Profile picture' }}">
            @else
                <span class="nav-brand-icon">{{ strtoupper(substr($portfolio->full_name ?? 'P', 0, 1)) }}</span>
            @endif
            <span>{{ $portfolio->full_name ?? 'My Portfolio' }}</span>
        </a>

        <button type="button" class="nav-toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navMenu">
            <span></span><span></span><span></span>
        </button>

        <div class="nav-menu" id="navMenu">
            <a href="#home" class="nav-link is-active">Home</a>
            <a href="#about" class="nav-link">About</a>
            <a href="#personal-details" class="nav-link">Personal Details</a>
            <a href="#skills" class="nav-link">Skills</a>
            <a href="#projects" class="nav-link">Projects</a>
            <a href="#experience" class="nav-link">Experience</a>
            <a href="#education" class="nav-link">Education</a>
            <a href="#contact" class="nav-link">Contact</a>
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
        ['icon' => 'fa-regular fa-user',       'label' => 'Full Name', 'value' => $fullName],
        ['icon' => 'fa-solid fa-briefcase',    'label' => 'Title',     'value' => $jobTitle],
        ['icon' => 'fa-regular fa-envelope',   'label' => 'Email',     'value' => $portfolio->email ?? ''],
        ['icon' => 'fa-solid fa-phone',        'label' => 'Phone',     'value' => $portfolio->phone ?? ''],
        ['icon' => 'fa-solid fa-location-dot', 'label' => 'Location',  'value' => $portfolio->address ?? ''],
        ['icon' => 'fa-solid fa-globe',        'label' => 'Website',   'value' => $website],
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
@endphp

<!-- HERO -->
<section class="hero" id="home">
    <div class="container hero-grid">

        <div class="hero-copy">

            <span class="hero-label"><i class="fa-solid fa-star"></i> Personal Portfolio</span>

            <p class="hero-hello">Hello, I'm</p>
            <h1>{{ $fullName }}</h1>

            @if($jobTitle)
                <p class="hero-role">{{ $jobTitle }}</p>
            @endif

            <p class="hero-description">
                Welcome to my portfolio! Here, you can explore my background, educational achievements, skills, projects, and experiences that reflect my personal and professional journey.
            </p>

            <div class="hero-buttons">
                <a href="#projects" class="btn btn--dark">Explore My Work <i class="fa-solid fa-arrow-right"></i></a>
                <a href="#contact" class="btn btn--line">Let's Connect</a>
            </div>

        </div>

        <div class="hero-image-wrap">

            <div class="hero-image-frame"></div>

            @if($profilePhoto)
                <img src="{{ $profilePhoto }}" alt="{{ $fullName }}" class="hero-image">
            @else
                <div class="hero-placeholder"><i class="fa-solid fa-user"></i></div>
            @endif

            <div class="image-note"><i class="fa-solid fa-wand-magic-sparkles"></i> Creating my own path</div>

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
                <p>{{ $aboutText ?: 'I am someone who enjoys learning, exploring new ideas, and developing skills through meaningful experiences and creative projects.' }}</p>
            </div>

            <div class="about-side">

                @if($jobTitle || !empty($portfolio->address))
                    <div class="about-current">
                        <span class="about-current-label">Currently</span>

                        @if($jobTitle)
                            <h3>{{ $jobTitle }}</h3>
                        @endif

                        @if(!empty($portfolio->address))
                            <p><i class="fa-solid fa-location-dot"></i>{{ $portfolio->address }}</p>
                        @endif
                    </div>
                @endif

                <a href="#personal-details" class="about-details-button">
                    View Personal Details <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </div>

    </div>
</section>


<!-- PERSONAL DETAILS -->
<section class="section" id="personal-details">
    <div class="container">

        <div class="section-head">
            <span class="section-label"><i class="fa-solid fa-id-card"></i> The basics</span>
            <h2>Personal Details</h2>
        </div>

        <div class="details-grid">
            @foreach($details as $detail)
                <div class="detail-card">
                    <span class="detail-icon"><i class="{{ $detail['icon'] }}"></i></span>
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
<section class="section section--dark" id="skills">
    <div class="container">

        <div class="section-head">
            <span class="section-label"><i class="fa-solid fa-bolt"></i> What I do</span>
            <h2>Skills &amp; Expertise</h2>
        </div>

        <div class="skills-list">
            @foreach($skillList as $skillName)
                <div class="skill-pill"><i class="fa-solid fa-bolt"></i>{{ $skillName }}</div>
            @endforeach
        </div>

    </div>
</section>
@endif


<!-- PROJECTS -->
@if($portfolio->projects && $portfolio->projects->count() > 0)
<section class="section" id="projects">
    <div class="container">

        <div class="section-head">
            <span class="section-label"><i class="fa-solid fa-layer-group"></i> What I've built</span>
            <h2>Projects</h2>
        </div>

        <div class="project-grid">
            @foreach($portfolio->projects as $project)

                <article class="project-card">

                    <span class="project-icon"><i class="fa-solid fa-laptop-code"></i></span>

                    <h3>{{ $project->name }}</h3>

                    <p>{{ !empty($project->description) ? $project->description : 'A project showcasing my skills, ideas, and learning experience.' }}</p>

                    @if(!empty($project->link))
                        <a href="{{ $project->link }}"
                           class="project-link"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="View {{ $project->name }}">View project <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
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
                                <span class="timeline-label">Role</span>
                                <h3 class="timeline-role">{{ $experience->position }}</h3>
                            </div>

                            @if(!empty($experience->company))
                                <div class="timeline-field">
                                    <span class="timeline-label">Company</span>
                                    <div class="timeline-company">{{ $experience->company }}</div>
                                </div>
                            @endif

                            <div class="timeline-field">
                                <span class="timeline-label">Duration</span>
                                <span class="timeline-date">{{ $experience->duration ?: 'Professional Experience' }}</span>
                            </div>

                        </div>

                        @if(!empty($experience->description))
                            <div class="timeline-field timeline-field--full">
                                <span class="timeline-label">What I did</span>
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
<section class="section" id="education">
    <div class="container">

        <div class="section-head">
            <span class="section-label"><i class="fa-solid fa-graduation-cap"></i> Studies</span>
            <h2>Education</h2>
        </div>

        <div class="education-grid">
            @foreach($portfolio->educations as $education)

                @php
                    $schoolName = $education->school_name ?? $education->institution ?? '';
                @endphp

                <article class="education-card">

                    <div class="education-icon"><i class="fa-solid fa-graduation-cap"></i></div>

                    <div class="education-details">

                        @if(!empty($schoolName))
                            <div class="education-field education-field--main">
                                <span class="education-label">School</span>
                                <span class="education-value">{{ $schoolName }}</span>
                            </div>
                        @endif

                        <div class="education-field">
                            <span class="education-label">Program</span>
                            <span class="education-value">{{ $education->program ?? $education->degree ?? $education->education_level ?? $education->level ?? 'Education' }}</span>
                        </div>

                        @if(!empty($education->year))
                            <div class="education-field">
                                <span class="education-label">Year</span>
                                <span class="education-value">{{ $education->year }}</span>
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
<section class="section section--dark" id="contact">
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

    // Clean up saved links: add https:// when missing and keep only http/https links
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

            <h3>Let's Connect and Create Something Amazing.</h3>

            <p>I'm open to job opportunities and collaborations. Feel free to reach out.</p>

            <div class="contact-actions">

                @if(!empty($portfolio->email))
                    <a href="mailto:{{ $portfolio->email }}" class="contact-btn contact-btn--light">
                        <i class="fa-regular fa-envelope"></i> Email Me
                    </a>
                @endif

                @if(!empty($portfolio->phone))
                    <a href="tel:{{ $portfolio->phone }}" class="contact-btn">
                        <i class="fa-solid fa-phone"></i> {{ $portfolio->phone }}
                    </a>
                @endif

                @foreach($socialLinks as $social)
                    <a href="{{ $social['url'] }}" class="contact-btn" target="_blank" rel="noopener noreferrer">
                        <i class="{{ $socialIcon($social['platform']) }}"></i> {{ $social['name'] }}
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

    toggle.addEventListener('click', function () {
        const isOpen = menu.classList.toggle('open');
        toggle.setAttribute('aria-expanded', String(isOpen));
    });

    links.forEach(function (link) {
        link.addEventListener('click', function () {
            menu.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
        });
    });

    function updateHeader() {
        header.classList.toggle('scrolled', window.scrollY > 20);
    }

    window.addEventListener('scroll', updateHeader, { passive: true });
    updateHeader();

    const sections = document.querySelectorAll('section[id]');

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) {
                    return;
                }

                links.forEach(function (link) {
                    link.classList.toggle('is-active', link.getAttribute('href') === '#' + entry.target.id);
                });
            });
        }, { rootMargin: '-20% 0px -65% 0px' });

        sections.forEach(function (section) {
            observer.observe(section);
        });
    }

    // Matches the 1000px CSS breakpoint.
    window.addEventListener('resize', function () {
        if (window.innerWidth > 1000) {
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
        '.section-head, .about-card, .about-side, .detail-card, .skills-list, ' +
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

<!-- PROJECT CARD SPOTLIGHT -->
<script>
document.querySelectorAll('.project-card').forEach(function (card) {
    card.addEventListener('mousemove', function (e) {
        var r = card.getBoundingClientRect();
        card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
        card.style.setProperty('--my', (e.clientY - r.top) + 'px');
    });
});
</script>

</body>
</html>