<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio Generator</title>

  <style>
    /* Reset the default spacing on every element */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    /* Colors */
    :root {
      --peacock: #4D52B4;
      --sky-blue: #4E9CE8;
      --turquoise: #70D6C5;
      --pale-green: #CAE5BC;
      --soft-cream: #E1EDD4;
      --dark-text: #24364b;
      --muted-text: #64748b;
      --white: #ffffff;
    }

    /* Smooth scrolling when clicking anchor links */
    html {
      scroll-behavior: smooth;
    }

    /* Page font, gradient background and text color */
    body {
      font-family: "Segoe UI", Arial, Helvetica, sans-serif;
      background: linear-gradient(
        180deg,
        #4E9CE8 0%,
        #70D6C5 35%,
        #CAE5BC 70%,
        #E1EDD4 100%
      );
      background-attachment: fixed;
      color: var(--dark-text);
      line-height: 1.6;
      min-height: 100vh;
    }

    /* Navigation */
    /* Top bar: logo on the left, links on the right */
    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 8%;
      background: rgba(255, 255, 255, 0.92);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.7);
      box-shadow: 0 4px 20px rgba(77, 82, 180, 0.08);
    }

    /* Site name in the top bar */
    .logo {
      font-size: 24px;
      font-weight: 800;
      letter-spacing: -0.7px;
      color: var(--peacock);
    }

    /* Links in the top bar */
    nav a {
      display: inline-block;
      text-decoration: none;
      color: #344563;
      margin-left: 22px;
      font-size: 14px;
      font-weight: 700;
      transition: color 0.3s ease;
    }

    /* Link color when the mouse is over it */
    nav a:hover {
      color: var(--sky-blue);
    }

    /* Hero */
    /* Main banner with centered content */
    .hero {
      min-height: 75vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 85px 20px;
      position: relative;
      overflow: hidden;
    }

    /* Soft white circle at the top left */
    .hero::before {
      content: "";
      position: absolute;
      width: 350px;
      height: 350px;
      top: 30px;
      left: -160px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.16);
      filter: blur(3px);
    }

    /* Soft white circle at the bottom right */
    .hero::after {
      content: "";
      position: absolute;
      width: 280px;
      height: 280px;
      bottom: -100px;
      right: -80px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.18);
      filter: blur(3px);
    }

    /* Small label above the title */
    .badge {
      display: inline-block;
      background: rgba(255, 255, 255, 0.8);
      color: var(--peacock);
      padding: 9px 20px;
      border: 1px solid rgba(255, 255, 255, 0.9);
      border-radius: 30px;
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 1.5px;
      margin-bottom: 25px;
      box-shadow: 0 5px 18px rgba(77, 82, 180, 0.1);
      position: relative;
      z-index: 1;
    }

    /* Main title */
    h1 {
      font-size: clamp(36px, 6vw, 64px);
      line-height: 1.15;
      max-width: 900px;
      margin-bottom: 24px;
      color: #ffffff;
      letter-spacing: -1.5px;
      text-shadow: 0 3px 15px rgba(36, 54, 75, 0.14);
      position: relative;
      z-index: 1;
    }

    /* Second title line in blue */
    h1 span {
      display: block;
      color: var(--peacock);
      text-shadow: none;
    }

    /* Short intro text under the title */
    .description {
      max-width: 650px;
      color: #294a64;
      font-size: 17px;
      margin-bottom: 34px;
      line-height: 1.9;
      position: relative;
      z-index: 1;
    }

    /* Buttons */
    /* Row that holds the buttons */
    .buttons {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      justify-content: center;
      position: relative;
      z-index: 1;
    }

    /* Shape shared by all buttons */
    .button {
      display: inline-block;
      padding: 15px 27px;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 700;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    /* Filled gradient button (Create My Portfolio) */
    .primary {
      background: linear-gradient(
        135deg,
        #4D52B4,
        #4E9CE8,
        #70D6C5
      );
      color: white;
      border: 1px solid rgba(255, 255, 255, 0.6);
      box-shadow:
        0 8px 20px rgba(77, 82, 180, 0.25),
        0 0 15px rgba(112, 214, 197, 0.18);
    }

    /* Button lifts and glows on hover */
    .primary:hover {
      transform: translateY(-4px);
      box-shadow:
        0 12px 26px rgba(77, 82, 180, 0.3),
        0 0 25px rgba(112, 214, 197, 0.45);
    }

    /* Light outlined button style */
    .secondary {
      background: rgba(255, 255, 255, 0.85);
      color: var(--peacock);
      border: 1px solid rgba(77, 82, 180, 0.15);
      box-shadow: 0 5px 15px rgba(77, 82, 180, 0.08);
    }

    /* Secondary button lifts on hover */
    .secondary:hover {
      background: #ffffff;
      transform: translateY(-4px);
      box-shadow: 0 10px 22px rgba(77, 82, 180, 0.15);
    }

    /* Features */
    /* Section that holds the three feature cards */
    .features {
      padding: 75px 8%;
      text-align: center;
      background: rgba(255, 255, 255, 0.32);
      border-top: 1px solid rgba(255, 255, 255, 0.55);
      border-bottom: 1px solid rgba(255, 255, 255, 0.55);
    }

    /* Section heading */
    .features h2 {
      font-size: clamp(28px, 4vw, 38px);
      margin-bottom: 12px;
      color: var(--peacock);
      letter-spacing: -0.5px;
    }

    /* Short line under the heading */
    .features-intro {
      color: #3f6174;
      margin-bottom: 42px;
      font-size: 16px;
    }

    /* Three cards in one row */
    .feature-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 25px;
      max-width: 1150px;
      margin: auto;
    }

    /* One feature card */
    .card {
      background: rgba(255, 255, 255, 0.82);
      padding: 32px 25px;
      border-radius: 24px;
      border: 1px solid rgba(255, 255, 255, 0.95);
      text-align: left;
      box-shadow:
        10px 10px 25px rgba(77, 82, 180, 0.08),
        -6px -6px 20px rgba(255, 255, 255, 0.25);
      transition:
        transform 0.3s ease,
        box-shadow 0.3s ease,
        background 0.3s ease;
    }

    /* Card lifts and turns solid white on hover */
    .card:hover {
      transform: translateY(-8px);
      background: #ffffff;
      box-shadow:
        0 15px 35px rgba(77, 82, 180, 0.14),
        0 0 20px rgba(112, 214, 197, 0.16);
    }

    /* Rounded box that holds the emoji */
    .icon {
      width: 62px;
      height: 62px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 29px;
      margin-bottom: 22px;
      border-radius: 19px;
      background: linear-gradient(
        135deg,
        #e8f1ff,
        #e1edd4
      );
      box-shadow:
        5px 5px 12px rgba(77, 82, 180, 0.1),
        -4px -4px 10px rgba(255, 255, 255, 0.8);
    }

    /* Card title */
    .card h3 {
      margin-bottom: 12px;
      color: var(--peacock);
      font-size: 19px;
    }

    /* Card description */
    .card p {
      color: var(--muted-text);
      font-size: 14px;
      line-height: 1.9;
    }

    /* Footer */
    /* Bottom bar */
    footer {
      text-align: center;
      padding: 27px 20px;
      color: #3b5870;
      background: rgba(255, 255, 255, 0.8);
      border-top: 1px solid rgba(255, 255, 255, 0.85);
      font-size: 13px;
    }

    /* Footer text */
    footer p {
      margin: 0;
    }

    /* Responsive */
    /* Tablets: two cards per row */
    @media (max-width: 850px) {
      .feature-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }

    /* Phones: everything stacks in one column */
    @media (max-width: 600px) {
      nav {
        padding: 18px 5%;
        flex-wrap: wrap;
        gap: 12px;
      }

      .logo {
        font-size: 21px;
      }

      nav a {
        margin-left: 0;
        margin-right: 14px;
        font-size: 13px;
      }

      .hero {
        min-height: 65vh;
        padding: 65px 20px;
      }

      h1 {
        letter-spacing: -0.8px;
      }

      .description {
        font-size: 15px;
      }

      .buttons {
        width: 100%;
        max-width: 340px;
        flex-direction: column;
      }

      .button {
        width: 100%;
        text-align: center;
      }

      .features {
        padding: 55px 5%;
      }

      .feature-grid {
        grid-template-columns: 1fr;
        gap: 20px;
      }

      .card {
        padding: 27px 23px;
      }
    }

    /* Reduced motion */
    @media (prefers-reduced-motion: reduce) {
      html {
        scroll-behavior: auto;
      }

      *,
      *::before,
      *::after {
        transition-duration: 0.01ms !important;
      }
    }
  </style>
</head>

<body>

  <!-- Navigation -->
  <nav>
    <!-- Site name -->
    <div class="logo">PortfolioGen</div>

    <!-- Links to Home and My Portfolios -->
    <div>
      <a href="{{ route('home') }}">Home</a>
      <a href="{{ route('portfolios.index') }}">My Portfolios</a>
    </div>
  </nav>

  <main>

    <!-- Hero -->
    <section class="hero">
      <!-- Small label above the title -->
      <div class="badge">YOUR CAREER, YOUR STYLE</div>

      <!-- Main title -->
      <h1>
        Create Your Own
        <span>Professional Portfolio</span>
      </h1>

      <!-- Short intro text -->
      <p class="description">
        Build a personal portfolio in just a few steps.
        Add your information, showcase your skills and projects,
        and choose a design that represents you.
      </p>

      <!-- Button that opens the create portfolio form -->
      <div class="buttons">
        <a href="{{ route('portfolios.create', [], false) }}" class="button primary">
          Create My Portfolio &rarr;
        </a>
      </div>
    </section>

    <!-- Features -->
    <section class="features">
      <!-- Section heading -->
      <h2>Everything You Need</h2>

      <p class="features-intro">
        Create and manage your personal portfolio in one place.
      </p>

      <!-- The three feature cards -->
      <div class="feature-grid">
        <!-- Card 1: enter information -->
        <div class="card">
          <div class="icon">📝</div>
          <h3>Add Your Information</h3>
          <p>
            Enter your profile, education, skills,
            projects, work experience, and contact details.
          </p>
        </div>

        <!-- Card 2: save the portfolio -->
        <div class="card">
          <div class="icon">💾</div>
          <h3>Save Your Portfolio</h3>
          <p>
            Save your details securely so you can come back and edit them anytime.
          </p>
        </div>

        <!-- Card 3: choose a template -->
        <div class="card">
          <div class="icon">🎨</div>
          <h3>Choose Your Design</h3>
          <p>
            Pick from three templates
            (Simple, Modern, and Creative) and preview your portfolio instantly.
          </p>
        </div>
      </div>
    </section>

  </main>

  <!-- Footer -->
  <footer>
    <p>PortfolioGen &mdash; Your Personal Portfolio Generator</p>
  </footer>

</body>
</html>
