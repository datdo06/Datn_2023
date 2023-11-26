@extends('template.master')
@section('title', 'Payment')
@section('content')

    <div class="card shadow-sm border">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Phòng</th>
                        <th scope="col">Trả hết</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tại</th>
                        <th scope="col">Phục vụ bởi</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr>
                            <th scope="row">
                                {{ ($payments->currentpage() - 1) * $payments->perpage() + $loop->index + 1 }}
                            </th>
                            <td>{{ $payment->transaction->room->number }}</td>
                            <td>{{ Helper::convertToRupiah($payment->price) }}</td>
                            <td>{{ $payment->status }}</td>
                            <td>{{ Helper::dateFormatTime($payment->created_at) }}</td>
                            <td>{{ $payment->user->name }}</td>
                            <td> <a href="{{ route('payment.invoice', $payment->id) }}">Invoice</a> </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="6">Không tìm thấy khoản thanh toán nào trên cơ sở dữ liệu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
