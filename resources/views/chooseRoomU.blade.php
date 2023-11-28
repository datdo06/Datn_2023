@extends('client.layout.master')
@section('content')
    <section class="section-sub-banner bg-16">

        <div class="awe-overlay"></div>

        <div class="sub-banner">
            <div class="container">
                <div class="text text-center">
                    <h2>RESERVATION</h2>
                    <p></p>
                </div>
            </div>

        </div>

    </section>
    <section class="section-reservation-page bg-white">

        <div class="container">
            <div class="reservation-page">
                <div class="row">
                    <!-- SIDEBAR -->
                    <div class="col-md-4 col-lg-3">
                        <div class="reservation-sidebar">
                            <div class="reservation-room-selected bg-gray">
                                <!-- HEADING -->
                                <h2 class="reservation-heading">{{ $roomsCount }} Homestay Available for:</h2>
                                <!-- END / HEADING -->

                                <!-- CURRENT -->
                                <div class="reservation-room-seleted_current bg-blue">
                                    <h6><label>{{ request()->input('count_person') }}
                                            {{ Helper::plural('People', request()->input('count_person')) }}</label>
                                    </h6>
                                </div>
                                <!-- CURRENT -->

                                <!-- ITEM -->
                                <div class="reservation-room-seleted_item reservation_disable">
                                    <span class="reservation-option"> {{ Helper::dateFormat(request()->input('check_in')) }}
                                        to
                                        {{ Helper::dateFormat(request()->input('check_out')) }}</span>
                                </div>
                                <!-- END / ITEM -->

                            </div>
                            <!-- SIDEBAR AVAILBBILITY -->
                            <div class="reservation-sidebar_availability bg-gray">

                                <!-- END / HEADING -->

                                <h6 class="check_availability_title" style="padding-top: 15px;">Ngày bạn ở</h6>
                                <form action="chooseRoom" method="GET">
                                    <input type="text" hidden name="count_person"
                                           value="{{ request()->input('count_person') }}">
                                    <input type="text" hidden name="check_in"
                                           value="{{ request()->input('check_in') }}">
                                    <input type="text" hidden name="check_out"
                                           value="{{ request()->input('check_out') }}">
                                    <div class="check_availability-field">
                                        <select class="awe-select" id="sort_name" name="sort_name">
                                            <option value="Price"
                                                    @if (request()->input('sort_name') == 'Price') selected @endif>Price
                                            </option>
                                            <option value="Number"
                                                    @if (request()->input('sort_name') == 'Number') selected @endif>Name
                                            </option>
                                            <option value="Capacity"
                                                    @if (request()->input('sort_name') == 'Capacity') selected @endif>
                                                Capacity
                                            </option>
                                        </select>
                                    </div>
                                    <div class="check_availability-field">
                                        <select class="awe-select" id="type_id" name="type_id">
                                            @foreach ($type as $t)
                                                <option value="{{ $t->id }}"
                                                        @if (request()->input('type_id') == $t->id) selected @endif>{{ $t->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="check_availability-field">

                                        <select class="awe-select" id="sort_type" name="sort_type">

                                            <option value="ASC"
                                                    @if (request()->input('sort_type') == 'ASC') selected @endif>
                                                Ascending
                                            </option>
                                            <option value="DESC"
                                                    @if (request()->input('sort_type') == 'DESC') selected @endif>
                                                Descending
                                            </option>
                                        </select>
                                    </div>
                                    <button class="awe-btn awe-btn-13" type="submit">CHECK AVAILABLE</button>

                                </form>


                            </div>
                            <!-- END / SIDEBAR AVAILBBILITY -->

                        </div>

                    </div>
                    <!-- END / SIDEBAR -->

                    <!-- CONTENT -->
                    <div class="col-md-8 col-lg-9">

                        <div class="reservation_content">

                            <!-- RESERVATION ROOM -->
                            <div class="reservation-room bg-gray">

                                <!-- ITEM -->
                                @forelse ($rooms as $room)
                                    <div class="reservation-room_item" style="padding: 25px">
                                        @if(isset(Auth()->user()->id))
                                            <form
                                                action="{{route('confirm',['user' => Auth()->user()->id, 'room'=>$room->id])}}"
                                                method="GET">
                                                @else
                                                    <form
                                                        action="{{route('confirm',['user' => 0, 'room'=>$room->id])}}"
                                                        method="GET">
                                                        @endif
                                                        @csrf
                                                        <h2 class="reservation-room_name"><a
                                                                href="homestay-detail/{{$room->id}}?checkin={{$stayFrom}}&checkout={{$stayUntil}}&person={{request()->input('count_person')}}">{{ $room->number }}
                                                                ~ {{ $room->type->name }}</a></h2>
                                                        <input type="hidden" value="{{ $stayFrom }}" name="checkin">
                                                        <input type="hidden" value="{{ $stayUntil }}" name="checkout">
                                                        <input type="hidden"
                                                               value="{{ request()->input('count_person') }}"
                                                               name="person">
                                                        <input type="hidden"
                                                               value="{{Helper::getDateDifference($_GET['check_in'], $_GET['check_out'])}}"
                                                               name="total_day">
                                                        <div class="reservation-room_img">
                                                            <a href="homestay-detail/{{$room->id}}?checkin={{$stayFrom}}&checkout={{$stayUntil}}&person={{request()->input('count_person')}}"><img
                                                                    src="img/homestay/homestay-1.jpg" alt=""></a>
                                                        </div>

                                                        <div class="reservation-room_text">

                                                            <div class="reservation-room_desc">
                                                                <p>{{ $room->view }}</p>
                                                                <ul>
                                                                    <li>1 King Bed</li>
                                                                    <li>Free Wi-Fi in all guest rooms</li>
                                                                    <li>Separate sitting area</li>

                                                                </ul>
                                                            </div>

                                                            <a href="homestay-detail/{{$room->id}}?checkin={{$stayFrom}}&checkout={{$stayUntil}}&person={{request()->input('count_person')}}"
                                                               class="reservation-room_view-more">View More
                                                                Infomation</a>

                                                            <div class="clear"></div>

                                                            <p class="reservation-room_price">
                                                <span
                                                    class="reservation-room_amout">{{ Helper::convertToRupiah($room->price) }}</span>
                                                                / days
                                                            </p>

                                                            <button type="submit" class="awe-btn awe-btn-default">BOOK
                                                                ROOM
                                                            </button>
                                                        </div>
                                                    </form>

                                    </div>


                            </div>
                            @empty
                                <h3>Không có homestay trống cho {{ request()->input('count_person') }} người hoặc homestay đã hết
                                </h3>
                            @endforelse
                            <!-- END / ITEM -->

                            <!-- ITEM -->

                        </div>
                        <!-- END / RESERVATION ROOM -->
                    </div>

                </div>
                <!-- END / CONTENT -->
                <div>
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


    </section>
@endsection
