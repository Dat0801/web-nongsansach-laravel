@extends('admin.shared.layout')
@section('title')
<title>{{ $title }}</title>
@endsection
@section('content')
<form class="d-flex" action="{{ route('user.index') }}" method="get">
    <div style="margin: 0 auto">
        <input class="form-control me-2" type="search" placeholder="Nhập tên khách hàng..." aria-label="Tìm kiếm khách hàng..."
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
            <a href="{{ route('user.create') }}"
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
                <th scope="col">Mã&nbsp;khách&nbsp;hàng</th>
                <th scope="col">Tên&nbsp;khách&nbsp;hàng</th>
                <th scope="col">Email</th>
                <th scope="col">Số&nbsp;điện&nbsp;thoại</th>
                <th scope="col" colspan="2">CRUD</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->user_id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>
                    <a href="{{ route('user.edit', ['user' => $user->user_id]) }}"
                        class="btn btn-sm btn-success material-symbols-outlined">edit</a>
                </td>
                <td>
                    <button class="btn btn-sm btn-danger btn-delete material-symbols-outlined" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-userid="{{ $user->user_id }}" data-username="{{ $user->name }}">delete</button>
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
                <h5 class="modal-title" id="exampleModalLabel" style="color:black">Xoá khách hàng</h5>
            </div>
            <div class="modal-body">
                <p style="color: red">Bạn có chắc muốn xoá khách hàng này không?</p>
                <table class="table table-user">
                    <tr>
                        <td>Mã khách hàng</td>
                        <td><span id="DeleteuserIDSpan"></span></td>
                    </tr>
                    <tr>
                        <td>Tên khách hàng</td>
                        <td><span id="DeleteuserNameSpan"></span></td>
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
        const userid = $(event.target).attr('data-userid');
        const username = $(event.target).attr('data-username');
        $('#DeleteuserIDSpan').html(userid);
        $('#DeleteuserNameSpan').html(username);

        let baseUrl = '{{ route("user.destroy", ["user" => ":id"]) }}';
        let deleteUrl = baseUrl.replace(':id', userid);

        $('#deleteForm').attr('action', deleteUrl);
    })
</script>
@endsection