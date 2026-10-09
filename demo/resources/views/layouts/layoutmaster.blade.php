<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  
  <!-- Local Offline Fonts: Plus Jakarta Sans & JetBrains Mono -->
  <link rel="stylesheet" href="{{ asset('vendor/fonts/fonts.css') }}">
  
  <!-- Local Offline Bootstrap 5 & Bootstrap Icons -->
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --sidebar-width: 260px;
      --header-height: 68px;
      --footer-height: 56px;

      /* Dark Tech Cyber-Glassmorphism Palette */
      --c-bg: #090d16;
      --c-surface: #111827;
      --c-surface-card: rgba(17, 24, 39, 0.78);
      --c-border: rgba(255, 255, 255, 0.08);
      --c-border-glow: rgba(99, 102, 241, 0.4);

      --c-header: rgba(13, 19, 33, 0.88);
      --c-sidebar: #0d1322;
      --c-content: #090d16;
      --c-footer: #070a12;

      --c-text: #f1f5f9;
      --c-text-muted: #94a3b8;
      --c-text-subtle: #64748b;

      --c-primary: #6366f1;
      --c-primary-hover: #4f46e5;
      --c-accent: #06b6d4;
      --c-purple: #8b5cf6;
      --c-success: #10b981;
      --c-danger: #f43f5e;
      --c-warning: #f59e0b;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #090d16;
    }
    ::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.15);
      border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: rgba(99, 102, 241, 0.5);
    }

    body {
      font-family: "Plus Jakarta Sans", system-ui, -apple-system, sans-serif;
      color: var(--c-text);
      background-color: var(--c-bg);
      background-image: 
        radial-gradient(circle at 10% 10%, rgba(99, 102, 241, 0.12) 0%, transparent 45%),
        radial-gradient(circle at 90% 20%, rgba(6, 182, 212, 0.08) 0%, transparent 40%),
        radial-gradient(circle at 50% 95%, rgba(139, 92, 246, 0.08) 0%, transparent 45%);
      background-attachment: fixed;
      line-height: 1.6;
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* Grid Layout - Giữ nguyên kiến trúc bố cục */
    .layout {
      display: grid;
      grid-template-areas:
        "header  header"
        "sidebar content"
        "footer  footer";
      grid-template-columns: var(--sidebar-width) 1fr;
      grid-template-rows: var(--header-height) 1fr auto;
      min-height: 100vh;
    }

    .header  { grid-area: header; }
    .sidebar { grid-area: sidebar; }
    .content { grid-area: content; }
    .footer  { grid-area: footer; }

    /* ============================================================
       CONTENT STYLING (Modern High-Tech Glass Theme)
       ============================================================ */
    .content {
      background: transparent;
      padding: 32px 38px;
      min-width: 0;
    }

    .content h1 {
      font-size: 26px;
      font-weight: 800;
      letter-spacing: -0.5px;
      color: #ffffff;
      margin-bottom: 8px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .content .subtitle {
      color: var(--c-text-muted);
      font-size: 14px;
      margin-bottom: 24px;
    }

    .content h2 {
      font-size: 18px;
      font-weight: 700;
      margin: 24px 0 12px;
      color: #e2e8f0;
    }

    .content p {
      color: var(--c-text-muted);
      margin-bottom: 14px;
    }

    /* Card Box / Form Card */
    .form-card, .detail-card {
      background: var(--c-surface-card);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border: 1px solid var(--c-border);
      border-radius: 14px;
      padding: 28px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
      margin-bottom: 24px;
    }

    /* Grid cards */
    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 18px;
      margin-top: 18px;
    }

    .card {
      border: 1px solid var(--c-border);
      border-radius: 12px;
      padding: 20px;
      background: var(--c-surface-card);
      backdrop-filter: blur(12px);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
      transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
      transform: translateY(-3px);
      border-color: var(--c-border-glow);
      box-shadow: 0 8px 28px rgba(99, 102, 241, 0.15);
    }

    .card h4 {
      color: #f8fafc;
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .card p {
      font-size: 13px;
      color: var(--c-text-muted);
      margin: 0;
    }

    /* Global Table Theme */
    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      background: rgba(17, 24, 39, 0.7);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid var(--c-border);
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 8px 28px rgba(0, 0, 0, 0.3);
      margin-top: 16px;
      margin-bottom: 22px;
    }

    th {
      background: rgba(15, 23, 42, 0.88) !important;
      color: #94a3b8 !important;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      padding: 14px 18px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      white-space: nowrap;
    }

    th a {
      color: inherit;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      transition: color 0.2s;
    }

    th a:hover {
      color: var(--c-accent) !important;
    }

    td {
      padding: 14px 18px;
      color: #cbd5e1;
      font-size: 14px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      vertical-align: middle;
      transition: background-color 0.15s ease;
    }

    tr:last-child td {
      border-bottom: none;
    }

    tr:hover td {
      background-color: rgba(99, 102, 241, 0.07);
      color: #ffffff;
    }

    /* Filter Box Controls */
    .filter-box {
      background: var(--c-surface-card);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid var(--c-border);
      border-radius: 14px;
      padding: 20px 24px;
      margin-bottom: 20px;
      box-shadow: 0 6px 24px rgba(0, 0, 0, 0.25);
    }

    /* Forms */
    .form-label {
      font-size: 13px;
      font-weight: 600;
      color: #cbd5e1;
      margin-bottom: 6px;
    }

    .form-control, .form-select {
      background-color: rgba(15, 23, 42, 0.75) !important;
      border: 1px solid rgba(255, 255, 255, 0.12) !important;
      color: #f8fafc !important;
      border-radius: 9px;
      padding: 9px 14px;
      font-size: 14px;
      transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
      background-color: rgba(15, 23, 42, 0.95) !important;
      border-color: var(--c-primary) !important;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25) !important;
      color: #ffffff !important;
    }

    .form-control::placeholder {
      color: #64748b !important;
    }

    .form-text {
      color: #64748b !important;
      font-size: 12px;
      margin-top: 5px;
    }

    .invalid-feedback {
      color: #fb7185;
      font-size: 12.5px;
      margin-top: 5px;
    }

    .form-control.is-invalid, .form-select.is-invalid {
      border-color: #f43f5e !important;
      box-shadow: 0 0 0 2px rgba(244, 63, 94, 0.2) !important;
    }

    /* Buttons */
    .btn {
      font-weight: 600;
      font-size: 13.5px;
      border-radius: 9px;
      padding: 8px 18px;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      border: none;
      text-decoration: none;
    }

    .btn-primary {
      background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%) !important;
      color: #ffffff !important;
      box-shadow: 0 4px 14px rgba(99, 102, 241, 0.35);
    }

    .btn-primary:hover, .btn-primary:focus {
      background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%) !important;
      box-shadow: 0 6px 18px rgba(99, 102, 241, 0.5);
      transform: translateY(-1px);
      color: #ffffff !important;
    }

    .btn-outline-secondary {
      background: rgba(255, 255, 255, 0.05) !important;
      border: 1px solid rgba(255, 255, 255, 0.15) !important;
      color: #94a3b8 !important;
    }

    .btn-outline-secondary:hover {
      background: rgba(255, 255, 255, 0.1) !important;
      color: #ffffff !important;
      border-color: rgba(255, 255, 255, 0.25) !important;
    }

    .btn-danger {
      background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%) !important;
      color: #ffffff !important;
      box-shadow: 0 3px 10px rgba(244, 63, 94, 0.3);
    }

    .btn-danger:hover {
      background: linear-gradient(135deg, #e11d48 0%, #be123c 100%) !important;
      box-shadow: 0 5px 14px rgba(244, 63, 94, 0.45);
      transform: translateY(-1px);
    }

    .btn-secondary {
      background: rgba(51, 65, 85, 0.8) !important;
      color: #cbd5e1 !important;
    }

    .btn-secondary:hover {
      background: rgba(71, 85, 105, 0.95) !important;
      color: #ffffff !important;
    }

    .btn-sm {
      padding: 5px 12px;
      font-size: 12.5px;
      border-radius: 7px;
    }

    /* Alerts */
    .alert {
      border-radius: 12px;
      padding: 14px 20px;
      font-weight: 500;
      margin-bottom: 20px;
      border: 1px solid transparent;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .alert-success {
      background: rgba(16, 185, 129, 0.14) !important;
      border-color: rgba(16, 185, 129, 0.35) !important;
      color: #34d399 !important;
      box-shadow: 0 0 20px rgba(16, 185, 129, 0.12);
    }

    /* Pagination */
    .pagination {
      display: flex;
      gap: 6px;
      margin-top: 18px;
    }

    .page-item .page-link {
      background: rgba(17, 24, 39, 0.85);
      border: 1px solid rgba(255, 255, 255, 0.08);
      color: #94a3b8;
      border-radius: 8px;
      padding: 7px 14px;
      font-size: 13.5px;
      font-weight: 600;
      transition: all 0.2s;
    }

    .page-item.active .page-link {
      background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
      border-color: #6366f1;
      color: #ffffff;
      box-shadow: 0 0 14px rgba(99, 102, 241, 0.4);
    }

    .page-item .page-link:hover {
      background: rgba(30, 41, 59, 0.9);
      border-color: rgba(99, 102, 241, 0.4);
      color: #ffffff;
    }

    .page-item.disabled .page-link {
      background: rgba(15, 23, 42, 0.5);
      color: #475569;
      border-color: rgba(255, 255, 255, 0.04);
    }

    /* Badges & Code */
    code {
      background: rgba(99, 102, 241, 0.15);
      color: #38bdf8;
      padding: 3px 8px;
      border-radius: 6px;
      font-family: 'JetBrains Mono', monospace;
      font-size: 12.5px;
    }

    .badge-status {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 10px;
      border-radius: 999px;
      font-size: 12px;
      font-weight: 600;
    }
    .badge-active {
      background: rgba(16, 185, 129, 0.15);
      color: #34d399;
      border: 1px solid rgba(16, 185, 129, 0.3);
    }
    .badge-inactive {
      background: rgba(244, 63, 94, 0.15);
      color: #fb7185;
      border: 1px solid rgba(244, 63, 94, 0.3);
    }

    /* Responsive - Giữ nguyên layout responsive cũ */
    @media (max-width: 768px) {
      .layout {
        grid-template-areas:
          "header"
          "sidebar"
          "content"
          "footer";
        grid-template-columns: 1fr;
        grid-template-rows: auto auto 1fr auto;
      }

      .sidebar {
        padding: 12px 14px;
      }

      .sidebar ul {
        display: flex;
        overflow-x: auto;
        margin-bottom: 0;
        gap: 8px;
      }

      .sidebar h3 { display: none; }

      .sidebar a {
        white-space: nowrap;
      }

      .header {
        flex-direction: column;
        height: auto;
        padding: 14px 18px;
        gap: 12px;
        position: static;
      }

      .content {
        padding: 20px 16px;
      }
    }
  </style>
</head>

<body>
  <div class="layout">

    <!-- ---------- HEADER ---------- -->
    @include('partials.header')

    <!-- ---------- SIDEBAR ---------- -->
    @include('partials.sidebar')

    <!-- ---------- CONTENT ---------- -->
    <main class="content">
      @yield('content')
    </main>

    <!-- ---------- FOOTER ---------- -->
    @include('partials.footer')

  </div>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  @stack('styles')
</body>
</html>