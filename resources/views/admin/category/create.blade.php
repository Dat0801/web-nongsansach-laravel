@extends('admin.shared.layout')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('content')
    <center>
        <h2>{{ Str::upper($title) }}</h2>
    </center>
    <form action="{{ route('category.store') }}" method="post">
        <div class="row">
            <div style="margin: 0px 50px;" class="col">
                <div>
                    <label for="">Tên nhóm hàng</label>
                    <input type="text" name="category_name" class="form-control" />
                    @error('category_name')
                        <div class="invalid-feedback" style="display: block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <br />
            </div>
        </div>
        @csrf
        <div>
            <center><button type="submit" class="btn btn-lg btn-success material-symbols-outlined">add_circle </button>
            </center>
            <a href="{{ route('category.index') }}" style="margin: 0px 50px;"
                class="btn btn-lg btn-primary material-symbols-outlined">
                keyboard_return
            </a>
        </div>
    </form>
@endsection
