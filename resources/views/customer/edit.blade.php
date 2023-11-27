@extends('template.master')
@section('title', 'Edit Customer')
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border">
                <div class="card-header">
                    <h2>Chỉnh sửa thông tin khách hàng</h2>
                </div>
                <div class="card-body p-3">
                    <form class="row g-3" method="POST" enctype="multipart/form-data"
                        action="{{ route('customer.update',  $customer->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label">Tên khách hàng</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ $customer->name }}">
                            @error('name')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id=" email"
                                name="email" value="{{ $customer->user->email }}" >
                            @error('email')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="birthdate" class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate"
                                name="birthdate" value="{{ $customer->birthdate }}">
                            @error('birthdate')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="birthdate" class="form-label">Giới tính </label>
                            <select name="gender" id="" class="form-control">
                                @if($customer->gender === 'Male')
                                    <option value="Male" selected >Giới tính Nam</option>
                                    <option value="Female" >Giới tính Nữ</option>
                                @else
                                    <option value="Male" >Giới tính Nữ</option>
                                    <option value="Female"selected >Giới tính Nam</option>
                                @endif
                            </select>
                            @error('birthdate')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="job" class="form-label">Nghề nghiệp</label>
                            <input type="text" class="form-control @error('job') is-invalid @enderror" id="job" name="job"
                                value="{{ $customer->job }}">
                            @error('job')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <textarea class="form-control" id="address" name="address"
                                rows="3">{{ $customer->address }}</textarea>
                            @error('address')
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
                        <div class="col-12">
                            <button type="submit" class="btn myBtn shadow-sm border float-end">Lưu thông tin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
