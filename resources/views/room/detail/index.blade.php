@extends('client.layout.master')
@section('content')
<style>
    .rating {
        font-size: 0;
        /* Loại bỏ khoảng trắng giữa các ngôi sao */
    }

    .star {
        width: 20px;
        /* Kích thước của mỗi ngôi sao */
        height: 20px;
        display: inline-block;
        background-color: #ccc;
        /* Màu mặc định của ngôi sao */
        clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
        margin-right: 5px;
        /* Khoảng cách giữa các ngôi sao */
    }

    /* Đổi màu của ngôi sao khi được chọn */
    .star.active {
        background-color: gold;
    }
</style>
    <section class="section-sub-banner bg-16">
        <div class="awe-overlay"></div>
        <div class="sub-banner">
            <div class="container">
                <div class="text text-center">
                    <h2>{{ $detailRoom->number }}</h2>
                    <p>{{ $detailRoom->type->name }}</p>
                </div>
            </div>

        </div>

    </section>
    <!-- END / SUB BANNER -->

    <!-- ROOM DETAIL -->
    <section class="section-room-detail bg-white">
        <div class="container">

            <!-- DETAIL -->
            <div class="room-detail">
                <div class="row">
                    <div class="col-lg-9">

                        <!-- LAGER IMGAE -->
                        <div class="room-detail_img">
                            @foreach ($image as $item)
                                <div class="room_img-item">
                                    <img src="{{ asset('img/room/') . '/' . $detailRoom->number . '/' . $item->url }}"
                                        alt="">
                                </div>
                            @endforeach

                        </div>
                        <!-- END / LAGER IMGAE -->

                        <!-- THUMBNAIL IMAGE -->
                        <div class="room-detail_thumbs">
                            @foreach ($image as $item)
                                <a href="#"><img
                                        src="{{ asset('img/room/') . '/' . $detailRoom->number . '/' . $item->url }}"
                                        alt=""></a>
                            @endforeach
                        </div>
                        <!-- END / THUMBNAIL IMAGE -->
                        <h1>{{ $detailRoom->number }}</h1>
                        <p>{{ $detailRoom->view }}</p>


                    </div>

                    <div class="col-lg-3">

                        <!-- FORM BOOK -->
                        <div class="room-detail_book">

                            <div class="room-detail_total">
                                <img src="img/icon-logo.png" alt="" class="icon-logo">

                                <h6>Giá phòng</h6>

                                <p class="price">
                                    <span class="amout">{{ Helper::convertToRupiah($detailRoom->price) }}</span> /Đêm
                                </p>
                            </div>

                            <div class="room-detail_form">
                                <input type="hidden" id="count" value="{{ $detailRoom->capacity }}">
                                @if (isset($_GET['checkin']) && isset($_GET['checkout']) && isset($_GET['person']))
                                    <label>Ngày đến</label>
                                    <input type="text" class="awe-calendar from" disabled placeholder="Arrive Date"
                                        value="{{ Helper::dateFormat($_GET['checkin']) }}" name="checkin">
                                    <label>Ngày đi</label>
                                    <input type="text" class="awe-calendar to" disabled placeholder="Departure Date"
                                        value="{{ Helper::dateFormat($_GET['checkout']) }}" name="checkin">
                                    <label>Số người</label>

                                    @if(isset(Auth()->user()->id))
                                        <form action="{{ route('confirm', ['user' => Auth()->user()->id, 'room' => $detailRoom->id]) }}" method="POST" id="form">
                                            @else
                                                <form action="{{ route('confirm', ['user' => 0, 'room' => $detailRoom->id]) }}" method="POST" id="form">
                                                    @endif
                                                    @csrf
                                                    <input type="hidden" value="{{ $_GET['checkin'] }}" name="checkin">
                                                    <input type="hidden" value="{{ $_GET['checkout'] }}"
                                                           name="checkout">
                                                    <input type="hidden"
                                                           value="{{ Helper::getDateDifference($_GET['checkin'], $_GET['checkout']) }}"
                                                           name="total_day">
                                                    <input type="text" class="awe-input" placeholder="Số người" id="count_person"
                                                           value="{{ $_GET['person'] }} " name="person" required>
                                                    <p style="color: red" id="loi"></p>
                                                    <label>Địa chỉ: {{ $detailRoom->type->name }}</label>
                                                    <button class="awe-btn awe-btn-13" id="sub" type="button">Đặt ngay
                                                    </button>
                                                </form>

                                @else
                                    @if (isset(Auth()->user()->id))
                                        <form
                                            action="{{ route('confirm', ['user' => Auth()->user()->id, 'room' => $detailRoom->id]) }}"
                                            method="GET" id="form">
                                        @else
                                            <form action="{{ route('confirm', ['user' => 0, 'room' => $detailRoom->id]) }}"
                                                method="GET" id="form">
                                    @endif
                                    @csrf
                                    <label>Ngày đến</label>
                                    <input type="text" class="awe-calendar from" placeholder="Ngày đến" id="check_in"
                                        name="checkin" value="{{ old('checkin') }}" required>
                                    <p style="color: red" id="loiCheckIn"></p>
                                    <label>Ngày đi</label>

                                    <input type="text" class="awe-calendar to" placeholder="Ngày đi" id="check_out"
                                        name="checkout" value="{{ old('checkout') }}">
                                    <p style="color: red" id="loi"></p>
                                    <input type="hidden" value="0" name="total_day">
                                    <label>Số người</label>
                                    <input type="text" class="awe-input" placeholder="Số người" id="count_person"
                                        name="person" value="{{ old('person') }}" required>
                                    <p style="color: red" id="loiCheckOut"></p>
                                    <label>Địa
                                        chỉ: {{ $detailRoom->type->name }}</label>
                                    <button class="awe-btn awe-btn-13" id="sub" type="button">Đặt ngay
                                    </button>
                                    </form>
                                @endif
                            </div>
                            <!-- END / FORM BOOK -->

                        </div>
                    </div>
                </div>
                <!-- END / DETAIL -->

                <!-- TAB -->
                <div class="room-detail_tab">

                    <div class="row">
                        <div class="col-md-3">
                            <ul class="room-detail_tab-header">
                                <li class="active"><a href="#overview" data-toggle="tab">Tổng Quan</a></li>
                                <li><a href="#amenities" data-toggle="tab">Tiện nghi</a></li>
                            </ul>
                        </div>

                        <div class="col-md-9">
                            <div class="room-detail_tab-content tab-content">

                                <!-- OVERVIEW -->
                                <div class="tab-pane fade active in" id="overview">

                                    <div class="room-detail_overview">
                                        {{-- <h5 class='text-uppercase
                                    '>de Finibus Bonorum et
                                            Malorum", written by Cicero in 45 BC</h5> --}}
                                        <p>KingTheLand Homestay là một lựa chọn tuyệt vời cho khách du lịch khi đến Hà
                                            Nội, cung cấp không khí dành cho gia đình cùng với nhiều tiện nghi hữu ích
                                            cho
                                            kì
                                            nghỉ của bạn.
                                            KingTheLand Homestay trở thành lựa chọn lý tưởng khi khi đến Hà Nội.</p>

                                        <div class="row">
                                            <div class="col-xs-6 col-md-4">
                                                <h6>Thông tin Homestay</h6>
                                                <ul>
                                                    <li> {{ $detailRoom->capacity }} người tối đa</li>
                                                    <li>Diện tích: {{ $detailRoom->acreage }} m<sup>2</sup></li>
                                                    <li>Phong cách: {{ $detailRoom->roomStatus->name }}</li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <!-- END / OVERVIEW -->

                                <!-- AMENITIES -->
                                <div class="tab-pane fade" id="amenities">

                                    <div class="room-detail_amenities">
                                        <p> Khách có thể dùng nhân viên hỗ trợ khách và dịch vụ Homestay khi nghỉ tại
                                            KingTheLand
                                            Homestay.</p>

                                        <div class="row">
                                            <h6>Dịch vụ có sẵn</h6>
                                            @foreach ($facilityHomestay as $fH)
                                                <div class="col-xs-6 col-lg-4">
                                                    <ul>
                                                        <li>{{ $fH->Facility->name }}</li>

                                                    </ul>
                                                </div>
                                            @endforeach

                                        </div>

                                    </div>

                                </div>
                                <!-- END / AMENITIES -->


                            </div>
                        </div>

                    </div>

                </div>
                <!-- END / TAB -->
                <section class="section-blog bg-white">
                    <div class="container">
                        <div class="blog">
                            <div class="row">

                                <div class="col-md-8 col-md-offset-2">
                                    <div class="blog-content">
                                        <div id="comments">
                                            @foreach ($results as $r)
                                                <h4 class="comment-title">Đánh giá ({{ $r->comment_count }})</h4>
                                            @endforeach
                                            <ul class="commentlist">
                                                @foreach ($comment as $c)
                                                    <li>
                                                        <div class="comment-body">

                                                            <a class="comment-avatar"><img
                                                                    src="{{ asset('img/user/' . $c->name . '-' . $c->uid . '/' . $c->avatar) }}"
                                                                    alt=""></a>
                                                            @if ($c->star == 1)
                                                                <div class="rating">
                                                                    <div class="star active"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                </div>
                                                            @elseif($c->star == 2)
                                                                <div class="rating">
                                                                    <div class="star active"></div>
                                                                    <div class="star active"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                </div>
                                                            @elseif($c->star == 3)
                                                                <div class="rating">
                                                                    <div class="star active"></div>
                                                                    <div class="star active"></div>
                                                                    <div class="star active"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                </div>
                                                            @elseif($c->star == 4)
                                                                <div class="rating">
                                                                    <div class="star active"></div>
                                                                    <div class="star active"></div>
                                                                    <div class="star active"></div>
                                                                    <div class="star active"></div>
                                                                    <div class="star"></div>
                                                                </div>
                                                            @elseif($c->star == 5)
                                                                <div class="rating">
                                                                    <div class="star active"></div>
                                                                    <div class="star active"></div>
                                                                    <div class="star active"></div>
                                                                    <div class="star active"></div>
                                                                    <div class="star active"></div>
                                                                </div>
                                                            @else
                                                                <div class="rating">
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                </div>
                                                            @endif
                                                            <h4 class="comment-subject">{{ $c->com_subject }}</h4>
                                                            <p>{{ $c->com_content }}.</p>

                                                            <span class="comment-meta">
                                                                <a href="#">{{ $c->name }}</a> -
                                                                {{ $c->created_at }}
                                                            </span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
                <!-- COMPARE ACCOMMODATION -->
                <div class="room-detail_compare">
                    <h2 class="room-compare_title">Địa điểm khác</h2>
                    <div class="room-compare_content">
                        <div class="row">
                            @foreach ($other_locations as $other_location)
                                <!-- ITEM -->
                                <div class="col-md-4 col-sm-6">
                                    <div class="room-compare_item">
                                        <div class="img">
                                            <a href="{{ route('homestayDetail', $other_location->id) }}"><img
                                                    src="{{ $other_location->firstImage() }}" alt=""></a>
                                        </div>
                                        <div class="text">
                                            <h2><a href="#">{{ $other_location->number }}</a></h2>
                                            <ul>
                                                <li><i class="lotus-icon-location"></i> {{ $other_location->location }}
                                                </li>
                                            </ul>
                                            <a href="{{ route('homestayDetail', $other_location->id) }}"
                                                class="awe-btn awe-btn-default">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- END / COMPARE ACCOMMODATION -->
            </div>
    </section>
    <script>
        var allstar = document.getElementById('allstar');

        function rate(rating) {
            // Đặt nội dung của phần tử hiển thị số sao
            allstar.value = rating;
            // Xóa trạng thái active của tất cả các ngôi sao
            document.querySelectorAll('.star').forEach(function(star) {
                star.classList.remove('active');
            });

            // Đặt trạng thái active cho số sao được chọn và tất cả các sao trước đó
            for (var i = 1; i <= rating; i++) {
                var starElement = document.querySelector('#star' + i);
                if (i <= rating) {
                    starElement.classList.add('active');
                } else {
                    // Đặt trạng thái active cho tất cả các sao trước đó
                    starElement.classList.add('active');
                }
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#sub').click(function() {
                var x = $('#count_person').val();
                $('#person').val(x);
                var chekIn = $('#check_in').val();
                var chekOut = $('#check_out').val();
                var count = $('#count').val();
                var check = true;
                x = Number(x);
                count = Number(count);
                console.log(count);
                if (chekIn == "") {
                    $('#loiCheckIn').html('Ngày đi không để trống');
                    check = false;
                } else {
                    $('#loiCheckIn').html('');
                    check = true;
                }
                if (chekOut == "") {
                    $('#loiCheckOut').html('Ngày đến không để trống');
                    check = false;
                } else {
                    $('#loiCheckOut').html('');
                    check = true;
                }
                if (x == "") {
                    $('#loi').html('Số người ở không được trống ');
                    check = false;
                } else if (x > count) {
                    $('#loi').html('Số người ở không được quá ' + count);
                    check = false;
                } else {
                    $('#loi').html('');
                    check = true;
                }
                if (check) {
                    $('#form').submit();
                }
            })
        })
    </script>
@endsection
