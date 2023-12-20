@extends('template.master')
@section('title', 'Count Person')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
@endsection
@section('content')
    @include('transaction.reservation.progressbar')
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-8 mt-2">
                <div class="card shadow-sm border">
                    <div class="card-body p-3">
                        <div class="card">
                            <div class="card-body">
                                @if(!empty($user))
                                    <form class="row g-3" method="GET"
                                          action="{{ route('transaction.reservation.chooseRoom', ['user'=> $user->id]) }}">
                                        @else
                                            <form method="GET"
                                                  action="{{ route('transaction.reservation.chooseRoom', ['user' => 0]) }}">
                                                @endif
                                    <div class="col-md-12">
                                        <label for="count_person" class="form-label">
                                            Nhập số người ở
                                        </label>
                                        <input type="text"
                                            class="form-control @error('count_person') is-invalid @enderror"
                                            id="
                                                count_person"
                                            name="count_person" value="{{ old('count_person') }}">
                                        @error('count_person')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label for="check_in" class="form-label">
                                            Ngày đến
                                        </label>
                                        <input type="date" class="form-control @error('check_in') is-invalid @enderror"
                                            id="
                                                check_in" name="check_in"
                                            value="{{ old('check_in') }}">
                                        @error('check_in')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label for="check_out" class="form-label">
                                            Ngày đi
                                        </label>
                                        <input type="date" class="form-control @error('check_out') is-invalid @enderror"
                                            id="
                                                check_out" name="check_out"
                                            value="{{ old('check_out') }}">
                                        @error('check_out')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label for="count_person" class="form-label">
                                            Bạn muốn chọn quận/huyện nào
                                        </label>
                                        <select class="form-control @error('type_id') is-invalid @enderror" name="type_id"
                                            id="type_id">
                                            @foreach ($room_type as $rt)
                                                <option value="{{ $rt->id }}">{{ $rt->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('type_id')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @if(empty($user))
                                            <label for="count_person" class="form-label">
                                                Họ và tên
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="guest_name" value="">
                                            @error('guest_name')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <label for="count_person" class="form-label">
                                                Email
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="guest_email" value="">
                                            @error('guest_email')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <label for="count_person" class="form-label">
                                                Số điện thoại
                                            </label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="guest_phone" value="">
                                            @error('guest_phone')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn myBtn shadow-sm border float-end">Tiếp tục</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($user))
                <div class="col-md-4 mt-2">
                    <div class="card shadow-sm">
                        <img src="{{ $user->getAvatar() }}"
                             style="border-top-right-radius: 0.5rem; border-top-left-radius: 0.5rem"; height="330px">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
