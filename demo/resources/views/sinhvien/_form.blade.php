@php($sinhvien = $sinhvien ?? null)

<div class="row g-3">
    <div class="col-md-6">
        <label for="ma_sv" class="form-label">Mã sinh viên <span class="text-danger">*</span></label>
        <input type="text" id="ma_sv" name="ma_sv"
               class="form-control @error('ma_sv') is-invalid @enderror"
               placeholder="Ví dụ: SV001, 68PM101..."
               value="{{ old('ma_sv', $sinhvien?->ma_sv) }}" required>
        <div class="form-text">Mã định danh duy nhất của sinh viên, tối đa 20 ký tự.</div>
        @error('ma_sv')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="ho_ten" class="form-label">Họ và tên <span class="text-danger">*</span></label>
        <input type="text" id="ho_ten" name="ho_ten"
               class="form-control @error('ho_ten') is-invalid @enderror"
               placeholder="Ví dụ: Nguyễn Văn A"
               value="{{ old('ho_ten', $sinhvien?->ho_ten ?? $sinhvien?->name) }}" required>
        @error('ho_ten')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="lop_hoc_id" class="form-label">Lớp học</label>
        <select id="lop_hoc_id" name="lop_hoc_id" class="form-select @error('lop_hoc_id') is-invalid @enderror">
            <option value="">-- Chọn lớp học --</option>
            @foreach ($lopHocs as $lop)
                <option value="{{ $lop->id }}" @selected(old('lop_hoc_id', $sinhvien?->lop_hoc_id ?? request('lop_hoc_id')) == $lop->id)>
                    {{ $lop->ten_lop }} ({{ $lop->ma_lop }})
                </option>
            @endforeach
        </select>
        @error('lop_hoc_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="tuoi" class="form-label">Tuổi</label>
        <input type="number" id="tuoi" name="tuoi" min="1" max="120"
               class="form-control @error('tuoi') is-invalid @enderror"
               placeholder="Ví dụ: 20"
               value="{{ old('tuoi', $sinhvien?->tuoi) }}">
        @error('tuoi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="gioi_tinh" class="form-label">Giới tính</label>
        <select id="gioi_tinh" name="gioi_tinh" class="form-select @error('gioi_tinh') is-invalid @enderror">
            <option value="Nam" @selected(old('gioi_tinh', $sinhvien?->gioi_tinh ?? 'Nam') === 'Nam')>Nam</option>
            <option value="Nữ" @selected(old('gioi_tinh', $sinhvien?->gioi_tinh) === 'Nữ')>Nữ</option>
            <option value="Khác" @selected(old('gioi_tinh', $sinhvien?->gioi_tinh) === 'Khác')>Khác</option>
        </select>
        @error('gioi_tinh')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="ngay_sinh" class="form-label">Ngày sinh</label>
        <input type="date" id="ngay_sinh" name="ngay_sinh"
               class="form-control @error('ngay_sinh') is-invalid @enderror"
               value="{{ old('ngay_sinh', $sinhvien?->ngay_sinh ? $sinhvien->ngay_sinh->format('Y-m-d') : '') }}">
        @error('ngay_sinh')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
        <input type="text" id="so_dien_thoai" name="so_dien_thoai"
               class="form-control @error('so_dien_thoai') is-invalid @enderror"
               placeholder="Ví dụ: 0912345678"
               value="{{ old('so_dien_thoai', $sinhvien?->so_dien_thoai) }}">
        @error('so_dien_thoai')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email"
               class="form-control @error('email') is-invalid @enderror"
               placeholder="Ví dụ: sinhvien@huce.edu.vn"
               value="{{ old('email', $sinhvien?->email) }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="trang_thai" class="form-label">Trạng thái <span class="text-danger">*</span></label>
        <select id="trang_thai" name="trang_thai" class="form-select @error('trang_thai') is-invalid @enderror">
            <option value="1" @selected(old('trang_thai', $sinhvien?->trang_thai ?? 1) == 1)>Đang học</option>
            <option value="0" @selected(old('trang_thai', $sinhvien?->trang_thai ?? 1) == 0)>Nghỉ học / Đã tốt nghiệp</option>
        </select>
        @error('trang_thai')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="dia_chi" class="form-label">Địa chỉ</label>
        <input type="text" id="dia_chi" name="dia_chi"
               class="form-control @error('dia_chi') is-invalid @enderror"
               placeholder="Địa chỉ cư trú hoặc quê quán"
               value="{{ old('dia_chi', $sinhvien?->dia_chi ?? $sinhvien?->diachi) }}">
        @error('dia_chi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
