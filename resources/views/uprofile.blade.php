@extends('client.layout.master')
@section('content')
    <section class="section-sub-banner bg-9">
        <div class="sub-banner">
            <div class="container">
                <div class="text text-center">
                    <h2>Hồ sơ</h2>
                </div>
            </div>

        </div>

    </section>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Họ và tên: {{ $user->name }}</h3>
            </div>
            <div class="card-body">
                <div class="row g-0 bg-light position-relative">
                    <div class="col-md-4 mb-md-0 p-md-4">
                        <img src="{{ $user->getAvatar() }}" class="w-100" alt="...">
                    </div>
                    <div class="col-md-8 p-4 ps-md-0">
                        <h5 class="mt-0">{{ $user->email }}</h5>
                        <p>Số điện thoại: {{ $user->phone }} </p>
                        <p>Giới tính: {{ $user->gender }} </p>
                        <p>Địa chỉ: {{ $user->location }} </p>
                        <button type="submit" class="awe-btn awe-btn-default"><a
                                href="{{ route('profile.edit', ['user' => $user->id]) }}">Sửa thông tin</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
