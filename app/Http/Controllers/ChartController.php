<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function dialyGuestPerMonth()
    {
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $day_array = array();
        $guests_count_array = array();

        for ($i = 1; $i <= $days_in_month; $i++) {
            array_push($day_array, $i);
            array_push($guests_count_array, $this->countGuestsPerDay($year, $month, $i));
        }

        $max_no = max($guests_count_array);
        $max = round(($max_no + 10 / 2) / 10) * 10;

        $dialyGuestPerMonth = array(
            'day' => $day_array,
            'guest_count_data' => $guests_count_array,
            'max' => $max
        );

        return $dialyGuestPerMonth;
    }

    private function countGuestsPerDay($year, $month, $day)
    {
        $time = strtotime($month . '/' . $day . '/' . $year);
        $date = date('Y-m-d', $time);

        $room_count = Transaction::where([['check_in', '<=', $date], ['check_out', '>=', $date]])->count();

        return $room_count;
    }

    public function dialyGuest($year, $month, $day)
    {
        $time = strtotime($month . '/' . $day . '/' . $year);
        $date = date('Y-m-d', $time);

        $transactions = Transaction::where([['check_in', '<=', $date], ['check_out', '>=', $date]])->get();

        return view('dashboard.chart_detail', compact('transactions', 'date'));
    }
    public function sumMoneyPerDay($day)
    {
        $today =  Carbon::now()->format('Y-m-d');
        $sum_money = Transaction::where('check_in', '=', $day)->where('check_out', '<=', $today)->sum('sum_money');

        return $sum_money;
    }

    public function sumMoneyPerDays($year, $month, $day)
    {
        $time = strtotime($month . '/' . $day . '/' . $year);
        $date = date('Y-m-d', $time);
        $today =  Carbon::now()->format('d');
        $monthd = Carbon::now()->format('m');
        $yeard = Carbon::now()->format('Y');
        $timed =  strtotime($monthd . '/' . $today. '/' . $yeard);
        $dated = date('Y-m-d', $timed);
        $sum_money = Transaction::where('check_in', '=', $date)->where('check_out', '<=', $dated)->sum('sum_money');
        return $sum_money;
    }
    public function sumMoneyPerWeek($month, $day, $year){
        $day2 = $day-7;
        $today =  Carbon::now()->format('d');
        $monthd = Carbon::now()->format('m');
        $yeard = Carbon::now()->format('Y');
        $timed =  strtotime($monthd . '/' . $today. '/' . $yeard);
        $dated = date('Y-m-d', $timed);
        if($day<=7){
            $m = $month - 1;
            $dayInMonth = cal_days_in_month(CAL_GREGORIAN, $m, $year);
            $day2 = $day2 + $dayInMonth;
            $time1 = strtotime($m . '/' . $day2 . '/' . $year);
            $time2 = strtotime($month . '/' . $day . '/' . $year);
            $date1 = date('Y-m-d', $time1);
            $date2 = date('Y-m-d', $time2);
        }else{
            $time1 = strtotime($month . '/' . $day2 . '/' . $year);
            $time2 = strtotime($month . '/' . $day . '/' . $year);
            $date1 = date('Y-m-d', $time1);
            $date2 = date('Y-m-d', $time2);
        }
        $sum_money = Transaction::where('check_in', '<=', $date2)->where('check_in', '>=', $date1)->where('check_out', '<=', $dated)->sum('sum_money');
        return $sum_money;
    }
    public function sumMoneyPerMonth($date)
    {
        list($Year, $Month) = explode('-', $date);
        $startDate = Carbon::createFromDate($Year, $Month, 1);
        $startDate = $startDate->format('Y-m-d');// Ngày đầu tiên của tháng
        $endDate = Carbon::createFromDate($Year, $Month, 1)->endOfMonth();
        $endDate = $endDate->format('Y-m-d');
        $sum_money = Transaction::where('check_in', '<=', $endDate)->where('check_in', '>=', $startDate)->sum('sum_money');
        return $sum_money;
    }
    public function sumMoneyPerQuy($year, $month1, $month2)
    {
        $day1 = 1;
        $day2 = cal_days_in_month(CAL_GREGORIAN, $month2, $year);
        $time = strtotime($month1 .'/'. $day1 .  '/' . $year);
        $time2 = strtotime($month2 .'/'. $day2 .  '/' . $year);
        $date1 = date('Y-m-d', $time);
        $date2 = date('Y-m-d', $time2);
        $sum_money = Transaction::where('check_in', '<=', $date2)->where('check_in', '>=', $date1)->sum('sum_money');

        return $sum_money;
    }

    public function dailyMoneysPerMonth(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $today =  Carbon::now()->format('Y-m-d');
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $day_array = array();
        $sum_money = array();
        if($request->has('filter_type')){
            $fillterType= $request->input('filter_type');
            if($fillterType == 1){
                $datefm = $day.'/'.$month.'/'.$year;
                array_push($day_array, $datefm);
                array_push($sum_money, $this->sumMoneyPerDay($today));
            }else if($fillterType == 2){
                $currentTime = time();
                $currentDayOfWeek = date('w', $currentTime);
                $firstDayOfWeek = strtotime("-$currentDayOfWeek days", $currentTime);
                $lastDayOfWeek = strtotime("+" . (6 - $currentDayOfWeek) . " days", $currentTime);
                for ($day = $firstDayOfWeek; $day <= $lastDayOfWeek; $day += 86400) { // 86400 giây trong một ngày
                    $datefm = date('d/m/Y', $day);
                    $date = date('Y-m-d', $day);
                    array_push($day_array, $datefm);
                    array_push($sum_money, $this->sumMoneyPerDay($date));
                }
            }else{
                for ($i = 1; $i <= $days_in_month; $i++) {
                    array_push($day_array, $i);
                    array_push($sum_money, $this->sumMoneyPerDays($year, $month, $i));
                }
            }
        }else if($request->has('den')&&$request->has('tu')){
            $start = $request->input('tu');
            $end = $request->input('den');
                $dateList = Helper::getDatesBetweenRange($start, $end);
                foreach ($dateList as $date){
                    $d = strtotime($date);
                    $datefm = date('d/m/Y', $d);
                    array_push($day_array, $datefm);
                    array_push($sum_money, $this->sumMoneyPerDay($date));
                }
        }else{
            for ($i = 1; $i <= $days_in_month; $i++) {
                array_push($day_array, $i);
                array_push($sum_money, $this->sumMoneyPerDays($year, $month, $i));
            }
        }
        $sumMoneyPerMonth = array(
            'day' => $day_array,
            'sum_money_data' => $sum_money,
        );
        return response()->json($sumMoneyPerMonth);
    }

    public function dailyMoneysPerMonthb(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $day = Carbon::now()->format('d');
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $day_array = array();
        $sum_money = array();
        if($request->has('den')){
            $filterType = $request->input('filter_type');
            if($filterType == 1){
                 $monthQuy = 0;
                switch ($month){
                    case 1 :
                    case 2:
                    case 3:
                        $quy = 1;
                        $monthQuy = 1;
                        break;
                    case 4:
                    case 5:
                    case 6:
                        $quy = 2;
                        $monthQuy = 4;
                        break;
                    case 7:
                    case 8:
                    case 9:
                        $quy = 3;
                        $monthQuy = 7;
                        break;
                    case 10:
                    case 11:
                    case 12:
                        $quy = 4;
                        $monthQuy = 10;
                        break;
                }
                if($quy == 4 && $monthQuy == 10){
                    $m = $monthQuy;
                    for ($i = $quy; $i>1; $i--){
                        array_unshift($day_array, 'Quý '.$i.' ('.$m.'/'.$year.' đến '.($m+2).'/'.$year.')');
                        array_unshift($sum_money, $this->sumMoneyPerQuy($year, $m, ($m+2)));
                        $m = $m-3;
                    }
                }else if($quy == 3 && $monthQuy == 7){
                    $m = $monthQuy;
                    for ($i = $quy; $i>0; $i--){
                        array_unshift($day_array, 'Quý '.$i.' ('.$m.'/'.$year.' đến '.($m+2).'/'.$year.')');
                        array_unshift($sum_money, $this->sumMoneyPerQuy($year, $m, ($m+2)));
                        $m = $m-3;
                    }
                }else if($quy == 2 && $monthQuy == 4){
                    $m = $monthQuy;
                    for ($i = $quy; $i>-1;$i--){
                        if($m<0){
                            $year = $year - 1;
                            $m = 9;
                            array_unshift($day_array, 'Quý '.$i.' ('.$m.'/'.$year.' đến '.($m+2).'/'.$year.')');
                            array_unshift($sum_money, $this->sumMoneyPerQuy($year, $m, ($m+2)));
                        }else{
                            array_unshift($day_array, 'Quý '.$i.' ('.$m.'/'.$year.' đến '.($m+2).'/'.$year.')');
                            array_unshift($sum_money, $this->sumMoneyPerQuy($year, $m, ($m+2)));
                            $m = $m - 3;
                        }
                    }
                }elseif($quy == 1 && $monthQuy == 1){
                    $m = $monthQuy;
                    for ($i = 1; $i<=3; $i++){
                        if($m>1){

                            array_unshift($day_array, 'Quý '.$i.' ('.$m.'/'.$year.' đến '.($m+2).'/'.$year.')');
                            array_unshift($sum_money, $this->sumMoneyPerQuy($year, $m, ($m+2)));
                            $m = $m - 3;
                        }else{
                            array_unshift($day_array, 'Quý '.$i.' ('.$m.'/'.$year.' đến '.($m+2).'/'.$year.')');
                            array_unshift($sum_money, $this->sumMoneyPerQuy($year, $m, ($m+2)));
                            $m = 9;
                            $year = $year - 1;
                        }
                    }
                }

            }elseif($filterType == 2){
                $m = $month;
                for ($i = 1; $i<=3; $i++){
                    array_unshift($day_array, 'Tháng '.$m);
                    array_unshift($sum_money, $this->sumMoneyPerMonth($year, $m));
                    $m= $m - 1;
                }
            }elseif ($filterType == 3){
                for ($i = 4; $i>=1; $i--){
                    if($day<=7){
                        $month2 = $month - 1;
                        $day2 = $day - 7;
                        if($day2<=0){
                            $day2 = $day2 + cal_days_in_month(CAL_GREGORIAN, $month2, $year);
                        }
                        array_unshift($day_array, 'Tuần '.$i.'('.$day2.'/'.$month2.' đến '.$day.'/'.$month.')' );
                        array_unshift($sum_money, $this->sumMoneyPerWeek($month,$day, $year));
                        $day = $day - 7;
                    }else{
                        array_unshift($day_array, 'Tuần '.$i.'('.($day-7).'/'.$month.'đến'.$day.'/'.$month.')' );
                        array_unshift($sum_money, $this->sumMoneyPerWeek($month,$day, $year));
                        $day = $day - 7;
                    }

                }
            }
            else{
                for ($i = 1; $i <= $days_in_month; $i++) {
                    array_push($day_array, $i);
                    array_push($sum_money, $this->sumMoneyPerDay($year, $month, $i));
                }
            }
            $sumMoneyPerMonth = array(
                'day' => $day_array,
                'sum_money_data' => $sum_money,
            );
            return response()->json($sumMoneyPerMonth);
        }else{
            for ($i = 1; $i <= $days_in_month; $i++) {
                array_push($day_array, $i);
                array_push($sum_money, $this->sumMoneyPerDay($year, $month, $i));
            }
            $sumMoneyPerMonth = array(
                'day' => $day_array,
                'sum_money_data' => $sum_money,
            );
        }
        return response()->json($sumMoneyPerMonth);
    }
}
