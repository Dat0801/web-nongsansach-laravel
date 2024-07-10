@extends('client.shared.layout')
@section('title', $title)
@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">{{ $title }}</h1>
    </div>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="{{ asset('') }}assets/client/img/banner-fruits.jpg"
                                    style="width: 100%; height: 100%">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Nhập mã xác nhận</h1>
                                    </div>
                                    <form action="{{ route('verify') }}" method="POST" class="user">
                                        <div class="form-group mb-4">
                                            <input type="text" class="form-control" aria-describedby=""
                                                placeholder="Nhập mã xác nhận thông qua mail" name="code">
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block form-control"
                                            style="margin: 0 auto">
                                            Gửi
                                        </button>
                                        @csrf
                                    </form>
                                    <div class="text-center mt-4">
                                        <p>Mã xác nhận đã được gửi tới email của bạn vui lòng kiểm tra và điền mã xác nhận!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
