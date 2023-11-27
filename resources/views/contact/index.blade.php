@extends('client.layout.master')
@section('content')

    <!-- SUB BANNER -->
    <section class="section-sub-banner bg-9">
        <div class="sub-banner">
            <div class="container">
                <div class="text text-center">
                    <h2>Thông tin liên hệ</h2>
                    <p>Gửi Lời Nhắn Cho Chúng Tôi</p>
                </div>
            </div>

        </div>

    </section>
    <!-- END / SUB BANNER -->

    <!-- CONTACT -->
    <section class="section-contact">
        <div class="container">
            <div class="contact">
                <div class="row">
                    <div class="col-md-6 col-lg-5">
                        <div class="text">
                            <h2>King The Land HomeStay</h2>
                            <p>Trang web được quản lý và vận hành bởi FPT Polytechnich Team.
                                 Quý khách hàng, đối tác có thể liên hệ trực tiếp với chúng tôi qua các thông tin dưới đây.</p>
                            <ul>
                                <li><i class="icon lotus-icon-location" style="padding-right:5px;"></i> Hà Nội, Việt Nam  </li>
                                <li><i class="icon lotus-icon-phone"></i> (+84) 989999999</li>
                                <li><i class="icon fa fa-envelope-o"></i> <a href="">KingTheLand@gmail.com</a></li>
                            </ul>
                        </div>
                        <div class="contact-location">
                            <a class="btn-collapse" data-toggle="collapse" href="#location">CÁC CƠ SỞ TRÊN TOÀN QUỐC <span class="fa fa-angle-down"></span></a>
                            <div class="collapse" id="location">
                                <div class="location-group">
                                    <h6>Khu vực châu á</h6>
                                    <span>Hà Nội, Việt Nam</span>
                                    <!-- ITEM -->
                                    <div class="location-item" data-location="21.016987, 105.803730">
                                        <div class="img">
                                            <img src="images/contact/img-1.jpg" alt="">
                                            <i class="fa  fa-map-marker"></i>
                                        </div>
                                        <div class="text">
                                            <address>
                                                734 Đường Láng, Trung Hòa, Đống Đa, Hà Nội</address>
                                            <p>
                                                Tel: (+84) 989999999  <br>

                                            </p>
                                        </div>
                                    </div>
                                    <!-- END / ITEM -->

                                    <!-- ITEM -->
                                    <div class="location-item" data-location="21.037479646844922, 105.78993706268827">
                                        <div class="img">
                                            <img src="images/contact/img-2.jpg" alt="">
                                            <i class="fa  fa-map-marker"></i>
                                        </div>
                                        <div class="text">
                                            <address>47 Đường Nguyễn Phong Sắc, Dịch Vọng Hậu, Cầu Giấy, Hà Nội</address>
                                            <p>
                                                Tel: (+84) 989999999 <br>

                                            </p>
                                        </div>
                                    </div>
                                    <!-- END / ITEM -->

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 col-lg-6 col-lg-offset-1">
                        <div class="contact-form">
                            <form action="{{ route('thank') }}" method="GET">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="field-text"  name="name" placeholder="Họ và tên">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="field-text" name="email" placeholder="Địa chỉ Email">
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" class="field-text" name="subject" placeholder="Chủ đề">
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea cols="30" rows="10" name="message"  class="field-textarea" placeholder="Nội Dung"></textarea>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="submit" class="awe-btn awe-btn-13">SEND</button>
                                    </div>
                                </div>
                                <div id="contact-content"></div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- END / CONTACT -->

    <!-- MAP -->
    <section class="section-map">
        <h1 class="element-invisible">Map</h1>
        <div class="contact-map">
            <div id="map" data-locations="21.0285,105.8542" data-center="21.0285,105.8542"></div>
        </div>
    </section>
    <!-- END / MAP -->


@endsection
