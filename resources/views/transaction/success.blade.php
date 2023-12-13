<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt phòng thành công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 600px;
            padding: 20px;
        }
        h1 {
            color: #007BFF;
            text-align: center;
        }
        p {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        strong {
            font-weight: bold;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .success-card {
            width: 800px;
            padding: 30px;
            margin: 100px auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }

        .success-card h1 {
            font-size: 36px;
            color: #FFFFFF;
            margin-bottom: 30px;
        }

        .success-card p {
            font-size: 18px;
            color: #666666;
            margin-bottom: 30px;
        }

        .success-card a {
            display: inline-block;
            font-size: 18px;
            color: #ffffff;
            background-color: #4caf50;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
        }
        .header {
            background-color: #4caf50;
            color: #fff;
            text-align: center;
            padding: 15px 0;
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
<div class="success-card">
    <div class="header">
        <h1>Đặt homestay thành công</h1>
    </div>
    <p>Xin chào {{$user->name}},</p>
    <p>Cảm ơn bạn đã đặt phòng tại khách sạn chúng tôi. Đặt phòng của bạn đã được xác nhận và thông tin đặt phòng chi tiết như sau:</p>

    <h2>Thông tin đặt phòng</h2>
    <ul>
        <li><strong>Ngày nhận phòng:</strong> {{\App\Helpers\Helper::dateFormat($transaction->check_in)}}</li>
        <li><strong>Ngày trả phòng:</strong> {{\App\Helpers\Helper::dateFormat($transaction->check_out)}}</li>
        <li><strong>Homestay đã đặt: </strong>{{$transaction->room->number}} - {{$transaction->room->type->name}}</li>
        <li><strong>Số người: </strong>{{$transaction->sum_people}}</li>
        @php
            $dayDifference = Helper::getDateDifference($transaction->check_in, $transaction->check_out);
            $price = ($transaction->room->price * $dayDifference);
        @endphp
        <li><strong>Tiền homestay: </strong>{{App\Helpers\Helper::convertToRupiah($price)}}</li>
        @foreach($transactionFacility as $tF)
            <li><strong>Tiền dich vụ {{$tF->Facility->name}} x {{$tF->quantity}}: </strong>{{\App\Helpers\Helper::convertToRupiah($tF->Facility->price * $tF->quantity)}}</li>
        @endforeach
        @if(!empty($transactionCoupon))
            <li><strong>Bạn đã sử dụng mã giảm giá: </strong>{{$transactionCoupon->Coupon->coupon_name}}</li>
            @if($transactionCoupon->Coupon->coupon_condition == 2)
                <li><strong>Bạn được giảm: </strong>{{\App\Helpers\Helper::convertToRupiah($transactionCoupon->Coupon->coupon_number)}}</li>
            @else
                <li><strong>Bạn được giảm: </strong>{{\App\Helpers\Helper::convertToRupiah(($price*$transactionCoupon->Coupon->coupon_number/100))}}</li>
            @endif
        @endif
        <li><strong>Tổng giá:</strong> {{\App\Helpers\Helper::convertToRupiah($transaction->sum_money)}}</li>
    </ul>

    <p>Hãy kiểm tra email này để xem lại thông tin đặt phòng của bạn. Nếu bạn có bất kỳ câu hỏi hoặc cần sự hỗ trợ bổ sung, vui lòng liên hệ với chúng tôi tại kingtheland@gmail.com hoặc số điện thoại 0987124921.</p>

    <p>Chúng tôi rất mong được phục vụ bạn tại homestay của chúng tôi. Chúc bạn có một kỳ nghỉ thú vị!</p>

    <p>Trân trọng,</p>
    <p>King The Land</p>
    <div class="button-container">
        <a href="{{route('home')}}" class="button">Quay lại trang chủ</a>
    </div>
</div>
</body>
</html>
