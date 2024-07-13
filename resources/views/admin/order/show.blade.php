@extends('admin.shared.layout')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('content')
    <center>
        <h2>{{ $title }}</h2>
    </center>
    <div class="row">
        <div style="margin: 0px 50px" class="col">
            <div>
                <label for="">Mã hóa đơn</label>
                <input type="text" name="MaHD" class="form-control" value="{{ $order->order_id }}" disabled />
            </div>
            <br />
            <div>
                <label for="">Ngày tạo</label>
                <input type="text" name="NgayTao" class="form-control" value="{{ $order->created_at }}" disabled />
            </div>
            <br />
            <div>
                <label for="">Ngày giao</label>
                <input type="text" name="NgayGiao" class="form-control" value="{{ $order->ship_date }}" disabled />
            </div><br />
        </div>
        <div style="margin: 0px 50px" class="col">
            <div>
                <label for="">Tên khách hàng</label>
                <input type="text" name="MaKH" class="form-control" value="{{ $order->user->name }}" disabled />
            </div>
            <br />
            <div>
                <label for="">Tên nhân viên</label>
                <input type="text" name="MaNV" class="form-control"
                    value="{{ $order->employee->employee_name ?? 'Nhân viên chưa xác nhận đơn hàng' }}" disabled />
            </div>
            <br />
            <div style="">
                <label for="">Trạng thái</label>
                <input type="text" name="TrangThai" class="form-control" value="{{ $order->status }}" disabled />
            </div><br />
        </div>
    </div>
    <div class="table-responsive container">
        <table class="table table-secondary table-bordered"
            style="text-align: center; border-radius: 10px; overflow: hidden; color: black">
            <thead>
                <tr>
                    <th scope="col">Mã hàng</th>
                    <th scope="col">Tên hàng</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Đơn vị tính</th>
                    <th scope="col">Trọng lượng</th>
                    <th scope="col">Đơn vị trọng lượng</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá bán</th>
                    <th scope="col">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderDetails as $orderDetail)
                    <tr>
                        <td>{{ $orderDetail->product->product_id }}</td>
                        <td>{{ $orderDetail->product->product_name }}</td>
                        <td>
                            <img src="{{ asset('/assets/client/img/products').'/'.$orderDetail->product->primaryImage->image_name }}"
                                alt="" style="width: 50px;">
                        </td>
                        <td>{{ $orderDetail->product->unit->unit_name }}</td>
                        <td>{{ $orderDetail->product->product_quantity }}</td>
                        <td>{{ $orderDetail->product->weight->weight_name }}</td>
                        <td>{{ $orderDetail->quantity }}</td>
                        <td>{{ number_format($orderDetail->product->product_price) }}</td>
                        <td>{{ number_format($orderDetail->total) }}</td>
                    </tr>
                @endforeach
        </table>
    </div>
    <div>
        <a href="{{ route('order.index') }}" style="margin: 0px 50px;"
            class="btn btn-primary material-symbols-outlined">
            keyboard_return
        </a>
    </div>
@endsection
