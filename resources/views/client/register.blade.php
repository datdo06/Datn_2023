@extends('client.layout.master')
@section('content')
    <section class="section-account parallax bg-11">
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="login-register">
                <div class="text text-center">
                    <h2>ĐĂNG KÝ</h2>
                    <p>Đăng ký King The Land</p>
                    <form action="{{route('customer.add')}}" class="account_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="field-form">
                            <input type="text" class="field-text" placeholder="Name" name="name" value="{{old('name')}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <input type="text" class="field-text" placeholder="Email" name="email" value="{{old('email')}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <input type="password" class="field-text" placeholder="Password" name="password" >
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="field-form">
                            <input type="date" class="field-text" name="birthdate" value="{{old('birthdate')}}">
                            @error('birthdate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <select class="field-text" name="gender">
                                <option value="Male">Nam</option>
                                <option value="Female">Nữ</option>
                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <input type="text" class="field-text" placeholder="Job" name="job" value="{{old('job')}}">
                            @error('job')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <input type="text" class="field-text" placeholder="Address" name="address" value="{{old('address')}}">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <input type="text" class="field-text" placeholder="Mô tả" name="description" value="{{old('description')}}">
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <input type="file" class="field-text"  name="avatar">
                            @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="field-form field-submit">
                            <button class="awe-btn awe-btn-13" type="submit">Thêm</button>
                        </div>
                        <span class="account-desc">Tôi không có tài khoản - -  <a href="#">Quên mật khẩu</a></span>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
