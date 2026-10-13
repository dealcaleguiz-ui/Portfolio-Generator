<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Choose Your Portfolio Template</title>

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
            padding: 40px 20px;
            color: var(--text);
            min-height: 100vh;
        }

        /* MAIN CONTAINER */
        .container {
            max-width: 1100px;
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

        .welcome-name {
            color: var(--primary-dark);
            font-weight: 700;
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

        /* SUCCESS MESSAGE */
        .message {
            margin-bottom: 25px;
            padding: 16px 20px;
            border: 1px solid #B8E3CE;
            border-radius: 15px;
            background: linear-gradient(
                135deg,
                #EAF8EE,
                #E0F6EF
            );
            color: #236B4A;
            font-size: 14px;
            box-shadow: 0 5px 15px rgba(50, 130, 90, 0.08);
        }

        /* TEMPLATE GRID */
        .templates {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
            margin-top: 30px;
        }

        /* TEMPLATE CARD */
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            background: linear-gradient(
                145deg,
                #FFFFFF,
                #F0F7ED
            );
            padding: 24px;
            border: 1px solid #E0EBDD;
            border-radius: 22px;
            text-align: center;
            box-shadow:
                7px 7px 18px rgba(77, 82, 180, 0.08),
                -6px -6px 18px rgba(255, 255, 255, 0.90);
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease,
                border-color 0.3s ease;
        }

        .card:hover {
            transform: translateY(-7px);
            border-color: var(--turquoise);
            box-shadow:
                0 12px 28px rgba(77, 82, 180, 0.12),
                0 0 18px rgba(78, 156, 232, 0.12),
                -6px -6px 18px rgba(255, 255, 255, 0.90);
        }

        /* TEMPLATE PREVIEW */
        .preview {
            height: 175px;
            border-radius: 16px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 12px;
            font-size: 23px;
            font-weight: 700;
            overflow: hidden;
            box-shadow:
                inset 3px 3px 8px rgba(0, 0, 0, 0.04),
                0 5px 12px rgba(77, 82, 180, 0.08);
        }

        .preview-icon {
            font-size: 32px;
            line-height: 1;
        }

        .preview small {
            font-size: 12px;
            font-weight: 500;
            opacity: 0.85;
        }

        /* SIMPLE PREVIEW */
        .simple {
            background: linear-gradient(
                145deg,
                #FFFFFF,
                #EAF3E5
            );
            color: var(--primary-dark);
            border: 1px solid #D8E8D0;
        }

        .simple .preview-icon {
            color: var(--sky-blue);
        }

        /* MODERN PREVIEW */
        .modern {
            background: #ADD8E6;
            color: #24364b;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        /* CREATIVE PREVIEW */
        .creative {
            background: linear-gradient(
                135deg,
                #4D52B4 0%,
                #4E9CE8 45%,
                #70D6C5 100%
            );
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        /* CARD TEXT */
        .card h2 {
            margin: 0 0 10px;
            color: var(--primary);
            font-size: 20px;
        }

        .card p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
            margin: 0 0 22px;
            flex-grow: 1;
        }

        .template-label {
            display: inline-block;
            margin-bottom: 12px;
            padding: 6px 12px;
            border-radius: 20px;
            background: linear-gradient(
                135deg,
                #EAF3FF,
                #E7F6EF
            );
            color: var(--primary-dark);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* CHOOSE TEMPLATE BUTTON */
        .choose-button {
            display: block;
            width: 100%;
            padding: 15px 18px;
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
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.3px;
            cursor: pointer;
            box-shadow:
                0 7px 18px rgba(77, 82, 180, 0.20),
                0 0 12px rgba(78, 156, 232, 0.14),
                0 0 18px rgba(112, 214, 197, 0.10);
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease,
                filter 0.3s ease;
        }

        .choose-button:hover {
            transform: translateY(-3px);
            box-shadow:
                0 10px 24px rgba(77, 82, 180, 0.25),
                0 0 18px rgba(78, 156, 232, 0.25),
                0 0 25px rgba(112, 214, 197, 0.20);
            filter: brightness(1.04);
        }

        .choose-button:active {
            transform: translateY(0);
        }

        .choose-button:focus-visible {
            outline: 3px solid var(--primary);
            outline-offset: 4px;
        }

        /* BACK LINK */
        .back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 32px;
            color: var(--primary-dark);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .back:hover {
            color: var(--sky-blue);
            transform: translateX(-4px);
        }

        /* MOBILE RESPONSIVENESS */
        @media (max-width: 850px) {
            .templates {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 20px 12px;
            }

            .container {
                padding: 24px 16px;
                border-radius: 22px;
            }

            .templates {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .card {
                padding: 20px;
            }

            .preview {
                height: 155px;
            }
        }

        /* ACCESSIBILITY */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <header class="header">

        <div class="header-icon">✦</div>

        <h1>Choose Your Portfolio Template</h1>

        <p class="subtitle">
            Hello,
            <span class="welcome-name">{{ $portfolio->full_name }}</span>!
            <br>
            Choose a design that reflects your personality and professional identity.
        </p>

        <span class="progress-note">
            ✧ &nbsp; STEP 2: SELECT YOUR DESIGN
        </span>

    </header>

    @if (session('ok'))
        <div class="message">
            ✓ &nbsp; {{ session('ok') }}
        </div>
    @endif

    <div class="templates">

        <!-- SIMPLE TEMPLATE -->
        <div class="card">

            <div class="preview simple">
                <span class="preview-icon">▤</span>
                <span>Simple</span>
                <small>Clean · Minimal · Elegant</small>
            </div>

            <span class="template-label">CLASSIC STYLE</span>

            <h2>Simple Template</h2>

            <p>
            A clean, minimal layout with a centered introduction and clearly labeled sections 
            that keep the focus on your content.
            </p>

            <form
                action="{{ route('portfolios.choose', ['portfolio' => $portfolio->id], false) }}"
                method="POST"
            >
                @csrf

                <input type="hidden" name="template" value="simple">

                <button type="submit" class="choose-button">
                    Choose Simple &nbsp; →
                </button>
            </form>

        </div>

        <!-- MODERN TEMPLATE -->
        <div class="card">

            <div class="preview modern">
                <span class="preview-icon">✧</span>
                <span>Modern</span>
                <small>Professional · Stylish · Bold</small>
            </div>

            <span class="template-label">PROFESSIONAL STYLE</span>

            <h2>Modern Template</h2>

            <p>
            A bold, structured layout with a deep teal hero card and lime accents. 
            Your education, skills, projects, and experience are neatly organized in clear cards.
            </p>

            <form
                action="{{ route('portfolios.choose', ['portfolio' => $portfolio->id], false) }}"
                method="POST"
            >
                @csrf

                <input type="hidden" name="template" value="modern">

                <button type="submit" class="choose-button">
                    Choose Modern &nbsp; →
                </button>
            </form>

        </div>

        <!-- CREATIVE TEMPLATE -->
        <div class="card">

            <div class="preview creative">
                <span class="preview-icon">✦</span>
                <span>Creative</span>
                <small>Colorful · Expressive · Unique</small>
            </div>

            <span class="template-label">CREATIVE STYLE</span>

            <h2>Creative Template</h2>

            <p>
              A creative design featuring purple gradients, bold typography, stylish icons, 
              and smooth animations for a unique, eye-catching portfolio.
            </p>

            <form
                action="{{ route('portfolios.choose', ['portfolio' => $portfolio->id], false) }}"
                method="POST"
            >
                @csrf

                <input type="hidden" name="template" value="creative">

                <button type="submit" class="choose-button">
                    Choose Creative &nbsp; →
                </button>
            </form>

        </div>

    </div>

    <a href="{{ route('portfolios.index', [], false) }}" class="back">
        &larr; Back to Manage Portfolios
    </a>

</div>

</body>
</html>