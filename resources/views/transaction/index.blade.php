@extends('template.master')
@section('title', 'Reservation')
@section('content')
    <div class="row mt-2 mb-2">
        <div class="col-lg-6 mb-2">
            <div class="d-grid gap-2 d-md-block">
                <span data-bs-toggle="tooltip" data-bs-placement="right" title="Add Room Reservation">
                    <button type="button" class="btn btn-sm shadow-sm myBtn border rounded" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        <i class="fas fa-plus"></i>
                    </button>
                </span>
                <span data-bs-toggle="tooltip" data-bs-placement="right" title="Payment History">
                    <a href="{{ route('payment.index') }}" class="btn btn-sm shadow-sm myBtn border rounded">
                        <i class="fas fa-history"></i>
                    </a>
                </span>
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <form class="d-flex" method="GET" action="{{ route('transaction.index') }}">
                <label style="margin: 5px 5px 0 0" for="">Từ</label>
                <input type="date" name="from" value="{{ request()->input('from') }}" class="form-control">
                <label style="margin: 5px 5px 0 0" for="" for="">Đến</label>
                <input type="date" name="to" value="{{ request()->input('to') }}" class="form-control">
                <input class="form-control me-2" type="search" placeholder="Tìm theo tên" aria-label="Search"
                    id="search-user" name="search" value="{{ request()->input('search') }}">
                <button class="btn btn-outline-dark" type="submit">Tìm</button>
            </form>
        </div>
    </div>
    <div class="row my-2 mt-4 ms-1">
        <div class="col-lg-12">
            <h5>Hóa đơn còn hoạt động: </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="room-table" class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Tên khách hàng</th>
                                    <th>Homestay</th>
                                    <th>Ngày đặt</th>
                                    <th>Ngày đến</th>
                                    <th>Ngày đi</th>
                                    <th>Số ngày</th>
                                    <th>Tổng tiền</th>
                                    <th>Đã trả</th>
                                    <th>Chưa trả</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <th>{{ ($transactions->currentpage() - 1) * $transactions->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->guest_name }}</td>
                                        <td>{{ $transaction->room->number }}</td>
                                        <td>{{ Helper::dateFormat($transaction->created_at) }}</td>
                                        <td>{{ Helper::dateFormat($transaction->check_in) }}</td>
                                        <td>{{ Helper::dateFormat($transaction->check_out) }}</td>
                                        <td>{{ $transaction->getDateDifferenceWithPlural($transaction->check_in, $transaction->check_out) }}
                                        </td>
                                        <td>{{ Helper::convertToRupiah($transaction->sum_money) }}
                                        </td>
                                        <td>
                                            {{ Helper::convertToRupiah($transaction->getTotalPayment()) }}
                                        </td>
                                        <td>{{ $transaction->sum_money - $transaction->getTotalPayment() <= 0 ? '-' : Helper::convertToRupiah($transaction->sum_money - $transaction->getTotalPayment()) }}
                                        </td>
                                        <td>
                                            <a class="btn btn-light btn-sm rounded shadow-sm border p-1 m-0 {{ $transaction->getTotalPrice() - $transaction->getTotalPayment() <= 0 ? 'disabled' : '' }}"
                                                href="{{ route('transaction.payment.create', ['transaction' => $transaction->id]) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Trả">
                                                <i class="fas fa-money-bill-wave-alt"></i>
                                            </a>
                                            <a class="btn btn-light btn-sm rounded shadow-sm border"
                                                href="/payment/{{ $transaction->id }}/invoice" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Chi tiết">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a class="btn btn-light btn-sm rounded shadow-sm border" id="delete3"
                                                transaction_id={{ $transaction->id }}><i class="fas fa-trash-alt"></i>
                                            </a>
                                            <form action="{{ route('cancelHomestay', $transaction->id) }}"
                                                id="form--{{ $transaction->id }}" method="post" class="delete-cus">
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="15" class="text-center">
                                            Không có dữ liệu gì trong bảng
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $transactions->onEachSide(2)->links('template.paginationlinks') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2 mt-4 ms-1">
        <div class="col-lg-12">
            <h5>Đã hủy:</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Tên khách hàng</th>
                                    <th>Homestay</th>
                                    <th>Ngày đặt</th>
                                    <th>Ngày đến</th>
                                    <th>Ngày đi</th>
                                    <th>Số ngày</th>
                                    <th>Tổng tiền</th>
                                    <th>Đã trả</th>
                                    <th>Chưa trả</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactionCancel as $transaction)
                                    <tr>
                                        <th>{{ ($transactions->currentpage() - 1) * $transactions->perpage() + $loop->index + 1 }}
                                        </th>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->guest_name }}</td>
                                        <td>{{ $transaction->room->number }}</td>
                                        <td>{{ Helper::dateFormat($transaction->created_at) }}</td>
                                        <td>{{ Helper::dateFormat($transaction->check_in) }}</td>
                                        <td>{{ Helper::dateFormat($transaction->check_out) }}</td>
                                        <td>{{ $transaction->getDateDifferenceWithPlural($transaction->check_in, $transaction->check_out) }}
                                        </td>
                                        <td>{{ Helper::convertToRupiah($transaction->sum_money) }}
                                        </td>
                                        <td>
                                            {{ Helper::convertToRupiah($transaction->getTotalPayment()) }}
                                        </td>
                                        <td>{{ $transaction->sum_money - $transaction->getTotalPayment() <= 0 ? '-' : Helper::convertToRupiah($transaction->sum_money - $transaction->getTotalPayment()) }}
                                        </td>
                                        <td>
                                            <a class="btn btn-light btn-sm rounded shadow-sm border"
                                                href="/payment/{{ $transaction->id }}/invoice" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Chi tiết">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="15" class="text-center">
                                            Không có dữ liệu gì trong bảng
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $transactions->onEachSide(2)->links('template.paginationlinks') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2 mt-4 ms-1">
        <div class="col-lg-12">
            <h5>Đã thanh toán hết: </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Tên khách hàng</th>
                                    <th>Homestay</th>
                                    <th>Ngày đặt</th>
                                    <th>Ngày đến</th>
                                    <th>Ngày đi</th>
                                    <th>Số ngày</th>
                                    <th>Tổng tiền</th>
                                    <th>Đã trả</th>
                                    <th>Chưa trả</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactionsExpired as $transaction)
                                    @if ($transaction->getTotalPayment() == $transaction->sum_money)
                                        <tr>
                                            <th>{{ ($transactions->currentpage() - 1) * $transactions->perpage() + $loop->index + 1 }}
                                            </th>
                                            <td>{{ $transaction->id }}</td>
                                            <td>{{ $transaction->guest_name }}</td>
                                            <td>{{ $transaction->room->number }}</td>
                                            <td>{{ Helper::dateFormat($transaction->created_at) }}</td>
                                            <td>{{ Helper::dateFormat($transaction->check_in) }}</td>
                                            <td>{{ Helper::dateFormat($transaction->check_out) }}</td>
                                            <td>{{ $transaction->getDateDifferenceWithPlural($transaction->check_in, $transaction->check_out) }}
                                            </td>
                                            <td>{{ Helper::convertToRupiah($transaction->sum_money) }}
                                            </td>
                                            <td>
                                                {{ Helper::convertToRupiah($transaction->getTotalPayment()) }}
                                            </td>
                                            <td>{{ $transaction->sum_money - $transaction->getTotalPayment() <= 0 ? '-' : Helper::convertToRupiah($transaction->sum_money - $transaction->getTotalPayment()) }}
                                            </td>
                                            <td>
                                                <a class="btn btn-light btn-sm rounded shadow-sm border p-1 m-0 {{ $transaction->sum_money - $transaction->getTotalPayment() <= 0 ? 'disabled' : '' }}"
                                                    href="{{ route('transaction.payment.create', ['transaction' => $transaction->id]) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Pay">
                                                    <i class="fas fa-money-bill-wave-alt"></i>
                                                </a>
                                                <a class="btn btn-light btn-sm rounded shadow-sm border"
                                                    href="/payment/{{ $transaction->id }}/invoice"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="15" class="text-center">
                                            Không có dữ liệu gì trong bảng
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $transactions->onEachSide(2)->links('template.paginationlinks') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2 mt-4 ms-1">
        <div class="col-lg-12">
            <h5>Hóa đơn đã hết hạn: </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Tên khách hàng</th>
                                    <th>Homestay</th>
                                    <th>Ngày đặt</th>
                                    <th>Ngày đến</th>
                                    <th>Ngày đi</th>
                                    <th>Số ngày</th>
                                    <th>Tổng tiền</th>
                                    <th>Đã trả</th>
                                    <th>Chưa trả</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactionsExpired as $transaction)
                                    @if ($transaction->getTotalPayment() < $transaction->sum_money)
                                        <tr>
                                            <th>{{ ($transactions->currentpage() - 1) * $transactions->perpage() + $loop->index + 1 }}
                                            </th>
                                            <td>{{ $transaction->id }}</td>
                                            <td>{{ $transaction->guest_name }}</td>
                                            <td>{{ $transaction->room->number }}</td>

                                            <td>{{ Helper::dateFormat($transaction->created_at) }}</td>
                                            <td>{{ Helper::dateFormat($transaction->check_in) }}</td>
                                            <td>{{ Helper::dateFormat($transaction->check_out) }}</td>
                                            <td>{{ $transaction->getDateDifferenceWithPlural($transaction->check_in, $transaction->check_out) }}
                                            </td>
                                            <td>{{ Helper::convertToRupiah($transaction->sum_money) }}
                                            </td>
                                            <td>
                                                {{ Helper::convertToRupiah($transaction->getTotalPayment()) }}
                                            </td>
                                            <td>{{ $transaction->sum_money - $transaction->getTotalPayment() <= 0 ? '-' : Helper::convertToRupiah($transaction->sum_money - $transaction->getTotalPayment()) }}
                                            </td>
                                            <td>
                                                <a class="btn btn-light btn-sm rounded shadow-sm border p-1 m-0 {{ $transaction->sum_money - $transaction->getTotalPayment() <= 0 ? 'disabled' : '' }}"
                                                    href="{{ route('transaction.payment.create', ['transaction' => $transaction->id]) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Pay">
                                                    <i class="fas fa-money-bill-wave-alt"></i>
                                                </a>
                                                <a class="btn btn-light btn-sm rounded shadow-sm border"
                                                    href="/payment/{{ $transaction->id }}/invoice"
                                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="15" class="text-center">
                                            Không có dữ liệu gì trong bảng
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $transactions->onEachSide(2)->links('template.paginationlinks') }}
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Đã có tài khoản?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-sm btn-primary m-1"
                            href="{{ route('transaction.reservation.createIdentity') }}">Chưa, tạo tài khoản mới!</a>
                        <a class="btn btn-sm btn-success m-1"
                            href="{{ route('transaction.reservation.pickFromCustomer') }}">Đã có!</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(function() {
            $(document).on('click', '#delete3', function(e) {
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
                    text: "Homestay bạn đặt sẽ bị hủy ",
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
            }).on('submit', '.delete-cus', async function(e) {
                try {
                    const response = await $.ajax({
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        method: $(this).attr('method'),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
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

@endsection
