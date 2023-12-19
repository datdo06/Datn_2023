@extends('template.master')
@section('title', 'Choose Day Reservation')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
@endsection
@section('content')
    @include('transaction.reservation.progressbar')
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-8 mt-2">
                <div class="card shadow-sm border">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row mb-3">
                                    <label for="room_number" class="col-sm-2 col-form-label">Homestay</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_number" name="room_number"
                                            placeholder="col-form-label" value="{{ $room->number }} " readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="room_type" class="col-sm-2 col-form-label">Quận/ Huyện</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_type" name="room_type"
                                            placeholder="col-form-label" value="{{ $room->type->name }} " readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="room_capacity" class="col-sm-2 col-form-label">Số người ở</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_capacity" name="room_capacity"
                                            placeholder="col-form-label" value="{{ $room->capacity }} " readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="room_price" class="col-sm-2 col-form-label">Tiền / Đêm</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_price" name="room_price"
                                            placeholder="col-form-label"
                                            value="{{ Helper::convertToRupiah($room->price) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-sm-12 mt-2">
                                <form method="POST"
                                    action="{{ route('transaction.reservation.payOnlinePayment', ['user' => $user->id, 'room' => $room->id]) }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="check_in" class="col-sm-2 col-form-label">Ngày đến</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="check_in" name="check_in"
                                                placeholder="col-form-label" value="{{ $stayFrom }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="check_out" class="col-sm-2 col-form-label">Ngày đi</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="check_out" name="check_out"
                                                placeholder="col-form-label" value="{{ $stayUntil }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="how_long" class="col-sm-2 col-form-label">Tổng số ngày ở</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="how_long" name="how_long"
                                                placeholder="col-form-label"
                                                value="{{ $dayDifference }} Ngày"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="how_long" class="col-sm-2 col-form-label">Tổng số người ở</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="how_long" name="person"
                                                   placeholder="col-form-label"
                                                   value="{{ $person }} người"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="total_price" class="col-sm-2 col-form-label">Tổng tiền</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="total_price" name="total_price"
                                                placeholder="col-form-label"
                                                value="{{ Helper::convertToRupiah(Helper::getTotalPayment($dayDifference, $room->price)) }} "
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="minimum_dp" class="col-sm-2 col-form-label">Số tiền tối thiểu phải trả</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="minimum_dp" name="minimum_dp"
                                                placeholder="col-form-label"
                                                value="{{ Helper::convertToRupiah($downPayment) }} " readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="downPayment" class="col-sm-2 col-form-label">Thanh toán</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                class="form-control @error('downPayment') is-invalid @enderror"
                                                id="downPayment" name="downPayment" placeholder="Nhập số tiền thanh toán"
                                                value="{{ old('downPayment') }}">
                                            @error('downPayment')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10" id="showPaymentType"></div>
                                    </div>
                                    <input type="hidden" value="{{Helper::getTotalPayment($dayDifference, $room->price)}}" name="sum_money">
                                    <input type="hidden" value="{{$person}}" name="person" >
                                    <input type="hidden" value="{{$dayDifference}}" name="total_day">
                                    <button type="submit" class="btn btn-primary float-end" >Thanh toán</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="card shadow-sm">
                    <img src="{{ $user->getAvatar() }}"
                        style="border-top-right-radius: 0.5rem; border-top-left-radius: 0.5rem">
                    <div class="card-body">
                        <table>
                            <tr>
                                <td>
                                    {{ $user->name }}
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
    $('#downPayment').keyup(function() {
        $('#showPaymentType').text('Rp. ' + parseFloat($(this).val(), 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1.")
            .toString());
    });
</script>
@endsection
