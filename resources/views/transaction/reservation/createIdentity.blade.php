@extends('template.master')
@section('title', 'Create Identity')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
@endsection
@section('content')
    @include('transaction.reservation.progressbar')
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <div class="card shadow-sm border">
                    <div class="card-header">
                        <h2>Thêm khách hàng</h2>
                    </div>
                    <div class="card-body p-3">
                        <form class="row g-3" method="POST" action="{{ route('transaction.reservation.storeCustomer') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <label for="name" class="form-label">Họ tên</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"  id="email"
                                    name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"  id=" phone"
                                       name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" value="{{ old('password') }}">
                                @error('password')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            <div class="col-mg-12">
                                <label for="avatar" class="form-label">Ảnh đại diện</label>
                                <input class="form-control" type="file" name="avatar" id="avatar">
                                @error('avatar')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <input type="hidden" value="Customer" name="role">
                            <div class="col-12">
                                <button type="submit" class="btn myBtn shadow-sm border float-end">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
