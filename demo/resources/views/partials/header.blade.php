@push('styles')
<style>
    .header {
      background: rgba(13, 19, 33, 0.88);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 28px;
      position: sticky;
      top: 0;
      z-index: 50;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.35);
    }

    .header .logo {
      display: flex;
      align-items: center;
      gap: 2px;
      font-size: 20px;
      font-weight: 800;
      letter-spacing: 0.5px;
      text-decoration: none;
      color: #ffffff;
      user-select: none;
    }

    .header .logo span {
      color: var(--c-accent, #06b6d4);
      font-weight: 700;
      text-shadow: 0 0 12px rgba(6, 182, 212, 0.45);
    }

    .header nav ul {
      display: flex;
      align-items: center;
      gap: 10px;
      list-style: none;
      margin-bottom: 0;
      padding-left: 0;
    }

    .header nav a {
      color: #94a3b8;
      text-decoration: none;
      font-size: 13.5px;
      font-weight: 600;
      padding: 7px 14px;
      border-radius: 8px;
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .header nav a:hover,
    .header nav a:focus {
      color: #ffffff;
      background: rgba(255, 255, 255, 0.08);
      box-shadow: 0 0 12px rgba(99, 102, 241, 0.2);
    }
</style>
@endpush

<header class="header">
  <div class="logo">HUCE<span>.Web</span></div>

  <nav>
    <ul>
      @foreach ($menuHienThi->get('header', []) as $menu)
        <li><a href="{{ $menu->url }}">{{ $menu->ten }}</a></li>
      @endforeach
    </ul>
  </nav>
</header>