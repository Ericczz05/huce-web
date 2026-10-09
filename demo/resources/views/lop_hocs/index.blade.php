@extends('layouts.layoutmaster')
@section('title', 'Danh sách lớp học')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h1><i class="bi bi-mortarboard-fill text-primary"></i> Danh sách lớp học</h1>
            <p class="subtitle mb-0">Quản lý và theo dõi thông tin các lớp học trong hệ thống đào tạo</p>
        </div>
        <a href="{{ route('lophoc.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Thêm lớp học
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    {{-- Bộ lọc: form GET nên điều kiện lọc nằm trên URL, copy link gửi người khác vẫn ra đúng kết quả --}}
    <form action="{{ route('lophoc.index') }}" method="GET" class="filter-box">
        {{-- Giữ nguyên cột đang sắp xếp khi bấm Lọc --}}
        <input type="hidden" name="sort" value="{{ $sort }}">
        <input type="hidden" name="direction" value="{{ $direction }}">

        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="keyword" class="form-label"><i class="bi bi-search me-1"></i> Từ khóa</label>
                <input type="text" id="keyword" name="keyword" class="form-control"
                       placeholder="Tên lớp, mã lớp, giáo viên..." value="{{ $filters['keyword'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <label for="trang_thai" class="form-label">Trạng thái</label>
                <select id="trang_thai" name="trang_thai" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="1" @selected(($filters['trang_thai'] ?? '') === '1')>Hoạt động</option>
                    <option value="0" @selected(($filters['trang_thai'] ?? '') === '0')>Không hoạt động</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="si_so_min" class="form-label">Sĩ số từ</label>
                <input type="number" id="si_so_min" name="si_so_min" min="0" class="form-control"
                       value="{{ $filters['si_so_min'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <label for="si_so_max" class="form-label">đến</label>
                <input type="number" id="si_so_max" name="si_so_max" min="0" class="form-control"
                       value="{{ $filters['si_so_max'] ?? '' }}">
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
                <a href="{{ route('lophoc.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-counterclockwise"></i> Xóa lọc</a>
            </div>
        </div>
    </form>

    <div class="d-flex justify-content-between align-items-center mb-2">
        <p class="mb-0 text-muted" style="font-size: 13.5px;">
            Tìm thấy <strong class="text-white">{{ $lopHocs->total() }}</strong> lớp học.
        </p>
    </div>

    @php
        $columns = [
            'id' => 'ID',
            'ten_lop' => 'Tên lớp',
            'ma_lop' => 'Mã lớp',
            'giao_vien' => 'Giáo viên',
            'so_dien_thoai_gvcn' => 'Số điện thoại GVCN',
            'ghi_chu' => 'Ghi chú',
            'si_so' => 'Sĩ số',
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
                @forelse ($lopHocs as $lopHoc)
                    <tr>
                        <td><code>#{{ $lopHoc->id }}</code></td>
                        <td>
                            <a href="{{ route('lophoc.show', $lopHoc) }}" class="fw-semibold">
                                {{ $lopHoc->ten_lop }}
                            </a>
                        </td>
                        <td><code>{{ $lopHoc->ma_lop }}</code></td>
                        <td>{{ $lopHoc->giao_vien }}</td>
                        <td>{{ $lopHoc->so_dien_thoai_gvcn }}</td>
                        <td><span class="text-muted">{{ $lopHoc->ghi_chu ?: '—' }}</span></td>
                        <td><strong>{{ $lopHoc->si_so }}</strong></td>
                        <td>
                            <span class="badge-status {{ $lopHoc->trang_thai ? 'badge-active' : 'badge-inactive' }}">
                                <i class="bi {{ $lopHoc->trang_thai ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }}"></i>
                                {{ $lopHoc->trang_thai ? 'Hoạt động' : 'Không hoạt động' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('lophoc.edit', $lopHoc) }}" class="btn btn-sm btn-primary" title="Sửa">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>
                                <form action="{{ route('lophoc.destroy', $lopHoc) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa lớp học này không?')" title="Xóa">
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
                            Không có lớp học nào phù hợp.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $lopHocs->links() }}
    </div>
@endsection
