@extends('layouts.layoutmaster')
@section('title', 'Chi tiết sinh viên')

@section('content')
    <div class="mb-4">
        <h1><i class="bi bi-person-badge-fill text-primary"></i> Hồ sơ sinh viên</h1>
        <p class="subtitle mb-0">Thông tin chi tiết của sinh viên {{ $sinhvien->ho_ten }}</p>
    </div>

    <div class="detail-card" style="max-width: 800px;">
        <table class="table mb-4">
            <tr>
                <th style="width: 220px">ID</th>
                <td><code>#{{ $sinhvien->id }}</code></td>
            </tr>
            <tr>
                <th>Mã sinh viên</th>
                <td><code class="fs-6 text-cyan">{{ $sinhvien->ma_sv }}</code></td>
            </tr>
            <tr>
                <th>Họ và tên</th>
                <td><strong class="text-white fs-6">{{ $sinhvien->ho_ten }}</strong></td>
            </tr>
            <tr>
                <th>Lớp học</th>
                <td>
                    @if ($sinhvien->lopHoc)
                        <a href="{{ route('lophoc.show', $sinhvien->lopHoc) }}" class="fw-semibold text-info">
                            <i class="bi bi-mortarboard me-1"></i>{{ $sinhvien->lopHoc->ten_lop }} ({{ $sinhvien->lopHoc->ma_lop }})
                        </a>
                    @else
                        <span class="text-muted">Chưa phân lớp</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Tuổi</th>
                <td>
                    @if ($sinhvien->tuoi)
                        <span class="badge bg-dark border border-secondary text-light px-2 py-1">{{ $sinhvien->tuoi }} tuổi</span>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Giới tính</th>
                <td>
                    <span class="badge {{ $sinhvien->gioi_tinh === 'Nam' ? 'bg-primary' : ($sinhvien->gioi_tinh === 'Nữ' ? 'bg-danger' : 'bg-secondary') }} px-2 py-1">
                        {{ $sinhvien->gioi_tinh ?: 'Không rõ' }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Ngày sinh</th>
                <td>{{ $sinhvien->ngay_sinh ? $sinhvien->ngay_sinh->format('d/m/Y') : '—' }}</td>
            </tr>
            <tr>
                <th>Số điện thoại</th>
                <td>
                    @if ($sinhvien->so_dien_thoai)
                        <a href="tel:{{ $sinhvien->so_dien_thoai }}" class="text-decoration-none">
                            <i class="bi bi-telephone me-1"></i>{{ $sinhvien->so_dien_thoai }}
                        </a>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td>
                    @if ($sinhvien->email)
                        <a href="mailto:{{ $sinhvien->email }}" class="text-decoration-none">
                            <i class="bi bi-envelope me-1"></i>{{ $sinhvien->email }}
                        </a>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <td>{{ $sinhvien->dia_chi ?: '—' }}</td>
            </tr>
            <tr>
                <th>Trạng thái học tập</th>
                <td>
                    <span class="badge-status {{ $sinhvien->trang_thai ? 'badge-active' : 'badge-inactive' }}">
                        <i class="bi {{ $sinhvien->trang_thai ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }}"></i>
                        {{ $sinhvien->trang_thai ? 'Đang theo học' : 'Nghỉ học / Đã tốt nghiệp' }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Ngày tạo hồ sơ</th>
                <td class="text-muted">{{ $sinhvien->created_at ? $sinhvien->created_at->format('d/m/Y H:i') : '—' }}</td>
            </tr>
        </table>

        <div class="d-flex gap-2">
            <a href="{{ route('sinhvien.edit', $sinhvien) }}" class="btn btn-primary">
                <i class="bi bi-pencil-square"></i> Chỉnh sửa
            </a>
            <a href="{{ route('sinhvien.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại danh sách
            </a>
        </div>
    </div>
@endsection
