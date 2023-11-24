@extends('client.layout.master')
@section('content')
    <section class="section-account parallax bg-11">
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="login-register">
                <div class="text text-center">
                    <h2>Chúng tôi sẽ gửi một liên kết đến email của bạn, sử dụng liên kết đó để đặt lại mật khẩu</h2>
                    <div class="mt-5">
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if(session()->has('success'))
                            <div class="alert alert-danger">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <form action="{{route('reset.password.post')}}" class="account_form" method="post">
                        @csrf
                        <input type="text" name="token" hidden value="{{$token}}">
                        <div class="field-form">
                            <input type="email" class="field-text" placeholder="Email" name="email">
                        </div>
                        <div class="field-form">
                            <input type="password" class="field-text" placeholder="Mật khẩu mới" name="password">
                        </div>
                        <div class="field-form">
                            <input type="password" class="field-text" placeholder="Nhập lại mật khẩu mới" name="password_confirmation">
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
