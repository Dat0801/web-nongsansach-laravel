@extends('client.shared.layout')
@section('title', $title)
@section('content')

    <body>
        <div class="container hero-header">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block">
                                    <img src="{{ asset('') }}assets/client/img/banner-fruits.jpg"
                                        style="width: 100%; height: 100%">
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Đăng ký tài khoản mới tại đây!</h1>
                                        </div>
                                        <form class="user" method="post" action="{{ route('register.verifyUser') }}">
                                            <div class="form-group row mb-4">
                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                    <input type="text" name="name"
                                                        class="form-control form-control-user" id="name"
                                                        placeholder="Nhập họ tên của bạn" value="{{ old('name') }}">
                                                    @error('name')
                                                        <div class="invalid-feedback mx-2" style="display: block">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                    <input type="email" name="email"
                                                        class="form-control form-control-user" id="exampleInputEmail"
                                                        placeholder="Địa chỉ Email" value="{{ old('email') }}">
                                                    @error('email')
                                                        <div class="invalid-feedback mx-2" style="display: block">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <div class="col-sm-12">
                                                    <input type="text" name="phone_number"
                                                        class="form-control form-control-user" id="phone_number"
                                                        placeholder="Nhập số điện thoại" value="{{ old('phone_number') }}">
                                                    @error('phone_number')
                                                        <div class="invalid-feedback mx-2" style="display: block">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group mb-4">
                                                <select id="province" name="province" class="form-select">
                                                    <option value="">Chọn Tỉnh/Thành phố</option>
                                                </select>
                                                @error('province')
                                                    <div class="invalid-feedback mx-2" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group row mb-4">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <select id="district" name="district"
                                                        class="form-select form-control-user">
                                                        <option value="">Chọn Quận/Huyện</option>
                                                    </select>
                                                    @error('district')
                                                        <div class="invalid-feedback mx-2" style="display: block">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <select id="ward" name="ward" class="form-select"
                                                        style="background-color: #fff;">
                                                        <option value="">Chọn Phường/Xã</option>
                                                    </select>
                                                    @error('ward')
                                                        <div class="invalid-feedback mx-2" style="display: block">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group mb-4">
                                                <input type="text" name="address" class="form-control form-control-user"
                                                    id="DiaChi" placeholder="Địa chỉ nhận hàng"
                                                    value="{{ old('address') }}">
                                                @error('address')
                                                    <div class="invalid-feedback mx-2" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group row mb-4">
                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                    <input type="password" class="form-control form-control-user"
                                                        id="Password" name="password" placeholder="Mật khẩu"
                                                        value="">
                                                    @error('password')
                                                        <div class="invalid-feedback mx-2" style="display: block">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <div class="col-sm-12">
                                                    <input type="password" class="form-control form-control-user"
                                                        id="RepeatPassword" name="password_confirmation"
                                                        placeholder="Xác nhận mật khẩu">
                                                    @error('password_confirmation')
                                                        <div class="invalid-feedback mx-2" style="display: block">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-user btn-block form-control">
                                                Đăng Ký
                                            </button>
                                            <hr>
                                            <div class="text-center">
                                                <a class="small" href="{{ route('forgotPassword') }}">Bạn
                                                    đã
                                                    quên mật khẩu?</a>
                                            </div>
                                            <div class="text-center">
                                                <a class="small" href="{{ route('login') }}">Bạn đã có tài
                                                    khoản?</a>
                                            </div>
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
