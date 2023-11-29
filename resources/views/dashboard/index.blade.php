@extends('template.master')
@section('title', 'Dashboard')
@section('content')
    <!-- Thêm CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />

    <!-- Thêm JavaScript -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

    <div id="dashboard">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="card shadow-sm border" style="border-radius: 0.5rem">
                            <div class="card-body">
                                <h5>{{ count($transactions) }} khách hôm nay</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow-sm border" style="border-radius: 0.5rem">
                            <div class="card-body text-center">
                                <h5>Bảng điều khiển</h5>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box border -->
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="card shadow-sm border">
                            <div class="card-header">
                                <div class="row ">
                                    <div class="col-lg-12 d-flex justify-content-between">
                                        <h3>Khách đang thuê hôm nay</h3>
                                        <div>
                                            <a href="#" class="btn btn-tool btn-sm">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <a href="#" class="btn btn-tool btn-sm">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Họ tên</th>
                                        <th>Homestay</th>
                                        <th class="text-center">Thời gian ở</th>
                                        <th>Số ngày</th>
                                        <th>Chưa thanh toán</th>
                                        <th class="text-center">Trạng thái
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td>
                                                <img src="{{ $transaction->user->getAvatar() }}"
                                                     class="rounded-circle img-thumbnail" width="40" height="40"
                                                     alt="">
                                            </td>
                                            <td>
                                                <a
                                                    href="{{ route('customer.show', ['customer' => $transaction->user->id]) }}">
                                                    {{ $transaction->user->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('room.show', ['room' => $transaction->room->id]) }}">
                                                    {{ $transaction->room->number }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ Helper::dateFormat($transaction->check_in) }} ~
                                                {{ Helper::dateFormat($transaction->check_out) }}
                                            </td>
                                            <td>{{ Helper::getDateDifference(now(), $transaction->check_out) == 0 ? 'Last Day' : Helper::getDateDifference(now(), $transaction->check_out) . ' ' . Helper::plural('Day', Helper::getDateDifference(now(), $transaction->check_out)) }}
                                            </td>
                                            <td>
                                                {{ $transaction->getTotalPrice() - $transaction->getTotalPayment() <= 0 ? '-' : Helper::convertToRupiah($transaction->getTotalPrice() - $transaction->getTotalPayment()) }}
                                            </td>
                                            <td>
                                                    <span
                                                        class="justify-content-center badge {{ $transaction->getTotalPrice() - $transaction->getTotalPayment() == 0 ? 'bg-success' : 'bg-warning' }}">
                                                        {{ $transaction->getTotalPrice() - $transaction->getTotalPayment() == 0 ? 'Success' : 'Đang ở' }}
                                                    </span>
                                                @if (Helper::getDateDifference(now(), $transaction->check_out) < 1)
                                                    <span class="justify-content-center badge bg-danger">
                                                            số tiền phải thanh toán
                                                        </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                Không có dữ liệu
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{-- <div class="row justify-content-md-center mt-3">
                                    <div class="col-sm-10 d-flex mx-auto justify-content-md-center">
                                        <div class="pagination-block">
                                            {{ $transactions->onEachSide(1)->links('template.paginationlinks') }}
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="card shadow-sm border">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Biểu đồ lượng khách trong tháng</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="d-flex flex-column">
                                        {{-- <span class="text-bold text-lg">Belum</span> --}}
                                        {{-- <span>Total Guests at {{ Helper::thisMonth() . '/' . Helper::thisYear() }}</span> --}}
                                    </p>
                                    {{-- <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> Belum
                                    </span>
                                    <span class="text-muted">Since last month</span>
                                </p> --}}
                                </div>
                                <div class="position-relative mb-4">
                                    <canvas this-year="{{ Helper::thisYear() }}" this-month="{{ Helper::thisMonth() }}"
                                            id="visitors-chart" height="400" width="100%" class="chartjs-render-monitor"
                                            style="display: block; width: 249px; height: 200px;"></canvas>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> {{ Helper::thisMonth() }}
                                    </span>
                                    <span>
                                        <i class="fas fa-square text-gray"></i> Tháng trước
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="card shadow-sm border">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between ">
                                    <h3 class="card-title ">Doanh thu <của></của> homestay</h3>
                                    <select style="width: 500px" name="" id="filter" class="form-control">
                                        <option value="">Tháng hiện tại</option>
                                        <option value="1">Hôm nay</option>
                                        <option value="2">Tuần này</option>
                                    </select>
                                    <div class="d-flex justify-content-between ">
                                        <label style="margin: 5px 5px 0 0" for=""> Từ</label>
                                        <input type="date" style="width: 150px; height: 35px" id="tu" class="form-control" >
                                        <label style="margin: 5px 5px 0 5px" for="">Đến</label>
                                        <input type="date" id="den" style="width: 150px; height: 35px" class="form-control" >
                                        <button type="button" id="xem" style="color: white" class="btn btn-success">Xem</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="d-flex flex-column">
                                        {{-- <span class="text-bold text-lg">Belum</span> --}}
                                        {{-- <span>Total Guests at {{ Helper::thisMonth() . '/' . Helper::thisYear() }}</span> --}}
                                    </p>
                                    {{-- <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> Belum
                                    </span>
                                    <span class="text-muted">Since last month</span>
                                </p> --}}
                                </div>
                                <div class="position-relative mb-4">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart" height="400px"></canvas>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('footer')
    <script src="{{ asset('style/js/chart.min.js') }}"></script>
    <script src="{{ asset('style/js/guestsChart.js') }}"></script>
    <script>
        function reloadJs(src) {
            src = $('script[src$="' + src + '"]').attr("src");
            $('script[src$="' + src + '"]').remove();
            $('<script/>').attr('src', src).appendTo('head');
        }

        Echo.channel('dashboard')
            .listen('.dashboard.event', (e) => {
                $("#dashboard").hide()
                $("#dashboard").load(window.location.href + " #dashboard");
                $("#dashboard").show(150)
                reloadJs('style/js/guestsChart.js');
                toastr.warning(e.message, "Hello, {{ auth()->user()->name }}");
            })
    </script>
@endsection --}}
