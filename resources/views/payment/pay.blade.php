@extends('client.layout.master')
@section('content')
    <style>
        .quantity-container {
            display: flex;
            align-items: center;
            border: 1px solid #ccc; /* Đường bao quanh */
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
            font-size: 14px; /* Tăng giá trị font-size để làm tăng kích thước chữ */
        }
        .quantity-container input {
            border-left: 1px solid #ccc ;
            border-right: 1px solid #ccc ;
        }

        .quantity-container button {
            cursor: pointer;
            background-color: #fff; /* Màu trắng */
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
                        <p>Page đặt Homestay King The Land</p>
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
                                <input type="text" name="coupon" placeholder="Nhập mã giảm giá">
                                <input type="submit" class="btn btn-success" name="check_coupon" value="Tinh ma giam gia">
                            </form>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form method="POST"
                                  action="{{route('transaction.reservation.payOnlinePayment', ['user' => $user->id, 'room' => $room->id])}}">
                                @csrf
                                <div class="reservation-sidebar">
                                    <!-- RESERVATION DATE -->
                                    <div class="reservation-date bg-gray">
                                        <!-- HEADING -->
                                        <h2 class="reservation-heading">Dates</h2>
                                        <!-- END / HEADING -->
                                        <ul>
                                            <li>
                                                <span>Check-In</span>
                                                <span>{{Helper::dateFormat($data['checkin'])}}</span>
                                            </li>
                                            <li>
                                                <span>Check-Out</span>
                                                <span>{{Helper::dateFormat($data['checkout'])}}</span>
                                            </li>
                                            <li>
                                                <span>Total Day</span>
                                                <span>{{$data['total_day']}}</span>
                                            </li>
                                            <li>
                                                <span>Total Guests</span>
                                                <span>{{$data['person']}}</span>
                                            </li>
                                        </ul>

                                    </div>
                                    <!-- END / RESERVATION DATE -->
                                    <!-- ROOM SELECT -->
                                    <div class="reservation-room-selected bg-gray">
                                        <!-- HEADING -->
                                        <h2 class="reservation-heading">Select Homestay</h2>
                                        <!-- END / HEADING -->

                                        <!-- ITEM -->
                                        <div class="reservation-room-seleted_item">


                                            <h6>{{ $room->number }}</h6> <span
                                                class="reservation-option">{{ $room->capacity }} người</span>

                                            <div class="reservation-room-seleted_name has-package">
                                                <h2><a href="#">{{$room->type->name}}</a></h2>
                                            </div>

                                            <div class="reservation-room-seleted_package">
                                                <h6>Space Price</h6>
                                                <ul>
                                                    <li>
                                                        <span>Price/Day</span>
                                                        <span>{{ Helper::convertToRupiah($room->price) }}</span>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="reservation-room-seleted_total-room">
                                                TOTAL DAY
                                                <span
                                                    class="reservation-amout">{{ $data['total_day'] }} {{ Helper::plural('Day', $data['total_day']) }}</span>
                                            </div>


                                            <div class="reservation-room-seleted_total-room">
                                                TOTAL {{$room->number}}
                                                <span
                                                    class="reservation-amout">{{ Helper::convertToRupiah(Helper::getTotalPayment($data['total_day'], $room->price)) }}</span>
                                            </div>
                                            <div class="reservation-room-seleted_total-room">
                                                Mã giảm
                                                @if(session('coupon'))
                                                    @if(session('coupon') -> coupon_condition == 0)
                                                        <span class="reservation-amout"> {{ session('coupon') -> coupon_number}} %</span>
                                                    @elseif(session('coupon') -> coupon_condition == 2)
                                                        <span class="reservation-amout"> {{ session('coupon') -> coupon_number}} VND</span>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="">
                                                <div class="reservation-room-seleted_total-room">
                                                    BẠN CÓ MUỐN
                                                </div>
                                                @php $a = 1; @endphp
                                                @foreach($facilities as $facility)
                                                    <div class="form-check" style="margin-top: 10px">
                                                        <div style="display: flex; justify-content: space-between">
                                                            <div class="col-6">
                                                                <input hidden style="width: 15px; height: 15px" class="form-check-input" name="facility[]" id="check{{$a}}" type="checkbox"
                                                                       value="{{$facility->id}}">
                                                                <label style="font-size: 16px" class="form-check-label" for="flexCheckChecked">
                                                                    {{$facility->name}}
                                                                    ({{Helper::convertToRupiah($facility->price)}})
                                                                </label>
                                                            </div>
                                                            <div class="col-6 quantity-container">
                                                                <button style="width:30px;  height: 30px" type="button" id="tru{{$a}}">-</button>
                                                                <input style="width:40px; height: 30px" type="text" name="quantity[]" id="quantityInput{{$a}}" value="0" readonly>
                                                                <button style="width:30px; height: 30px " type="button" id="cong{{$a}}">+</button>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" id="x{{$a}}" value="0">
                                                        <input type="hidden" id="price{{$a}}" value="{{$facility->price}}">
                                                    </div>
                                                    @php $a +=1; @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- END / ITEM -->
                                        <!-- TOTAL -->
                                        <div class="reservation-room-seleted_total bg-blue">
                                            <label>TOTAL</label>

                                            @if(session('coupon'))
                                                @if(session('coupon') -> coupon_condition == 0)
                                                    @php
                                                        $total_coupon = (Helper::getTotalPayment($data['total_day'], $room->price) * (session('coupon') -> coupon_number)/100);
                                                        echo '<span class="reservation-total">'. Helper::convertToRupiah($total_coupon).'</span>';
                                                    @endphp
                                                @elseif(session('coupon') -> coupon_condition == 2)
                                                    @php
                                                        $total_coupon = (Helper::getTotalPayment($data['total_day'], $room->price) - session('coupon') -> coupon_number);
                                                        echo '<span class="reservation-total">'. Helper::convertToRupiah($total_coupon).'</span>'
                                                    @endphp
                                                @endif
                                            @else
                                                <span class="reservation-total">{{ Helper::convertToRupiah(Helper::getTotalPayment($data['total_day'], $room->price)) }}</span>
                                            @endif
                                        </div>
                                        <!-- END / TOTAL -->
                                    </div>
                                    <!-- END / ROOM SELECT -->
                                </div>
                                <div>
                                    <input type="hidden" value="{{$data['checkin']}}" name="check_in">
                                    <input type="hidden" value="{{$data['checkout']}}" name="check_out">
                                    <input type="hidden" value="{{$data['total_day']}}" name="total_day">
                                    <input type="hidden" value="{{$data['person']}}" name="person">
                                    @if(session('coupon'))
                                        <input type="hidden" id="sum_money" value="{{$total_coupon}}" name="sum_money">
                                        <input type="hidden" name="coupon_id" value="{{session('coupon') -> id}}">
                                    @else
                                        <input type="hidden" id="sum_money" value="{{Helper::getTotalPayment($data['total_day'], $room->price)}}" name="sum_money">
                                    @endif
                                    <input type="hidden" value="1" name="cus">
                                </div>
                                <button style="margin-top: 50px" type="submit" class="awe-btn awe-btn-13">THANH TOÁN
                                    VNPAY
                                </button>
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
    $(document).ready(function () {
        $('.form-check').each(function (index, element) {
            // $('#check'+(index+1)).change(function (){
                var check = document.getElementById('check'+(index+1));
                // if(check.checked){

                    // if($('#x'+(index+1)).val() == 0){
                    $('#cong'+(index+1)).click(function (){
                        // if(check.checked){
                            var quantityInput = document.getElementById('quantityInput'+(index+1));
                            var currentQuantity = parseInt(quantityInput.value, 10);
                            quantityInput.value = currentQuantity + 1;
                            var x = $('#price'+(index+1)).val();
                            var sum = $('#sum_money').val();
                            sum = Number(sum);
                            x = Number(x);
                            sum = sum+x;
                            $('.reservation-total').text(new Intl.NumberFormat("de-DE").format(sum) + 'VND');
                            $('#sum_money').val(sum);
                            $('#x'+(index+1)).val(1);
                            check.checked = true;
                        // }
                    });
                    $('#tru'+(index+1)).click(function (){
                        var quantityInput = document.getElementById('quantityInput'+(index+1));
                        var currentQuantity = parseInt(quantityInput.value, 10);
                        if(currentQuantity>0){
                            quantityInput.value = currentQuantity - 1;
                            var x = $('#price'+(index+1)).val();
                            var sum = $('#sum_money').val();
                            sum = Number(sum);
                            x = Number(x);
                            sum = sum - x;
                            $('.reservation-total').text(new Intl.NumberFormat("de-DE").format(sum) + 'VND');
                            $('#sum_money').val(sum);
                            $('#x'+(index+1)).val(1);
                            if(currentQuantity - 1 == 0){
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

    })
    ;
</script>
