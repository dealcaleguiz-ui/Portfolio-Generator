{{--
  =========================================================
  SHARE AND DOWNLOAD BUTTON (works in Simple, Modern, Creative)
  Save as: resources/views/partials/share-download.blade.php
  Add before </body> in each template:

      @include('partials.share-download')
  =========================================================
--}}

<style>
  /* =========================================
     COLORS
     Uses the template colors when they exist
  ========================================= */

  :root {
    --share-primary: var(--primary, #035A52);
    --share-accent: var(--lime, #D8E267);
  }

  /* =========================================
     FLOATING BUTTON AND MENU
  ========================================= */

  .share-download-widget {
    position: fixed;
    right: 24px;
    bottom: 24px;
    z-index: 9999;
    font-family: Arial, sans-serif;
  }

  .share-download-toggle {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 13px 20px;
    border: none;
    border-radius: 50px;
    background: var(--share-primary);
    color: white;
    font-size: 14px;
    font-weight: 700;
    box-shadow: 0 5px 18px rgba(0, 0, 0, .2);
    cursor: pointer;
    transition: transform .2s, background .2s;
  }

  .share-download-toggle:hover {
    background: var(--share-accent);
    color: #17352F;
    transform: translateY(-2px);
  }

  .share-download-menu {
    display: none;
    position: absolute;
    right: 0;
    bottom: 60px;
    width: 230px;
    padding: 8px;
    border: 1px solid rgba(0, 0, 0, .08);
    border-radius: 15px;
    background: white;
    box-shadow: 0 8px 30px rgba(0, 0, 0, .16);
  }

  .share-download-menu.open {
    display: block;
  }

  .share-download-menu button,
  .share-download-menu a {
    display: block;
    width: 100%;
    padding: 11px 12px;
    border: none;
    border-radius: 9px;
    background: transparent;
    color: #24332F;
    font-size: 13px;
    text-align: left;
    text-decoration: none;
    cursor: pointer;
  }

  .share-download-menu button:hover,
  .share-download-menu a:hover {
    background: #F0F5F1;
  }

  /* Small hint about the print window */
  .share-download-tip {
    margin: 6px 4px 2px;
    padding-top: 8px;
    border-top: 1px solid rgba(0, 0, 0, .08);
    color: #5A6B66;
    font-size: 11px;
    line-height: 1.5;
  }

  .share-download-message {
    display: none;
    margin-top: 8px;
    padding: 8px 12px;
    border-radius: 8px;
    background: #17352F;
    color: white;
    font-size: 12px;
    text-align: center;
  }

  .share-download-message.show {
    display: block;
  }

  @media (max-width: 480px) {
    .share-download-widget {
      right: 14px;
      bottom: 14px;
    }

    .share-download-toggle {
      padding: 12px 16px;
    }
  }

  /* =========================================
     PRINT / SAVE AS PDF
     Hides menus, keeps colors, and keeps each
     section together on one page when it fits
  ========================================= */

  @media print {

    /* Page margins for every PDF page */
    @page {
      margin: 10mm;
    }

    /* Hide menus, bars and the share button */
    .share-download-widget,
    .portfolio-navbar,
    .management-bar,
    .site-header,
    .navbar {
      display: none !important;
    }

    /* Keep all colors */
    * {
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }

    /* Stop sticky titles from overlapping content */
    .section-head {
      position: static !important;
    }

    /* Show every section that fades in on scroll (Creative template) */
    .js-reveal .reveal,
    .reveal {
      opacity: 1 !important;
      translate: none !important;
      animation: none !important;
    }

    /* Keep each section together on one page when it fits
       (a section taller than one page still continues normally) */
    section,
    .section,
    .hero,
    .hero-card,
    .about-layout,
    .about-grid,
    .about-panel,
    .personal-panel,
    .about-card,
    .about-side,
    .education-skills-layout,
    .education-container,
    .skills-container,
    .details,
    .details-grid,
    .skills-list,
    .skills,
    .contact-section,
    .contact-box,
    footer,
    .footer {
      break-inside: avoid;
      page-break-inside: avoid;
    }

    /* Never cut a single card or entry in half */
    .project,
    .entry,
    .experience-row,
    .project-row,
    .education-card,
    .skill-card,
    .skill-pill,
    .timeline-item,
    .detail-card,
    .project-card,
    .contact-item,
    .contact-social-item,
    .social-card {
      break-inside: avoid;
      page-break-inside: avoid;
    }

    /* Slightly tighter text so About Me fits on one page */
    .about-text {
      line-height: 1.7 !important;
    }

    /* Keep headings with the content that follows them */
    h1,
    h2,
    h3,
    h4,
    .section-heading,
    .section-head {
      break-after: avoid;
      page-break-after: avoid;
    }
  }
</style>

<div class="share-download-widget" id="shareDownloadWidget">
  <div class="share-download-menu" id="shareDownloadMenu">

    <button type="button" id="downloadPortfolioPdf">
      📄 Download as PDF
    </button>

    <button type="button" id="copyPortfolioLink">
      🔗 Copy Link
    </button>

    <button type="button" id="nativePortfolioShare" hidden>
      📱 Share...
    </button>

    <a id="shareFacebook" href="#" target="_blank" rel="noopener noreferrer">
      Facebook
    </a>

    <a id="shareLinkedIn" href="#" target="_blank" rel="noopener noreferrer">
      LinkedIn
    </a>

    <a id="shareX" href="#" target="_blank" rel="noopener noreferrer">
      X
    </a>

    <p class="share-download-tip">
      Tip for PDF: turn ON "Background graphics" and turn OFF "Headers and footers".
    </p>

  </div>

  <button
    type="button"
    class="share-download-toggle"
    id="shareDownloadToggle"
    aria-expanded="false"
    aria-controls="shareDownloadMenu"
  >
    <span>↗</span>
    Share / Download
  </button>

  <div
    class="share-download-message"
    id="shareDownloadMessage"
    role="status"
    aria-live="polite"
  ></div>
</div>

<script>
(function () {
  const widget = document.getElementById('shareDownloadWidget');

  // Stop if the widget is missing or was already set up
  if (!widget || widget.dataset.initialized === 'true') {
    return;
  }

  widget.dataset.initialized = 'true';

  const toggle = document.getElementById('shareDownloadToggle');
  const menu = document.getElementById('shareDownloadMenu');
  const message = document.getElementById('shareDownloadMessage');
  const copyButton = document.getElementById('copyPortfolioLink');
  const pdfButton = document.getElementById('downloadPortfolioPdf');
  const nativeShareButton = document.getElementById('nativePortfolioShare');

  // Public link of this portfolio (anyone can open it without logging in)
  const portfolioUrl = @json(isset($portfolio) ? url('/p/' . $portfolio->id) : url()->current());
  const portfolioTitle = document.title || 'My Portfolio';

  // Create the social media sharing links
  document.getElementById('shareFacebook').href =
    'https://www.facebook.com/sharer/sharer.php?u=' +
    encodeURIComponent(portfolioUrl);

  document.getElementById('shareLinkedIn').href =
    'https://www.linkedin.com/sharing/share-offsite/?url=' +
    encodeURIComponent(portfolioUrl);

  document.getElementById('shareX').href =
    'https://twitter.com/intent/tweet?url=' +
    encodeURIComponent(portfolioUrl) +
    '&text=' + encodeURIComponent(portfolioTitle);

  // Show the native share option only when the device supports it
  if (navigator.share) {
    nativeShareButton.hidden = false;
  }

  // Open and close the menu
  toggle.addEventListener('click', function () {
    const isOpen = menu.classList.toggle('open');

    toggle.setAttribute('aria-expanded', String(isOpen));
  });

  // Small message shown after copying the link
  function showMessage(text) {
    message.textContent = text;
    message.classList.add('show');

    window.setTimeout(function () {
      message.classList.remove('show');
    }, 2500);
  }

  // Copy the portfolio link
  copyButton.addEventListener('click', async function () {
    try {
      if (navigator.clipboard && window.isSecureContext) {
        await navigator.clipboard.writeText(portfolioUrl);
      } else {
        const temporaryInput = document.createElement('textarea');

        temporaryInput.value = portfolioUrl;
        temporaryInput.style.position = 'fixed';
        temporaryInput.style.opacity = '0';

        document.body.appendChild(temporaryInput);
        temporaryInput.select();

        const copied = document.execCommand('copy');
        temporaryInput.remove();

        if (!copied) {
          throw new Error('Copy failed');
        }
      }

      showMessage('Link copied!');
    } catch (error) {
      showMessage('Unable to copy. Please copy the URL from your browser.');
    }
  });

  // Open the print window so the user can save as PDF
  pdfButton.addEventListener('click', function () {
    menu.classList.remove('open');
    toggle.setAttribute('aria-expanded', 'false');

    window.print();
  });

  // Use the phone or browser share menu
  nativeShareButton.addEventListener('click', async function () {
    if (!navigator.share) {
      return;
    }

    try {
      await navigator.share({
        title: portfolioTitle,
        url: portfolioUrl
      });
    } catch (error) {
      if (error.name !== 'AbortError') {
        showMessage('Unable to open the sharing menu.');
      }
    }
  });

  // Close the menu when clicking outside it
  document.addEventListener('click', function (event) {
    if (!widget.contains(event.target)) {
      menu.classList.remove('open');
      toggle.setAttribute('aria-expanded', 'false');
    }
  });
})();
</script>