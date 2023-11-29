@extends('client.layout.master')
@section('content')
    <div class="container">
        <!-- HEADER MENU -->

        <!-- END / HEADER MENU -->

        <!-- MENU BAR -->
        <span class="menu-bars">
                        <span></span>
                    </span>
        <!-- END / MENU BAR -->


        <!-- END / HEADER LOGO & MENU -->


        <!-- END / HEADER -->

        <!-- SUB BANNER -->
        <section class="section-sub-banner awe-parallax bg-16">

            <div class="awe-overlay"></div>

            <div class="sub-banner">
                <div class="container">
                    <div class="text text-center">
                        <h2>ĐẶT Homestay</h2>
                        <p>Page đặt homestay King The Land</p>
                    </div>
                </div>

            </div>

        </section>
        <!-- END / SUB BANNER -->

        <!-- RESERVATION -->
        <section class="section-reservation-page bg-white">

            <div class="container">
                <div class="reservation-page">

                    <!-- STEP -->

                    <!-- END / STEP -->

                    <div class="row">
                        <div class="col-md-2 col-lg-2 ">
                        </div>

                        <!-- SIDEBAR -->
                        <div class=" col-md-8 col-lg-8">


                            <div class="reservation-sidebar">

                                <!-- RESERVATION DATE -->
                                <!-- END / RESERVATION DATE -->

                                <!-- ROOM SELECT -->
                                <div class="reservation-room-selected bg-gray">

                                    <!-- HEADING -->
                                    <h2 class="reservation-heading">Xác nhận thông tin </h2>
                                    <!-- END / HEADING -->

                                    <!-- ITEM -->
                                    <div class="reservation-room-seleted_item">

                                        <h6>{{$room->number}}</h6> <span class="reservation-option">{{$room->capacity}} people</span>

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
                                        @if(!empty($facilities))
                                            <div class="reservation-room-seleted_package">
                                                <h6>Facility</h6>
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
                                            TOTAL DAY
                                            <span
                                                class="reservation-amout">{{ $data['total_day'] }} {{ Helper::plural('Day', $data['total_day']) }}</span>
                                        </div>


                                        <div class="reservation-room-seleted_total-room">
                                            TOTAL
                                            <span
                                                class="reservation-amout">{{ Helper::convertToRupiah($data['sum_money']) }}</span>
                                        </div>
                                        <div class="reservation-room-seleted_total-room">
                                            Mini DownPaymment
                                            <span
                                                class="reservation-amout">{{ Helper::convertToRupiah($minimumDownPayment) }}</span>
                                        </div>
                                        <form action="{{route('transaction.reservation.pay')}}" method="post">
                                            @csrf
                                            <div class="reservation-room-seleted_total-room">
                                                PAYMENT
                                                <span class="reservation-amout"><input style="margin-bottom: 50px"
                                                                                       type="text"
                                                                                       name="downPayment"></span>
                                            </div>
                                            <div style="margin-top: 50px">
                                                <button type="submit" name="redirect" class="awe-btn awe-btn-13 ">XÁC NHẬN THANH TOÁN
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
@endsection
