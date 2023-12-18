@extends('client.layout.master')
@section('content')
    <style>
        .quantity-container {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            /* Đường bao quanh */
            border-radius: 5px;
            overflow: hidden;
        }

        .quantity-container button,
        .quantity-container input {
            margin: 0;
            /* Tăng giá trị padding để làm tăng kích thước */
            box-sizing: border-box;
            border-bottom: 1px solid white;
            border-top: 1px solid white;
            border-left: 1px solid white;
            border-right: 1px solid white;
            font-size: 14px;
            /* Tăng giá trị font-size để làm tăng kích thước chữ */
        }

        .quantity-container input {
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
        }

        .quantity-container button {
            cursor: pointer;
            background-color: #fff;
            /* Màu trắng */
        }

        .quantity-container input {
            width: 30px;
            text-align: center;
        }
    </style>
    <div class="container">
        <span class="menu-bars">
            <span></span>
        </span>
        <section class="section-sub-banner awe-parallax bg-16">

            <div class="awe-overlay"></div>

            <div class="sub-banner">
                <div class="container">
                    <div class="text text-center">
                        <h2>Đặt Homestay</h2>

                        <p>Xác nhận thông tin</p>

                    </div>
                </div>

            </div>

        </section>
        <!-- END / SUB BANNER -->

        <!-- RESERVATION -->
        <section class="section-reservation-page bg-white">

            <div class="container">
                <div class="reservation-page">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 ">
                        </div>
                        <div class=" col-md-8 col-lg-8">
                            <form action="{{ route('check-coupon') }}" method="POST">
                                @csrf
                                <input type="text" name="coupon" style="width: 500px" placeholder="Nhập mã giảm giá">
                                <input style="margin-left: 20px" type="submit" class="awe-btn awe-btn-3 btn-medium font-hind bold f12 mt30" name="check_coupon"
                                    value="Tính mã giảm giá">
                                @if (Session::get('coupon'))
                                    <a class="awe-btn awe-btn-4 btn-medium font-hind bold f12 mt30"
                                        href="{{ route('unset-coupon') }}">Xóa mã đang áp dụng</a>
                                @endif
                            </form>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form method="POST"
                                action="{{ route('transaction.reservation.payOnlinePayment', ['room' => $room->id]) }}" id="form">
                                @csrf
                                <div class="reservation-sidebar">
                                    <!-- RESERVATION DATE -->
                                    <div class="reservation-date bg-gray">
                                        <!-- HEADING -->

                                        <h2 class="reservation-heading">Thời gian</h2>

                                        <!-- END / HEADING -->
                                        <ul>
                                            <li>
                                                <span>Ngày đến</span>
                                                <span>{{ Helper::dateFormat($data['checkin']) }}</span>
                                            </li>
                                            <li>
                                                <span>Ngày đi</span>
                                                <span>{{ Helper::dateFormat($data['checkout']) }}</span>
                                            </li>
                                            <li>

                                                <span>Tổng số ngày </span>

                                                <span>{{ $data['total_day'] }}</span>
                                            </li>
                                            <li>
                                                <span>Tổng số người</span>
                                                <span>{{ $data['person'] }}</span>
                                            </li>
                                        </ul>

                                    </div>
                                    <!-- END / RESERVATION DATE -->
                                    <!-- ROOM SELECT -->
                                    <div class="reservation-room-selected bg-gray">
                                        <!-- HEADING -->


                                        <h2 class="reservation-heading">Thông tin Homestay</h2>


                                        <!-- END / HEADING -->

                                        <!-- ITEM -->
                                        <div class="reservation-room-seleted_item">


                                            <h6>{{ $room->number }}</h6> <span
                                                class="reservation-option">Số người ở tối đa: {{ $room->capacity }}</span>

                                            <div class="reservation-room-seleted_name has-package">
                                                <h2><a href="#">{{ $room->type->name }}</a></h2>
                                            </div>

                                            <div class="reservation-room-seleted_package">
                                                <h6>Giá Thuê</h6>
                                                <ul>
                                                    <li>
                                                        <span>Tiền/Đêm</span>

                                                        <span>{{ Helper::convertToRupiah($room->price) }}</span>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="reservation-room-seleted_total-room">

                                                Tổng số ngày

                                                <span class="reservation-amout">{{ $data['total_day'] }}
                                                    {{ Helper::plural('', $data['total_day']) }} Ngày</span>
                                            </div>


                                            <div class="reservation-room-seleted_total-room">


                                                Tổng tiền phòng

                                                {{ $room->number }}

                                                <span
                                                    class="reservation-amout">{{ Helper::convertToRupiah(Helper::getTotalPayment($data['total_day'], $room->price)) }}</span>
                                            </div>
                                           
                                                @if (session('coupon'))
                                                <div class="reservation-room-seleted_total-room">
                                                    Mã giảm
                                                    @if (session('coupon')->coupon_condition == 0)
                                                        <span class="reservation-amout">
                                                            {{ session('coupon')->coupon_number }} %</span>
                                                    @elseif(session('coupon')->coupon_condition == 2)
                                                        <span class="reservation-amout">
                                                            {{ Helper::convertToRupiah(session('coupon')->coupon_number) }} VND</span>
                                                    @endif
                                                </div>
                                                @endif
                                           
                                            <div class="">
                                                <div class="reservation-room-seleted_total-room">
                                                    THUÊ THÊM DỊCH VỤ
                                                </div>
                                                @php $a = 1; @endphp
                                                @foreach ($facilities as $facility)
                                                    <div class="form-check" style="margin-top: 10px">
                                                        <div style="display: flex; justify-content: space-between">
                                                            <div class="col-6">
                                                                <input hidden style="width: 15px; height: 15px"
                                                                    class="form-check-input" name="facility[]"
                                                                    id="check{{ $a }}" type="checkbox"
                                                                    value="{{ $facility->id }}">
                                                                <label style="font-size: 16px" class="form-check-label"
                                                                    for="flexCheckChecked">
                                                                    {{ $facility->name }} (1 lần)
                                                                    ({{ Helper::convertToRupiah($facility->price) }})
                                                                </label>
                                                            </div>
                                                            <div class="col-6 quantity-container">
                                                                <button style="width:30px;  height: 30px" type="button"
                                                                    id="tru{{ $a }}">-
                                                                </button>
                                                                <input style="width:40px; height: 30px" type="text"
                                                                    name="quantity[]" id="quantityInput{{ $a }}"
                                                                    value="0" readonly>
                                                                <button style="width:30px; height: 30px " type="button"
                                                                    id="cong{{ $a }}">+
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" id="x{{ $a }}" value="0">
                                                        <input type="hidden" id="price{{ $a }}"
                                                            value="{{ $facility->price }}">
                                                    </div>
                                                    @php $a +=1; @endphp
                                                @endforeach

                                            </div>


                                        </div>

                                        <!-- END / ITEM -->
                                        <!-- TOTAL -->
                                        <div class="reservation-room-seleted_total bg-blue">
                                            <label>Tổng tiền</label>
                                            @if (session('coupon'))
                                                @if (session('coupon')->coupon_condition == 0)
                                                    @php
                                                        $total_coupon = (Helper::getTotalPayment($data['total_day'], $room->price) * session('coupon')->coupon_number) / 100;
                                                        echo '<span class="reservation-total">' . Helper::convertToRupiah($total_coupon) . '</span>';
                                                    @endphp
                                                @elseif(session('coupon')->coupon_condition == 2)
                                                    @php
                                                        $total_coupon = Helper::getTotalPayment($data['total_day'], $room->price) - session('coupon')->coupon_number;
                                                        echo '<span class="reservation-total">' . Helper::convertToRupiah($total_coupon) . '</span>';
                                                    @endphp
                                                @endif
                                            @else
                                                <span
                                                    class="reservation-total">{{ Helper::convertToRupiah(Helper::getTotalPayment($data['total_day'], $room->price)) }}</span>
                                            @endif
                                        </div>
                                        <!-- END / TOTAL -->
                                    </div>
                                    <!-- END / ROOM SELECT -->
                                    <div>
                                        <input type="hidden" value="{{ $data['checkin'] }}" name="check_in">
                                        <input type="hidden" value="{{ $data['checkout'] }}" name="check_out">
                                        <input type="hidden" value="{{ $data['total_day'] }}" name="total_day">
                                        <input type="hidden" value="{{ $data['person'] }}" name="person">

                                        @if (session('coupon'))
                                            <input type="hidden" id="sum_money" value="{{ $total_coupon }}"
                                                name="sum_money">
                                            <input type="hidden" name="coupon_id" value="{{ session('coupon')->id }}">
                                        @else
                                            <input type="hidden" id="sum_money"
                                                value="{{ Helper::getTotalPayment($data['total_day'], $room->price) }}"
                                                name="sum_money">
                                        @endif
                                        <input type="hidden" value="1" name="cus">
                                    </div>
                                    @if (!empty(auth()->user()->id))
                                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                    @else

                                        <div class="comment-respond">
                                            <h3 class="comment-reply-title">Nhập thông tin của bạn</h3>
                                            <div class="comment-form">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="field-text" name="guest_name" placeholder="Họ và tên" id="name" required><br>
                                                        <p class="errorName" style="color: red"></p>
                                                    </div>
                                                    <div class="col-sm-12">

                                                        <input type="text" class="field-text" name="guest_email" placeholder="Email" id="email" required><br>
                                                        <p class="errorEmail" style="color: red"></p>
                                                    </div>
                                                    <div class="col-sm-12">

                                                        <input type="text" class="field-text" name="guest_phone" placeholder="Số điện thoại" id="phone" required><br>
                                                        <p class="errorPhone" style="color: red"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <br>
                                    @if(!empty(auth()->user()->id))
                                        <button style="margin-top: 5px" type="submit" class="awe-btn awe-btn-13">THANH TOÁN
                                            BẰNG
                                            VNPAY
                                        </button>
                                    @else
                                        <button style="margin-top: 5px" id="sub" type="button" class="awe-btn awe-btn-13">THANH TOÁN
                                            BẰNG
                                            VNPAY
                                        </button>
                                    @endif

                                </div>
                            </form>


                        </div>
                        <!-- END / SIDEBAR -->

                        <!-- CONTENT -->
                        <div class="col-md-2 col-lg-2 ">
                        </div>

                        <!-- END / CONTENT -->

                    </div>
                </div>
            </div>

        </section>
        <!-- END / RESERVATION -->

        <!-- FOOTER -->
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#sub').click(function (){
            var check = true;
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var filter = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var filterPhone = /^[0-9-+]+$/;
            if(name == ""){
                $('.errorName').html('Tên của bạn không được để trống');
                check = false;
            }else{
                $('.errorName').html('');
                check = true;
            }

            if(email == ""){
                $('.errorEmail').html('Email của bạn không được để trống');
                check = false;
                console.log(check);
            }
            else if(!(filter.test(email))){
                $('.errorEmail').html('Email của bạn không đúng định dạng');
                check = false;
                console.log(check);
            }else{
                $('.errorEmail').html('');
                check = true;
                console.log(check);
            }
            if (phone == ""){
                $('.errorPhone').html('Số điện thoại của bạn không được để trống');
                check = false;
                console.log(check);
            }else if(!(filterPhone.test(phone))){
                $('.errorPhone').html('Số điện thoại của bạn không đúng định dạng');
                check = false;
                console.log(check);
            }else if(phone.length != 10){
                $('.errorPhone').html('Số điện thoại của bạn phải là 10 số');
                check = false;
            }else{
                $('.errorPhone').html('');
                check = true;
            }
            if(check){
                $('#form').submit();
            }

        })


        $('.form-check').each(function(index, element) {
            // $('#check'+(index+1)).change(function (){
            var check = document.getElementById('check' + (index + 1));
            // if(check.checked){

            // if($('#x'+(index+1)).val() == 0){
            $('#cong' + (index + 1)).click(function() {
                // if(check.checked){
                var quantityInput = document.getElementById('quantityInput' + (index + 1));
                var currentQuantity = parseInt(quantityInput.value, 10);
                quantityInput.value = currentQuantity + 1;
                var x = $('#price' + (index + 1)).val();
                var sum = $('#sum_money').val();
                sum = Number(sum);
                x = Number(x);
                sum = sum + x;
                $('.reservation-total').text(new Intl.NumberFormat("de-DE").format(sum) +
                    'VND');
                $('#sum_money').val(sum);
                $('#x' + (index + 1)).val(1);
                check.checked = true;
                // }
            });
            $('#tru' + (index + 1)).click(function() {
                var quantityInput = document.getElementById('quantityInput' + (index + 1));
                var currentQuantity = parseInt(quantityInput.value, 10);
                if (currentQuantity > 0) {
                    quantityInput.value = currentQuantity - 1;
                    var x = $('#price' + (index + 1)).val();
                    var sum = $('#sum_money').val();
                    sum = Number(sum);
                    x = Number(x);
                    sum = sum - x;
                    $('.reservation-total').text(new Intl.NumberFormat("de-DE").format(sum) +
                        'VND');
                    $('#sum_money').val(sum);
                    $('#x' + (index + 1)).val(1);
                    if (currentQuantity - 1 == 0) {
                        check.checked = false;
                    }
                }
            });
            // }else if($('#x'+(index+1)).val() != 0){
            //
            // }
            // }else{
            //     var quantityInput = document.getElementById('quantityInput'+(index+1));
            //     var currentQuantity = parseInt(quantityInput.value, 10);
            //     var sum = $('#sum_money').val();
            //     var x = $('#price'+(index+1)).val();
            //     sum = Number(sum);
            //     x = Number(x);
            //     x = x * currentQuantity;
            //     sum = sum - x;
            //     $('.reservation-total').text(new Intl.NumberFormat("de-DE").format(sum) + 'VND');
            //     $('#sum_money').val(sum);
            //     $('#x'+(index+1)).val(0);
            //     quantityInput.value = 0;
            // }
            // })
        });

    });
</script>
