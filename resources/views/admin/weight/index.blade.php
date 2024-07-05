@extends('admin.shared.layout')
@section('title')
<title>{{ $title }}</title>
@endsection
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-pzjw8s+ekmvplp5f/ZxXnDQbcz0S7bJr6W2kcoFVGLsRakET4Qc5I2tG4LDA2tB" crossorigin="anonymous">
<form class="d-flex" action="{{ route('weight.index') }}" method="get">
    <div style="margin: 0 auto">
        <input class="form-control me-2" type="search" placeholder="Nhập tên đơn vị trọng lượng..." aria-label="Tìm kiếm đơn vị trọng lượng..."
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
<div class="container">
    <div class="row">
        <div class="col-md-12 my-3">
            <a href="{{ route('weight.create') }}"
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
                <th scope="col">Mã&nbsp;đơn&nbsp;vị&nbsp;trọng&nbsp;lượng</th>
                <th scope="col">Tên&nbsp;đơn&nbsp;vị&nbsp;trọng&nbsp;lượng</th>
                <th scope="col" colspan="2">CRUD</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weights as $weight)
            <tr>
                <td>{{ $weight->weight_id }}</td>
                <td>{{ $weight->weight_name }}</td>
                <td>
                    <a href="{{ route('weight.edit', ['weight' => $weight->weight_id]) }}"
                        class="btn btn-sm btn-success  material-symbols-outlined">edit</a>
                </td>
                <td>
                    <button class="btn btn-sm btn-danger btn-delete material-symbols-outlined" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-weightid="{{ $weight->weight_id }}" data-weightname="{{ $weight->weight_name }}">delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Xử lý phân trang -->

<!-- Xử lý nút delete -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color:black">Xoá đơn vị trọng lượng hàng hoá</h5>
            </div>
            <div class="modal-body">
                <p style="color: red">Bạn có chắc muốn xoá đơn vị trọng lượng hàng này không?</p>
                <table class="table table-weight">
                    <tr>
                        <td>Mã đơn vị trọng lượng</td>
                        <td><span id="DeleteweightIDSpan"></span></td>
                    </tr>
                    <tr>
                        <td>Tên đơn vị trọng lượng</td>
                        <td><span id="DeleteweightNameSpan"></span></td>
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
        const weightid = $(event.target).attr('data-weightid');
        const weightname = $(event.target).attr('data-weightname');
        $('#DeleteweightIDSpan').html(weightid);
        $('#DeleteweightNameSpan').html(weightname);

        let baseUrl = '{{ route("weight.destroy", ["weight" => ":id"]) }}';
        let deleteUrl = baseUrl.replace(':id', weightid);

        $('#deleteForm').attr('action', deleteUrl);
    })
</script>
@endsection