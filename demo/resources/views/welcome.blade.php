@extends('layouts.layoutmaster')
@section('title', 'Bảng điều khiển')

@php
    $soLopHoc = 0;
    $soMenu = 0;
    $soSinhVien = 0;
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('lop_hocs')) {
            $soLopHoc = \App\Models\LopHoc::count();
        }
        if (\Illuminate\Support\Facades\Schema::hasTable('menus')) {
            $soMenu = \App\Models\Menu::count();
        }
        if (\Illuminate\Support\Facades\Schema::hasTable('sinh_viens')) {
            $soSinhVien = \App\Models\SinhVien::count();
        }
    } catch (\Throwable $e) {
        // Fallback
    }
@endphp

@section('content')
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1>
                    <i class="bi bi-speedometer2 text-primary"></i> 
                    Hệ thống Quản lý Đào tạo HUCE
                </h1>
                <p class="subtitle mb-0">Hệ thống thông tin quản lý đào tạo và điều hướng trực tuyến</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge-status badge-active">
                    <i class="bi bi-activity"></i> Hệ thống sẵn sàng
                </span>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted" style="font-size: 13px; font-weight: 600; text-transform: uppercase;">Quản lý lớp học</span>
                    <span class="p-2 rounded-3" style="background: rgba(99, 102, 241, 0.15); color: #818cf8;">
                        <i class="bi bi-mortarboard fs-5"></i>
                    </span>
                </div>
                <h3 class="fw-bold text-white mb-2">{{ $soLopHoc }}</h3>
                <p class="text-muted mb-3" style="font-size: 13px;">Tổng số lớp học đang quản trị trong cơ sở dữ liệu.</p>
                <a href="{{ route('lophoc.index') }}" class="btn btn-sm btn-primary align-self-start">
                    Truy cập lớp học <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted" style="font-size: 13px; font-weight: 600; text-transform: uppercase;">Quản trị Menu</span>
                    <span class="p-2 rounded-3" style="background: rgba(6, 182, 212, 0.15); color: #22d3ee;">
                        <i class="bi bi-menu-app fs-5"></i>
                    </span>
                </div>
                <h3 class="fw-bold text-white mb-2">{{ $soMenu }}</h3>
                <p class="text-muted mb-3" style="font-size: 13px;">Mục điều hướng trên Header và Sidebar.</p>
                <a href="{{ route('menu.index') }}" class="btn btn-sm btn-primary align-self-start">
                    Cấu hình menu <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted" style="font-size: 13px; font-weight: 600; text-transform: uppercase;">Sinh viên</span>
                    <span class="p-2 rounded-3" style="background: rgba(16, 185, 129, 0.15); color: #34d399;">
                        <i class="bi bi-people fs-5"></i>
                    </span>
                </div>
                <h3 class="fw-bold text-white mb-2">{{ $soSinhVien }}</h3>
                <p class="text-muted mb-3" style="font-size: 13px;">Tổng số hồ sơ sinh viên đang quản lý trong hệ thống.</p>
                <a href="{{ route('sinhvien.index') }}" class="btn btn-sm btn-primary align-self-start">
                    Quản lý sinh viên <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Feature Info Grid -->
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="form-card mb-0">
                <h4 class="text-white mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-shield-check text-info"></i> Hệ thống Quản trị & Điều hướng
                </h4>
                <p class="text-muted mb-4">
                    Giao diện được tái thiết kế theo phong cách <strong>Cyber Glassmorphism Hiện đại</strong> kết hợp tông màu trầm Dark Slate, hiệu ứng ánh sáng Neon Indigo và hệ thống phân cấp trực quan tinh tế, trong khi vẫn bảo toàn tuyệt đối <strong>bố cục CSS Grid kinh điển (Header - Sidebar - Content - Footer)</strong>.
                </p>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="p-3 rounded-3" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                            <div class="fw-bold text-white mb-1"><i class="bi bi-check2-circle text-success me-1"></i> Bố cục Layout</div>
                            <small class="text-muted">Giữ nguyên cấu trúc CSS Grid 2 cột + Header Sticky + Sidebar phân nhóm.</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 rounded-3" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                            <div class="fw-bold text-white mb-1"><i class="bi bi-palette2 text-primary me-1"></i> Phong cách mới</div>
                            <small class="text-muted">Dark Obsidian & Cyber-Indigo, hiệu ứng kính mờ và tương tác vi mô mượt mà.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-card mb-0">
                <h4 class="text-white mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-lightning-charge text-warning"></i> Thao tác nhanh
                </h4>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('lophoc.create') }}" class="btn btn-outline-secondary justify-content-start w-100">
                        <i class="bi bi-plus-circle me-2 text-primary"></i> Thêm lớp học mới
                    </a>
                    <a href="{{ route('menu.create') }}" class="btn btn-outline-secondary justify-content-start w-100">
                        <i class="bi bi-plus-square me-2 text-info"></i> Thêm mục menu mới
                    </a>
                    <a href="{{ url('/sinhvien/create') }}" class="btn btn-outline-secondary justify-content-start w-100">
                        <i class="bi bi-person-plus me-2 text-success"></i> Thêm hồ sơ sinh viên
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
