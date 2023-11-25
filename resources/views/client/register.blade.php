@extends('client.layout.master')
@section('content')
    <section class="section-account parallax bg-11">
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="login-register">
                <div class="text text-center">
                    <h2>REGISTER FORM</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing</p>
                    <form action="{{route('customer.add')}}" class="account_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="field-form">
                            <input type="text" class="field-text" placeholder="Name" name="name" value="{{old('name')}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <input type="text" class="field-text" placeholder="Email" name="email" value="{{old('email')}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <input type="text" class="field-text" placeholder="Phone" name="phone" value="{{old('phone')}}">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <input type="password" class="field-text" placeholder="Password" name="password">
                            <span class="view-pass"><i class="lotus-icon-view"></i></span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="field-form">
                            <input type="date" class="field-text" name="birthdate" value="{{old('birthdate')}}">
                            @error('birthdate')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <select class="field-text" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <input type="text" class="field-text" placeholder="Job" name="job" value="{{old('job')}}">
                            @error('job')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <input type="text" class="field-text" placeholder="Address" name="address" value="{{old('address')}}">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <input type="text" class="field-text" placeholder="Mô tả" name="description" value="{{old('description')}}">
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-form">
                            <input type="file" class="field-text"  name="avatar">
                            @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="field-form field-submit">
                            <button class="awe-btn awe-btn-13" type="submit">Create</button>
                        </div>
                        <span class="account-desc">I don’t have an account  -  <a href="#">Forgot Password</a></span>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
