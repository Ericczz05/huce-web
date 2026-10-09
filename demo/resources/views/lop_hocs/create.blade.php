@extends('layouts.layoutmaster')
@section('title', 'Thêm lớp học')

@section('content')
    <div class="mb-4">
        <h1><i class="bi bi-plus-circle-fill text-primary"></i> Thêm lớp học</h1>
        <p class="subtitle mb-0">Điền thông tin chi tiết để tạo lớp học mới trong hệ thống</p>
    </div>

    <div class="form-card" style="max-width: 720px;">
        {{-- novalidate: tắt kiểm tra của trình duyệt để thấy rõ lỗi do server (Form Request) trả về --}}
        <form action="{{ route('lophoc.store') }}" method="POST" novalidate>
            @csrf
            @include('lop_hocs._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Thêm lớp học</button>
                <a href="{{ route('lophoc.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Quay lại</a>
            </div>
        </form>
    </div>
@endsection
