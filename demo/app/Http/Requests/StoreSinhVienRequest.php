<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSinhVienRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Chuẩn hoá dữ liệu trước khi validate.
     */
    protected function prepareForValidation(): void
    {
        $mergeData = [];

        // Viết hoa mã sinh viên nếu có
        if (is_string($this->ma_sv)) {
            $mergeData['ma_sv'] = strtoupper(trim($this->ma_sv));
        }

        // Tương thích ngược nếu form gửi 'ten' hoặc 'name' thay vì 'ho_ten'
        if (!$this->filled('ho_ten')) {
            if ($this->filled('ten')) {
                $mergeData['ho_ten'] = $this->ten;
            } elseif ($this->filled('name')) {
                $mergeData['ho_ten'] = $this->name;
            }
        }

        // Tương thích ngược nếu form gửi 'diachi' thay vì 'dia_chi'
        if (!$this->filled('dia_chi') && $this->filled('diachi')) {
            $mergeData['dia_chi'] = $this->diachi;
        }

        if (!empty($mergeData)) {
            $this->merge($mergeData);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'ma_sv' => 'required|string|max:20|unique:sinh_viens,ma_sv',
            'ho_ten' => 'required|string|max:255',
            'tuoi' => 'nullable|integer|min:1|max:120',
            'ngay_sinh' => 'nullable|date|before_or_equal:today',
            'gioi_tinh' => 'nullable|in:Nam,Nữ,Khác',
            'email' => 'nullable|email|max:255',
            'so_dien_thoai' => 'nullable|string|max:20',
            'dia_chi' => 'nullable|string|max:255',
            'lop_hoc_id' => 'nullable|exists:lop_hocs,id',
            'trang_thai' => 'required|boolean',
        ];
    }

    /**
     * Thông báo lỗi tiếng Việt.
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi ký tự.',
            'max' => ':attribute không được vượt quá :max ký tự.',
            'min' => ':attribute phải từ :min trở lên.',
            'integer' => ':attribute phải là số nguyên.',
            'boolean' => ':attribute không hợp lệ.',
            'email' => ':attribute không đúng định dạng email.',
            'date' => ':attribute không đúng định dạng ngày.',
            'before_or_equal' => ':attribute không được lớn hơn ngày hiện tại.',
            'ma_sv.unique' => 'Mã sinh viên này đã tồn tại trong hệ thống.',
            'gioi_tinh.in' => 'Giới tính phải là Nam, Nữ hoặc Khác.',
            'lop_hoc_id.exists' => 'Lớp học được chọn không tồn tại.',
        ];
    }

    /**
     * Tên hiển thị của các trường trong thông báo lỗi.
     */
    public function attributes(): array
    {
        return [
            'ma_sv' => 'Mã sinh viên',
            'ho_ten' => 'Họ và tên',
            'tuoi' => 'Tuổi',
            'ngay_sinh' => 'Ngày sinh',
            'gioi_tinh' => 'Giới tính',
            'email' => 'Email',
            'so_dien_thoai' => 'Số điện thoại',
            'dia_chi' => 'Địa chỉ',
            'lop_hoc_id' => 'Lớp học',
            'trang_thai' => 'Trạng thái',
        ];
    }
}
