<?php

namespace Tests\Feature;

use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SinhVienTest extends TestCase
{
    use RefreshDatabase;

    private function taoLopHoc(): LopHoc
    {
        return LopHoc::create([
            'ten_lop' => 'Lớp 68PM1',
            'ma_lop' => '68PM1',
            'giao_vien' => 'Thầy Hoàng',
            'si_so' => 40,
            'trang_thai' => 1,
        ]);
    }

    private function duLieuHopLe(array $ghiDe = []): array
    {
        return array_merge([
            'ma_sv' => 'SV1001',
            'ho_ten' => 'Nguyễn Văn Test',
            'tuoi' => 20,
            'gioi_tinh' => 'Nam',
            'email' => 'test@huce.edu.vn',
            'so_dien_thoai' => '0987654321',
            'dia_chi' => '55 Giải Phóng, Hà Nội',
            'trang_thai' => 1,
        ], $ghiDe);
    }

    public function test_danh_sach_sinh_vien_hien_thi_duoc(): void
    {
        $response = $this->get(route('sinhvien.index'));
        $response->assertOk();
        $response->assertSee('Danh sách sinh viên');
    }

    public function test_form_them_moi_sinh_vien_hien_thi_duoc(): void
    {
        $response = $this->get(route('sinhvien.create'));
        $response->assertOk();
        $response->assertSee('Thêm sinh viên');
    }

    public function test_them_sinh_vien_hop_le(): void
    {
        $lop = $this->taoLopHoc();

        $data = $this->duLieuHopLe(['lop_hoc_id' => $lop->id]);

        $response = $this->post(route('sinhvien.store'), $data);
        $response->assertRedirect(route('sinhvien.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('sinh_viens', [
            'ma_sv' => 'SV1001',
            'ho_ten' => 'Nguyễn Văn Test',
            'lop_hoc_id' => $lop->id,
        ]);
    }

    public function test_them_sinh_vien_tu_dong_viet_hoa_ma_sv(): void
    {
        $data = $this->duLieuHopLe(['ma_sv' => 'svlower1']);

        $response = $this->post(route('sinhvien.store'), $data);
        $response->assertRedirect(route('sinhvien.index'));

        $this->assertDatabaseHas('sinh_viens', [
            'ma_sv' => 'SVLOWER1',
        ]);
    }

    public function test_form_rong_bao_loi_cac_truong_bat_buoc(): void
    {
        $response = $this->from(route('sinhvien.create'))
            ->post(route('sinhvien.store'), []);

        $response->assertRedirect(route('sinhvien.create'));
        $response->assertSessionHasErrors(['ma_sv', 'ho_ten', 'trang_thai']);
        $this->assertDatabaseCount('sinh_viens', 0);
    }

    public function test_khong_cho_trung_ma_sinh_vien(): void
    {
        SinhVien::create($this->duLieuHopLe(['ma_sv' => 'SVDUPLICATE']));

        $response = $this->from(route('sinhvien.create'))
            ->post(route('sinhvien.store'), $this->duLieuHopLe(['ma_sv' => 'SVDUPLICATE']));

        $response->assertSessionHasErrors('ma_sv');
        $this->assertDatabaseCount('sinh_viens', 1);
    }

    public function test_xem_chi_tiet_sinh_vien(): void
    {
        $lop = $this->taoLopHoc();
        $sinhVien = SinhVien::create($this->duLieuHopLe(['lop_hoc_id' => $lop->id]));

        $response = $this->get(route('sinhvien.show', $sinhVien));
        $response->assertOk();
        $response->assertSee($sinhVien->ho_ten);
        $response->assertSee($sinhVien->ma_sv);
        $response->assertSee($lop->ten_lop);
    }

    public function test_chinh_sua_sinh_vien_thanh_cong(): void
    {
        $sinhVien = SinhVien::create($this->duLieuHopLe());

        $updateData = $this->duLieuHopLe([
            'ho_ten' => 'Nguyễn Văn Đã Sửa',
            'tuoi' => 22,
        ]);

        $response = $this->put(route('sinhvien.update', $sinhVien), $updateData);
        $response->assertRedirect(route('sinhvien.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('sinh_viens', [
            'id' => $sinhVien->id,
            'ho_ten' => 'Nguyễn Văn Đã Sửa',
            'tuoi' => 22,
        ]);
    }

    public function test_xoa_sinh_vien_thanh_cong(): void
    {
        $sinhVien = SinhVien::create($this->duLieuHopLe());

        $response = $this->from(route('sinhvien.index'))
            ->delete(route('sinhvien.destroy', $sinhVien));

        $response->assertRedirect(route('sinhvien.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('sinh_viens', ['id' => $sinhVien->id]);
    }

    public function test_loc_va_tim_kiem_sinh_vien(): void
    {
        SinhVien::create($this->duLieuHopLe(['ma_sv' => 'SV001', 'ho_ten' => 'Tran Van A']));
        SinhVien::create($this->duLieuHopLe(['ma_sv' => 'SV002', 'ho_ten' => 'Le Thi B']));

        $response = $this->get(route('sinhvien.index', ['keyword' => 'Tran Van A']));
        $response->assertOk();
        $response->assertSee('Tran Van A');
        $response->assertDontSee('Le Thi B');
    }
}
