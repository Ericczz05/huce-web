@extends('layouts.layoutmaster')
@section('title', 'Danh sách sinh viên')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h1><i class="bi bi-people-fill text-primary"></i> Danh sách sinh viên</h1>
            <p class="subtitle mb-0">Quản lý, tìm kiếm và theo dõi hồ sơ sinh viên trong hệ thống</p>
        </div>
        <a href="{{ route('sinhvien.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus-fill"></i> Thêm sinh viên
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    {{-- Bộ lọc tìm kiếm sinh viên --}}
    <form action="{{ route('sinhvien.index') }}" method="GET" class="filter-box">
        <input type="hidden" name="sort" value="{{ $sort }}">
        <input type="hidden" name="direction" value="{{ $direction }}">

        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="keyword" class="form-label"><i class="bi bi-search me-1"></i> Từ khóa</label>
                <input type="text" id="keyword" name="keyword" class="form-control"
                       placeholder="Họ tên, mã SV, email, SĐT..." value="{{ $filters['keyword'] ?? '' }}">
            </div>

            <div class="col-md-3">
                <label for="lop_hoc_id" class="form-label">Lớp học</label>
                <select id="lop_hoc_id" name="lop_hoc_id" class="form-select">
                    <option value="">Tất cả các lớp</option>
                    @foreach ($lopHocs as $lop)
                        <option value="{{ $lop->id }}" @selected(($filters['lop_hoc_id'] ?? '') == $lop->id)>
                            {{ $lop->ten_lop }} ({{ $lop->ma_lop }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="gioi_tinh" class="form-label">Giới tính</label>
                <select id="gioi_tinh" name="gioi_tinh" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="Nam" @selected(($filters['gioi_tinh'] ?? '') === 'Nam')>Nam</option>
                    <option value="Nữ" @selected(($filters['gioi_tinh'] ?? '') === 'Nữ')>Nữ</option>
                    <option value="Khác" @selected(($filters['gioi_tinh'] ?? '') === 'Khác')>Khác</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="trang_thai" class="form-label">Trạng thái</label>
                <select id="trang_thai" name="trang_thai" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="1" @selected(($filters['trang_thai'] ?? '') === '1')>Đang học</option>
                    <option value="0" @selected(($filters['trang_thai'] ?? '') === '0')>Nghỉ học</option>
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
                <a href="{{ route('sinhvien.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-counterclockwise"></i> Xóa lọc</a>
            </div>
        </div>
    </form>

    <div class="d-flex justify-content-between align-items-center mb-2">
        <p class="mb-0 text-muted" style="font-size: 13.5px;">
            Tìm thấy <strong class="text-white">{{ $sinhviens->total() }}</strong> sinh viên.
        </p>
    </div>

    @php
        $columns = [
            'id' => 'ID',
            'ma_sv' => 'Mã SV',
            'ho_ten' => 'Họ và tên',
            'lop_hoc' => 'Lớp học',
            'tuoi' => 'Tuổi',
            'gioi_tinh' => 'Giới tính',
            'lien_he' => 'Liên hệ',
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
                    <th style="width: 150px;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sinhviens as $sinhvien)
                    <tr>
                        <td><code>#{{ $sinhvien->id }}</code></td>
                        <td>
                            <a href="{{ route('sinhvien.show', $sinhvien) }}" class="fw-bold text-cyan text-decoration-none">
                                {{ $sinhvien->ma_sv }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('sinhvien.show', $sinhvien) }}" class="fw-semibold text-white text-decoration-none">
                                {{ $sinhvien->ho_ten }}
                            </a>
                        </td>
                        <td>
                            @if ($sinhvien->lopHoc)
                                <a href="{{ route('lophoc.show', $sinhvien->lopHoc) }}" class="text-decoration-none text-info">
                                    <i class="bi bi-mortarboard me-1"></i>{{ $sinhvien->lopHoc->ten_lop }}
                                </a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if ($sinhvien->tuoi)
                                <span class="badge bg-dark border border-secondary text-light px-2 py-1">{{ $sinhvien->tuoi }} tuổi</span>
                            @elseif ($sinhvien->ngay_sinh)
                                <span class="text-muted">{{ $sinhvien->ngay_sinh->format('d/m/Y') }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $sinhvien->gioi_tinh === 'Nam' ? 'bg-primary' : ($sinhvien->gioi_tinh === 'Nữ' ? 'bg-danger' : 'bg-secondary') }} px-2 py-1">
                                {{ $sinhvien->gioi_tinh ?: 'Nam' }}
                            </span>
                        </td>
                        <td>
                            <div style="font-size: 13px;">
                                @if ($sinhvien->so_dien_thoai)
                                    <div><i class="bi bi-telephone text-muted me-1"></i>{{ $sinhvien->so_dien_thoai }}</div>
                                @endif
                                @if ($sinhvien->email)
                                    <div><i class="bi bi-envelope text-muted me-1"></i>{{ $sinhvien->email }}</div>
                                @endif
                                @if (!$sinhvien->so_dien_thoai && !$sinhvien->email)
                                    <span class="text-muted">—</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="badge-status {{ $sinhvien->trang_thai ? 'badge-active' : 'badge-inactive' }}">
                                <i class="bi {{ $sinhvien->trang_thai ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }}"></i>
                                {{ $sinhvien->trang_thai ? 'Đang học' : 'Nghỉ học' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('sinhvien.show', $sinhvien) }}" class="btn btn-sm btn-outline-info" title="Xem chi tiết">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('sinhvien.edit', $sinhvien) }}" class="btn btn-sm btn-primary" title="Sửa">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('sinhvien.destroy', $sinhvien) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên {{ $sinhvien->ho_ten }} ({{ $sinhvien->ma_sv }}) không?')"
                                            title="Xóa">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + 1 }}" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Không có sinh viên nào phù hợp.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $sinhviens->links() }}
    </div>
@endsection