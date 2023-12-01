@extends('template.invoicemaster')
@section('title', 'Payment')
@section('head')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap');

        body {
            font-family: 'Maven Pro', sans-serif;
        }

        hr {
            color: #0000004f;
            margin-top: 5px;
            margin-bottom: 5px
        }

        .add td {
            color: #c5c4c4;
            text-transform: uppercase;
            font-size: 12px
        }

        .content {
            font-size: 14px
        }
    </style>
@endsection
@section('content')

    <div class="container mt-5 mb-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="d-flex flex-row p-2"><img src="{{ asset('img/logo/sip.png') }}" width="48">
                        <div class="d-flex flex-column"><span class="font-weight-bold">Hóa đơn</span>
                            <small>Hóa đơn-{{ $transaction->id }}</small>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive p-2">
                        <table class="table table-borderless">
                            <tbody>
                            <tr class="add">
                                <td>Từ</td>
                                <td>Đến</td>
                                <td class="text-center">Ngày</td>
                            </tr>
                            <tr class="content">
                                <td class="font-weight-bold"> {{ Helper::dateDayFormat($transaction->check_in) }}</td>
                                <td class="font-weight-bold"> {{ Helper::dateDayFormat($transaction->check_out) }}</td>
                                <td class="text-center">{{ $transaction->getDateDifferenceWithPlural() }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="products p-2">
                        <table class="table table-borderless">
                            <tbody>
                            <tr class="add">
                                <td>Mô tả</td>
                                <td>Tổng số người</td>
                                <td class="text-center">Giá homestay / ngày</td>
                                <td class="text-center">Tổng giá</td>
                            </tr>
                            <tr class="content">
                                <td>{{ $transaction->room->type->name }} -
                                    {{ $transaction->room->number }}</td>

                                <td>{{ $transaction->sum_people }}</td>
                                <td class="text-center">
                                    {{ Helper::convertToRupiah($transaction->room->price) }}</td>
                                <td class="text-center">
                                    {{ Helper::convertToRupiah($transaction->getTotalPrice()) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @if (!empty($transactionCoupon))
                        <hr>
                        <div class="products p-2">
                            <table class="table table-borderless">
                                <tbody>
                                <tr class="add">
                                    <td>Mã giảm giá sử dụng</td>
                                    <td>Bạn đươc giảm</td>
                                </tr>
                                <tr>
                                    @if($transactionCoupon->Coupon->coupon_condition == 2)
                                        <td>{{\App\Helpers\Helper::convertToRupiah($transactionCoupon->Coupon->coupon_number)}}</td>
                                    @else
                                        <td>{{\App\Helpers\Helper::convertToRupiah(($price*$transactionCoupon->Coupon->coupon_number/100))}}</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if (!empty($transaction_facilities))
                        <hr>
                        <div class="products p-2">
                            <table class="table table-borderless">
                                <tbody>
                                <tr class="add">

                                    <td>Dịch vụ thêm</td>
                                    <td>Số lượng</td>
                                    <td>Giá</td>

                                </tr>
                                @foreach ($transaction_facilities as $transaction_facility)
                                    <tr>
                                        <td>
                                            {{ $transaction_facility->Facility->name }}</td>
                                        <td>{{ $transaction_facility->quantity}}</td>
                                        <td>{{ Helper::convertToRupiah(($transaction_facility->Facility->price * $transaction_facility->quantity)) }}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <hr>
                    <div class="products p-2">
                        <table class="table table-borderless">
                            <tbody>
                            <tr class="add">
                                <td>Khoản trả trước tối thiểu</td>
                                <td>Trả hết</td>
                                <td>Thanh toán không đủ</td>
                                <td>Tổng thanh toán</td>
                            </tr>
                            <tr class="content">
                                <td>{{ Helper::convertToRupiah($transaction->getMinimumDownPayment()) }}</td>
                                <td>{{ Helper::convertToRupiah($transaction->getTotalPayment()) }}</td>
                                <td>{{ $transaction->sum_money - $transaction->getTotalPayment() <= 0 ? '-' : Helper::convertToRupiah($transaction->sum_money - $transaction->getTotalPayment()) }}</td>
                                <td>{{ Helper::convertToRupiah($transaction->sum_money) }} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="address p-2">
                        <table class="table table-borderless">
                            <tbody>
                            <tr class="add">
                                <td>Chi tiết khách hàng</td>
                            </tr>
                            <tr class="content">
                                <td>
                                    Tên khách hàng : {{ $transaction->user->name }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="address p-2">
                        @if (Helper::getDateDifference(now(), $transaction->check_in) > 0)
                            <form action="{{ route('cancelHomestay', $transaction->id) }}" id="form" method="post">
                                @csrf
                                <button style="color: #fff;background-color: #d9534f;border-color: #d43f3a;"
                                        onclick="if(confirm('Bạn có muốn hủy')){
                                document.getElementById('#form').submit();
                            }">Hủy
                                    Homestay
                                </button>
                            </form>
                        @elseif(Helper::getDateDifference($transaction->check_in, now()) > 0 &&
                                Helper::getDateDifference(now(), $transaction->out) > 0)
                            <p>Khách đang trải nghiệm tại homestay</p>
                        @elseif(Helper::getDateDifference($transaction->out, now()) > 0)
                            <p>Khách đã thuê xong</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
