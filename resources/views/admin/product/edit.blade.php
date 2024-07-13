@extends('admin.shared.layout')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('content')
    <center>
        <h2>{{ Str::upper($title) }}</h2>
    </center>
    <form action="{{ route('admin.product.update', ['product' => $product->product_id]) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        <div class="row">
            <div style="margin: 0px 50px;" class="col">
                <div>
                    <label for="">Tên hàng hóa</label>
                    <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" />
                    @error('product_name')
                        <div class="invalid-feedback" style="display: block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <br />
                <div>
                    <label for="">Nhóm hàng</label>
                    <select name="category_id" id="" class="form-select">
                        @foreach ($categories as $category)
                            @if ($category->category_id == $product->category_id)
                                <option value="{{ $category->category_id }}" selected>{{ $category->category_name }}
                                </option>
                            @else
                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <br>
                <div>
                    <label for="">Đơn vị tính</label>
                    <select name="unit_id" id="" class="form-select">
                        @foreach ($units as $unit)
                            @if ($unit->unit_id == $product->unit_id)
                                <option value="{{ $unit->unit_id }}" selected>{{ $unit->unit_name }}</option>
                            @else
                                <option value="{{ $unit->unit_id }}">{{ $unit->unit_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <br>
                <div>
                    <!-- Primary Image Input -->
                    <div>
                        <label class="form-label">Hình ảnh đại diện</label>
                        <div class="custom-file mb-3">
                            @php
                                $primaryImage = $images
                                    ->where('product_id', $product->product_id)
                                    ->where('is_primary', 1)
                                    ->pluck('image_name')
                                    ->first();
                            @endphp
                            <input type="file" class="custom-file-input" id="primaryImage" name="primary_img_name">
                            <label class="custom-file-label"
                                for="primaryImage">{{ $primaryImage ?: 'Chọn hình ảnh' }}</label>
                        </div>
                    </div>
                    <br>
                    <!-- Secondary Images Input -->
                    <div>
                        <label class="form-label">Hình ảnh phụ</label>
                        <div class="custom-file mb-3">
                            @php
                                $secondaryImages = $images
                                    ->where('product_id', $product->product_id)
                                    ->where('is_primary', 0)
                                    ->pluck('image_name')
                                    ->join(', ');
                            @endphp
                            <input type="file" multiple class="custom-file-input" id="secondaryImages" name="secondary_img_name[]">
                            <label class="custom-file-label"
                                for="secondaryImages">{{ $secondaryImages ?: 'Chọn hình ảnh' }}</label>
                        </div>
                        <a href="{{ route('image.index') }}" class="btn btn-md btn-danger"> Xóa 1 hình ảnh
                        </a>
                        <a href="{{ route('image.create') }}" class="btn btn-md btn-success"> Thêm 1 hình ảnh
                        </a>
                    </div>
                </div>
            </div>
            <div style="margin: 0px 50px;" class="col">
                <div>
                    <label for="">Trọng lượng</label>
                    <input type="text" name="product_quantity" class="form-control"
                        value="{{ $product->product_quantity }}" />
                    @error('product_quantity')
                        <div class="invalid-feedback" style="display: block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <br />
                <div>
                    <label for="">Đơn vị trọng lượng</label>
                    <select name="weight_id" id="" class="form-select">
                        @foreach ($weights as $weight)
                            @if ($weight->weight_id == $product->weight_id)
                                <option value="{{ $weight->weight_id }}" selected>{{ $weight->weight_name }}</option>
                            @else
                                <option value="{{ $weight->weight_id }}">{{ $weight->weight_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <br>
                <div>
                    <label for="">Giá bán</label>
                    <input type="text" name="product_price" class="form-control"
                        value="{{ $product->product_price }}" />
                    @error('product_price')
                        <div class="invalid-feedback" style="display: block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <br>
                <div>
                    <label for="">Số lượng tồn</label>
                    <input type="text" name="product_stock" class="form-control"
                        value="{{ $product->product_stock }}" />
                    @error('product_stock')
                        <div class="invalid-feedback" style="display: block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>
            @csrf
            <div>
                <center><button type="submit" class="btn btn-lg btn-success material-symbols-outlined">add_circle
                    </button>
                </center>
                <a href="{{ route('admin.product.index') }}" style="margin: 0px 50px;"
                    class="btn btn-lg btn-primary material-symbols-outlined">
                    keyboard_return
                </a>
            </div>
        </div>
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

            handleFiles('primaryImage');
            handleFiles('secondaryImages');
        });
    </script>
@endsection
