<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Portfolios | PortfolioGen</title>

    <style>
        :root {
            --primary: #4D52B4;
            --primary-dark: #383D91;
            --sky-blue: #4E9CE8;
            --turquoise: #70D6C5;
            --pale-green: #CAE5BC;
            --soft-cream: #E1EDD4;
            --panel: #FAFCF7;
            --text: #24364B;
            --muted: #718096;
            --border: #D8E8D0;
            --danger: #E45D68;
        }

        * {
            box-sizing: border-box;
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

        .container {
            max-width: 1050px;
            margin: auto;
            padding: 38px;
            background: rgba(250, 252, 247, 0.97);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 28px;
            box-shadow:
                0 15px 40px rgba(36, 54, 75, 0.12),
                0 0 25px rgba(78, 156, 232, 0.12);
        }

        /* HEADER */

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .header-icon {
            width: 65px;
            height: 65px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            background: linear-gradient(
                145deg,
                #FFFFFF,
                #E1EDD4
            );
            color: var(--primary);
            font-size: 30px;
            box-shadow: 0 6px 18px rgba(77, 82, 180, 0.12);
            flex-shrink: 0;
        }

        h1 {
            margin: 0;
            font-size: 32px;
            line-height: 1.3;
            background: linear-gradient(
                100deg,
                var(--primary),
                var(--sky-blue)
            );
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .subtitle {
            color: var(--muted);
            margin: 8px 0 0;
            font-size: 15px;
            line-height: 1.6;
        }

        /* BUTTONS */

        .button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 9px;
            padding: 13px 20px;
            border: none;
            border-radius: 30px;
            background: linear-gradient(
                110deg,
                var(--primary),
                var(--sky-blue),
                var(--turquoise)
            );
            color: white;
            text-decoration: none;
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 6px 15px rgba(77, 82, 180, 0.18);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 9px 20px rgba(77, 82, 180, 0.25);
        }

        .create-button {
            white-space: nowrap;
        }

        /* SUCCESS MESSAGE */

        .success-message {
            padding: 15px 18px;
            margin-bottom: 25px;
            border: 1px solid #B8DEC3;
            border-radius: 12px;
            background: #F0F9F1;
            color: #327A4B;
            font-size: 14px;
            line-height: 1.5;
        }

        /* PORTFOLIO CARD */

        .portfolio {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 22px;
            padding: 23px;
            margin-bottom: 17px;
            border: 1px solid #D7E9F4;
            border-radius: 20px;
            background: linear-gradient(
                145deg,
                #FFFFFF,
                #F5FAF7
            );
            box-shadow: 0 5px 16px rgba(50, 85, 120, 0.07);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .portfolio:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 23px rgba(50, 85, 120, 0.12);
        }

        .portfolio-info {
            flex: 1;
            min-width: 0;
        }

        .portfolio h2 {
            color: var(--primary);
            font-size: 21px;
            margin: 0 0 13px;
            overflow-wrap: anywhere;
        }

        .detail {
            margin: 8px 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .detail strong {
            color: var(--text);
            font-weight: 600;
        }

        .template-badge {
            display: inline-block;
            padding: 5px 12px;
            margin-left: 5px;
            border-radius: 20px;
            background: #E7F1FF;
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
        }

        /* ACTION BUTTONS */

        .actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;
            flex-wrap: wrap;
            padding-left: 20px;
            border-left: 1px solid #E0E8ED;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 14px;
            border: 1px solid transparent;
            border-radius: 10px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease;
            white-space: nowrap;
        }

        .action-button:hover {
            transform: translateY(-2px);
        }

        .edit-button {
            color: var(--sky-blue);
            background: #F2F8FF;
            border-color: #B9D9FA;
        }

        .edit-button:hover {
            background: #E2F0FF;
        }

        .view-button {
            color: white;
            background: linear-gradient(
                110deg,
                var(--sky-blue),
                var(--turquoise)
            );
        }

        .delete-button {
            color: var(--danger);
            background: #FFF5F5;
            border-color: #F5C4C8;
        }

        .delete-button:hover {
            background: #FFE8EA;
        }

        /* EMPTY STATE */

        .empty {
            text-align: center;
            padding: 45px 20px;
            margin-top: 15px;
            border: 1px dashed #A8DCCB;
            border-radius: 20px;
            background: linear-gradient(
                145deg,
                #F8FCF6,
                #EFF8F0
            );
        }

        .empty-icon {
            width: 75px;
            height: 75px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: linear-gradient(
                145deg,
                #E1EDD4,
                #D2F2E8
            );
            font-size: 34px;
        }

        .empty h2 {
            color: var(--text);
            font-size: 22px;
            margin: 0 0 10px;
        }

        .empty p {
            max-width: 390px;
            margin: 0 auto 22px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        /* FOOTER */

        .footer {
            text-align: center;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #E2EBDD;
        }

        .back-link {
            color: var(--sky-blue);
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--primary);
        }

        /* RESPONSIVE DESIGN */

        @media (max-width: 800px) {
            body {
                padding: 22px 12px;
            }

            .container {
                padding: 25px 18px;
                border-radius: 22px;
            }

            .header {
                align-items: flex-start;
            }

            h1 {
                font-size: 26px;
            }

            .portfolio {
                align-items: stretch;
                flex-direction: column;
                gap: 18px;
            }

            .actions {
                justify-content: flex-start;
                padding-left: 0;
                padding-top: 17px;
                border-left: none;
                border-top: 1px solid #E0E8ED;
            }
        }

        @media (max-width: 480px) {
            .header-content {
                align-items: flex-start;
                gap: 12px;
            }

            .header-icon {
                width: 48px;
                height: 48px;
                border-radius: 14px;
                font-size: 23px;
            }

            h1 {
                font-size: 23px;
            }

            .subtitle {
                font-size: 13px;
            }

            .create-button {
                width: 100%;
            }

            .portfolio {
                padding: 18px;
            }

            .portfolio h2 {
                font-size: 19px;
            }

            .actions {
                gap: 8px;
            }

            .action-button {
                padding: 10px 12px;
                font-size: 12px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition: none !important;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->

    <div class="header">

        <div class="header-content">

            <div class="header-icon" aria-hidden="true">
                📁
            </div>

            <div>
                <h1>Manage Your Portfolios</h1>

                <p class="subtitle">
                    View and manage your saved portfolio information.
                </p>
            </div>

        </div>

        <a href="{{ route('portfolios.create') }}" class="button create-button">
            <span aria-hidden="true">＋</span>
            Create New Portfolio
        </a>

    </div>

    <!-- SUCCESS MESSAGE -->

    @if (session('ok'))
        <div class="success-message" role="status">
            ✓ {{ session('ok') }}
        </div>
    @endif

    <!-- PORTFOLIO LIST -->

    @forelse ($portfolios as $portfolio)

        <div class="portfolio">

            <div class="portfolio-info">

                <h2>{{ $portfolio->full_name }}</h2>

                <p class="detail">
                    ✉️ &nbsp;
                    <strong>Email:</strong>
                    {{ $portfolio->email }}
                </p>

                <p class="detail">
                    🎨 &nbsp;
                    <strong>Selected Template:</strong>

                    <span class="template-badge">
                        {{ $portfolio->template ?? 'Not selected yet' }}
                    </span>
                </p>

            </div>

            <!-- PORTFOLIO ACTIONS -->

            <div class="actions">

                <a
                    href="{{ route('portfolios.edit', $portfolio, false) }}"
                    class="action-button edit-button"
                >
                    ✏️ Edit
                </a>

                <a
                    href="{{ route('portfolios.templates', ['portfolio' => $portfolio->id], false) }}"
                    class="action-button view-button"
                >
                    👁 View Portfolio
                </a>

                <form
                    action="{{ route('portfolios.destroy', $portfolio) }}"
                    method="POST"
                    style="display: inline;"
                    onsubmit="return confirm('Are you sure you want to delete this portfolio? This action cannot be undone.')"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="action-button delete-button"
                    >
                        🗑 Delete
                    </button>
                </form>

            </div>

        </div>

    @empty

        <!-- EMPTY STATE -->

        <div class="empty">

            <div class="empty-icon" aria-hidden="true">
                📂
            </div>

            <h2>No Portfolios Yet</h2>

            <p>
                You haven't created any portfolios yet.
                Start building your personal portfolio by clicking
                the button below.
        
            </p>
        </div>

    @endforelse

    <!-- FOOTER -->

    <div class="footer">

        <a href="{{ route('home') }}" class="back-link">
            ← Back to Home
        </a>

    </div>

</div>

</body>
</html>