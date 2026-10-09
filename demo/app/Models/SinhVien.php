<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'sinh_viens';

    protected $fillable = [
        'ma_sv',
        'ho_ten',
        'tuoi',
        'ngay_sinh',
        'gioi_tinh',
        'email',
        'so_dien_thoai',
        'dia_chi',
        'lop_hoc_id',
        'trang_thai',
    ];

    protected $casts = [
        'ngay_sinh' => 'date',
        'trang_thai' => 'boolean',
        'tuoi' => 'integer',
    ];

    /**
     * Mối quan hệ: Một sinh viên thuộc về một lớp học.
     */
    public function lopHoc()
    {
        return $this->belongsTo(LopHoc::class, 'lop_hoc_id');
    }

    /**
     * Accessor tương thích ngược với code cũ dùng $sinhvien->name hoặc $sinhvien->ten.
     */
    public function getNameAttribute(): string
    {
        return $this->attributes['ho_ten'] ?? '';
    }

    public function getTenAttribute(): string
    {
        return $this->attributes['ho_ten'] ?? '';
    }

    public function getAgeAttribute(): ?int
    {
        return $this->attributes['tuoi'] ?? null;
    }

    public function getDiachiAttribute(): ?string
    {
        return $this->attributes['dia_chi'] ?? null;
    }
}
