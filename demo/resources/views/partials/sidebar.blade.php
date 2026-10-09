@push('styles')
<style>
    .sidebar {
      background: rgba(13, 19, 33, 0.75);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-right: 1px solid rgba(255, 255, 255, 0.06);
      color: #cbd5e1;
      padding: 22px 14px;
    }

    .sidebar h3 {
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.2px;
      color: #64748b;
      padding: 0 12px;
      margin-top: 14px;
      margin-bottom: 8px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .sidebar h3::before {
      content: '';
      display: inline-block;
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: #06b6d4;
      box-shadow: 0 0 6px rgba(6, 182, 212, 0.6);
    }

    .sidebar ul {
      list-style: none;
      margin-bottom: 18px;
      padding-left: 0;
    }

    .sidebar li {
      margin-bottom: 3px;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      padding: 9px 14px;
      color: #94a3b8;
      text-decoration: none;
      font-size: 13.5px;
      font-weight: 500;
      border-radius: 8px;
      border-left: 3px solid transparent;
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
    }

    .sidebar a:hover {
      background: rgba(255, 255, 255, 0.06);
      color: #ffffff;
      border-left-color: rgba(99, 102, 241, 0.6);
      transform: translateX(3px);
    }

    .sidebar a.active {
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.9) 0%, rgba(139, 92, 246, 0.9) 100%);
      color: #ffffff;
      font-weight: 600;
      border-left-color: #06b6d4;
      box-shadow: 0 4px 14px rgba(99, 102, 241, 0.35);
      transform: translateX(3px);
    }
</style>
@endpush

<aside class="sidebar">
  {{-- Menu động lấy từ CSDL, gom theo nhóm --}}
  @foreach (collect($menuHienThi->get('sidebar', []))->groupBy('nhom') as $nhom => $menus)
    @if ($nhom !== '')
      <h3>{{ $nhom }}</h3>
    @endif
    <ul>
      @foreach ($menus as $menu)
        <li><a href="{{ $menu->url }}" @class(['active' => $menu->dangChon()])>{{ $menu->ten }}</a></li>
      @endforeach
    </ul>
  @endforeach
</aside>