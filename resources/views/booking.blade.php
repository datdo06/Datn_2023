@extends('client.layout.master')
@section('content')
    <!-- SUB BANNER -->
    <section class="section-sub-banner awe-parallax bg-16">

        <div class="awe-overlay"></div>

        <div class="sub-banner">
            <div class="container">
                <div class="text text-center">
                    <h2>Đặt phòng</h2>
                    <p>King The Land</p>
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
                    <!-- SIDEBAR -->
                    <div class="col-md-4 col-lg-3">

                        <div class="reservation-sidebar">

                            <!-- RESERVATION DATE -->
                            <div class="reservation-date bg-gray">

                                <!-- HEADING -->
                                <h2 class="reservation-heading">Ngày</h2>
                                <!-- END / HEADING -->

                                <ul>
                                    <li>
                                        <span>Đăng ký vào</span>
                                        <span>Thứ 5 ngày 06/03/2019</span>
                                    </li>
                                    <li>
                                        <span>Đăng ký ra</span>
                                        <span>Thứ 7 06/06/2019</span>
                                    </li>
                                    <li>
                                        <span>Tổng số đêm</span>
                                        <span>2</span>
                                    </li>
                                    <li>
                                        <span>Tổng số phòng</span>
                                        <span>2 trên 2</span>
                                    </li>
                                    <li>
                                        <span>Tổng số khách</span>
                                        <span>4 người lớn 1 trẻ em</span>
                                    </li>
                                </ul>

                            </div>
                            <!-- END / RESERVATION DATE -->

                            <!-- ROOM SELECT -->
                            <div class="reservation-room-selected bg-gray">

                                <!-- HEADING -->
                                <h2 class="reservation-heading">Select Rooms</h2>
                                <!-- END / HEADING -->

                                <!-- ITEM -->
                                <div class="reservation-room-seleted_item">

                                    <h6>ROOM 1</h6> <span class="reservation-option">2 Adult, 1 Child</span>

                                    <div class="reservation-room-seleted_name has-package">
                                        <h2><a href="#">LUXURY ROOM</a></h2>
                                    </div>

                                    <div class="reservation-room-seleted_package">
                                        <h6>Space Price</h6>
                                        <ul>
                                            <li>
                                                <span>3 June 2015</span>
                                                <span>$250.00</span>
                                            </li>
                                            <li>
                                                <span>6 June 2015</span>
                                                <span>$320.00</span>
                                            </li>
                                        </ul>

                                        <ul>
                                            <li>
                                                <span>Service</span>
                                                <span>Free</span>
                                            </li>
                                            <li>
                                                <span>Tax</span>
                                                <span>$320.00</span>
                                            </li>
                                        </ul>

                                    </div>

                                    <div class="reservation-room-seleted_total-room">
                                        TOTAL Room 1
                                        <span class="reservation-amout">$470.00</span>
                                    </div>

                                </div>
                                <!-- END / ITEM -->

                                <!-- ITEM -->
                                <div class="reservation-room-seleted_item">
                                    <h6>ROOM 2</h6> <span class="reservation-option">2 Adult, 1 Child</span>
                                    <div class="reservation-room-seleted_name has-package">
                                        <h2><a href="#">LUXURY ROOM</a></h2>
                                    </div>

                                    <div class="reservation-room-seleted_package">
                                        <h6>Space Price</h6>
                                        <ul>
                                            <li>
                                                <span>3 June 2015</span>
                                                <span>$250.00</span>
                                            </li>
                                            <li>
                                                <span>6 June 2015</span>
                                                <span>$320.00</span>
                                            </li>
                                        </ul>

                                        <ul>
                                            <li>
                                                <span>Service</span>
                                                <span>Free</span>
                                            </li>
                                            <li>
                                                <span>Tax</span>
                                                <span>$320.00</span>
                                            </li>
                                        </ul>

                                    </div>

                                    <div class="reservation-room-seleted_total-room">
                                        TOTAL Room 2
                                        <span class="reservation-amout">$470.00</span>
                                    </div>

                                </div>
                                <!-- END / ITEM -->

                                <!-- TOTAL -->
                                <div class="reservation-room-seleted_total bg-blue">
                                    <label>TOTAL</label>
                                    <span class="reservation-total">$470.00</span>
                                </div>
                                <!-- END / TOTAL -->

                            </div>
                            <!-- END / ROOM SELECT -->

                        </div>

                    </div>
                    <!-- END / SIDEBAR -->

                    <!-- CONTENT -->
                    <div class="col-md-8 col-lg-9">

                        <div class="reservation_content">

                            <div class="reservation-billing-detail">

                                <p class="reservation-login">Returning customer? <a href="#">Click here to login</a></p>

                                <h4>BILLING DETAILS</h4>

                                <label>Country <sup>*</sup></label>
                                <select class="awe-select">
                                    <option>United Kingdom (Uk)</option>
                                    <option>Viet Nam</option>
                                    <option>Thai Lan</option>
                                    <option>China</option>
                                </select>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name<sup>*</sup></label>
                                        <input type="text" class="input-text">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Last Name<sup>*</sup></label>
                                        <input type="text" class="input-text">
                                    </div>
                                </div>

                                <label>Company Name</label>
                                <input type="text" class="input-text">

                                <label>Address<sup>*</sup></label>
                                <input type="text" class="input-text" placeholder="Street Address">
                                <br><br>
                                <input type="text" class="input-text" placeholder="Apartment, suite, unit etc. (Optional)">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Town / City<sup>*</sup></label>
                                        <input type="text" class="input-text">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Country<sup>*</sup></label>
                                        <input type="text" class="input-text">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Email Address<sup>*</sup></label>
                                        <input type="text" class="input-text">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Phone<sup>*</sup></label>
                                        <input type="text" class="input-text">
                                    </div>
                                </div>

                                <label>Order Notes</label>
                                <textarea class="input-textarea" placeholder="Notes about your order, eg. special notes for delivery"></textarea>

                                <label class="label-radio">
                                    <input type="radio" class="input-radio">
                                    Create an account?
                                </label>

                                <p class="reservation-code">
                                    You have a coupon? <a href="#">Click here to enter your code</a>
                                </p>

                                <ul class="option-bank">
                                    <li>
                                        <label class="label-radio">
                                            <input type="radio" class="input-radio" name="chose-bank">
                                            Direct Bank Transfer
                                        </label>
                                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                    </li>

                                    <li>
                                        <label class="label-radio">
                                            <input type="radio" class="input-radio" name="chose-bank">
                                            Cheque Payment
                                        </label>
                                    </li>

                                    <li>
                                        <label class="label-radio">
                                            <input type="radio" class="input-radio" name="chose-bank">
                                            Credit Card
                                        </label>

                                        <img src="images/icon-card.jpg" alt="">
                                    </li>

                                </ul>
                                <button class="awe-btn awe-btn-13">PLACE ORDER</button>
                            </div>

                        </div>

                    </div>
                    <!-- END / CONTENT -->

                </div>
            </div>
        </div>

    </section>
    <!-- END / RESERVATION -->
@endsection
