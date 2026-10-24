<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Register | PortfolioGen</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap"
        rel="stylesheet">

  <style>
    /* =========================================
       COLORS AND SETTINGS
       Change --card-bg to make the card more
       or less transparent (last number: 0 to 1)
    ========================================= */

    :root {
      --teal: #035A52;
      --teal-dark: #023F3A;
      --lime: #D8E267;
      --white: #FFFFFF;
      --text: #0F2420;
      --danger: #9E1C14;

      --card-bg: rgba(255, 255, 255, 0.30);
      --card-border: rgba(255, 255, 255, 0.60);
      --input-bg: rgba(255, 255, 255, 0.60);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* =========================================
       BACKGROUND IMAGE
       The picture must be saved at:
       public/images/login-bg.png
    ========================================= */

    body {
      min-height: 100vh;
      display: grid;
      place-items: center;
      padding: 24px;
      font-family: 'DM Sans', sans-serif;
      font-size: 15px;
      line-height: 1.7;
      color: var(--text);
      background:
        linear-gradient(rgba(2, 63, 58, .25), rgba(2, 63, 58, .25)),
        url('{{ asset('images/login-bg.png') }}') center / cover no-repeat fixed;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    /* =========================================
       TRANSPARENT (GLASS) CARD
    ========================================= */

    .register-card {
      width: min(100%, 430px);
      padding: 40px 36px;
      border: 1.5px solid var(--card-border);
      border-radius: 24px;
      background: var(--card-bg);
      -webkit-backdrop-filter: blur(14px);
      backdrop-filter: blur(14px);
      box-shadow: 0 20px 50px rgba(2, 63, 58, .25);
    }

    /* Logo and name */
    .brand {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 11px;
      margin-bottom: 24px;
      color: var(--teal-dark);
      font-family: 'Space Grotesk', sans-serif;
      font-size: 20px;
      font-weight: 700;
    }

    .brand-icon {
      width: 42px;
      height: 42px;
      display: grid;
      place-items: center;
      border: 2px solid var(--teal-dark);
      border-radius: 12px;
      background: var(--lime);
      color: var(--teal-dark);
    }

    .register-card h1 {
      margin-bottom: 4px;
      text-align: center;
      color: var(--teal-dark);
      font-family: 'Space Grotesk', sans-serif;
      font-size: 28px;
    }

    .form-subtitle {
      margin-bottom: 26px;
      text-align: center;
      color: var(--text);
      font-weight: 500;
    }

    /* =========================================
       MESSAGES
    ========================================= */

    .error-text {
      display: block;
      margin-top: 6px;
      color: var(--danger);
      font-size: 13px;
      font-weight: 700;
    }

    /* =========================================
       FORM FIELDS
    ========================================= */

    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      color: var(--teal-dark);
      font-size: 13px;
      font-weight: 700;
    }

    .input-wrap {
      position: relative;
    }

    .input-wrap input {
      width: 100%;
      padding: 13px 15px;
      border: 2px solid rgba(255, 255, 255, .7);
      border-radius: 12px;
      background: var(--input-bg);
      color: var(--text);
      font-family: inherit;
      font-size: 15px;
      transition: .2s;
    }

    .input-wrap input::placeholder {
      color: #4A5E59;
    }

    .input-wrap input:focus {
      outline: none;
      border-color: var(--teal);
      background: rgba(255, 255, 255, .9);
      box-shadow: 0 0 0 4px rgba(216, 226, 103, .6);
    }

    .input-wrap input.has-error {
      border-color: var(--danger);
    }

    /* Space for the Show / Hide button */
    .input-wrap input.has-toggle {
      padding-right: 70px;
    }

    /* Show / hide password button */
    .toggle-password {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      padding: 5px 10px;
      border: none;
      border-radius: 8px;
      background: rgba(3, 90, 82, .12);
      color: var(--teal-dark);
      font-family: inherit;
      font-size: 12px;
      font-weight: 700;
      cursor: pointer;
      transition: .2s;
    }

    .toggle-password:hover {
      background: var(--lime);
    }

    /* =========================================
       BUTTON AND LINKS
    ========================================= */

    .btn-register {
      width: 100%;
      margin-top: 6px;
      padding: 14px;
      border: 2px solid var(--teal-dark);
      border-radius: 12px;
      background: var(--teal);
      color: var(--white);
      font-family: inherit;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      transition: .25s;
    }

    .btn-register:hover {
      background: var(--lime);
      border-color: var(--lime);
      color: var(--teal-dark);
      transform: translateY(-3px);
    }

    .login-text {
      margin-top: 22px;
      text-align: center;
      color: var(--text);
      font-size: 14px;
      font-weight: 500;
    }

    .login-text a {
      color: var(--teal-dark);
      font-weight: 700;
      text-decoration: underline;
      text-decoration-color: var(--lime);
      text-decoration-thickness: 3px;
      text-underline-offset: 4px;
    }

    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 480px) {
      .register-card {
        padding: 30px 22px;
      }
    }
  </style>
</head>

<body>

  <main class="register-card">

    {{-- Logo --}}
    <a href="{{ url('/') }}" class="brand">
      <span class="brand-icon">P</span>
      <span>PortfolioGen</span>
    </a>

    <h1>Create account</h1>
    <p class="form-subtitle">Sign up to build your portfolio.</p>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      {{-- Name --}}
      <div class="form-group">
        <label for="name">Name</label>

        <div class="input-wrap">
          <input
            id="name"
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Your full name"
            class="{{ $errors->has('name') ? 'has-error' : '' }}"
            required
            autofocus
            autocomplete="name"
          >
        </div>

        @error('name')
          <span class="error-text">{{ $message }}</span>
        @enderror
      </div>

      {{-- Email --}}
      <div class="form-group">
        <label for="email">Email address</label>

        <div class="input-wrap">
          <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="you@example.com"
            class="{{ $errors->has('email') ? 'has-error' : '' }}"
            required
            autocomplete="username"
          >
        </div>

        @error('email')
          <span class="error-text">{{ $message }}</span>
        @enderror
      </div>

      {{-- Password --}}
      <div class="form-group">
        <label for="password">Password</label>

        <div class="input-wrap">
          <input
            id="password"
            type="password"
            name="password"
            placeholder="Create a password"
            class="has-toggle {{ $errors->has('password') ? 'has-error' : '' }}"
            required
            autocomplete="new-password"
          >

          <button type="button" class="toggle-password" data-target="password">
            Show
          </button>
        </div>

        @error('password')
          <span class="error-text">{{ $message }}</span>
        @enderror
      </div>

      {{-- Confirm password --}}
      <div class="form-group">
        <label for="password_confirmation">Confirm password</label>

        <div class="input-wrap">
          <input
            id="password_confirmation"
            type="password"
            name="password_confirmation"
            placeholder="Re-enter your password"
            class="has-toggle {{ $errors->has('password_confirmation') ? 'has-error' : '' }}"
            required
            autocomplete="new-password"
          >

          <button type="button" class="toggle-password" data-target="password_confirmation">
            Show
          </button>
        </div>

        @error('password_confirmation')
          <span class="error-text">{{ $message }}</span>
        @enderror
      </div>

      {{-- Submit --}}
      <button type="submit" class="btn-register">
        Register
      </button>

      {{-- Link back to login --}}
      <p class="login-text">
        Already registered?
        <a href="{{ route('login') }}">Log in</a>
      </p>

    </form>

  </main>

  <script>
    // Show or hide a password field when its button is clicked
    document.querySelectorAll('.toggle-password').forEach(function (button) {
      button.addEventListener('click', function () {
        const input = document.getElementById(button.dataset.target);
        const isHidden = input.type === 'password';

        input.type = isHidden ? 'text' : 'password';
        button.textContent = isHidden ? 'Hide' : 'Show';
      });
    });
  </script>

</body>
</html>