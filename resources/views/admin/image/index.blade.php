@extends('admin.shared.layout')
@section('title')
<title>{{ $title }}</title>
@endsection
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-pzjw8s+ekmvplp5f/ZxXnDQbcz0S7bJr6W2kcoFVGLsRakET4Qc5I2tG4LDA2tB" crossorigin="anonymous">
<form class="d-flex" action="{{ route('image.index') }}" method="get">
    <div style="margin: 0 auto">
        <input class="form-control me-2" type="search" placeholder="Nhập tên hình ảnh..." aria-label="Tìm kiếm hình ảnh..."
            style="width:400px; margin: 0 auto" name="searchStr" id="searchStr">
        <center>
            <button class="btn btn-outline-success m-2" type="submit">Tìm kiếm</button>
        </center>
    </div>
</form>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-12 my-3">
            <a href="{{ route('image.create') }}"
                class="btn btn-success material-symbols-outlined">
                add_circle
            </a>
        </div>
    </div>
</div>
<div class="table-responsive container">
    <table class="table table-secondary table-bordered"
        style="text-align: center; border-radius: 10px; overflow: hidden;color:black">
        <thead>
            <tr>
                <th scope="col">Mã&nbsp;hình&nbsp;ảnh</th>
                <th scope="col">Tên&nbsp;hình&nbsp;ảnh</th>
                <th scope="col">Hình&nbsp;ảnh</th>
                <th scope="col">Tên&nbsp;sản&nbsp;phẩm</th>
                <th scope="col">Ảnh&nbsp;chính</th>
                <th scope="col" colspan="2">CRUD</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images as $image)
            <tr>
                <td>{{ $image->image_id }}</td>
                <td>{{ $image->image_name }}</td>
                <td><img src="{{ asset('assets/client/img/products'). '/'. $image->image_name }}" alt="" style="width: 50px;"></td>
                <td>{{ $image->product_name }}</td>
                <td>{{ $image->is_primary}}</td>
                <td>
                    <a href="{{ route('image.edit', ['image' => $image->image_id]) }}"
                        class="btn btn-sm btn-success  material-symbols-outlined">edit</a>
                </td>
                <td>
                    <button class="btn btn-sm btn-danger btn-delete material-symbols-outlined" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-imageid="{{ $image->image_id }}" data-imagename="{{ $image->image_name }}">delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination justify-content-center">
        {{ $images->onEachSide(1)->links() }}
    </div>
</div>

<!-- Xử lý phân trang -->

<!-- Xử lý nút delete -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color:black">Xoá hình ảnh hàng hoá</h5>
            </div>
            <div class="modal-body">
                <p style="color: red">Bạn có chắc muốn xoá hình ảnh hàng này không?</p>
                <table class="table table-image">
                    <tr>
                        <td>Mã hình ảnh</td>
                        <td><span id="DeleteimageIDSpan"></span></td>
                    </tr>
                    <tr>
                        <td>Tên hình ảnh</td>
                        <td><span id="DeleteimageNameSpan"></span></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <form action="" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.btn-delete').click((event) => {
        const imageid = $(event.target).attr('data-imageid');
        const imagename = $(event.target).attr('data-imagename');
        $('#DeleteimageIDSpan').html(imageid);
        $('#DeleteimageNameSpan').html(imagename);

        let baseUrl = '{{ route("image.destroy", ["image" => ":id"]) }}';
        let deleteUrl = baseUrl.replace(':id', imageid);

        $('#deleteForm').attr('action', deleteUrl);
    })
</script>
@endsection