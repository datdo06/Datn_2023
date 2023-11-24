@extends('client.layout.master')
@section('content')
    <section class="section-account parallax bg-11">
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="login-register">
                <div class="text text-center">
                    <h2>Chúng tôi sẽ gửi một liên kết đến email của bạn, sử dụng liên kết đó để đặt lại mật khẩu</h2>
                    <form action="{{route('forget.password.post')}}" class="account_form" method="post">
                        @csrf
                        <div class="field-form">
                            <input type="text" class="field-text" placeholder="Email" name="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form field-submit">
                            <button class="awe-btn awe-btn-13" type="submit">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
