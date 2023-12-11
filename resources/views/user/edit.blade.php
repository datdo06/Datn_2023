@extends('template.master')
@section('title', 'Edit User')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row justify-content-md-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border">
                <div class="card-header">
                    <h2>Chỉnh sửa thông tin</h2>
                </div>
                <div class="card-body p-3">
                    <form class="row g-3" method="POST" action="{{ route('user.update', ['user' => $user->id]) }}">
                        @method('PUT')
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label">Họ tên</label>
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
                                name="email" value="{{ $user->email }}">
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
                            <label for="gender" class="form-label">Giới tính </label>
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

                                rows="3">{{ $user->location }}</textarea>
                            @error('location')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-mg-12">
                            <label for="avatar" class="form-label">Hình đại diện</label>
                            <input class="form-control" type="file" id="avatar" name="avatar">
                            @error('avatar')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class=" col-md-12">
                            <label for="role" class="form-label">Vai trò</label>
                            <select id="role" name="role" class="form-select @error('password') is-invalid @enderror">
                                <option selected disabled hidden>Chọn...</option>
                                @if (in_array($user->role, ['Super', 'Admin']))
                                    <option value="Super" @if ($user->role == 'Super') selected @endif>Quản lý</option>
                                    <option value="Admin" @if ($user->role == 'Admin') selected @endif>Nhân viên</option>
                                @endif
                                @if ($user->role == 'Customer')
                                    <option value="Customer" @if ($user->role == 'Customer') selected @endif>Khách hàng</option>
                                @endif
                            </select>
                            @error('role')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-light shadow-sm border float-end">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
