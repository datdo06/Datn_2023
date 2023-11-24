<?php

namespace App\Repositories\Interface;

interface CouponRepositoryInterface
{
    public function showAll($request);
    public function store($couponData);
    public function getCouponList($request);
    public function getCouponsDatatable($request);
}
