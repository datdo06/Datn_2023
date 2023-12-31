<!DOCTYPE html>
<html>

<head>
    <title>Email Hủy Đặt Phòng Khách Sạn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        table {
            width: 600px;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #ffffff;
        }


        p {
            font-size: 14px;
            line-height: 1.6;
            color: #333;
        }

        strong {
            font-weight: bold;
        }

        table {
            background-color: #fff;
        }

        td {
            padding: 20px;
        }

        .header {
            background-color: #0078d4;
            color: #fff;
            text-align: center;
            padding: 15px 0;
        }

        .header h1 {
            font-size: 24px;
        }

        .signature {
            font-family: 'Comic Sans MS', sans-serif;
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }

        .contact-info {
            font-family: 'Arial', sans-serif;
            margin-top: 5px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>
    <table align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <div class="header">
                    <h1>Email Hủy Đặt Homestay</h1>
                </div>
                <p><strong>Kính gửi quý khách {{ $transaction->guest_name }}</strong></p>
                <p>Cảm ơn bạn đã sử dụng dịch vụ đặt homestay của chúng tôi. Chúng tôi rất tiếc phải thông báo rằng đơn
                    đặt
                    phòng của bạn đã bị hủy. Vui lòng xem chi tiết dưới đây:</p>

                <table width="100%">
                    <tr>
                        <td>Ngày đặt phòng: {{ \App\Helpers\Helper::dateFormat($payment->created_at) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Homestay đã đặt: {{ $transaction->room->number }}</strong></td>
                        <td>{{ $transaction->room->type->name }}</td>

                    </tr>
                    @php
                        $dayDifference = Helper::getDateDifference($transaction->check_in, $transaction->check_out);
                        $price = $transaction->room->price * $dayDifference;
                    @endphp

                    <tr>
                        <td>Ngày nhận phòng: {{ \App\Helpers\Helper::dateFormat($transaction->check_in) }}
                        </td>
                        <td>Ngày trả phòng: {{ \App\Helpers\Helper::dateFormat($transaction->check_out) }}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Tiền homestay: {{ \App\Helpers\Helper::convertToRupiah($price) }}</strong></td>

                    </tr>
                    <tr>

                        @if (!empty($transactionCoupon))
                            <td>Bạn đã sử dụng mã giảm giá: {{ $transactionCoupon->Coupon->coupon_name }}</td>
                            @if ($transactionCoupon->Coupon->coupon_condition == 2)
                                <td><strong>Bạn được
                                        giảm:
                                        {{ \App\Helpers\Helper::convertToRupiah($transactionCoupon->Coupon->coupon_number) }}</strong>
                                </td>
                            @else
                                <td><strong>Bạn được
                                        giảm:
                                        {{ \App\Helpers\Helper::convertToRupiah(($price * $transactionCoupon->Coupon->coupon_number) / 100) }}</strong>
                                </td>
                            @endif
                        @endif
                    </tr>
                    <tr>
                        <td>
                            @foreach ($transactionFacility as $tF)
                                <p><strong>Tiền dịch vụ {{ $tF->Facility->name }}:
                                    </strong>{{ \App\Helpers\Helper::convertToRupiah($tF->Facility->price * $tF->quantity) }}
                                </p>
                            @endforeach
                        </td>

                    </tr>
                    <tr>
                        <td><strong>Tổng tiền phải trả:
                                {{ \App\Helpers\Helper::convertToRupiah($transaction->sum_money) }}</strong></td>
                        <td><strong style=" color: #e1bd85">Số tiền đã trả:
                                {{ \App\Helpers\Helper::convertToRupiah(($transaction->sum_money * 15) / 100) }}</strong>
                        </td>
                    </tr>
                    @if (!empty($hoan))
                        <tr>
                            <td><strong color: #e1bd85">Số tiền được hoàn lại:
                                    {{ \App\Helpers\Helper::convertToRupiah(($transaction->sum_money * 15) / 100) }}</strong>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td><strong color: #e1bd85">Số tiền được hoàn lại: 0 VNĐ</strong>
                            </td>
                        </tr>
                    @endif

                </table>
                @if (!empty($hoan))
                    <p>Bạn đã hủy trước 2 ngày nên bạn sẽ được hoàn lại tiền cọc. Chúng tôi sẽ gửi lại bạn sau 1 - 2
                        ngày</p>
                @else
                    <p>Bạn đã không hủy trước 2 ngày so với ngày đến nên không được hoàn lại tiền cọc</p>
                @endif


                <div>
                </div>

                <p>Chúng tôi hiểu rằng có những thay đổi trong kế hoạch của bạn và việc hủy đặt homestay có thể gây
                    phiền
                    hà. Nếu bạn có bất kỳ câu hỏi hoặc cần hỗ trợ thêm, vui lòng liên hệ với chúng tôi.</p>
                <p>Chúng tôi rất mong được phục vụ bạn trong tương lai và cảm ơn bạn đã lựa chọn dịch vụ của chúng tôi.
                </p>

                <p><strong>Trân trọng,</strong></p>
                <div class="signature">
                    King The Land
                    <div class="contact-info">
                        Email: kingtheland@gmail.com<br>
                        Phone: 0987124921
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
