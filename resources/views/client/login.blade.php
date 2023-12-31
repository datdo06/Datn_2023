@extends('client.layout.master')
@section('content')
    <section class="section-account parallax bg-11">
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="login-register">
                <div class="text text-center">
                    <h2>ĐĂNG NHẬP TÀI KHOẢN</h2>
                    <p>Đăng nhập King The Land</p>
                    <form action="{{route('postlogin')}}" class="account_form" method="post">
                        @csrf
                        <div class="field-form" style="text-align: left">
                            <input type="text" class="field-text" placeholder="Email" name="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form" style="text-align: left">
                            <input type="password" class="field-text" placeholder="Mật khẩu" name="password">
                            <span class="view-pass"><i class="lotus-icon-view"></i></span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form field-submit">
                            <button class="awe-btn awe-btn-13" type="submit">Đăng nhập</button>
                        </div>

                        <span class="account-desc">Tôi không có tài khoản - <a href="{{ route('register') }}">Đăng kí</a></span>
                        <span class="account-desc" style="margin-top: 10px"><a href="{{ route('forget.password') }}">Quên mật khẩu</a></span>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
