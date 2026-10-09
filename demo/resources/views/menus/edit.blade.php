@extends('layouts.layoutmaster')
@section('title', 'Sửa menu')

@section('content')
    <div class="mb-4">
        <h1><i class="bi bi-pencil-square text-primary"></i> Sửa menu: {{ $menu->ten }}</h1>
        <p class="subtitle mb-0">Cập nhật thông tin mục điều hướng trong hệ thống</p>
    </div>

    <div class="form-card" style="max-width: 720px;">
        <form action="{{ route('menu.update', $menu) }}" method="POST" novalidate>
            @csrf
            @method('PUT')
            @include('menus._form', ['menu' => $menu])
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Cập nhật</button>
                <a href="{{ route('menu.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Quay lại</a>
            </div>
        </form>
    </div>
@endsection
