<div style="width:600px; margin: 0 auto;">
    <div style="text-align: center">
        <h2>Hi {{ session()->get('user')['name'] ?? '' }}</h2>
        <p>Đơn hàng của bạn đã được đặt thành công!</p>
    </div>
    <p>Thông tin đơn hàng</p>
    <table border="1" cellspacing="0" cellpadding="10" style="width: 100%">
        <tr>
            <th>Mã đơn hàng</th>
            <td>{{ $order->order_id }}</td>
        </tr>
        <tr>
            <th>Ngày đặt hàng</th>
            <td>{{ $order->created_at }}</td>
        </tr>

        <tr>
            <th>Phương thức thanh toán</th>
            @if($order->payment_method == 'cod')
                <td>Thanh toán khi nhận hàng</td>
            @else
                <td>Thanh toán qua thẻ</td>
            @endif
        </tr>
        <tr>
            <th>Địa chỉ nhận hàng</th>
            <td>{{ $order->user->defaultAddress->address }}
                {{ $order->user->defaultAddress->province }}
                {{ $order->user->defaultAddress->district }}
                {{ $order->user->defaultAddress->ward }}
            </td>
        </tr>
        <tr>
            <th>Tổng tiền</th>
            <td>{{ number_format($order->order_total) }} VND</td>
        </tr>
    </table>
    <p>Chi tiết đơn hàng</p>
    <table border="1" cellspacing="0" cellpadding="10" style="width: 100%">
        <tr>
            <th>Tên sản phẩm</th>
            <th>Đơn vị tính</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
        @foreach ($order->orderDetails as $orderDetail)
            <tr>
                <td>{{ $orderDetail->product->product_name }}</td>
                <td>{{ $orderDetail->product->unit->unit_name }}/{{ $orderDetail->product->product_quantity }}{{ $orderDetail->product->weight->weight_name  }}</td>
                <td>{{ number_format($orderDetail->product->product_price) }} VND</td>
                <td>{{ $orderDetail->quantity }}</td>
                <td>{{ number_format($orderDetail->product->product_price * $orderDetail->quantity) }} VND</td>
            </tr>
        @endforeach
    </table>
    <p>Trạng thái đơn hàng: <strong>{{ $order->status }}</strong></p>
    <p>Cảm ơn bạn đã ủng hộ cửa hàng chúng tôi!</p>
</div>
