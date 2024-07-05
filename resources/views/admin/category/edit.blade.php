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
<form action="{{ route('category.update', ['category' => $category->category_id]) }}" method="post">
    @method('PUT')
    <div class="row">
        <div style="margin: 0px 50px;" class="col">
            <label for="">Mã nhóm hàng</label>
            <input type="text" name="category_id" class="form-control" value="{{ $category->category_id }}" disabled/>
        </div>
        <div style="margin: 0px 50px;" class="col">
            <div>
                <label for="">Tên nhóm hàng</label>
                <input type="text" name="category_name" class="form-control" value="{{ old('category_name') ? old('category_name') : $category->category_name }}"  />
            </div>
            <br />
        </div>
    </div>
    @csrf
    <div>
        <center><button type="submit" class="btn  btn-lg btn-success material-symbols-outlined">edit</button>
        </center>
        <a href="{{ route('category.index') }}" style="margin: 0px 50px;"
            class="btn btn-lg btn-primary material-symbols-outlined">
            keyboard_return
        </a>
    </div>
</form>
@endsection
