@extends('layouts.layoutmaster')
@section('title', 'Thêm menu')

@section('content')
    <div class="mb-4">
        <h1><i class="bi bi-plus-circle-fill text-primary"></i> Thêm menu</h1>
        <p class="subtitle mb-0">Thiết lập mục điều hướng mới cho ứng dụng</p>
    </div>

    <div class="form-card" style="max-width: 720px;">
        <form action="{{ route('menu.store') }}" method="POST" novalidate>
            @csrf
            @include('menus._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Thêm menu</button>
                <a href="{{ route('menu.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Quay lại</a>
            </div>
        </form>
    </div>
@endsection
