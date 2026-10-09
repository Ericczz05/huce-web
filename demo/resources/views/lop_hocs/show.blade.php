@extends('layouts.layoutmaster')
@section('title', 'Chi tiết lớp học')

@section('content')
    <div class="mb-4">
        <h1><i class="bi bi-info-circle-fill text-primary"></i> Chi tiết lớp học</h1>
        <p class="subtitle mb-0">Thông tin chi tiết của lớp học {{ $lopHoc->ten_lop }}</p>
    </div>

    <div class="detail-card" style="max-width: 860px;">
        <table class="table mb-4">
            <tr><th style="width: 220px">ID</th><td><code>#{{ $lopHoc->id }}</code></td></tr>
            <tr><th>Tên lớp</th><td><strong>{{ $lopHoc->ten_lop }}</strong></td></tr>
            <tr><th>Mã lớp</th><td><code>{{ $lopHoc->ma_lop }}</code></td></tr>
            <tr><th>Giáo viên</th><td>{{ $lopHoc->giao_vien }}</td></tr>
            <tr><th>Số điện thoại GVCN</th><td>{{ $lopHoc->so_dien_thoai_gvcn ?: '—' }}</td></tr>
            <tr><th>Ghi chú</th><td>{{ $lopHoc->ghi_chu ?: '—' }}</td></tr>
            <tr><th>Sĩ số kế hoạch</th><td><strong class="text-info">{{ $lopHoc->si_so }}</strong> học viên</td></tr>
            <tr><th>Số sinh viên thực tế</th><td><strong class="text-cyan">{{ $lopHoc->sinhViens->count() }}</strong> sinh viên</td></tr>
            <tr>
                <th>Trạng thái</th>
                <td>
                    <span class="badge-status {{ $lopHoc->trang_thai ? 'badge-active' : 'badge-inactive' }}">
                        <i class="bi {{ $lopHoc->trang_thai ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }}"></i>
                        {{ $lopHoc->trang_thai ? 'Hoạt động' : 'Không hoạt động' }}
                    </span>
                </td>
            </tr>
        </table>

        @if ($lopHoc->sinhViens->count() > 0)
            <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                <h5 class="text-white mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-people-fill text-info"></i> Danh sách sinh viên thuộc lớp ({{ $lopHoc->sinhViens->count() }})
                </h5>
                <div class="table-responsive mb-4">
                    <table>
                        <thead>
                            <tr>
                                <th>Mã SV</th>
                                <th>Họ và tên</th>
                                <th>Tuổi</th>
                                <th>Liên hệ</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lopHoc->sinhViens as $sv)
                                <tr>
                                    <td><code>{{ $sv->ma_sv }}</code></td>
                                    <td><strong class="text-white">{{ $sv->ho_ten }}</strong></td>
                                    <td>{{ $sv->tuoi ? $sv->tuoi . ' tuổi' : '—' }}</td>
                                    <td>{{ $sv->so_dien_thoai ?: $sv->email ?: '—' }}</td>
                                    <td>
                                        <span class="badge-status {{ $sv->trang_thai ? 'badge-active' : 'badge-inactive' }}">
                                            {{ $sv->trang_thai ? 'Đang học' : 'Nghỉ học' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('sinhvien.show', $sv) }}" class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i> Xem
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <div class="d-flex gap-2">
            <a href="{{ route('lophoc.edit', $lopHoc) }}" class="btn btn-primary">
                <i class="bi bi-pencil-square"></i> Sửa
            </a>
            <a href="{{ route('sinhvien.create') }}?lop_hoc_id={{ $lopHoc->id }}" class="btn btn-outline-primary">
                <i class="bi bi-person-plus-fill"></i> Thêm SV vào lớp
            </a>
            <a href="{{ route('lophoc.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>
@endsection
