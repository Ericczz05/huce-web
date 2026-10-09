<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSinhVienRequest;
use App\Http\Requests\UpdateSinhVienRequest;
use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SinhVienController extends Controller
{
    private const SORTABLE = ['id', 'ma_sv', 'ho_ten', 'tuoi', 'gioi_tinh', 'trang_thai', 'created_at'];

    private const PER_PAGE_OPTIONS = [10, 20, 50, 100];

    /**
     * Danh sách sinh viên có tìm kiếm, lọc, sắp xếp và phân trang.
     */
    public function index(Request $request)
    {
        $filters = Validator::make($request->query(), [
            'keyword' => 'nullable|string|max:100',
            'lop_hoc_id' => 'nullable|integer',
            'trang_thai' => 'nullable|in:0,1',
            'gioi_tinh' => 'nullable|in:Nam,Nữ,Khác',
            'sort' => 'nullable|in:' . implode(',', self::SORTABLE),
            'direction' => 'nullable|in:asc,desc',
            'perPage' => 'nullable|in:' . implode(',', self::PER_PAGE_OPTIONS),
        ])->valid();

        $sort = $filters['sort'] ?? 'id';
        $direction = $filters['direction'] ?? 'desc';
        $perPage = (int) ($filters['perPage'] ?? 10);

        $sinhviens = SinhVien::query()
            ->with('lopHoc')
            ->when(!empty($filters['keyword']), function ($query) use ($filters) {
                $keyword = '%' . $filters['keyword'] . '%';
                $query->where(function ($q) use ($keyword) {
                    $q->where('ho_ten', 'like', $keyword)
                        ->orWhere('ma_sv', 'like', $keyword)
                        ->orWhere('email', 'like', $keyword)
                        ->orWhere('so_dien_thoai', 'like', $keyword)
                        ->orWhere('dia_chi', 'like', $keyword);
                });
            })
            ->when(isset($filters['lop_hoc_id']) && $filters['lop_hoc_id'] !== '', function ($query) use ($filters) {
                $query->where('lop_hoc_id', $filters['lop_hoc_id']);
            })
            ->when(isset($filters['trang_thai']) && $filters['trang_thai'] !== '', function ($query) use ($filters) {
                $query->where('trang_thai', $filters['trang_thai']);
            })
            ->when(!empty($filters['gioi_tinh']), function ($query) use ($filters) {
                $query->where('gioi_tinh', $filters['gioi_tinh']);
            })
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();

        $lopHocs = LopHoc::orderBy('ten_lop')->get(['id', 'ten_lop', 'ma_lop']);

        return view('sinhvien.index', [
            'title' => 'Danh sách sinh viên',
            'sinhviens' => $sinhviens,
            'lopHocs' => $lopHocs,
            'filters' => $filters,
            'sort' => $sort,
            'direction' => $direction,
            'perPage' => $perPage,
            'sortable' => self::SORTABLE,
            'perPageOptions' => self::PER_PAGE_OPTIONS,
        ]);
    }

    /**
     * Hiển thị giao diện thêm sinh viên mới.
     */
    public function create()
    {
        $lopHocs = LopHoc::where('trang_thai', true)->orderBy('ten_lop')->get();

        return view('sinhvien.create', [
            'title' => 'Thêm sinh viên',
            'lopHocs' => $lopHocs,
        ]);
    }

    /**
     * Tương thích ngược với view / route cũ gọi add().
     */
    public function add()
    {
        return $this->create();
    }

    /**
     * Lưu sinh viên mới vào cơ sở dữ liệu.
     */
    public function store(StoreSinhVienRequest $request)
    {
        $sinhVien = SinhVien::create($request->validated());

        return redirect()
            ->route('sinhvien.index')
            ->with('success', 'Sinh viên "' . $sinhVien->ho_ten . '" đã được thêm mới thành công.');
    }

    /**
     * Hiển thị chi tiết thông tin sinh viên.
     */
    public function show($sinhvien)
    {
        if (!$sinhvien instanceof SinhVien) {
            $sinhvien = SinhVien::with('lopHoc')->findOrFail($sinhvien);
        } else {
            $sinhvien->load('lopHoc');
        }

        return view('sinhvien.show', [
            'title' => 'Chi tiết sinh viên - ' . $sinhvien->ho_ten,
            'sinhvien' => $sinhvien,
        ]);
    }

    /**
     * Hiển thị form chỉnh sửa thông tin sinh viên.
     */
    public function edit(SinhVien $sinhvien)
    {
        $lopHocs = LopHoc::orderBy('ten_lop')->get();

        return view('sinhvien.edit', [
            'title' => 'Chỉnh sửa sinh viên - ' . $sinhvien->ho_ten,
            'sinhvien' => $sinhvien,
            'lopHocs' => $lopHocs,
        ]);
    }

    /**
     * Cập nhật thông tin sinh viên trong cơ sở dữ liệu.
     */
    public function update(UpdateSinhVienRequest $request, SinhVien $sinhvien)
    {
        $sinhvien->update($request->validated());

        return redirect()
            ->route('sinhvien.index')
            ->with('success', 'Cập nhật thông tin sinh viên "' . $sinhvien->ho_ten . '" thành công.');
    }

    /**
     * Xóa sinh viên khỏi hệ thống.
     */
    public function destroy(SinhVien $sinhvien)
    {
        $ten = $sinhvien->ho_ten;
        $sinhvien->delete();

        return back()->with('success', 'Đã xóa sinh viên "' . $ten . '" thành công.');
    }

    /**
     * Tương thích ngược nếu có route gọi delete().
     */
    public function delete($id)
    {
        $sinhvien = SinhVien::findOrFail($id);
        return $this->destroy($sinhvien);
    }
}
