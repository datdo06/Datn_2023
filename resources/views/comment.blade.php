@extends('client.layout.master')
@section('content')
    <style>
        .rating {
            font-size: 0; /* Loại bỏ khoảng trắng giữa các ngôi sao */
        }

        .star {
            width: 20px; /* Kích thước của mỗi ngôi sao */
            height: 20px;
            display: inline-block;
            background-color: #ccc; /* Màu mặc định của ngôi sao */
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
            margin-right: 5px; /* Khoảng cách giữa các ngôi sao */
        }

        /* Đổi màu của ngôi sao khi được chọn */
        .star.active {
            background-color: gold;
        }
    </style>
    <section class="section-sub-banner bg-9">
        <div class="sub-banner">
            <div class="container">
                <div class="text text-center">
                    <h2>Đánh giá</h2>
                    <p>Hãy cho chúng tôi lắng nghe ý kiến của bạn</p>
                </div>
            </div>

        </div>

    </section>

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
                                                @if($c->star == 1)
                                                    <div class="rating">
                                                        <div class="star active" ></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                    </div>
                                                @elseif($c->star == 2)
                                                    <div class="rating">
                                                        <div class="star active" ></div>
                                                        <div class="star active"></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                    </div>
                                                @elseif($c->star == 3)
                                                    <div class="rating">
                                                        <div class="star active" ></div>
                                                        <div class="star active"></div>
                                                        <div class="star active"></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                    </div>
                                                @elseif($c->star == 4)
                                                    <div class="rating">
                                                        <div class="star active" ></div>
                                                        <div class="star active"></div>
                                                        <div class="star active"></div>
                                                        <div class="star active"></div>
                                                        <div class="star"></div>
                                                    </div>
                                                @elseif($c->star == 5)
                                                    <div class="rating">
                                                        <div class="star active" ></div>
                                                        <div class="star active"></div>
                                                        <div class="star active"></div>
                                                        <div class="star active"></div>
                                                        <div class="star active"></div>
                                                    </div>
                                                @else
                                                    <div class="rating">
                                                        <div class="star" ></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                    </div>
                                                @endif
                                                <h4 class="comment-subject">{{ $c->com_subject }}</h4>
                                                <p>{{ $c->com_content }}.</p>

                                                <span class="comment-meta">
                                                    <a href="#">{{ $c->name }}</a> - {{ $c->created_at }}
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- END / COMMENT -->

                            <!-- COMMENT RESPOND -->
                            @if (isset($checkUser->cui))

                                <h3 class="comment-reply-title">Cảm ơn bạn đã đánh giá!!!</h3>
                            @else
                                <div class="comment-respond">
                                    <h3 class="comment-reply-title">LEAVE A COMMENT</h3>
                                    <form action="{{ route('postComment', ['id' => $room->id]) }}" method="post"
                                        class="comment-form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" class="field-text" placeholder="Tiêu đề"
                                                    name="com_subject" required>
                                            </div>
                                            <div class="rating">
                                                <div class="star" id="star1" onclick="rate(1)"></div>
                                                <div class="star" id="star2" onclick="rate(2)"></div>
                                                <div class="star" id="star3" onclick="rate(3)"></div>
                                                <div class="star" id="star4" onclick="rate(4)"></div>
                                                <div class="star" id="star5" onclick="rate(5)"></div>
                                                <input type="hidden" value="0" name="star" id="allstar">
                                            </div>
                                            <div class="col-sm-12">
                                                <textarea placeholder="Nội dung " name="com_content" class="field-textarea" required></textarea>
                                            </div>

                                            <div class="col-sm-12">
                                                <button class="awe-btn awe-btn-14">Gửi đánh giá</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            <!-- END COMMENT RESPOND -->

                        </div>
                    </div>

                </div>
            </div>
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
@endsection
