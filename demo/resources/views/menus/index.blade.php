@extends('layouts.layoutmaster')
@section('title', 'Quản lý menu')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h1><i class="bi bi-menu-button-wide-fill text-primary"></i> Quản lý menu</h1>
            <p class="subtitle mb-0">Quản lý cấu trúc điều hướng và hệ thống menu trên toàn bộ ứng dụng</p>
        </div>
        <a href="{{ route('menu.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Thêm menu
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <form action="{{ route('menu.index') }}" method="GET" class="filter-box">
        {{-- Giữ nguyên cột đang sắp xếp khi bấm Lọc --}}
        <input type="hidden" name="sort" value="{{ $sort }}">
        <input type="hidden" name="direction" value="{{ $direction }}">

        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="keyword" class="form-label"><i class="bi bi-search me-1"></i> Từ khóa</label>
                <input type="text" id="keyword" name="keyword" class="form-control"
                       placeholder="Tên menu, đường dẫn, nhóm..." value="{{ $filters['keyword'] ?? '' }}">
            </div>
            <div class="col-md-3">
                <label for="vi_tri" class="form-label">Vị trí</label>
                <select id="vi_tri" name="vi_tri" class="form-select">
                    <option value="">Tất cả</option>
                    @foreach (\App\Models\Menu::VI_TRI as $giaTri => $nhan)
                        <option value="{{ $giaTri }}" @selected(($filters['vi_tri'] ?? '') === $giaTri)>{{ $nhan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="trang_thai" class="form-label">Trạng thái</label>
                <select id="trang_thai" name="trang_thai" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="1" @selected(($filters['trang_thai'] ?? '') === '1')>Hiển thị</option>
                    <option value="0" @selected(($filters['trang_thai'] ?? '') === '0')>Ẩn</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="perPage" class="form-label">Số dòng / trang</label>
                <select id="perPage" name="perPage" class="form-select" onchange="this.form.submit()">
                    @foreach ($perPageOptions as $option)
                        <option value="{{ $option }}" @selected($perPage === $option)>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-funnel-fill"></i> Lọc</button>
                <a href="{{ route('menu.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-counterclockwise"></i> Xóa lọc</a>
            </div>
        </div>
    </form>

    <div class="d-flex justify-content-between align-items-center mb-2">
        <p class="mb-0 text-muted" style="font-size: 13.5px;">
            Tìm thấy <strong class="text-white">{{ $menus->total() }}</strong> menu.
        </p>
    </div>

    @php
        $columns = [
            'id' => 'ID',
            'ten' => 'Tên menu',
            'url' => 'Đường dẫn',
            'vi_tri' => 'Vị trí',
            'nhom' => 'Nhóm',
            'thu_tu' => 'Thứ tự',
            'trang_thai' => 'Trạng thái',
        ];
    @endphp

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    @foreach ($columns as $column => $label)
                        <th>
                            @if (in_array($column, $sortable))
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => $column,
                                    'direction' => $sort === $column && $direction === 'asc' ? 'desc' : 'asc',
                                    'page' => null,
                                ]) }}">
                                    {{ $label }}
                                    @if ($sort === $column)
                                        <span class="text-info">{{ $direction === 'asc' ? '▲' : '▼' }}</span>
                                    @endif
                                </a>
                            @else
                                {{ $label }}
                            @endif
                        </th>
                    @endforeach
                    <th style="width: 140px;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menus as $menu)
                    <tr>
                        <td><code>#{{ $menu->id }}</code></td>
                        <td><strong class="text-white">{{ $menu->ten }}</strong></td>
                        <td><code>{{ $menu->url }}</code></td>
                        <td>
                            <span class="badge bg-dark border border-secondary text-light">
                                {{ \App\Models\Menu::VI_TRI[$menu->vi_tri] ?? $menu->vi_tri }}
                            </span>
                        </td>
                        <td>{{ $menu->nhom ?: '—' }}</td>
                        <td><span class="badge bg-secondary">{{ $menu->thu_tu }}</span></td>
                        <td>
                            <span class="badge-status {{ $menu->trang_thai ? 'badge-active' : 'badge-inactive' }}">
                                <i class="bi {{ $menu->trang_thai ? 'bi-eye-fill' : 'bi-eye-slash-fill' }}"></i>
                                {{ $menu->trang_thai ? 'Hiển thị' : 'Ẩn' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('menu.edit', $menu) }}" class="btn btn-sm btn-primary" title="Sửa">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>
                                <form action="{{ route('menu.destroy', $menu) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa menu này không?')" title="Xóa">
                                        <i class="bi bi-trash3"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + 1 }}" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Không có menu nào phù hợp.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $menus->links() }}
    </div>
@endsection
