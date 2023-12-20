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

        p {
            color: #333;
        }

        ul {
            list-style-type: none;
        }

        li {
            font-size: 14px;
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
            width: 600px;
            padding: 30px;
            margin: 100px auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success-card h1 {
            font-size: 36px;
            color: #4caf50;
            margin-bottom: 30px;
        }

        .header {
            background-color: #FFFFFF;
            text-align: center;
            padding: 15px 0;
        }

        .success-card p {
            font-size: 14px;
            color: #666666;
            margin-bottom: 15px;
        }

        .success-card a {
            display: inline-block;
            font-size: 18px;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
        }

        .signature {
            font-family: 'Comic Sans MS', sans-serif;
            font-size: 16px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="success-card">
        <div class="header">
            <h1>Đặt homestay thành công</h1>
        </div>
        <p>Xin chào {{ $transaction->guest_name }},</p>
        <p>Cảm ơn bạn đã đặt homestay của chúng tôi. Homestay của bạn đã đặt được xác nhận và thông tin chi tiết như
            sau:</p>

        <h2>Thông tin đặt homestay</h2>
        <p>Ngày đặt phòng: {{ \App\Helpers\Helper::dateFormat($payment->created_at) }}</p>
        <p>Ngày nhận phòng: {{ \App\Helpers\Helper::dateFormat($transaction->check_in) }}</p>
        <p>Ngày trả phòng: {{ \App\Helpers\Helper::dateFormat($transaction->check_out) }}</p>
        <p>Homestay đã đặt: {{ $transaction->room->number }} - {{ $transaction->room->type->name }}</p>
        <p>Số người: {{ $transaction->sum_people }}</p>
        @php
            $dayDifference = Helper::getDateDifference($transaction->check_in, $transaction->check_out);
            $price = $transaction->room->price * $dayDifference;
        @endphp
        <p style="font-size: 20px"><strong>Tiền homestay: </strong>{{ App\Helpers\Helper::convertToRupiah($price) }}</p>
        @foreach ($transactionFacility as $tF)
            <p>Tiền dịch vụ {{ $tF->Facility->name }}:
                {{ \App\Helpers\Helper::convertToRupiah($tF->Facility->price) }}</p>
        @endforeach
        @if (!empty($transactionCoupon))
            <p>Bạn đã sử dụng mã giảm giá: {{ $transactionCoupon->Coupon->coupon_name }}</p>
            @if ($transactionCoupon->Coupon->coupon_condition == 2)
                <p><strong>Bạn được giảm:
                    </strong>{{ \App\Helpers\Helper::convertToRupiah($transactionCoupon->Coupon->coupon_number) }}</p>
            @else
                <p><strong>Bạn được giảm:
                    </strong>{{ \App\Helpers\Helper::convertToRupiah(($price * $transactionCoupon->Coupon->coupon_number) / 100) }}
                </p>
            @endif
        @endif
        <p><strong>Tổng tiền phải trả:</strong> {{ \App\Helpers\Helper::convertToRupiah($transaction->sum_money) }}</p>
        <p style="font-size: 20px;"><strong style=" color: #e1bd85">Số tiền đã trả: {{ \App\Helpers\Helper::convertToRupiah($transaction->getTotalPayment()) }}</strong>
        </p>
        <p style="font-size: 20px;"><strong style=" color: #DB073D">Số tiền chưa trả: {{ \App\Helpers\Helper::convertToRupiah($transaction->sum_money - $transaction->getTotalPayment()) }}</strong>
        </p>
        <p><strong>Lưu ý: </strong>Chính sách hoàn tiền của Homestay của chúng tôi:</p>
        <p>Nếu quý khách hủy đặt phòng trước 2 ngày so với ngày checkin sẽ được hoàn 100% phí đã đặt cọc.</p>
        <p>Sau khoảng thời gian đó nếu quý khách hủy phòng, Homestay sẽ không hoàn lại phí đã đặt cọc.</p>
        <p>Nếu bạn có bất kỳ câu hỏi hoặc cần sự hỗ trợ bổ sung, vui lòng liên hệ với chúng tôi.</p>
        <p>Chúng tôi rất mong được phục vụ bạn tại homestay của chúng tôi. Chúc bạn có một kỳ nghỉ thú vị!</p>

        <p>Trân trọng,</p>
        <div class="signature">
            King The Land
            <div class="contact-info">
                Email: kingtheland@email.com<br>
                Phone: 0987124921
            </div>
        </div>
    </div>
</body>

</html>
