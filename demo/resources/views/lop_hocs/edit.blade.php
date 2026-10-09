@extends('layouts.layoutmaster')
@section('title', 'Sửa lớp học')

@section('content')
    <div class="mb-4">
        <h1><i class="bi bi-pencil-square text-primary"></i> Sửa lớp học: {{ $lopHoc->ten_lop }}</h1>
        <p class="subtitle mb-0">Cập nhật thông tin chi tiết của lớp học</p>
    </div>

    <div class="form-card" style="max-width: 720px;">
        <form action="{{ route('lophoc.update', $lopHoc) }}" method="POST" novalidate>
            @csrf
            @method('PUT')
            @include('lop_hocs._form', ['lopHoc' => $lopHoc])
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Cập nhật</button>
                <a href="{{ route('lophoc.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Quay lại</a>
            </div>
        </form>
    </div>
@endsection
