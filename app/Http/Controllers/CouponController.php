<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCouponRequest;
use App\Models\Coupon;
use App\Repositories\Interface\CouponRepositoryInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
class CouponController extends Controller
{
    private $couponRepository;

    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->couponRepository->getCouponsDatatable($request);
        }
        return view('coupon.index');
    }

    public function create()
    {
        $view =  view('coupon.create')->render();

        return response()->json([
            'view' => $view,
        ]);
    }

    public function store(StoreCouponRequest $request)
    {

        $coupon = $this->couponRepository->store($request);
        return response()->json([
            'message' => 'Mã giảm giá ' . $coupon->name . ' tạo thành công'
        ]);
    }

    public function edit(Coupon $coupon)
    {
        $view = view('coupon.edit', compact('coupon'))->render();

        return response()->json([
            'view' => $view,
        ]);
    }

    public function update(Coupon $coupon, StoreCouponRequest $request)
    {
        $coupon->update($request->all());
        return response()->json([
            'message' => 'Mã giảm giá  ' . $coupon->coupon_name . ' cập nhật thành công!'
        ]);
    }

    public function destroy(Coupon $coupon)
    {
        try {
            $coupon->delete();
            return response()->json([
                'message' => 'Mã giảm giá ' . $coupon->name . ' đã được xóa'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Mã giảm giá ' . $coupon->name . ' không thể xóa! Lỗi:' . $e->errorInfo[1]
            ], 500);
        }
    }
    public function check_coupon(Request $request){
        $data = $request->all();
        $currentDate = Carbon::now();
        $coupon = Coupon::where('coupon_code', $data['coupon'])
            ->first();

//        if (session('coupon')) {
//            session()->forget('coupon');
//        }

        if ($coupon && $coupon->coupon_time > 0 && !$coupon->expired && $currentDate->between($coupon->start_time, $coupon->end_time)) {
            // Mã giảm giá hợp lệ
            $coupon->coupon_time -= 1;
            $coupon->save();
            session()->put('coupon', $coupon);
            return redirect()->back()->with('success', 'Mã giảm giá đã được áp dụng.');
        } else {
            // Mã giảm giá không hợp lệ
            return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ.');
        }
    }
}

