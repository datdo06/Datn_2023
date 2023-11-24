@extends('client.layout.master')
@section('content')
<div>
    <style>
    .card {
        background-color: #fff;
        padding: 14px;
        border: none
    }



    img {
        display: block;
        height: auto;
        width: 100%
    }

    .stars i {
        color: #f6d151
    }

    .stars span {
        font-size: 13px
    }

    hr {
        color: #d4d4d4
    }

    .badge {
        padding: 5px !important;
        padding-bottom: 6px !important
    }

    .badge i {
        font-size: 10px
    }

    .profile-image {
        width: 35px;
    }

    .comment-ratings i {
        font-size: 13px
    }

    .username {
        font-size: 12px
    }

    .comment-profile {
        line-height: 17px
    }

    .date span {
        font-size: 12px
    }

    .p-ratings i {
        color: #f6d151;
        font-size: 12px
    }

    .btn-long {
        padding-left: 35px;
        padding-right: 35px
    }

    .buttons {
        margin-top: 15px
    }

    .buttons .btn {
        height: 46px
    }

    .buttons .cart {
        border-color: #ff7676;
        color: #ff7676
    }

    .buttons .cart:hover {
        background-color: #e86464 !important;
        color: #fff
    }

    .buttons .buy {
        color: #fff;
        background-color: #ff7676;
        border-color: #ff7676
    }

    .buttons .buy:focus,
    .buy:active {
        color: #fff;
        background-color: #ff7676;
        border-color: #ff7676;
        box-shadow: none
    }

    .buttons .buy:hover {
        color: #fff;
        background-color: #e86464;
        border-color: #e86464
    }

    .buttons .wishlist {
        background-color: #fff;
        border-color: #ff7676
    }

    .buttons .wishlist:hover {
        background-color: #e86464;
        border-color: #e86464;
        color: #fff
    }

    .buttons .wishlist:hover i {
        color: #fff
    }

    .buttons .wishlist i {
        color: #ff7676
    }

    .comment-ratings i {
        color: #f6d151
    }

    .followers {
        font-size: 9px;
        color: #d6d4d4
    }

    .store-image {
        width: 42px;
    }

    .dot {
        height: 10px;
        width: 10px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px
    }

    .bullet-text {
        font-size: 12px
    }

    .my-color {
        margin-top: 10px;
        margin-bottom: 10px
    }

    label.radio {
        cursor: pointer
    }

    label.radio input {
        position: absolute;
        top: 0;
        left: 0;
        visibility: hidden;
        pointer-events: none
    }

    label.radio span {
        border: 2px solid #8f37aa;
        display: inline-block;
        color: #8f37aa;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        text-transform: uppercase;
        transition: 0.5s all
    }

    label.radio .red {
        background-color: red;
        border-color: red
    }

    label.radio .blue {
        background-color: blue;
        border-color: blue
    }

    label.radio .green {
        background-color: green;
        border-color: green
    }

    label.radio .orange {
        background-color: orange;
        border-color: orange
    }

    label.radio input:checked+span {
        color: #fff;
        position: relative
    }

    label.radio input:checked+span::before {
        opacity: 1;
        content: '\2713';
        position: absolute;
        font-size: 13px;
        font-weight: bold;
        left: 4px
    }

    .card-body {
        padding: 0.3rem 0.3rem 0.2rem
    }
    </style>
</div>


<!-- CHECK AVAILABILITY -->
<section class="section-check-availability">
    <div class="container">
        <div class="check-availability">
            <div class="row v-align">
                <div class="col-lg-3">
                    <h2 class="title-room">HOMESTAY & GIÁ PHÒNG</h2>
                </div>

                <div class="col-lg-9">
                    <div class="availability-form">
                        <form action="chooseRoom" method="GET">
                            <input type="text" class="awe-calendar from  @error('check_in') is-invalid @enderror"
                                id="check_in" name="check_in" value="{{ old('check_in') }}" placeholder="Ngày đến"
                                required>

                            <input type="text" class="awe-calendar to @error('check_out') is-invalid @enderror"
                                id="check_out" name="check_out" value="{{ old('check_out') }}" placeholder="Ngày đi"
                                required>

                            <input type="text" class="awe-input @error('count_person') is-invalid @enderror"
                                id="count_person" name="count_person" value="{{ old('count_person') }}"
                                placeholder="Số người" required>

                            <select class="awe-select @error('type_id') is-invalid @enderror" name="type_id"
                                id="type_id" required>
                                {{-- @foreach ($room_type as $rt)
                                <option value="{{ $rt->id }}">{{ $rt->name }}</option>
                                @endforeach --}}
                            </select>

                            <div class="vailability-submit">
                                <button class="awe-btn awe-btn-13" type="submit">Tìm Kiếm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END / CHECK AVAILABILITY -->
<br><br><br>
<section class="container text-center">
    <h2 class="heading"> Chi Tiết Phòng</h2>
</section>
<section class="container section-accommo_1">
    <link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>
    <div class="container-fluid mt-2 mb-3">
        <div class="row no-gutters">
            <div class="col-md-5 pr-2">
                <div class="card">
                    <div class="demo">
                        <ul id="lightSlider">
                            <li data-thumb="img/homestay/homestay-1.jpg"> <img src="img/homestay/homestay-1.jpg" />
                            </li>
                            <li data-thumb="img/homestay/homestay-2.jpg"> <img src="img/homestay/homestay-2.jpg" />
                            </li>
                            <li data-thumb="img/homestay/homestay-3.jpg"> <img src="img/homestay/homestay-3.jpg" />
                            </li>
                            <li data-thumb="img/homestay/homestay-4.jpg"> <img src="img/homestay/homestay-4.jpg" />
                            </li>
                            <li data-thumb="img/homestay/homestay-5.jpg"> <img src="img/homestay/homestay-5.jpg" />
                            </li>
                            <li data-thumb="img/homestay/homestay-6.jpg"> <img src="img/homestay/homestay-6.jpg" />
                            </li>
                            <li data-thumb="img/homestay/homestay-7.jpg"> <img src="img/homestay/homestay-7.jpg" />
                            </li>
                            <li data-thumb="img/homestay/homestay-8.jpg"> <img src="img/homestay/homestay-8.jpg" />
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card mt-2">
                    <h6>Reviews</h6>
                    <div class="d-flex flex-row">
                        <div class="stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> </div> <span
                            class="ml-1 font-weight-bold">4.6</span>
                    </div>
                    <hr>
                    <div class="badges"> <span class="badge bg-dark ">All (230)</span> <span class="badge bg-dark "> <i
                                class="fa fa-image"></i> 23 </span> <span class="badge bg-dark "> <i
                                class="fa fa-comments-o"></i> 23 </span> <span class="badge bg-warning"> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <span class="ml-1">2,123</span> </span> </div>
                    <hr>

                    <!-- comment -->
                    <div class="comment-section">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row align-items-center"> <img src="img/homestay/homestay-1.jpg"
                                    class="rounded-circle profile-image">
                                <div class="d-flex flex-column ml-1 comment-profile">
                                    <div class="comment-ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                    </div> <span class="username">Lori Benneth</span>
                                </div>
                            </div>
                            <div class="date"> <span class="text-muted">2 May</span> </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row align-items-center"> <img src="https://i.imgur.com/tmdHXOY.jpg"
                                    class="rounded-circle profile-image">
                                <div class="d-flex flex-column ml-1 comment-profile">
                                    <div class="comment-ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                    </div> <span class="username">Timona Simaung</span>
                                </div>
                            </div>
                            <div class="date"> <span class="text-muted">12 May</span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">

                    <div class="about">
                        <h2 class="heading">Căn 1 phòng ngủ </h2>
                        <br>
                        <div class="wrap-price">
                            <p class="price">
                                <span class="amout">700.000</span> / Ngày
                            </p>
                        </div>
                        <div class="buttons"> <button class="btn btn-outline-warning btn-long cart">Đặt trước
                                phòng</button>
                            <button class="btn btn-warning btn-long buy">Thanh Toán</button>  
                        </div>
                        <hr>
                        <div class="product-description">
                        <div class="">
                    <div class="availability-form">
                        <form action="chooseRoom" method="GET">
                            <input type="text" class="awe-calendar from  @error('check_in') is-invalid @enderror"
                                id="check_in" name="check_in" value="{{ old('check_in') }}" placeholder="Ngày đến"
                                required>

                            <input type="text" class="awe-calendar to @error('check_out') is-invalid @enderror"
                                id="check_out" name="check_out" value="{{ old('check_out') }}" placeholder="Ngày đi"
                                required>

                            <input type="text" class="awe-input @error('count_person') is-invalid @enderror"
                                id="count_person" name="count_person" value="{{ old('count_person') }}"
                                placeholder="Số người" required>

                            <select class="awe-select @error('type_id') is-invalid @enderror" name="type_id"
                                id="type_id" required>
                                 
                            </select>

                        </form>
                    </div>
                </div>
                            <br><br> <br>
                            <div class="mt-4">
                                <h4 class="font-bold"></h4>
                                <p>Căn hộ này có 1 phòng ngủ, bếp với tủ lạnh và bếp nấu, TV màn hình phẳng, khu vực ghế
                                    ngồi cũng như 2 phòng tắm được trang bị chậu rửa vệ sinh.
                                    Du khách có thể thưởng thức bữa ăn trên khu vực ăn uống ngoài trời trong khi ngắm
                                    nhìn quang cảnh thành phố. Để tăng thêm sự riêng tư, chỗ ở này có lối vào riêng.</p>
                                <p class="desc">
                                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i> <i
                                        class="fa fa-long-arrow-down" aria-hidden="true"></i> Thang máy <br>
                                    <i class="fa fa-smile-o" aria-hidden="true"></i> Điều hòa không khí <br>
                                    <i class="fa fa-wifi" aria-hidden="true"></i> WiFi miễn phí <br>
                                    <i class="fa fa-sun-o" aria-hidden="true"></i> Ban công <br>
                                    <i class="fa fa-users" aria-hidden="true"></i> Phòng gia đình <br>
                                    <i class="fa fa-paw" aria-hidden="true"></i> Cho phép mang theo vật nuôi <br>
                                    <i class="fa fa-ban"></i> Khu vực không cho phép hút thuốc
                                </p>
                            </div>

                        </div>
                    </div>
                    <!-- <div class="card mt-2"> <span>Similar items:</span>
                    <div class="similar-products mt-2 d-flex flex-row">
                        <div class="card border p-1" style="width: 9rem;margin-right: 3px;"> <img
                                src="https://i.imgur.com/KZpuufK.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$1,999</h6>
                            </div>
                        </div>
                        <div class="card border p-1" style="width: 9rem;margin-right: 3px;"> <img
                                src="https://i.imgur.com/GwiUmQA.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$1,699</h6>
                            </div>
                        </div>
                        <div class="card border p-1" style="width: 9rem;margin-right: 3px;"> <img
                                src="https://i.imgur.com/c9uUysL.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$2,999</h6>
                            </div>
                        </div>
                        <div class="card border p-1" style="width: 9rem;margin-right: 3px;"> <img
                                src="https://i.imgur.com/kYWqL7k.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$3,999</h6>
                            </div>
                        </div>
                        <div class="card border p-1" style="width: 9rem;"> <img src="https://i.imgur.com/DhKkTrG.jpg"
                                class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$999</h6>
                            </div>
                        </div>
                    </div>
                </div> -->
                </div>
            </div>
        </div>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
        <script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>
        <script>
        $('#lightSlider').lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 9
        });
        </script>
</section>

<section class="container ">
    <div class="container  col-md-9  bg-white">
        <br>
        <h2 class="heading"> Giới Thiệu</h2>

        <div class="row d-flex justify-content-between">
            <hr>
            <div class="col-md-5 ">
                <br>
                <div class=" row d-flex justify-content-between ">
                    <div class="col-md-2" style="margin-right:20px;">
                        <h3 class="heading">4,0</h3>
                    </div>
                    <div class="col-md-4 ">
                        <h5> Rất Tốt</h5> 200 đánh giá
                    </div>
                </div>
                #222 trong số 1.518 khách sạn tại Hà Nội <br><br>

                <p class=".me-2">KingTheLand Homestay là một lựa chọn tuyệt vời cho khách du lịch khi đến Hà
                    Nội, cung cấp không khí dành cho gia đình cùng với nhiều tiện nghi hữu ích cho kì nghỉ của bạn.
                    KingTheLand Homestay trở thành lựa chọn lý tưởng khi khi đến Hà Nội.

                    Là “ngôi nhà xa xứ,” các phòng khách sạn cung cấp tv màn hình phẳng, quầy bar mini và tủ lạnh, và
                    kết nối mạng thật dễ dàng, với wifi miễn phí sẵn có.

                    Khách có thể dùng nhân viên hỗ trợ khách và dịch vụ phòng khi nghỉ tại KingTheLand Homestay. 
                    <span id="dots">...</span><span id="more">
                    Ngoài ra, KingTheLand còn có bể bơi và bữa sáng, sẽ làm cho kì nghỉ của bạn ở Hà Nội trở nên tuyệt vời hơn nữa. Thuận tiện hơn nữa, còn có đỗ
                    xe miễn phí có sẵn cho khách.

                    Hơn nữa, trong suốt kỳ nghỉ của bạn đừng quên ghé thăm một số viện bảo tàng lịch sử tự nhiên nổi
                    tiếng, như Bảo tàng Nhân học.

                    Hãy tận hưởng kỳ nghỉ của bạn ở Hà Nội!
                    </span>
                    <a onclick="myFunction()" id="myBtn">Xem thêm</a>
                </p>
                
            </div>
            <div class=" col-sm-7 ">
                <h5 class="sub-heading"> Tiện nghi của khách sạn</h5> <br>
                <div class="row ">
                    <div class="col-md-5">
                        <p><i class="fa fa-car" aria-hidden="true"></i> Bãi đỗ xe miễn phí</p>
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-wifi" aria-hidden="true"></i> Internet miễn phí</p>
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-tint" aria-hidden="true"></i> Bể bơi</p>
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-cutlery" aria-hidden="true"></i> Quầy bar mini</p>
                    </div>


                </div>

                <h5 class="sub-heading"> Tiện nghi trong phòng</h5> <br>
                <div class="row ">
                    <div class="col-md-5">
                        <p><i class="fa fa-tint" aria-hidden="true"></i> Điều hòa nhiệt độ
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-bell" aria-hidden="true"></i> Dịch vụ phòng
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-bell" aria-hidden="true"></i> Dọn phòng
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-home" aria-hidden="true"></i> Két sắt
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-home" aria-hidden="true"></i> Nhà bếp
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-check" aria-hidden="true"></i> Bàn ăn, đồ bếp
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-check" aria-hidden="true"></i> Máy giặt, tủ lạnh
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-shower" aria-hidden="true"></i> Bồn tắm / vòi sen
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-bed" aria-hidden="true"></i> Giường sofa
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-check" aria-hidden="true"></i> TV màn hình phẳng
                    </div>
                </div>
                <h5 class="sub-heading"> Loại phòng</h5> <br>
                <div class="row ">

                    <div class="col-md-5">
                        <p><i class="fa fa-building" aria-hidden="true"></i> Ngắm cảnh thành phố
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-bed" aria-hidden="true"></i> Phòng cho gia đình
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-bed" aria-hidden="true"></i> Phòng Suite
                    </div>
                    <div class="col-md-5">
                        <p><i class="fa fa-bed" aria-hidden="true"></i> Phòng cho nhiều gia đình
                    </div>
                </div>

                <h5 class="sub-heading"> Thông tin cần biết</h5> <br>
                <div class="row ">
                    <div class="col-md-5">
                        <p> Ngôn ngữ được sử dụng : Tiếng Anh, Tiếng Việt
                    </div>
                    <div class="col-md-5">
                        <p> Thời gian hoạt động : 24/7
                    </div>


                </div>



            </div>
        </div>



</section>

<section class="section-accommo_1 ">
    <div class="container">

        <div class="accomd-modations_1">

            <h2 class="heading"> Các loại phòng khác</h2>

            <div class="accomd-modations-content_1">

                <div class="accomd-modations-slide_1">

                    {{-- @foreach($rooms as $rooms) --}}
                    <div class="accomd-modations-room_1 bg-white">

                        <div class="img ">
                            <a href="#"><img class="" src="img/homestay/homestay-11.jpg" alt=""></a>
                        </div>

                        <div class="text">
                            <h2><a href="#">Căn 1 phòng ngủ</a></h2>
                            <p class="desc">
                                Căn hộ này có 1 phòng ngủ, bếp với tủ lạnh và bếp nấu, TV màn hình phẳng, khu vực ghế
                                ngồi cũng như 2 phòng tắm được trang bị chậu rửa vệ sinh.
                                Du khách có thể thưởng thức bữa ăn trên khu vực ăn uống ngoài trời trong khi ngắm nhìn
                                quang cảnh thành phố. Để tăng thêm sự riêng tư, chỗ ở này có lối vào riêng.
                            </p>
                            <p class="desc">Tối đa : 2 người lớn và 1 trẻ em</p>

                            <div class="wrap-price">
                                <p class="price">
                                    <span class="amout">700.000</span> / Ngày
                                </p>
                                <a href="{{ route('roomdetail') }}" class="awe-btn awe-btn-default">CHI TIẾT </a>
                            </div>
                        </div>

                    </div>
                    {{-- @endforeach --}}
                    <!-- END / ITEM -->

                    <!-- ITEM -->
                    <div class="accomd-modations-room_1 bg-white">
                        <div class="img">
                            <a href="#"><img src="img/homestay/homestay-2.jpg" alt=""></a>
                        </div>
                        <div class="text">
                            <h2><a href="#">Căn 2 phòng ngủ</a></h2>
                            <p class="desc">Căn hộ này có 2 phòng ngủ, bếp với tủ lạnh và bếp nấu, TV màn hình phẳng,
                                khu vực ghế ngồi cũng như 2 phòng tắm được trang bị chậu rửa vệ sinh.
                                Du khách có thể thưởng thức bữa ăn trên khu vực ăn uống ngoài trời trong khi ngắm nhìn
                                quang cảnh thành phố. Để tăng thêm sự riêng tư, chỗ ở này có lối vào riêng.</p>
                            <p class="desc">Tối đa : 4 người lớn và 1 trẻ em</p>

                            <div class="wrap-price">
                                <p class="price">
                                    <span class="amout">1.400.000</span> / Ngày
                                </p>
                                <a href="#" class="awe-btn awe-btn-default">CHI TIẾT</a>
                            </div>
                        </div>
                    </div>
                    <!-- END / ITEM -->

                    <!-- ITEM -->
                    <div class="accomd-modations-room_1 bg-white">
                        <div class="img">
                            <a href="#"><img src="img/homestay/homestay-8.jpg" alt=""></a>
                        </div>
                        <div class="text">
                            <h2><a href="#">Căn 3 phòng ngủ</a></h2>
                            <p class="desc">Căn hộ này có 2 phòng ngủ, bếp với tủ lạnh và bếp nấu, TV màn hình phẳng,
                                khu vực ghế ngồi cũng như 2 phòng tắm được trang bị chậu rửa vệ sinh.
                                Du khách có thể thưởng thức bữa ăn trên khu vực ăn uống ngoài trời trong khi ngắm nhìn
                                quang cảnh thành phố. Để tăng thêm sự riêng tư, chỗ ở này có lối vào riêng.</p>
                            <p class="desc">Tối đa : 6 người lớn và 1 trẻ em</p>


                            <div class="wrap-price">
                                <p class="price">
                                    <span class="amout">2.100.000</span> / Ngày
                                </p>
                                <a href="#" class="awe-btn awe-btn-default">VIEW DETAIL</a>
                            </div>
                        </div>
                    </div>
                    <!-- END / ITEM -->

                    <!-- ITEM -->
                    <div class="accomd-modations-room_1 bg-white">
                        <div class="img">
                            <a href="#"><img src="img/homestay/homestay-20.jpg" alt=""></a>
                        </div>
                        <div class="text">
                            <h2><a href="#">Căn 4 phòng ngủ</a></h2>
                            <p class="desc">Căn hộ này có 2 phòng ngủ, bếp với tủ lạnh và bếp nấu, TV màn hình phẳng,
                                khu vực ghế ngồi cũng như 2 phòng tắm được trang bị chậu rửa vệ sinh.
                                Du khách có thể thưởng thức bữa ăn trên khu vực ăn uống ngoài trời trong khi ngắm nhìn
                                quang cảnh thành phố. Để tăng thêm sự riêng tư, chỗ ở này có lối vào riêng.</p>
                            <p class="desc">Tối đa : 8 người lớn và 1 trẻ em</p>



                            <div class="wrap-price">
                                <p class="price">
                                    <span class="amout">2.800.000</span> / Ngày
                                </p>
                                <a href="#" class="awe-btn awe-btn-default">VIEW DETAIL</a>
                            </div>
                        </div>
                    </div>
                    <!-- END / ITEM -->

                </div>

            </div>
        </div>

    </div>
</section>
<br><br><br>





<script>
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Rút gọn"; 
    moreText.style.display = "inline";
  }
}
</script>

@endsection