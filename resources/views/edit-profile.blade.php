@extends('client.layout.master')
@section('content')
    <section class="section-sub-banner bg-9">
        <div class="sub-banner">
            <div class="container">
                <div class="text text-center">
                    <h2>Chỉnh sửa thông tin</h2>
                </div>
            </div>

        </div>

    </section>
    <div class="editpro row justify-content-md-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border">
                <div class="card-body p-3">
                    <form class="row g-3" method="POST" enctype="multipart/form-data"
                        action="{{ route('profile.update',  $user->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ $user->name }}">
                            @error('name')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id=" email"
                                name="email" value="{{ $user->email }}" >
                            @error('email')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                   name="phone" value="{{ $user->phone }}" >
                            @error('phone')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="birthdate" class="form-label">Giới tính </label>
                            <select name="gender" id="" class="form-control">
                                @if($user->gender === 'Nam')
                                    <option value="Nam" selected >Giới tính Nam</option>
                                    <option value="Nữ" >Giới tính Nữ</option>
                                @else
                                    <option value="Nữ" >Giới tính Nữ</option>
                                    <option value="Nam"selected >Giới tính Nam</option>
                                @endif
                            </select>
                            @error('gender')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <textarea class="form-control" id="location" name="location"
                               >{{ $user->location }}</textarea>
                            @error('location')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="avatar" class="form-label">Hình đại diện</label>
                            <input class="form-control" type="file" id="avatar" name="avatar">
                            @error('avatar')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn myBtn shadow-sm border float-end">Lưu thông tin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
