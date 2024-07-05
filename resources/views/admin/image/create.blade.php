@extends('admin.shared.layout')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('content')
    <center>
        <h2>{{ Str::upper($title) }}</h2>
    </center>
    <form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div style="margin: 0px 50px;" class="col">
                <div>
                    <label for="">Hàng hóa</label>
                    <select name="product_id" id="" class="form-select">
                        @foreach ($products as $product)
                            <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div>
                    <label class="form-label">Hình ảnh</label>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="image_name" name="image_name">
                        <label class="custom-file-label" for="image_name">Chọn hình ảnh</label>
                        @error('image_name')
                            <div class="invalid-feedback" style="display: block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>
                <br>
                <div>
                    <label for="">Loại ảnh</label>
                    <select name="is_primary" id="" class="form-select">
                        <option value="1">Ảnh chính</option>
                        <option value="0">Ảnh phụ</option>
                    </select>
                </div>
                <br>
            </div>
            @csrf
            <div>
                <center><button type="submit" class="btn btn-lg btn-success material-symbols-outlined">add_circle </button>
                </center>
                <a href="{{ route('image.index') }}" style="margin: 0px 50px;"
                    class="btn btn-lg btn-primary material-symbols-outlined">
                    keyboard_return
                </a>
            </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function handleFiles(inputId) {
                var inputElement = document.getElementById(inputId);
                var label = document.querySelector(`label[for="${inputId}"]`);

                inputElement.addEventListener('change', function(event) {
                    var files = event.target.files;
                    var fileNames = Array.from(files).map(file => file.name).join(', ');

                    label.textContent = fileNames || 'Chọn hình ảnh';
                });
            }

            handleFiles('image_name');
        });
    </script>
@endsection
