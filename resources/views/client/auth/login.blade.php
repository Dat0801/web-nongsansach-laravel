@extends('client.shared.layout')
@section('title', '{{ $title }}')
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
                                            <h1 class="h4 text-gray-900 mb-4">Chào mừng bạn trở lại!</h1>
                                        </div>
                                        @if (Session::has('error'))
                                            <div class="alert alert-danger">
                                                {{ Session::get('error') }}
                                            </div>
                                        @endif
                                        <form action="{{ route('login.store') }}" method="POST" class="user">
                                            <div class="form-group mb-4">
                                                <input type="text" class="form-control" id="exampleInputEmail"
                                                    aria-describedby="emailHelp" placeholder="Nhập email" name="email" value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="invalid-feedback mx-2" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                <input type="password" class="form-control form-control-user"
                                                    id="exampleInputPassword" placeholder="Nhập mật khẩu" name="password">
                                                @error('password')
                                                    <div class="invalid-feedback mx-2" style="display: block">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block form-control">
                                                Đăng nhập
                                            </button>
                                            @csrf
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="{{ route('forgot-password') }}">Bạn đã
                                                quên mật khẩu?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="{{ route('register') }}">Tạo tài khoản
                                                mới tại đây!</a>
                                        </div>
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
{{-- </html> --}}
