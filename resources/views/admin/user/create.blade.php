@extends('admin.shared.layout')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('content')
    <center>
        <h2>{{ Str::upper($title) }}</h2>
    </center>
    <form action="{{ route('user.store') }}" method="post">
        <div class="row">
            <div style="margin: 0px 50px;" class="col">
                <div>
                    <label for="">Tên khách hàng</label>
                    <input type="text" name="name" class="form-control" />
                    @error('name')
                        <div class="invalid-feedback" style="display: block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <br />
                <div>
                    <label for="">Số điện thoại</label>
                    <input type="text" name="phone_number" class="form-control" />
                    @error('phone_number')
                        <div class="invalid-feedback" style="display: block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <br>
                <div>
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control" />
                    @error('email')
                        <div class="invalid-feedback" style="display: block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <br>
                <div>
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" />
                    @error('password')
                        <div class="invalid-feedback" style="display: block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <br>
            </div>
        </div>
        @csrf
        <div>
            <center><button type="submit" class="btn btn-lg btn-success material-symbols-outlined">add_circle </button>
            </center>
            <a href="{{ route('user.index') }}" style="margin: 0px 50px;"
                class="btn btn-lg btn-primary material-symbols-outlined">
                keyboard_return
            </a>
        </div>
    </form>
@endsection
