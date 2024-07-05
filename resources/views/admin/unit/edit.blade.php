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
<form action="{{ route('unit.update', ['unit' => $unit->unit_id]) }}" method="post">
    @method('PUT')
    <div class="row">
        <div style="margin: 0px 50px;" class="col">
            <label for="">Mã đơn vị</label>
            <input type="text" name="unit_id" class="form-control" value="{{ $unit->unit_id }}" disabled/>
        </div>
        <div style="margin: 0px 50px;" class="col">
            <div>
                <label for="">Tên đơn vị</label>
                <input type="text" name="unit_name" class="form-control" value="{{ old('unit_name') ? old('unit_name') : $unit->unit_name }}"  />
            </div>
            <br />
        </div>
    </div>
    @csrf
    <div>
        <center><button type="submit" class="btn  btn-lg btn-success material-symbols-outlined">edit</button>
        </center>
        <a href="{{ route('unit.index') }}" style="margin: 0px 50px;"
            class="btn btn-lg btn-primary material-symbols-outlined">
            keyboard_return
        </a>
    </div>
</form>
@endsection
