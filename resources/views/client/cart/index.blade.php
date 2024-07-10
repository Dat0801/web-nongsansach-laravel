@extends('client.shared.layout')
@section('title', $title)
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">{{ $title }}</h1>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="table-responsive" id="cart-table-body">
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
                                        <a class="d-lg-flex align-items-center"
                                            href="{{ route('product.show', ['product' => $key]) }}">
                                            <img src="{{ asset('') }}assets/client/img/products/{{ $item['image'] }}"
                                                class="img-fluid rounded-circle"
                                                style="width: 80px; height: 80px; object-fit: contain;" alt="">
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
                                            class="mb-0 mt-4 cart-quantity-single"
                                            data-stock="{{ $item['stock'] }}" data-url="{{ route('cart') }}"
                                            data-id = "{{ $key }}"
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
                    <a class="btn border-secondary rounded-pill px-3 py-3 text-primary text-uppercase mb-4 ms-4"
                        type="button" style="float:right" href="{{ route('checkout') }}">Tiến hành thanh toán</a>
                @else
                    <table class="table">
                        <tr>
                            <td>
                                <p>Giỏ hàng của bạn hiện đang trống, hãy thêm hàng hóa vào giỏ hàng!</p>
                            </td>
                        </tr>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
        aria-hidden="true" style="margin-top: 20%">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Xác nhận xóa sản phẩm trong giỏ hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc muốn xóa sản phẩm này?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không xóa</button>
                    <button type="button" class="btn btn-danger" id='accept-delete' data-id="" data-url="">Đồng
                        ý</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.remove-cart', function(event) {
                const id = $(this).data('id');
                const url = $(this).data('url');

                $('#accept-delete').data('id', id).data('url', url);

                console.log($('#accept-delete').data('id'));
                console.log($('#accept-delete').data('url'));
            });

            // $(document).on('input', '.cart-quantity-single', function(e) {
            //     if (e.target.value < 1) {
            //         e.target.setCustomValidity("Số lượng không thể nhỏ hơn 1.");
            //     } else {
            //         e.target.setCustomValidity("");
            //     }
            // });
        });
    </script>
@endsection
