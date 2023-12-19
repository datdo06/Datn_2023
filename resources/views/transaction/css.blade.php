@extends('template.master')
@section('title', 'Payment')
@section('content')
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
                                    <label for="room_type" class="col-sm-2 col-form-label">Địa chỉ</label>
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
                            <div class="col-sm-12">
                                <form action="{{route('transaction.reservation.pay')}}" method="post">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="check_in" class="col-sm-2 col-form-label">Ngày đến</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="check_in" name="check_in"
                                                   placeholder="col-form-label" value="{{ $data['check_in'] }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="check_out" class="col-sm-2 col-form-label">Ngày đi</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="check_out" name="check_out"
                                                   placeholder="col-form-label" value="{{ $data['check_out'] }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="how_long" class="col-sm-2 col-form-label">Số ngày</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="how_long" name="how_long"
                                                   placeholder="col-form-label"
                                                   value="{{ $data['how_long'] }} "
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="total_price" class="col-sm-2 col-form-label">Tổng tiền</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="total_price" name="total_price"
                                                   placeholder="col-form-label"
                                                   value="{{$data['total_price'] }} "
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="minimum_dp" class="col-sm-2 col-form-label">Tiền cọc</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="minimum_dp" name="minimum_dp"
                                                   placeholder="col-form-label"
                                                   value="{{ $data['minimum_dp'] }} " readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="downPayment" class="col-sm-2 col-form-label">Nhập số tiền muốn thanh toán</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                   class="form-control @error('downPayment') is-invalid @enderror"
                                                   id="downPayment" name="downPayment"
                                                   value="{{ Helper::convertToRupiah($data['downPayment']) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10" id="showPaymentType"></div>
                                    </div>
                                    <button type="submit " class="btn btn-primary" name="redirect">Xác nhận thanh toán</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
