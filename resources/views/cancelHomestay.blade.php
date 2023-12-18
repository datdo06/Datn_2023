<!DOCTYPE html>
<html>
<head>
    <title>Hủy Đặt Phòng Thành Công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #0078d4;
        }

        .success-message {
            text-align: center;
            padding: 10px;
            background-color: #5cb85c;
            color: #ffffff;
        }

        .success-message p {
            font-size: 18px;
        }

        .details {
            padding: 20px;
        }

        .details p {
            font-size: 16px;
            line-height: 1.6;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0078d4;
            color: #ffffff;
            text-decoration: none;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Hủy Đặt Phòng Thành Công</h1>
    </div>
    <div class="success-message">
        <p>Cảm ơn bạn đã hủy đặt homestay!</p>
    </div>
    <div class="details">
        <p><strong>Tên homestay: </strong> {{$transaction->room->number}} </p>
        <p><strong>Ngày nhận phòng:</strong> {{\App\Helpers\Helper::dateFormat($transaction->check_in)}}</p>
        <p><strong>Ngày trả phòng:</strong> {{\App\Helpers\Helper::dateFormat($transaction->check_out)}}</p>
        @foreach($transactionFacility as $tF)
            <p><strong>Tiền dich vụ {{$tF->Facility->name}} x {{$tF->quantity}}: </strong>{{\App\Helpers\Helper::convertToRupiah($tF->Facility->price * $tF->quantity)}}</p>
        @endforeach
        @if(!empty($transactionCoupon))
            <p><strong>Bạn đã sử dụng mã giảm giá: </strong>{{$transactionCoupon->Coupon->coupon_name}}</p>
            @if($transactionCoupon->Coupon->coupon_condition == 2)
                <p><strong>Bạn được giảm: </strong>{{\App\Helpers\Helper::convertToRupiah($transactionCoupon->Coupon->coupon_number)}}</p>
            @else
                <p><strong>Bạn được giảm: </strong>{{\App\Helpers\Helper::convertToRupiah(($price*$transactionCoupon->Coupon->coupon_number/100))}}</p>
            @endif
        @endif
        <p><strong>Số tiền bạn đã cọc: </strong>{{\App\Helpers\Helper::convertToRupiah($transaction->getTotalPayment())}}</p>
        <div>

        </div>
        <p><strong>Tổng số tiền: </strong>{{\App\Helpers\Helper::convertToRupiah($transaction->sum_money)}}</p>
    </div>
    <div class="button-container">
        <a href="{{route('home')}}" class="button">Quay lại trang chủ</a>
    </div>
</div>
</body>
</html>
