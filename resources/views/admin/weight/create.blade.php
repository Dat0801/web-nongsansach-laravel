@extends('admin.shared.layout')
@section('title')
<title>{{ $title }}</title>
@endsection
@section('content')
<center>
    <h2>{{ Str::upper($title) }}</h2>
</center>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('weight.store') }}" method="post">
    <div class="row">
        <div style="margin: 0px 50px;" class="col">
            <div>
                <label for="">Tên đơn vị trọng lượng</label>
                <input type="text" name="weight_name" class="form-control" />
            </div>
            <br />
        </div>
    </div>
    @csrf
    <div>
        <center><button type="submit" class="btn btn-lg btn-success material-symbols-outlined">add_circle </button>
        </center>
        <a href="{{ route('weight.index') }}" style="margin: 0px 50px;"
            class="btn btn-lg btn-primary material-symbols-outlined">
            keyboard_return
        </a>
    </div>
</form>
@endsection