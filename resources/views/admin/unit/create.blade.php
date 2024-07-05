@extends('admin.shared.layout')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('content')
    <center>
        <h2>{{ Str::upper($title) }}</h2>
    </center>
    <form action="{{ route('unit.store') }}" method="post">
        <div class="row">
            <div style="margin: 0px 50px;" class="col">
                <div>
                    <label for="">Tên đơn vị</label>
                    <input type="text" name="unit_name" class="form-control" />
                    @error('unit_name')
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
            <a href="{{ route('unit.index') }}" style="margin: 0px 50px;"
                class="btn btn-lg btn-primary material-symbols-outlined">
                keyboard_return
            </a>
        </div>
    </form>
@endsection
