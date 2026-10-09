<?php

namespace Database\Seeders;

use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Database\Seeder;

class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lopIds = LopHoc::pluck('id')->toArray();
        $lop1 = $lopIds[0] ?? null;
        $lop2 = $lopIds[1] ?? null;
        $lop3 = $lopIds[2] ?? null;

        $sinhviens = [
            [
                'ma_sv' => 'SV001',
                'ho_ten' => 'Nguyen Van A',
                'tuoi' => 20,
                'ngay_sinh' => '2004-05-15',
                'gioi_tinh' => 'Nam',
                'email' => 'nguyenvana@huce.edu.vn',
                'so_dien_thoai' => '0981234567',
                'dia_chi' => 'Hà Nội',
                'lop_hoc_id' => $lop1,
                'trang_thai' => true,
            ],
            [
                'ma_sv' => 'SV002',
                'ho_ten' => 'Tran Thi B',
                'tuoi' => 21,
                'ngay_sinh' => '2003-08-20',
                'gioi_tinh' => 'Nữ',
                'email' => 'tranthib@huce.edu.vn',
                'so_dien_thoai' => '0972345678',
                'dia_chi' => 'Hải Phòng',
                'lop_hoc_id' => $lop1,
                'trang_thai' => true,
            ],
            [
                'ma_sv' => 'SV003',
                'ho_ten' => 'Le Van C',
                'tuoi' => 22,
                'ngay_sinh' => '2002-11-10',
                'gioi_tinh' => 'Nam',
                'email' => 'levanc@huce.edu.vn',
                'so_dien_thoai' => '0963456789',
                'dia_chi' => 'Nam Định',
                'lop_hoc_id' => $lop2,
                'trang_thai' => true,
            ],
            [
                'ma_sv' => 'SV004',
                'ho_ten' => 'Pham Thi D',
                'tuoi' => 23,
                'ngay_sinh' => '2001-03-25',
                'gioi_tinh' => 'Nữ',
                'email' => 'phamthid@huce.edu.vn',
                'so_dien_thoai' => '0954567890',
                'dia_chi' => 'Bắc Ninh',
                'lop_hoc_id' => $lop2,
                'trang_thai' => true,
            ],
            [
                'ma_sv' => 'SV005',
                'ho_ten' => 'Hoang Van E',
                'tuoi' => 24,
                'ngay_sinh' => '2000-09-05',
                'gioi_tinh' => 'Nam',
                'email' => 'hoangvane@huce.edu.vn',
                'so_dien_thoai' => '0945678901',
                'dia_chi' => 'Thanh Hóa',
                'lop_hoc_id' => $lop3,
                'trang_thai' => true,
            ],
        ];

        foreach ($sinhviens as $data) {
            SinhVien::updateOrCreate(['ma_sv' => $data['ma_sv']], $data);
        }
    }
}
