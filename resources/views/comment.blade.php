@extends('client.layout.master')
@section('content')
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
                                                <input type="text" class="field-text" placeholder="Subject"
                                                    name="com_subject" required>
                                            </div>
                                            <div class="col-sm-12">
                                                <textarea placeholder="Your comment" name="com_content" class="field-textarea" required></textarea>
                                            </div>
                                            <div class="col-sm-12">
                                                <button class="awe-btn awe-btn-14">SUBMIT COMMENT</button>
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
@endsection
