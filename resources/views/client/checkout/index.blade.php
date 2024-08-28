@extends('client.shared.layout')
@section('title', $title)
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">{{ $title }}</h1>
    </div>
    <!-- Single Page Header End -->
    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <form action="{{ route('checkout.verifyUser') }}" method="post">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <h3 class="mb-4">Địa chỉ nhận hàng</h3>
                        <div class="form-item">
                            <label class="form-label my-3">Họ và tên<sup style="color: red"> (*)</sup></label>
                            <input type="text" class="form-control" name="name"
                                value="@php if (session()->has('user')) {
                                echo session()->get('user')['name'];
                            } else {
                                echo !empty(old('name')) ? old('name') : '';
                            } @endphp">
                            @error('name')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email<sup style="color: red"> (*)</sup></label>
                            <input type="email" class="form-control" name="email"
                                value="@php if (session()->has('user')) {
                                echo session()->get('user')['email'];
                            } else {
                                echo !empty(old('email')) ? old('email') : '';
                            } @endphp">
                            @error('email')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Số điện thoại<sup style="color: red"> (*)</sup></label>
                            <input type="tel" class="form-control" name="phone_number"
                                value="@php if (session()->has('user')) {
                                echo session()->get('user')['phone_number'];
                            } else {
                                echo !empty(old('phone_number')) ? old('phone_number') : '';
                            } @endphp">
                            @error('phone_number')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Địa chỉ <sup style="color: red"> (*)</sup></label>
                            <input type="text" class="form-control" name="address"
                                value="@php if (session()->has('user')) {
                                echo session()->get('user')['address'];
                            } else {
                                echo !empty(old('address')) ? old('address') : '';
                            } @endphp">
                            @error('address')
                                <div class="invalid-feedback" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="province" class="form-label my-3">Tỉnh<sup style="color: red"> (*)</sup></label>
                                <select id="province" name="province" class="form-select">
                                    @if (session()->has('user'))
                                        <option value="{{ session()->get('user')['province'] }}" id="provinceSelected">
                                            {{ session()->get('user')['province'] }}
                                        </option>
                                    @else
                                        <option value="">Chọn Tỉnh/Thành phố</option>
                                    @endif
                                </select>
                                @error('province')
                                    <div class="invalid-feedback" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="district" class="form-label my-3">Quận/Huyện<sup style="color: red">
                                        (*)</sup></label>
                                <select id="district" name="district" class="form-select form-control-user">
                                    @if (session()->has('user'))
                                        <option value="{{ session()->get('user')['district'] }}"
                                            id="districtSelected">
                                            {{ session()->get('user')['district'] }}
                                        </option>
                                    @else
                                        <option value="">Chọn Quận/Huyện</option>
                                    @endif
                                </select>
                                @error('district')
                                    <div class="invalid-feedback" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="ward" class="form-label my-3">Xã<sup style="color: red"> (*)</sup></label>
                                <select id="ward" name="ward" class="form-select" style="background-color: #fff;">
                                    @if (session()->has('user'))
                                        <option value="{{ session()->get('user')['ward'] }}" selected id="wardSelected">
                                            {{ session()->get('user')['ward'] }}
                                        </option>
                                    @else
                                        <option value="">Chọn Phường/Xã</option>
                                    @endif
                                </select>
                                @error('ward')
                                    <div class="invalid-feedback" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            @if (!session()->has('user') || (session()->has('user') && !session()->get('user')['password']))
                                <div class="container">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="showInput">
                                        <label class="custom-control-label" for="showInput">Tạo tài khoản mới?</label>
                                    </div>

                                    <div class="input-group mt-3" style="display: none">
                                        <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
                                    </div>
                                </div>
                            @endif
                        </div>
                        @csrf
                        <h5 class="mt-4">Hình thức thanh toán</h5>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom">
                            <button type="submit" name="payment_method"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary"
                                value="vnpay">Thanh toán qua
                                Vnpay</button>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit" name="payment_method"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary"
                                value="cod">Thanh toán khi nhận
                                hàng</button>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <h3 class="d-flex justify-content-between align-items-center mb-5">
                            <span>Giỏ hàng của bạn</span>
                            <span class="badge bg-primary badge-pill">{{ count(session()->get('cart')) }}</span>
                        </h3>
                        <ul class="list-group mb-3">
                            @php
                                $total = 0;
                            @endphp
                            @foreach (session()->get('cart') as $key => $cartItem)
                                @php $total += $cartItem['price'] * $cartItem['quantity']; @endphp
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{ $cartItem['name'] }}</h6>
                                        <small class="text-muted">Số lượng: {{ $cartItem['quantity'] }} X Giá:
                                            {{ number_format($cartItem['price']) }}<sup><small>đ</small></sup></small>
                                    </div>
                                    <span
                                        class="text-muted">{{ number_format($cartItem['price'] * $cartItem['quantity']) }}<sup><small>đ</small></sup></span>
                                </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between">
                                <strong>Tổng (VNĐ)</strong>
                                <strong>{{ number_format($total) }}<sup><small>đ</small></sup></strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#showInput').change(function() {
                if ($(this).is(':checked')) {
                    $('.input-group').slideDown();
                } else {
                    $('.input-group').slideUp();
                }
            });
        });
    </script>
@endsection
