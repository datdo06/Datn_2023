@extends('client.layout.master')
@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Header của trang */
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        header h1 {
            margin: 0;
        }

        /* Phần chính của trang */
        main {
            max-width: 960px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Phần Lịch sử Đặt Phòng */
        .booking-history {
            margin-bottom: 20px;
        }

        .booking-history h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        table th {
            background-color: #333;
            color: #fff;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #e0e0e0;
        }
        swal2-show{
            width: 500px;
        }

    </style>
    <section class="section-sub-banner bg-16">

        <div class="awe-overlay"></div>

        <div class="sub-banner">
            <div class="container">
                <div class="text text-center">
                    <h2>Lịch sử Đặt HomeStay</h2>
                    <p>Xem lại các phòng bạn đã đặt</p>
                </div>
            </div>

        </div>

    </section>
    <div class="container-fluid">
        <section class="booking-history">
            <h2>Lịch sử Đặt HomeStay</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>HomeStay</th>
                    <th>Quận</th>
                    <th>Ngày đến</th>
                    <th>Ngày đi</th>
                    <th>Tổng tiền</th>
                    <th colspan="2">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <th>{{ $transaction->id }}
                            </th>
                            <td>{{ $transaction->room->number }}</td>
                            <td>{{ $transaction->room->type->name }}</td>
                            <td>{{ Helper::dateFormat($transaction->check_in) }}</td>
                            <td>{{ Helper::dateFormat($transaction->check_out) }}</td>
                            <td>{{ Helper::convertToRupiah($transaction->sum_money) }}
                            </td>
                            <td><a style="font-weight: bold" class="btn btn-light btn-sm rounded shadow-sm border"
                                    href="/payment/{{ $transaction->id }}/invoice" data-bs-toggle="tooltip"
                                    data-bs-placement="top">
                                    Chi tiết
                                </a></td>
                            @php
                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                            @endphp
                            @if (Helper::thisNow() > $transaction->check_out)
                                <td><a style="font-weight: bold" class="btn btn-light btn-sm rounded shadow-sm border"
                                        href="/formComment/{{ $transaction->room->id }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top">
                                        Đánh giá
                                    </a></td>
                            @endif


                            @if (Helper::getDateDifference(now(), $transaction->check_in) >= 0)
                                @if (Helper::getDateDifference(now(), $transaction->check_in) <= 3)
                                    <td>
                                        <button class="btn btn-danger" id="delete1"
                                            transaction_id={{ $transaction->id }}>Hủy phòng</button>
                                        <form action="{{ route('cancelHomestay', $transaction->id) }}"
                                            id="form--{{ $transaction->id }}" method="post">
                                            @csrf
                                        </form>
                                    </td>
                                @elseif(Helper::getDateDifference(now(), $transaction->check_in) <= 7)
                                    <td>
                                        <button class="btn btn-danger" id="delete2"
                                            transaction_id={{ $transaction->id }}>Hủy phòng</button>
                                        <form action="{{ route('cancelHomestay', $transaction->id) }}"
                                            id="form--{{ $transaction->id }}" method="post">
                                            @csrf
                                            <input type="hidden" value="15" name="hoan">
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <button class="btn btn-danger" id="delete3"
                                            transaction_id={{ $transaction->id }}>Hủy phòng</button>
                                        <form action="{{ route('cancelHomestay', $transaction->id) }}"
                                            id="form--{{ $transaction->id }}" method="post" class="delete-cus">
                                            @csrf
                                            <input type="hidden" value="100" name="hoan">
                                        </form>
                                    </td>
                                @endif
                            @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function () {
        $(document).on('click', '#delete1', function (e) {
            var transaction_id = $(this).attr('transaction_id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            e.preventDefault();
            swalWithBootstrapButtons.fire({
                title: 'Bạn muốn hủy homestay',
                text: "Homestay bạn đặt sẽ bị hủy và sẽ không mất phí ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Đúng',
                cancelButtonText: 'Không ',
                reverseButtons: true
            }).then((result) => {
                console.log(result);
                if (result.isConfirmed) {
                    $(`#form--${transaction_id}`).submit();
                }
            })
        }).on('submit', '.delete-cus', async function (e) {
            try {
                const response = await $.ajax({
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    method: $(this).attr('method'),
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                })

                if (!response) return

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                })
                window.location.reload();
            } catch (e) {
                if (e && e.responseJSON && e.responseJSON.message) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: e.responseJSON.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        })
        $(document).on('click', '#delete2', function (e) {
            var transaction_id = $(this).attr('transaction_id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            e.preventDefault();
            swalWithBootstrapButtons.fire({
                title: 'Bạn muốn hủy homestay',
                text: "Homestay bạn đặt sẽ bị hủy và sẽ được hoàn 15% phí đã cọc",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Đúng',
                cancelButtonText: 'Không ',
                reverseButtons: true
            }).then((result) => {
                console.log(result);
                if (result.isConfirmed) {
                    $(`#form--${transaction_id}`).submit();
                }
            })
        }).on('submit', '.delete-cus', async function (e) {
            try {
                const response = await $.ajax({
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    method: $(this).attr('method'),
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                })

                if (!response) return

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                })
                window.location.reload();
            } catch (e) {
                if (e && e.responseJSON && e.responseJSON.message) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: e.responseJSON.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        })
        $(document).on('click', '#delete3', function (e) {
            var transaction_id = $(this).attr('transaction_id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            e.preventDefault();
            swalWithBootstrapButtons.fire({
                title: 'Bạn muốn hủy homestay',
                text: "Homestay bạn đặt sẽ bị hủy và sẽ không được hoàn trả phí cọc ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Đúng',
                cancelButtonText: 'Không ',
                reverseButtons: true
            }).then((result) => {
                console.log(result);
                if (result.isConfirmed) {
                    $(`#form--${transaction_id}`).submit();
                }
            })
        }).on('submit', '.delete-cus', async function (e) {
            try {
                const response = await $.ajax({
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    method: $(this).attr('method'),
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                })

                if (!response) return

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                })
                window.location.reload();
            } catch (e) {
                if (e && e.responseJSON && e.responseJSON.message) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: e.responseJSON.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        })
    });
</script>
