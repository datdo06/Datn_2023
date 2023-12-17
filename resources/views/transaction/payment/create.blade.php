@extends('template.master')
@section('title', $transaction->guest_name . ' Pay Reservation')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class=" col-sm-2 col-form-label">Homestay</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $transaction->room->number }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Ngày đến</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                    value="{{ Helper::dateFormat($transaction->check_in) }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Ngày đi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                    value="{{ Helper::dateFormat($transaction->check_out) }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class=" col-sm-2 col-form-label">Giá Homestay</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                    value="{{ Helper::convertToRupiah($transaction->room->price) }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Số ngày đặt</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                    value="{{ $transaction->getDateDifferenceWithPlural($transaction->check_in, $transaction->check_out) }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Tổng tiền</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                    value="{{ Helper::convertToRupiah($transaction->sum_money) }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Đã trả</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                    value="{{ Helper::convertToRupiah($transaction->getTotalPayment()) }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Số tiền chưa trả</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                    value="{{ Helper::convertToRupiah($transaction->sum_money - $transaction->getTotalPayment()) }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="POST"
                                    action="{{ route('transaction.payment.store', ['transaction' => $transaction->id]) }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input type="hidden" class="form-control @error('payment') is-invalid @enderror"
                                                placeholder="Nhập số tiền thanh toán" value="{{$transaction->sum_money - $transaction->getTotalPayment()}}" id="payment" name="payment">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10" id="showPaymentType"></div>
                                    </div>
                                    @error('payment')
                                        <div class="text-danger mt-1">
{{--                                            {{ $message }}--}}
                                        </div>
                                    @enderror
                                    <button class="btn btn-success float-end">Đã thanh toán</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mt-2">
                <div class="card shadow-sm">

                    <div class="card-body">
                        <table>
                            <tr>
                                <td style="text-align: center; width:50px">
                                    <span>
                                        <i
                                            class="fas {{ $transaction->gender == 'Male' ? 'fa-male' : 'fa-female' }}">
                                        </i>
                                    </span>
                                </td>
                                <td>
                                    {{ $transaction->guest_name }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; ">
                                    <span>
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                </td>
                                <td>
                                    {{ $transaction->location }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
<script>
    $('#payment').keyup(function() {
        $('#showPaymentType').text('Rp. ' + parseFloat($(this).val(), 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1,")
            .toString());
    });

</script>
@endsection
