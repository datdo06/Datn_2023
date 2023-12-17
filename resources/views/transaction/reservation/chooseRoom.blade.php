@extends('template.master')
@section('title', 'Choose Room Reservation')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
    <style>
        .wrapper {
            max-width: 400px;
        }

        .demo-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>
@endsection
@section('content')
    @include('transaction.reservation.progressbar')
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-8 mt-2">
                <div class="card shadow-sm border">
                    <div class="card-body p-3">
                        <h2>{{ $roomsCount }} Homestay có sẵn cho:</h2>
                        <p>{{ request()->input('count_person') }}
                            {{ Helper::plural('', request()->input('count_person')) }} Người trong ngày
                            {{ Helper::dateFormat(request()->input('check_in')) }} đến ngày
                            {{ Helper::dateFormat(request()->input('check_out')) }}</p>
                        <hr>
                        <form method="GET"
                            action="{{ route('transaction.reservation.chooseRoom', ['user' => $user->id]) }}">
                            <div class="row mb-2">
                                <input type="text" hidden name="count_person"
                                    value="{{ request()->input('count_person') }}">
                                <input type="date" hidden name="check_in" value="{{ request()->input('check_in') }}">
                                <input type="date" hidden name="check_out" value="{{ request()->input('check_out') }}">
                                {{--                                <input type="text" hidden name="type_id" value="{{{$type_id}}}"> --}}
                                <div class="col-lg-3">
                                    <select class="form-select" id="sort_name" name="sort_name"
                                        aria-label="Default select example">
                                        <option value="Price" @if (request()->input('sort_name') == 'Giá tiền') selected @endif>Giá tiền
                                        </option>

                                        <option value="Capacity" @if (request()->input('sort_name') == 'Số người') selected @endif>Số người
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-select" id="type_id" name="type_id"
                                        aria-label="Default select example">
                                        @foreach ($type as $t)
                                            <option value="{{ $t->id }}"
                                                @if (request()->input('type_id') == $t->id) selected @endif>{{ $t->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-select" id="sort_type" name="sort_type"
                                        aria-label="Default select example">
                                        <option value="ASC" @if (request()->input('sort_type') == 'ASC') selected @endif>Tăng dần
                                        </option>
                                        <option value="DESC" @if (request()->input('sort_type') == 'DESC') selected @endif>Giảm dần
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" class="btn myBtn shadow-sm border w-100">Tìm</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            @forelse ($rooms as $room)
                                <div class="col-lg-12">
                                    <div
                                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                        <div class="col p-4 d-flex flex-column position-static">
                                            <strong class="d-inline-block mb-2 text-secondary">{{ $room->capacity }}
                                                {{ Str::plural('', $room->capacity) }} Người</strong>
                                            <h3 class="mb-0">{{ $room->number }} ~ {{ $room->type->name }}</h3>
                                            <div class="mb-1 text-muted">{{ Helper::convertToRupiah($room->price) }} /
                                                Đêm
                                            </div>
                                            <div class="wrapper">
                                                <p class="card-text mb-auto demo-1">{{ $room->view }}</p>
                                            </div>
                                            <a href="{{ route('transaction.reservation.confirmation', ['user' => $user->id, 'room' => $room->id, 'from' => request()->input('check_in'), 'to' => request()->input('check_out'), 'person'=>request()->input('count_person')]) }}"
                                                class="btn myBtn shadow-sm border w-100 m-2">Chọn</a>
                                        </div>
                                        <div class="col-auto d-none d-lg-block">
                                            <img src="{{ $room->firstImage() }}" width="200" height="250"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h3>Không có Homestay có sẵn cho {{ request()->input('count_person') }} người hoặc nhiều người hơn
                                </h3>
                            @endforelse
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                {{ $rooms->onEachSide(1)->appends([
                                        'count_person' => request()->input('count_person'),
                                        'check_in' => request()->input('check_in'),
                                        'check_out' => request()->input('check_out'),
                                        'type_id' => request()->input('type_id'),
                                        'sort_name' => request()->input('sort_name'),
                                        'sort_type' => request()->input('sort_type'),
                                    ])->links('template.paginationlinks') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="card shadow-sm">
                    <img src="{{ $user->getAvatar() }}"
                        style="border-top-right-radius: 0.5rem; border-top-left-radius: 0.5rem">
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
        </div>
    </div>
@endsection
