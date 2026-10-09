@extends('layouts.layoutmaster')
@section('title', 'Thêm sinh viên mới')

@section('content')
    <div class="mb-4">
        <h1><i class="bi bi-person-plus-fill text-primary"></i> Thêm sinh viên mới</h1>
        <p class="subtitle mb-0">Nhập đầy đủ thông tin để tạo hồ sơ sinh viên trong hệ thống quản lý</p>
    </div>

    <div class="form-card" style="max-width: 820px;">
        <form method="POST" action="{{ route('sinhvien.store') }}" novalidate>
            @csrf
            @include('sinhvien._form')

            <div class="d-flex gap-2 mt-4 pt-2 border-top border-secondary border-opacity-25">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i> Lưu sinh viên
                </button>
                <a href="{{ route('sinhvien.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </form>
    </div>
@endsection
