<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;

class Helper
{
    public static function convertToRupiah($price)
    {
        $price_rupiah = number_format($price, 0, '', '.')." VNĐ";
        return $price_rupiah;
    }

    public static function thisNow()
    {
        return Carbon::parse(Carbon::now());
    }
    public static function thisMonth()
    {
        return Carbon::parse(Carbon::now())->format('m');
    }

    public static function thisYear()
    {
        return Carbon::parse(Carbon::now())->format('Y');
    }

    public static function dateDayFormat($date)
    {
        return Carbon::parse($date)->isoFormat('dddd, D MMM YYYY');
    }

    public static function dateFormat($date)
    {
        return Carbon::parse($date)->locale('vi')->isoFormat('D MMM YYYY');
    }

    public static function dateFormatTime($date)
    {
        return Carbon::parse($date)->isoFormat('D MMM YYYY H:m:s');
    }

    public static function dateFormatTimeNoYear($date)
    {
        return Carbon::parse($date)->locale('vi')->isoFormat('D MMM, hh:mm a');
    }

    public static function getDateDifference($check_in, $check_out)
    {
        $check_in = strtotime($check_in);
        $check_out = strtotime($check_out);
        $date_difference = $check_out - $check_in;
        $date_difference = ceil($date_difference / (60 * 60 * 24));
        return $date_difference;
    }
    public static function getHourDifference($check_in, $now)
    {
        $check_in = strtotime($check_in);
        $now = strtotime($now);
        $date_difference = $now - $check_in;
        $date_difference = round($date_difference / (60 * 60 ));
        return $date_difference;
    }

    public static function plural($value, $count)
    {
        return Str::plural($value, $count);
    }

    public static function getColorByDay($day)
    {
        $color = '';
        if ($day == 1) {
            $color = 'bg-danger';
        } else if ($day > 1 && $day < 4) {
            $color = 'bg-warning';
        } else {
            $color = 'bg-success';
        }
        return $color;
    }

    public static function getTotalPayment($day, $price)
    {
        return $day * $price;
    }
    public static function getDatesBetweenRange($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $dateRange = [];

        while ($start->lte($end)) {
            $dateRange[] = $start->format('Y-m-d');
            $start->addDay(); // Thêm 1 ngày
        }

        return $dateRange;
    }
    public static function getMonthsBetweenRange($start, $end)
    {
        list($startYear, $startMonth) = explode('-', $start);
        list($endYear, $endMonth) = explode('-', $end);

        $startDate = Carbon::createFromDate($startYear, $startMonth, 1); // Ngày đầu tiên của tháng
        $endDate = Carbon::createFromDate($endYear, $endMonth, 1)->endOfMonth(); // Ngày cuối cùng của tháng

        $monthRange = [];

        while ($startDate->lte($endDate)) {
            $monthRange[] = $startDate->format('Y-m');
            $startDate->addMonths(1); // Thêm 1 tháng
        }

        return $monthRange;
    }
}
