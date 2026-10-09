@extends('layouts.layoutmaster')
@section('title', 'Sửa thông tin sinh viên')

@section('content')
    <div class="mb-4">
        <h1><i class="bi bi-pencil-square text-primary"></i> Sửa thông tin: {{ $sinhvien->ho_ten }}</h1>
        <p class="subtitle mb-0">Cập nhật hồ sơ thông tin sinh viên mã {{ $sinhvien->ma_sv }}</p>
    </div>

    <div class="form-card" style="max-width: 820px;">
        <form method="POST" action="{{ route('sinhvien.update', $sinhvien) }}" novalidate>
            @csrf
            @method('PUT')
            @include('sinhvien._form', ['sinhvien' => $sinhvien])

            <div class="d-flex gap-2 mt-4 pt-2 border-top border-secondary border-opacity-25">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i> Cập nhật thông tin
                </button>
                <a href="{{ route('sinhvien.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </form>
    </div>
@endsection
