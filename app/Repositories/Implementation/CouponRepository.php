<?php

namespace App\Repositories\Implementation;

use App\Models\Coupon;
use App\Repositories\Interface\CouponRepositoryInterface;

class CouponRepository implements CouponRepositoryInterface
{
    public function showAll($request)
    {
        $coupons = Coupon::orderBy('id', 'DESC');
        if (!empty($request->search)) {
            $coupons = $coupons->where('coupon_name', 'LIKE', '%' . $request->search . '%');
        }
        $coupons = $coupons->paginate(5);
        $coupons->appends($request->all());

        return $coupons;
    }

    public function store($couponData)
    {
        $coupon = new Coupon;
        $coupon->coupon_name = $couponData->coupon_name;
        $coupon->coupon_code = $couponData->coupon_code;
        $coupon->coupon_time = $couponData->coupon_time;
        $coupon->coupon_number = $couponData->coupon_number;
        $coupon->coupon_condition = $couponData->coupon_condition;
        $coupon->start_time = $couponData->start_time;
        $coupon->end_time = $couponData->end_time;

        $coupon->save();

        return $coupon;
    }

    public function getCouponList($request)
    {
        return Coupon::get();
    }

    public function getCouponsDatatable($request)
    {
        $columns = array(
            0 => 'coupons.id',
            1 => 'coupons.coupon_name',
            2 => 'coupons.coupon_code',
            3 => 'coupons.coupon_time',
            4 => 'coupons.coupon_number',
            5 => 'coupons.coupon_condition',
            6 => 'coupons.start_time',
            7 => 'coupons.end_time',
        );

        $limit          = $request->input('length');
        $start          = $request->input('start');
        $order          = $columns[$request->input('order.0.column')];
        $dir            = $request->input('order.0.dir');

        $main_query = Coupon::select(
            'coupons.id as number',
            'coupons.coupon_name',
            'coupons.coupon_code',
            'coupons.coupon_time',
            'coupons.coupon_number',
            'coupons.coupon_condition',
            'coupons.start_time',
            'coupons.end_time',
            'coupons.id',
        );

        $totalData = $main_query->get()->count();

        // Filter global column
        if ($request->input('search.value')) {
            $search = $request->input('search.value');
            $main_query->where(function ($query) use ($search, $columns) {
                $i = 0;
                foreach ($columns as $column) {
                    if ($i = 0) {
                        $query->where($column, 'LIKE', "%{$search}%");
                    } else {
                        $query->orWhere($column, 'LIKE', "%{$search}%");
                    }
                    $i++;
                }
            });
        }

        $totalFiltered = $main_query->count();

        $main_query->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir);

        $models = $main_query->get();

        $data = [];
        if (!empty($models)) {
            foreach ($models as $model) {
                $data[] = array(
                    "number" => $model->id,
                    "coupon_name" => $model->coupon_name,
                    "coupon_code" => $model->coupon_code,
                    "coupon_time" => $model->coupon_time,
                    "coupon_number" => $model->coupon_number,
                    "coupon_condition" => $model->coupon_condition,
                    'start_time' => $model->start_time,
                    'end_time' => $model->end_time,

                    "id" => $model->id,

                );
            }
        }

        $response = array(
            "draw" => intval($request->input('draw')),
            "iTotalRecords" => $totalData,
            "iTotalDisplayRecords" => $totalFiltered,
            "aaData" => $data
        );

        return json_encode($response);
    }
}
