@extends('template.master')
@section('title', 'Add User')
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border">
                <div class="card-header">
                    <h2>Thêm mới</h2>
                </div>
                <div class="card-body p-3">
                    <form class="row g-3" method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label">Tên</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="
                                password" name="password"
                                value="{{ old('password') }}">
                            @error('password')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Số điện thoại</label>
                            <input type="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Giới tính</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender"
                                    aria-label="Default select example">
                                {{-- <option selected hidden>Select</option> --}}
                                <option value="Nam">Giới tính Nam</option>
                                <option value="Nữ">Giới tính Nữ</option>
                            </select>
                            @error('gender')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="location" class="form-label">Địa chỉ</label>
                            <textarea class="form-control" id="location" name="location"
                                      rows="3">{{ old('location') }}</textarea>
                            @error('location')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class=" col-md-6">
                            <label for="role" class="form-label">Vai trò</label>
                            <select id="role" name="role"
                                class="form-select @error('password') is-invalid @enderror">
                                <option selected disabled hidden>Chọn...</option>
                                <option value="Super" @if (old('role') == 'Super') selected @endif>Quản lý</option>
                                <option value="Admin" @if (old('role') == 'Admin') selected @endif>Nhân viên</option>
                                <option value="Customer" @if (old('role') == 'Customer') selected @endif>Khách hàng
                                </option>
                            </select>
                            @error('role')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-mg-12">
                            <label for="avatar" class="form-label">Ảnh đại diện</label>
                            <input class="form-control" type="file" name="avatar" id="avatar">
                            @error('avatar')
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
