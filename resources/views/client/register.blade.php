@extends('client.layout.master')
@section('content')
    <section class="section-account parallax bg-11">
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="login-register">
                <div class="text text-center">
                    <h2>Đăng ký</h2>
                  
                    <form action="{{route('customer.add')}}" class="account_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="field-form" style="text-align: left">
                            <input type="text" class="field-text" placeholder="Họ và tên" name="name" value="{{old('name')}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form" style="text-align: left">
                            <input type="text" class="field-text" placeholder="Email" name="email" value="{{old('email')}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form" style="text-align: left">
                            <input type="text" class="field-text" placeholder="Số điện thoại" name="phone" value="{{old('phone')}}">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;" >{{ $message }}</strong>
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

                        <div class="field-form">
                            <input type="file" class="field-text"  name="Ảnh đại diện">
                            @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <input type="hidden" value="Customer" name="role">

                        <div class="field-form field-submit">
                            <button class="awe-btn awe-btn-13" type="submit">Đăng ký</button>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
