@extends('admin.shared.layout')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('content')
    <form class="d-flex" action="{{ route('order.index') }}" method="get">
        <div style="margin: 0 auto">
            <input class="form-control me-2" type="search" placeholder="Nhập tên đơn hàng..." aria-label="Tìm kiếm đơn hàng..."
                style="width:400px; margin: 0 auto" name="searchStr" id="searchStr">
            <center>
                <button class="btn btn-outline-success m-2" type="submit">Tìm kiếm</button>
            </center>
        </div>
    </form>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 my-3">
                <a href="{{ route('order.create') }}" class="btn btn-success material-symbols-outlined">
                    add_circle
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive container-fluid">
        <table class="table table-secondary table-bordered"
            style="text-align: center; border-radius: 10px; overflow: hidden;color:black">
            <thead>
                <tr>
                    <th scope="col">Mã&nbsp;đơn&nbsp;hàng</th>
                    <th scope="col">Tên&nbsp;khách&nbsp;hàng</th>
                    <th scope="col">Tên&nbsp;nhân&nbsp;viên</th>
                    <th scope="col">Ngày&nbsp;tạo</th>
                    <th scope="col">Ngày&nbsp;giao</th>
                    <th scope="col">Phương&nbsp;thức&nbsp;thanh&nbsp;toán</th>
                    <th scope="col">Tổng&nbsp;tiền</th>
                    <th scope="col">Trạng&nbsp;thái</th>
                    <th scope="col" colspan="2">CRUD</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->employee->employee_name ?? 'Nhân viên chưa xác nhận' }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->ship_date }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ $order->order_total }}</td>
                        @php
                            $color = '';
                            if ($order['status'] == 'Đang xử lý' || $order['status'] == 'Đang giao hàng') {
                                $color = '#e65c00';
                            } elseif ($order['status'] == 'Đã giao hàng') {
                                $color = '#008000';
                            } else {
                                $color = '#cc0000';
                            }
                        @endphp
                        <td style="color: {{ $color }}">{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('order.show', [$order->order_id]) }}"
                                class="btn btn-sm btn-primary material-symbols-outlined">visibility</a>
                        </td>
                        <td colspan="2">
                            @if ($order->status == 'Đang xử lý' || $order->status == 'Đang giao hàng')
                                @if ($order->status == 'Đang xử lý')
                                    <a href="{{ route('admin.order.accept', [$order->order_id]) }}"
                                        class="btn btn-sm btn-success material-symbols-outlined">check_circle</a>
                                    {{-- @else
                                    <a href="{{ route('admin.order.cancel', [$order->order_id]) }}"
                                        class="btn btn-sm btn-success material-symbols-outlined">check_circle</a> --}}
                                @endif
                                <a class="btn-delete btn btn-sm btn-danger material-symbols-outlined" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-orderid="{{ $order->order_id }}"
                                    data-orderstatus="{{ $order->status }}">cancel</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- Xử lý phân trang -->

    <!-- Xử lý nút delete -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:black">Hủy đơn hàng</h5>
                </div>
                <div class="modal-body">
                    <p style="color: red">Bạn có chắc muốn hủy đơn hàng này không?</p>
                    <table class="table table-order">
                        <tr>
                            <td>Mã đơn hàng</td>
                            <td><span id="DeleteorderIDSpan"></span></td>
                        </tr>
                        <tr>
                            <td>Trạng thái đơn hàng</td>
                            <td><span id="DeleteorderStatusSpan"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <form action="" method="GET" id="deleteForm">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.btn-delete').click((event) => {
            const orderid = $(event.target).attr('data-orderid');
            const orderstatus = $(event.target).attr('data-orderstatus');
            $('#DeleteorderIDSpan').html(orderid);
            $('#DeleteorderStatusSpan').html(orderstatus);
            let baseUrl = '{{ route('admin.order.cancel', ['id' => ':id']) }}';
            let deleteUrl = baseUrl.replace(':id', orderid);

            $('#deleteForm').attr('action', deleteUrl);
        })
    </script>
@endsection
