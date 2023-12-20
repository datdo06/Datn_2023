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
            <p>Ngày đặt phòng: {{ \App\Helpers\Helper::dateFormat($payment->created_at) }}</p>
            <p>Ngày nhận phòng: {{ \App\Helpers\Helper::dateFormat($transaction->check_in) }}</p>
            <p>Ngày trả phòng: {{ \App\Helpers\Helper::dateFormat($transaction->check_out) }}</p>
            <p>Homestay đã đặt: {{ $transaction->room->number }} - {{ $transaction->room->type->name }}</p>
            <p>Số người: {{ $transaction->sum_people }}</p>
            @php
                $dayDifference = Helper::getDateDifference($transaction->check_in, $transaction->check_out);
                $price = $transaction->room->price * $dayDifference;
            @endphp
            <p style="font-size: 20px"><strong>Tiền homestay: </strong>{{ App\Helpers\Helper::convertToRupiah($price) }}
            </p>
            @foreach ($transactionFacility as $tF)
                <p>Tiền dịch vụ {{ $tF->Facility->name }}:
                    {{ \App\Helpers\Helper::convertToRupiah($tF->Facility->price * $tF->quantity) }}</p>
            @endforeach
            @php
                $dayDifference = Helper::getDateDifference($transaction->check_in, $transaction->check_out);
                $price = $transaction->room->price * $dayDifference;
            @endphp
            @if (!empty($transactionCoupon))
                <p>Bạn đã sử dụng mã giảm giá: {{ $transactionCoupon->Coupon->coupon_name }}</p>
                @if ($transactionCoupon->Coupon->coupon_condition == 2)
                    <p><strong>Bạn được giảm:
                        </strong>{{ \App\Helpers\Helper::convertToRupiah($transactionCoupon->Coupon->coupon_number) }}
                    </p>
                @else
                    <p><strong>Bạn được giảm:
                        </strong>{{ \App\Helpers\Helper::convertToRupiah(($price * $transactionCoupon->Coupon->coupon_number) / 100) }}
                    </p>
                @endif
            @endif
            <p><strong>Tổng tiền phải trả: </strong>{{ \App\Helpers\Helper::convertToRupiah($transaction->sum_money) }}
            </p>
            <p><strong style="font-size: 20px; color: #e1bd85">Số tiền đã trả:
                {{ \App\Helpers\Helper::convertToRupiah($transaction->getTotalPayment()) }}</strong></p>
            <p><strong style="font-size: 20px; color: #DB073D">Số tiền chưa trả:
                    {{ \App\Helpers\Helper::convertToRupiah($transaction->sum_money - $transaction->getTotalPayment()) }}</strong>
            </p>
            @if(!empty($hoan))
                <p>Bạn đã hủy trước 2 ngày nên bạn sẽ được hoàn lại tiền cọc. Chúng tôi sẽ gửi lại bạn sau 1 - 2 ngày</p>
            @else
                <p>Bạn đã không hủy trước 2 ngày so với ngày đến nên không được hoàn lại tiền cọc</p>
            @endif


            <div class="button-container">
                <a href="{{ route('home') }}" class="button">Quay lại trang chủ</a>
            </div>
        </div>
</body>

</html>
