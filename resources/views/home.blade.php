<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Generator</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

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

        html {
            scroll-behavior: smooth;
        }

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

        /* NAVIGATION */
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

        .logo {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.7px;
            color: var(--peacock);
        }

        nav a {
            display: inline-block;
            text-decoration: none;
            color: #344563;
            margin-left: 22px;
            font-size: 14px;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: var(--sky-blue);
        }

        /* HERO SECTION */
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

        h1 span {
            display: block;
            color: var(--peacock);
            text-shadow: none;
        }

        .description {
            max-width: 650px;
            color: #294a64;
            font-size: 17px;
            margin-bottom: 34px;
            line-height: 1.9;
            position: relative;
            z-index: 1;
        }

        /* BUTTONS */
        .buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        .button {
            display: inline-block;
            padding: 15px 27px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s ease;
        }

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

        .primary:hover {
            transform: translateY(-4px);
            box-shadow:
                0 12px 26px rgba(77, 82, 180, 0.3),
                0 0 25px rgba(112, 214, 197, 0.45);
        }

        .secondary {
            background: rgba(255, 255, 255, 0.85);
            color: var(--peacock);
            border: 1px solid rgba(77, 82, 180, 0.15);
            box-shadow: 0 5px 15px rgba(77, 82, 180, 0.08);
        }

        .secondary:hover {
            background: #ffffff;
            transform: translateY(-4px);
            box-shadow: 0 10px 22px rgba(77, 82, 180, 0.15);
        }

        /* FEATURES SECTION */
        .features {
            padding: 75px 8%;
            text-align: center;
            background: rgba(255, 255, 255, 0.32);
            border-top: 1px solid rgba(255, 255, 255, 0.55);
            border-bottom: 1px solid rgba(255, 255, 255, 0.55);
        }

        .features h2 {
            font-size: clamp(28px, 4vw, 38px);
            margin-bottom: 12px;
            color: var(--peacock);
            letter-spacing: -0.5px;
        }

        .features-intro {
            color: #3f6174;
            margin-bottom: 42px;
            font-size: 16px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 25px;
            max-width: 1150px;
            margin: auto;
        }

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

        .card:hover {
            transform: translateY(-8px);
            background: #ffffff;
            box-shadow:
                0 15px 35px rgba(77, 82, 180, 0.14),
                0 0 20px rgba(112, 214, 197, 0.16);
        }

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

        .card h3 {
            margin-bottom: 12px;
            color: var(--peacock);
            font-size: 19px;
        }

        .card p {
            color: var(--muted-text);
            font-size: 14px;
            line-height: 1.9;
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 27px 20px;
            color: #3b5870;
            background: rgba(255, 255, 255, 0.8);
            border-top: 1px solid rgba(255, 255, 255, 0.85);
            font-size: 13px;
        }

        footer p {
            margin: 0;
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 850px) {
            .feature-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

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

        /* REDUCED MOTION ACCESSIBILITY */
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

    <nav>
        <div class="logo">PortfolioGen</div>

     <div>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('portfolios.index') }}">My Portfolios</a>
        </div>
    </nav>
    <main>
        <section class="hero">
            <div class="badge">YOUR CAREER, YOUR STYLE</div>

            <h1>
                Create Your Own
                <span>Professional Portfolio</span>
            </h1>

            <p class="description">
                Build a personal portfolio in just a few steps.
                Add your information, showcase your skills and projects,
                and choose a design that represents you.
            </p>

            <div class="buttons">
                <a href="{{ route('portfolios.create', [], false) }}" class="button primary">
                    Create My Portfolio &rarr;
                </a>

            </div>
        </section>

        <section class="features">
            <h2>Everything You Need</h2>

            <p class="features-intro">
                Create and manage your personal portfolio in one place.
            </p>

            <div class="feature-grid">
                <div class="card">
                    <div class="icon">📝</div>
                    <h3>Add Your Information</h3>
                    <p>
                        Enter your profile, education, skills,
                        projects, work experience, and contact details.
                    </p>
                </div>

                <div class="card">
                    <div class="icon">💾</div>
                    <h3>Save Your Portfolio</h3>
                    <p>
                        Save your details securely so you can come back and edit them anytime.
                    </p>
                </div>

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

    <footer>
        <p>PortfolioGen &mdash; Your Personal Portfolio Generator</p>
    </footer>

</body>
</html>