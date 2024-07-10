@if (session('cart') && count(session('cart')) > 0)
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Sản&nbsp;phẩm</th>
                <th>Giá</th>
                <th>Đơn&nbsp;vị&nbsp;tính</th>
                <th>Trọng&nbsp;lượng</th>
                <th>Số&nbsp;lượng</th>
                <th>Tổng</th>
                <th>Thao&nbsp;tác</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalCounter = 0;
                $itemCounter = 0;
                $cartItems = session()->get('cart');
            @endphp
            @forelse ($cartItems as $key => $item)
                @php
                    $total = $item['price'] * $item['quantity'];
                    $totalCounter += $total;
                    $itemCounter += $item['quantity'];
                @endphp
                <tr>
                    <th>
                        <a class="d-lg-flex align-items-center" href="{{ route('product.show', ['product' => $key]) }}">
                            <img src="{{ asset('') }}assets/client/img/products/{{ $item['image'] }}"
                                class="img-fluid rounded-circle" style="width: 80px; height: 80px; object-fit: contain;"
                                alt="">
                            <p class="mb-0 ms-2">{{ $item['name'] }}</p>
                        </a>
                    </th>
                    <td>
                        <p class="mb-0 mt-4">
                            {{ number_format($item['price']) }}<sup><small>đ</small></sup>
                        </p>
                    </td>
                    <td>
                        <p class="mb-0 mt-4">
                            {{ $item['unit'] }}
                        </p>
                    </td>
                    <td>
                        <p class="mb-0 mt-4">
                            {{ $item['weight_quantity'] }}
                            {{ $item['weight_name'] }}
                        </p>
                    </td>
                    <td>
                        <input type="number" min="1" max="{{ $item['stock'] }}" required
                            class="mb-0 mt-4 cart-quantity-single" data-stock="{{ $item['stock'] }}"
                            data-url="{{ route('cart') }}" data-id = "{{ $key }}"
                            value="{{ $item['quantity'] > $item['stock'] ? $item['stock'] : $item['quantity'] }}">
                    </td>
                    <td>
                        <p class="mb-0 mt-4">
                            {{ number_format($item['price'] * $item['quantity']) }}<sup><small>đ</small></sup>
                        </p>
                    </td>
                    <td>
                        <button class="btn btn-md rounded-circle bg-light border mt-4 remove-cart"
                            data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                            data-url="{{ route('cart') }}" data-id = "{{ $key }}">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        <p>Giỏ hàng của bạn hiện đang trống, hãy thêm hàng hóa vào giỏ hàng!</p>
                    </td>
                </tr>
            @endforelse
            <tr>
                <th scope="row">
                    <div class="d-flex align-items-center">
                        <a class="mt-2 btn btn-danger btn-sm"
                            href="{{ route('cart.emptyCart') }}">Xóa&nbsp;giỏ&nbsp;hàng</a>
                    </div>
                </th>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <p class="mb-0 mt-2">
                        <strong>
                            {{ $itemCounter }}&nbsp;Sản&nbsp;phẩm
                        </strong>
                    </p>

                </td>
                <td>
                    <p class="mb-0 mt-2">
                        <strong>
                            {{ number_format($totalCounter) }}<sup><small>đ</small></sup>
                        </strong>
                    </p>
                </td>
                <td></td>
            </tr>

        </tbody>
    </table>
    <a class="btn border-secondary rounded-pill px-3 py-3 text-primary text-uppercase mb-4 ms-4" type="button"
        href="{{ route('checkout') }}" style="float:right">Tiến hành thanh toán</a>
@else
    <table class="table">
        <tr>
            <td>
                <p>Giỏ hàng của bạn hiện đang trống, hãy thêm hàng hóa vào giỏ hàng!</p>
            </td>
        </tr>
    </table>
@endif
