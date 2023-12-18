@extends('client.layout.master')
@section('content')
    <div class="container">
        <span class="menu-bars">
                        <span></span>
                    </span>
        <section class="section-sub-banner awe-parallax bg-16">
            <div class="awe-overlay"></div>
            <div class="sub-banner">
                <div class="container">
                    <div class="text text-center">
                        <h2>ĐẶT Homestay</h2>
                        <p>Thanh toán</p>
                        <p>King The Land</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-reservation-page bg-white">
            <div class="container">
                <div class="reservation-page">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 ">
                        </div>
                        <div class=" col-md-8 col-lg-8">
                            <div class="reservation-sidebar">
                                <div class="reservation-room-selected bg-gray">
                                    <h2 class="reservation-heading">Xác nhận thông tin </h2>
                                    <div class="reservation-room-seleted_item">
                                        <h6>{{$room->number}}</h6> <span class="reservation-option">{{$room->capacity}} người</span>
                                        <div class="reservation-room-seleted_name has-package">
                                            <h2><a href="#">{{$room->type->name}}</a></h2>
                                        </div>
                                        <div class="reservation-room-seleted_package">
                                            <h6>Giá Thuê</h6>
                                            <ul>
                                                <li>

                                                   <span>Tiền/Ngày</span>
                                                   <span>{{ Helper::convertToRupiah($room->price) }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        @if(!empty($facilities))
                                            <div class="reservation-room-seleted_package">
                                                <h6>Dịch vụ thêm</h6>
                                                <ul>
                                                    @foreach($facilities as $key => $facility)
                                                        @if(empty($quantity[$key]))
                                                            <li>
                                                                <span>{{$facility->name}} x {{$quantity[$key]+1}}</span>
                                                                <span> {{ Helper::convertToRupiah($facility->price * ($quantity[$key]+1)) }}</span>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <span>{{$facility->name}} x {{$quantity[$key]}}</span>
                                                                <span> {{ Helper::convertToRupiah($facility->price * $quantity[$key]) }}</span>
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ul>
                                            </div>
                                        @endif
                                        <div class="reservation-room-seleted_total-room">
                                            Tổng số ngày
                                            <span

                                                class="reservation-amout">{{ $data['total_day'] }} Ngày</span>
                                        </div>


                                            @if (session('coupon'))
                                            <div class="reservation-room-seleted_total-room">
                                             Mã giảm
                                                @if (session('coupon')->coupon_condition == 0)
                                                    <span class="reservation-amout">
                                                        {{ session('coupon')->coupon_number }} %</span>
                                                @elseif(session('coupon')->coupon_condition == 2)
                                                    <span class="reservation-amout">
                                                        {{  Helper::convertToRupiah(session('coupon')->coupon_number)  }} VND</span>
                                                @endif
                                            </div>
                                            @endif


                                        <div class="reservation-room-seleted_total-room">

                                            Tổng tiền

                                            <span
                                                class="reservation-amout">{{ Helper::convertToRupiah($data['sum_money']) }}</span>
                                        </div>
                                        @if(!empty(auth()->user()->id))
                                            <div class="reservation-room-seleted_total-room">

                                                Họ và tên

                                                <span
                                                    class="reservation-amout">{{auth()->user()->name}}</span>
                                            </div>
                                            <div class="reservation-room-seleted_total-room">

                                                Email

                                                <span
                                                    class="reservation-amout">{{auth()->user()->email}}</span>
                                            </div>
                                            <div class="reservation-room-seleted_total-room">

                                                Số điện thoại

                                                <span
                                                    class="reservation-amout">{{auth()->user()->phone}}</span>
                                            </div>
                                        @else
                                            <div class="reservation-room-seleted_total-room">

                                                Họ và tên

                                                <span
                                                    class="reservation-amout">{{$data['guest_name']}}</span>
                                            </div>
                                            <div class="reservation-room-seleted_total-room">

                                                Email

                                                <span
                                                    class="reservation-amout">{{$data['guest_email']}}</span>
                                            </div>
                                            <div class="reservation-room-seleted_total-room">

                                                Số điện thoại

                                                <span
                                                    class="reservation-amout">{{$data['guest_phone']}}</span>
                                            </div>
                                        @endif
                                        <div class="reservation-room-seleted_total-room">

                                            Tiền cọc

                                            <span
                                                class="reservation-amout">{{ Helper::convertToRupiah($minimumDownPayment) }}</span>
                                            <input type="hidden" id="minimum" value="{{$minimumDownPayment}}">
                                        </div>
                                        <form action="{{route('transaction.reservation.pay')}}" method="post"
                                              id="formBook">
                                            @csrf
                                            <div class="reservation-room-seleted_total-room">


                                                Thanh toán

                                                <span class="reservation-amout">
                                                    <select name="downPayment" id="downPayment" class="form-control">
                                                        <option
                                                            value="{{$minimumDownPayment}}">Thanh toán tiền cọc</option>
                                                        <option
                                                            value="{{$data['sum_money']}}">Thanh toán toàn bộ</option>
                                                    </select>
                                                </span>
                                            </div>
                                            <input type="hidden" id="sum_money" value="{{$data['sum_money']}}">

                                            <div style="margin-top: 50px">
                                                <input type="hidden" name="redirect">
                                                <button type="button" class="awe-btn awe-btn-13 "
                                                        id="btn">XÁC NHẬN THANH TOÁN
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END / ITEM -->

                                </div>
                                <!-- END / ROOM SELECT -->

                            </div>


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
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
    <script>
        $(document).on('click', '#btn', function () {
            var minimum = $('#minimum').val();
            console.log(minimum);
            minimum = parseFloat(minimum);
            var downPayment = $('#downPayment').val();
            if (downPayment == "") {
                downPayment = 0;
            }
            downPayment = parseFloat(downPayment);
            console.log(downPayment);
            var sum_money = $('#sum_money').val();
            sum_money = parseFloat(sum_money);
            console.log(sum_money);
            if (downPayment < minimum) {
                alert('Số tiền không được nhỏ hơn số tiền tối thiểu');
            } else if (downPayment > sum_money) {
                alert('Số tiền không được lớn hơn tổng số tiền cần thanh toán');
            } else {
                $('#formBook').submit();
            }
        });
    </script>
@endsection
