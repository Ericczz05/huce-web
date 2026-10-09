<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateSinhVienRequest extends StoreSinhVienRequest
{
    /**
     * Giống lúc thêm mới, nhưng mã sinh viên được phép trùng với chính sinh viên đang sửa.
     */
    public function rules(): array
    {
        $rules = parent::rules();

        $sinhvienId = $this->route('sinhvien');
        if (is_object($sinhvienId)) {
            $sinhvienId = $sinhvienId->id;
        }

        $rules['ma_sv'] = [
            'required',
            'string',
            'max:20',
            Rule::unique('sinh_viens', 'ma_sv')->ignore($sinhvienId),
        ];

        return $rules;
    }
}
